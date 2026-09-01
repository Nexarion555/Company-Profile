<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\CompanySetting;
use App\Models\Message;
use App\Services\DynamicMailer;
use App\Services\EmailTemplateService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function storeMessage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'phone' => 'required|string|max:40',
            'service' => 'nullable|string|max:120',
            'budget' => 'nullable|string|max:120',
            'detail' => 'required|string|max:5000',
        ]);

        $subject = 'Permintaan '.($data['service'] ?: 'Konsultasi');
        $parts = ['Telepon: '.$data['phone']];

        if (!empty($data['service'])) {
            $parts[] = 'Layanan: '.$data['service'];
        }

        if (!empty($data['budget'])) {
            $parts[] = 'Anggaran: '.$data['budget'];
        }

        $parts[] = 'Detail: '.$data['detail'];

        $message = Message::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $subject,
            'msg' => implode("\n", $parts),
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Pesan berhasil dikirim.',
            'id' => $message->id,
        ], 201);
    }

    public function storeAppointment(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:40',
            'email' => 'required|email|max:160',
            'type' => 'required|string|max:120',
            'date' => 'required|date|after_or_equal:today',
            'time' => ['required', 'regex:/^(08|09|10|11|13|14|15|16):00$/'],
            'notes' => 'nullable|string|max:2000',
        ]);

        $exists = Appointment::query()
            ->whereDate('date', $data['date'])
            ->where('time', $data['time'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Jadwal tersebut baru saja terisi. Silakan pilih waktu lain.',
            ], 422);
        }

        try {
            $appointment = Appointment::create($data + [
                'status' => 'pending',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Jadwal tersebut baru saja terisi. Silakan pilih waktu lain.',
            ], 422);
        }

        $receiptMailSent = false;

        try {
            $settings = CompanySetting::current();
            $company = $settings->publicData();
            $templates = app(EmailTemplateService::class);

            $subject = $templates->renderAppointmentTemplate(
                'mail_received_subject',
                $appointment,
                $settings,
                $company
            );

            $body = $templates->renderAppointmentTemplate(
                'mail_received_body',
                $appointment,
                $settings,
                $company
            );

            app(DynamicMailer::class)->sendRaw(
                $appointment->email,
                $subject,
                $body
            );

            $receiptMailSent = true;
        } catch (\Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => 'Jadwal berhasil dikirim dan menunggu validasi admin.',
            'id' => $appointment->id,
            'receipt_mail_sent' => $receiptMailSent,
        ], 201);
    }
}
