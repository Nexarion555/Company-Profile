<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentStatusMail;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Certification;
use App\Models\CompanySetting;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Services\DynamicMailer;
use App\Services\EmailTemplateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin', [
            'authenticated' => (bool) $request->session()->get('admin_authenticated'),
            'branding' => CompanySetting::current()->publicData(),
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'login' => 'nullable|string|max:180',
            'email' => 'nullable|string|max:180',
            'password' => 'required|string',
        ]);

        $login = trim((string) ($data['login'] ?? $data['email'] ?? ''));

        if ($login === '') {
            throw ValidationException::withMessages([
                'login' => 'Email atau username wajib diisi.',
            ]);
        }

        $admin = Admin::query()
            ->where('email', $login)
            ->orWhere('username', $login)
            ->first();

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return response()->json([
                'message' => 'Email/username atau password salah.',
            ], 422);
        }

        $request->session()->regenerate();
        $request->session()->put([
            'admin_authenticated' => true,
            'admin_id' => $admin->id,
        ]);

        return response()->json([
            'message' => 'Login berhasil.',
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->session()->forget([
            'admin_authenticated',
            'admin_id',
        ]);
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }

    public function data(Request $request): JsonResponse
    {
        $portfolios = Portfolio::query()
            ->with('service:id,title,is_active')
            ->orderBy('display_order')
            ->orderByDesc('updated_at')
            ->get()
            ->map(fn ($p) => [
                'id' => $p->id,
                'title' => $p->title,
                'client' => $p->client,
                'service_id' => $p->service_id,
                'category' => $p->categoryLabel(),
                'service_active' => $p->service ? (bool) $p->service->is_active : null,
                'year' => $p->year ? (string) $p->year : '',
                'location' => $p->location,
                'area' => $p->area,
                'description' => $p->description,
                'image' => $p->image,
                'display_order' => (int) $p->display_order,
                'is_active' => (bool) $p->is_active,
                'updated' => $p->updated_at->format('d M Y'),
            ]);

        $certifications = Certification::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get()
            ->map(fn ($certification) => [
                'id' => $certification->id,
                'name' => $certification->name,
                'issuer' => $certification->issuer,
                'certificate_number' => $certification->certificate_number,
                'issued_year' => $certification->issued_year,
                'display_order' => $certification->display_order,
                'description' => $certification->description,
                'file_path' => $certification->file_path,
                'file_type' => $certification->file_type,
                'file_name' => $certification->file_name,
                'file_url' => $certification->file_path
                    ? Storage::disk('public')->url($certification->file_path)
                    : null,
            ]);

        $appointments = Appointment::orderByDesc('date')
            ->orderByDesc('time')
            ->get()
            ->map(fn ($a) => [
                'id' => $a->id,
                'name' => $a->name,
                'phone' => $a->phone,
                'email' => $a->email,
                'type' => $a->type,
                'date' => $a->date->format('Y-m-d'),
                'time' => substr($a->time, 0, 5),
                'notes' => $a->notes,
                'admin_note' => $a->admin_note,
                'status' => $a->status,
                'notification_sent_at' => $a->notification_sent_at?->format('Y-m-d H:i:s'),
                'notified_status' => $a->notified_status,
                'email_notified' => $a->notification_sent_at !== null && $a->notified_status === $a->status,
            ]);

        $messages = Message::latest()->get()->map(function ($m) {
            $legacyPhone = null;
            $legacyService = null;
            $legacyBudget = null;
            $legacyDetail = null;

            if (!$m->phone && preg_match('/^Telepon:\s*(.+)$/mi', (string) $m->msg, $match)) {
                $legacyPhone = trim($match[1]);
            }
            if (!$m->service && preg_match('/^Layanan:\s*(.+)$/mi', (string) $m->msg, $match)) {
                $legacyService = trim($match[1]);
            }
            if (!$m->budget && preg_match('/^Anggaran:\s*(.+)$/mi', (string) $m->msg, $match)) {
                $legacyBudget = trim($match[1]);
            }
            if (!$m->detail && preg_match('/^Detail:\s*(.+)$/mis', (string) $m->msg, $match)) {
                $legacyDetail = trim($match[1]);
            }

            return [
                'id' => $m->id,
                'name' => $m->name,
                'email' => $m->email,
                'phone' => $m->phone ?: $legacyPhone,
                'service' => $m->service ?: $legacyService,
                'budget' => $m->budget ?: $legacyBudget,
                'detail' => $m->detail ?: $legacyDetail ?: $m->msg,
                'subject' => $m->subject,
                'msg' => $m->msg,
                'date' => $m->created_at->format('Y-m-d H:i'),
                'read' => (bool) $m->is_read,
            ];
        });

        $team = TeamMember::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get()
            ->map(fn ($t) => [
                'id' => $t->id,
                'name' => $t->name,
                'role' => $t->role,
                'email' => $t->email,
                'phone' => $t->phone,
                'img' => $t->img,
                'bio' => $t->bio,
                'linkedin_url' => $t->linkedin_url,
                'display_order' => $t->display_order,
                'is_active' => (bool) $t->is_active,
            ]);

        $services = Service::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get()
            ->map(fn ($service) => [
                'id' => $service->id,
                'title' => $service->title,
                'description' => $service->description,
                'icon' => $service->icon,
                'image_path' => $service->image_path,
                'image_url' => $service->imageUrl(),
                'features' => array_values($service->features ?: []),
                'display_order' => $service->display_order,
                'is_active' => (bool) $service->is_active,
            ]);


        $testimonials = Testimonial::query()
            ->with('service:id,title')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 WHEN status = 'published' THEN 1 ELSE 2 END")
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn ($testimonial) => [
                'id' => $testimonial->id,
                'name' => $testimonial->name,
                'email' => $testimonial->email,
                'phone' => $testimonial->phone,
                'company' => $testimonial->company,
                'position' => $testimonial->position,
                'service_id' => $testimonial->service_id,
                'service' => $testimonial->service?->title,
                'rating' => (int) $testimonial->rating,
                'testimonial' => $testimonial->testimonial,
                'status' => $testimonial->status,
                'display_order' => (int) $testimonial->display_order,
                'created_at' => $testimonial->created_at?->format('Y-m-d H:i'),
            ]);

        $s = CompanySetting::current();
        $admin = Admin::find($request->session()->get('admin_id'));

        return response()->json([
            'portfolios' => $portfolios,
            'certifications' => $certifications,
            'appointments' => $appointments,
            'messages' => $messages,
            'team' => $team,
            'services' => $services,
            'testimonials' => $testimonials,
            'settings' => array_merge($s->publicData(), $s->mailAdminData()),
            'account' => $admin ? [
                'id' => $admin->id,
                'name' => $admin->name,
                'username' => $admin->username,
                'email' => $admin->email,
                'created_at' => $admin->created_at?->format('d M Y H:i'),
                'updated_at' => $admin->updated_at?->format('d M Y H:i'),
            ] : null,
        ]);
    }

    public function updateAccount(Request $request): JsonResponse
    {
        $admin = Admin::find($request->session()->get('admin_id'));

        if (!$admin) {
            return response()->json([
                'message' => 'Akun admin tidak ditemukan. Silakan login kembali.',
            ], 401);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z0-9._-]+$/',
                Rule::unique('admins', 'username')->ignore($admin->id),
            ],
            'email' => [
                'required',
                'email',
                'max:180',
                Rule::unique('admins', 'email')->ignore($admin->id),
            ],
            'current_password' => ['required', 'string'],
            'new_password' => ['nullable', 'string', 'min:8', 'max:255', 'confirmed'],
        ], [
            'username.regex' => 'Username hanya boleh berisi huruf, angka, titik, garis bawah, atau tanda minus.',
            'username.unique' => 'Username tersebut sudah digunakan.',
            'email.unique' => 'Email tersebut sudah digunakan.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sama.',
        ]);

        if (!Hash::check($data['current_password'], $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password saat ini tidak sesuai.',
            ]);
        }

        $admin->name = trim($data['name']);
        $admin->username = trim($data['username']);
        $admin->email = strtolower(trim($data['email']));

        if (!empty($data['new_password'])) {
            $admin->password = Hash::make($data['new_password']);
        }

        $admin->save();

        $request->session()->regenerate();
        $request->session()->put([
            'admin_authenticated' => true,
            'admin_id' => $admin->id,
        ]);

        return response()->json([
            'message' => !empty($data['new_password'])
                ? 'Akun admin dan password berhasil diperbarui.'
                : 'Akun admin berhasil diperbarui.',
            'account' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'username' => $admin->username,
                'email' => $admin->email,
                'created_at' => $admin->created_at?->format('d M Y H:i'),
                'updated_at' => $admin->updated_at?->format('d M Y H:i'),
            ],
        ]);
    }

    private function portfolioValidated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:180',
            'client' => 'nullable|string|max:180',
            'service_id' => 'required|integer|exists:services,id',
            'year' => 'nullable|integer|min:1900|max:2100',
            'location' => 'nullable|string|max:180',
            'area' => 'nullable|string|max:80',
            'description' => 'required|string|max:5000',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'required|boolean',
            'portfolio_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);
    }

    private function portfolioImageUrl(Request $request, ?string $currentImage = null): string
    {
        if ($request->hasFile('portfolio_image')) {
            if ($currentImage) {
                $this->deletePortfolioImage($currentImage);
            }

            $path = $request->file('portfolio_image')->store('portfolios', 'public');

            return Storage::disk('public')->url($path);
        }

        if ($currentImage) {
            return $currentImage;
        }

        throw ValidationException::withMessages([
            'portfolio_image' => 'Foto portfolio wajib diunggah.',
        ]);
    }

    private function deletePortfolioImage(?string $image): void
    {
        if (!$image) {
            return;
        }

        $path = parse_url($image, PHP_URL_PATH) ?: $image;
        $marker = '/storage/';
        $position = strpos($path, $marker);

        if ($position === false) {
            return;
        }

        $relativePath = ltrim(substr($path, $position + strlen($marker)), '/');

        if (str_starts_with($relativePath, 'portfolios/')) {
            Storage::disk('public')->delete($relativePath);
        }
    }

    public function storePortfolio(Request $request): JsonResponse
    {
        $data = $this->portfolioValidated($request);
        unset($data['portfolio_image']);

        $service = Service::findOrFail($data['service_id']);
        $data['category'] = $service->title; // Disimpan juga untuk kompatibilitas data lama.
        $data['display_order'] = $data['display_order'] ?? 0;
        $data['is_active'] = (bool) $data['is_active'];
        $data['image'] = $this->portfolioImageUrl($request);

        $portfolio = Portfolio::create($data);

        return response()->json([
            'message' => 'Portfolio ditambahkan.',
            'id' => $portfolio->id,
        ], 201);
    }

    public function updatePortfolio(Request $request, Portfolio $portfolio): JsonResponse
    {
        $data = $this->portfolioValidated($request);
        unset($data['portfolio_image']);

        $service = Service::findOrFail($data['service_id']);
        $data['category'] = $service->title; // Nama kategori selalu mengikuti layanan terpilih.
        $data['display_order'] = $data['display_order'] ?? 0;
        $data['is_active'] = (bool) $data['is_active'];
        $data['image'] = $this->portfolioImageUrl($request, $portfolio->image);

        $portfolio->update($data);

        return response()->json([
            'message' => 'Portfolio diperbarui.',
        ]);
    }

    public function destroyPortfolio(Portfolio $portfolio): JsonResponse
    {
        $this->deletePortfolioImage($portfolio->image);
        $portfolio->delete();

        return response()->json([
            'message' => 'Portfolio dihapus.',
        ]);
    }

    private function certificationValidated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:180',
            'issuer' => 'nullable|string|max:180',
            'certificate_number' => 'nullable|string|max:180',
            'issued_year' => 'nullable|integer|min:1900|max:2100',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'description' => 'nullable|string|max:3000',
            'certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'remove_file' => 'nullable|boolean',
        ]);
    }

    public function storeCertification(Request $request): JsonResponse
    {
        $data = $this->certificationValidated($request);
        $data['display_order'] = $data['display_order'] ?? 0;

        unset($data['certificate_file'], $data['remove_file']);

        if ($request->hasFile('certificate_file')) {
            $file = $request->file('certificate_file');

            $data['file_path'] = $file->store('certifications', 'public');
            $data['file_type'] = $file->getClientMimeType();
            $data['file_name'] = $file->getClientOriginalName();
        }

        $certification = Certification::create($data);

        return response()->json([
            'message' => 'Sertifikasi ditambahkan.',
            'id' => $certification->id,
        ], 201);
    }

    public function updateCertification(Request $request, Certification $certification): JsonResponse
    {
        $data = $this->certificationValidated($request);
        $data['display_order'] = $data['display_order'] ?? 0;

        $removeFile = $request->boolean('remove_file');

        unset($data['certificate_file'], $data['remove_file']);

        if ($request->hasFile('certificate_file')) {
            if ($certification->file_path) {
                Storage::disk('public')->delete($certification->file_path);
            }

            $file = $request->file('certificate_file');

            $data['file_path'] = $file->store('certifications', 'public');
            $data['file_type'] = $file->getClientMimeType();
            $data['file_name'] = $file->getClientOriginalName();
        } elseif ($removeFile) {
            if ($certification->file_path) {
                Storage::disk('public')->delete($certification->file_path);
            }

            $data['file_path'] = null;
            $data['file_type'] = null;
            $data['file_name'] = null;
        }

        $certification->update($data);

        return response()->json([
            'message' => 'Sertifikasi diperbarui.',
        ]);
    }

    public function destroyCertification(Certification $certification): JsonResponse
    {
        if ($certification->file_path) {
            Storage::disk('public')->delete($certification->file_path);
        }

        $certification->delete();

        return response()->json([
            'message' => 'Sertifikasi dihapus.',
        ]);
    }

    private function teamValidated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:180',
            'role' => 'required|string|max:180',
            'email' => 'nullable|email|max:180',
            'phone' => 'nullable|string|max:50',
            'bio' => 'nullable|string|max:3000',
            'linkedin_url' => 'nullable|url|max:1000',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'required|boolean',
            'member_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'remove_image' => 'nullable|boolean',
        ]);
    }

    private function teamImageUrl(Request $request, ?string $currentImage = null): ?string
    {
        if ($request->hasFile('member_image')) {
            if ($currentImage) {
                $this->deleteTeamImage($currentImage);
            }

            $path = $request->file('member_image')->store('team', 'public');

            return Storage::disk('public')->url($path);
        }

        if ($request->boolean('remove_image')) {
            if ($currentImage) {
                $this->deleteTeamImage($currentImage);
            }

            return null;
        }

        return $currentImage;
    }

    private function deleteTeamImage(?string $image): void
    {
        if (!$image) {
            return;
        }

        $path = parse_url($image, PHP_URL_PATH) ?: $image;
        $marker = '/storage/';
        $position = strpos($path, $marker);

        if ($position === false) {
            return;
        }

        $relativePath = ltrim(substr($path, $position + strlen($marker)), '/');

        if (str_starts_with($relativePath, 'team/')) {
            Storage::disk('public')->delete($relativePath);
        }
    }

    public function storeTeamMember(Request $request): JsonResponse
    {
        $data = $this->teamValidated($request);
        unset($data['member_image'], $data['remove_image']);

        $data['display_order'] = $data['display_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['img'] = $this->teamImageUrl($request);

        $member = TeamMember::create($data);

        return response()->json([
            'message' => 'Anggota tim berhasil ditambahkan.',
            'id' => $member->id,
        ], 201);
    }

    public function updateTeamMember(Request $request, TeamMember $teamMember): JsonResponse
    {
        $data = $this->teamValidated($request);
        unset($data['member_image'], $data['remove_image']);

        $data['display_order'] = $data['display_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['img'] = $this->teamImageUrl($request, $teamMember->img);

        $teamMember->update($data);

        return response()->json([
            'message' => 'Anggota tim berhasil diperbarui.',
        ]);
    }

    public function destroyTeamMember(TeamMember $teamMember): JsonResponse
    {
        $this->deleteTeamImage($teamMember->img);
        $teamMember->delete();

        return response()->json([
            'message' => 'Anggota tim berhasil dihapus.',
        ]);
    }

    public function updateAppointmentStatus(Request $request, Appointment $appointment): JsonResponse
    {
        $data = $request->validate([
            'status' => [
                'required',
                Rule::in(['pending', 'confirmed', 'done', 'cancelled']),
            ],
            'admin_note' => 'nullable|string|max:2000',
        ]);

        $status = $data['status'];
        $adminNote = array_key_exists('admin_note', $data)
            ? trim((string) $data['admin_note'])
            : $appointment->admin_note;

        if ($status === 'cancelled' && $adminNote === '') {
            return response()->json([
                'message' => 'Alasan pembatalan wajib diisi agar dapat diinformasikan kepada user.',
            ], 422);
        }

        $update = [
            'status' => $status,
            'admin_note' => $adminNote === '' ? null : $adminNote,
        ];

        if (in_array($status, ['confirmed', 'cancelled'], true)) {
            $update['notification_sent_at'] = null;
            $update['notified_status'] = null;
        }

        $appointment->update($update);
        $appointment->refresh();

        if (!in_array($status, ['confirmed', 'cancelled'], true)) {
            return response()->json([
                'message' => 'Status jadwal berhasil diperbarui.',
                'mail_sent' => null,
            ]);
        }

        return $this->sendAppointmentStatusEmail($appointment);
    }

    public function resendAppointmentEmail(Appointment $appointment): JsonResponse
    {
        if (!in_array($appointment->status, ['confirmed', 'cancelled'], true)) {
            return response()->json([
                'message' => 'Email hanya dapat dikirim untuk jadwal yang sudah dikonfirmasi atau dibatalkan.',
            ], 422);
        }

        return $this->sendAppointmentStatusEmail($appointment, true);
    }

    private function sendAppointmentStatusEmail(Appointment $appointment, bool $resend = false): JsonResponse
    {
        try {
            $settings = CompanySetting::current();
            $company = $settings->publicData();
            $templates = app(EmailTemplateService::class);
            $prefix = $appointment->status === 'confirmed' ? 'mail_confirmed' : 'mail_cancelled';

            $subject = $templates->renderAppointmentTemplate(
                $prefix.'_subject',
                $appointment,
                $settings,
                $company
            );
            $body = $templates->renderAppointmentTemplate(
                $prefix.'_body',
                $appointment,
                $settings,
                $company
            );

            app(DynamicMailer::class)->sendMailable(
                $appointment->email,
                new AppointmentStatusMail($appointment, $company, $subject, $body)
            );

            $appointment->update([
                'notification_sent_at' => now(),
                'notified_status' => $appointment->status,
            ]);

            return response()->json([
                'message' => $resend
                    ? 'Email informasi berhasil dikirim ulang ke '.$appointment->email.'.'
                    : 'Status berhasil diperbarui dan email informasi telah dikirim ke '.$appointment->email.'.',
                'mail_sent' => true,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Status jadwal sudah tersimpan, tetapi email belum berhasil dikirim: '.$this->mailErrorMessage($e),
                'mail_sent' => false,
            ]);
        }
    }

    public function markMessageRead(Message $message): JsonResponse
    {
        $message->update([
            'is_read' => true,
        ]);

        return response()->json([
            'message' => 'Pesan ditandai dibaca.',
        ]);
    }

    private function serviceValidated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:180',
            'description' => 'required|string|max:5000',
            'icon' => 'required|string|max:120',
            'features' => 'required|array|min:1|max:20',
            'features.*' => 'required|string|max:500',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'required|boolean',
            'service_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'remove_image' => 'nullable|boolean',
        ]);
    }

    public function storeService(Request $request): JsonResponse
    {
        $data = $this->serviceValidated($request);
        unset($data['service_image'], $data['remove_image']);
        $data['display_order'] = $data['display_order'] ?? 0;

        if ($request->hasFile('service_image')) {
            $data['image_path'] = $request->file('service_image')->store('services', 'public');
        }

        $service = Service::create($data);

        return response()->json([
            'message' => 'Layanan berhasil ditambahkan.',
            'id' => $service->id,
        ], 201);
    }

    public function updateService(Request $request, Service $service): JsonResponse
    {
        $data = $this->serviceValidated($request);
        $removeImage = $request->boolean('remove_image');
        unset($data['service_image'], $data['remove_image']);
        $data['display_order'] = $data['display_order'] ?? 0;

        if ($request->hasFile('service_image')) {
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $data['image_path'] = $request->file('service_image')->store('services', 'public');
        } elseif ($removeImage) {
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $data['image_path'] = null;
        }

        $service->update($data);

        return response()->json([
            'message' => 'Layanan berhasil diperbarui.',
        ]);
    }

    public function destroyService(Service $service): JsonResponse
    {
        if ($service->image_path) {
            Storage::disk('public')->delete($service->image_path);
        }

        $service->delete();

        return response()->json([
            'message' => 'Layanan berhasil dihapus.',
        ]);
    }

    private function testimonialValidated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:160',
            'email' => 'required|email|max:180',
            'phone' => 'nullable|string|max:60',
            'company' => 'nullable|string|max:180',
            'position' => 'nullable|string|max:180',
            'service_id' => 'nullable|integer|exists:services,id',
            'rating' => 'required|integer|min:1|max:5',
            'testimonial' => 'required|string|min:20|max:3000',
            'status' => ['required', Rule::in(['pending', 'published', 'hidden'])],
            'display_order' => 'nullable|integer|min:0|max:9999',
        ]);
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial): JsonResponse
    {
        $data = $this->testimonialValidated($request);
        $data['display_order'] = $data['display_order'] ?? 0;
        $testimonial->update($data);

        return response()->json([
            'message' => $testimonial->status === 'published'
                ? 'Testimoni berhasil diperbarui dan ditampilkan di website.'
                : 'Testimoni berhasil diperbarui.',
        ]);
    }

    public function destroyTestimonial(Testimonial $testimonial): JsonResponse
    {
        $testimonial->delete();

        return response()->json([
            'message' => 'Testimoni berhasil dihapus.',
        ]);
    }

    public function updateSettings(Request $request): JsonResponse
    {
        $data = $request->validate([
            'company' => 'required|string|max:180',
            'short_name' => 'required|string|max:50',
            'business_type' => 'required|string|max:100',
            'tagline' => 'required|string|max:180',
            'email' => 'required|email|max:180',
            'marketing_email' => 'nullable|email|max:180',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'office_hours_weekday' => 'required|string|max:180',
            'office_hours_saturday' => 'nullable|string|max:180',
            'instagram_url' => 'nullable|url|max:1000',
            'facebook_url' => 'nullable|url|max:1000',
            'linkedin_url' => 'nullable|url|max:1000',
            'youtube_url' => 'nullable|url|max:1000',
            'map_url' => 'nullable|url|max:1000',
            'hero_badge' => 'required|string|max:180',
            'hero_title_primary' => 'required|string|max:180',
            'hero_title_highlight' => 'required|string|max:180',
            'hero_title_secondary' => 'required|string|max:180',
            'hero_description' => 'required|string|max:1000',
            'founded_year' => 'required|integer|min:1900|max:2100',
            'stat_projects' => 'required|integer|min:0|max:9999999',
            'stat_projects_label' => 'required|string|max:100',
            'stat_clients' => 'required|integer|min:0|max:9999999',
            'stat_clients_label' => 'required|string|max:100',
            'stat_experience' => 'required|integer|min:0|max:9999',
            'stat_experience_label' => 'required|string|max:100',
            'stat_team' => 'required|integer|min:0|max:999999',
            'stat_team_label' => 'required|string|max:100',
            'seo_title' => 'required|string|max:180',
            'seo_description' => 'required|string|max:500',
            'seo_keywords' => 'nullable|string|max:1000',
            'footer_description' => 'required|string|max:1000',
            'copyright_text' => 'required|string|max:255',

            // Halaman Tentang
            'about_hero_eyebrow' => 'required|string|max:120',
            'about_hero_title_primary' => 'required|string|max:180',
            'about_hero_title_highlight' => 'required|string|max:180',
            'about_hero_description' => 'required|string|max:1200',
            'about_story_eyebrow' => 'required|string|max:120',
            'about_story_title_primary' => 'required|string|max:180',
            'about_story_title_highlight' => 'required|string|max:180',
            'about_story_paragraph_1' => 'required|string|max:3000',
            'about_story_paragraph_2' => 'nullable|string|max:3000',
            'about_feature_1_title' => 'required|string|max:120',
            'about_feature_1_description' => 'required|string|max:1200',
            'about_feature_2_title' => 'required|string|max:120',
            'about_feature_2_description' => 'required|string|max:1200',
            'about_vision_title' => 'required|string|max:120',
            'about_vision' => 'required|string|max:3000',
            'about_mission_title' => 'required|string|max:120',
            'about_mission_items' => 'required|array|min:1|max:20',
            'about_mission_items.*' => 'required|string|max:1000',
            'about_values_eyebrow' => 'required|string|max:120',
            'about_values_title_primary' => 'required|string|max:180',
            'about_values_title_highlight' => 'required|string|max:180',
            'about_values' => 'required|array|min:1|max:12',
            'about_values.*.icon' => 'nullable|string|max:30',
            'about_values.*.title' => 'required|string|max:120',
            'about_values.*.description' => 'nullable|string|max:500',
            'organization_eyebrow' => 'required|string|max:120',
            'organization_title_primary' => 'required|string|max:180',
            'organization_title_highlight' => 'required|string|max:180',
            'organization_description' => 'nullable|string|max:1200',
            'about_team_eyebrow' => 'required|string|max:120',
            'about_team_title_primary' => 'required|string|max:180',
            'about_team_title_highlight' => 'required|string|max:180',
            'about_cert_eyebrow' => 'required|string|max:120',
            'about_cert_title_primary' => 'required|string|max:180',
            'about_cert_title_highlight' => 'required|string|max:180',
            'about_cert_description' => 'required|string|max:1200',
            'about_hero_image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',
            'about_story_image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',
            'organization_chart_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:15360',
            'remove_about_hero_image' => 'nullable|boolean',
            'remove_about_story_image' => 'nullable|boolean',
            'remove_organization_chart' => 'nullable|boolean',

            // Halaman Layanan
            'service_hero_eyebrow' => 'required|string|max:120',
            'service_hero_title_primary' => 'required|string|max:180',
            'service_hero_title_highlight' => 'required|string|max:180',
            'service_hero_description' => 'required|string|max:1200',
            'service_process_eyebrow' => 'required|string|max:120',
            'service_process_title_primary' => 'required|string|max:180',
            'service_process_title_highlight' => 'required|string|max:180',
            'service_process_steps' => 'required|array|min:1|max:12',
            'service_process_steps.*.title' => 'required|string|max:180',
            'service_process_steps.*.description' => 'required|string|max:1000',
            'service_hero_image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',
            'remove_service_hero_image' => 'nullable|boolean',

            // Halaman Portofolio
            'portfolio_hero_eyebrow' => 'required|string|max:120',
            'portfolio_hero_title_primary' => 'required|string|max:180',
            'portfolio_hero_title_highlight' => 'required|string|max:180',
            'portfolio_hero_description' => 'required|string|max:1200',
            'portfolio_all_label' => 'required|string|max:80',
            'portfolio_empty_title' => 'required|string|max:180',
            'portfolio_empty_description' => 'required|string|max:1200',
            'portfolio_modal_cta_label' => 'required|string|max:180',
            'portfolio_hero_image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',
            'remove_portfolio_hero_image' => 'nullable|boolean',

            // Halaman Hubungi Kami
            'contact_hero_eyebrow' => 'required|string|max:120',
            'contact_hero_title_primary' => 'required|string|max:180',
            'contact_hero_title_highlight' => 'required|string|max:180',
            'contact_hero_description' => 'required|string|max:1200',
            'contact_office_label' => 'required|string|max:120',
            'contact_phone_label' => 'required|string|max:120',
            'contact_email_label' => 'required|string|max:120',
            'contact_hours_label' => 'required|string|max:120',
            'contact_form_title' => 'required|string|max:180',
            'contact_form_description' => 'required|string|max:1200',
            'contact_form_name_label' => 'required|string|max:120',
            'contact_form_name_placeholder' => 'required|string|max:180',
            'contact_form_email_label' => 'required|string|max:120',
            'contact_form_email_placeholder' => 'required|string|max:180',
            'contact_form_phone_label' => 'required|string|max:120',
            'contact_form_phone_placeholder' => 'required|string|max:180',
            'contact_form_service_label' => 'required|string|max:120',
            'contact_form_service_placeholder' => 'required|string|max:180',
            'contact_form_other_service_label' => 'required|string|max:180',
            'contact_form_budget_label' => 'required|string|max:120',
            'contact_form_budget_placeholder' => 'required|string|max:180',
            'contact_budget_options' => 'required|array|min:1|max:20',
            'contact_budget_options.*' => 'required|string|max:180',
            'contact_form_detail_label' => 'required|string|max:120',
            'contact_form_detail_placeholder' => 'required|string|max:1000',
            'contact_form_submit_label' => 'required|string|max:120',
            'contact_form_success_message' => 'required|string|max:1200',
            'contact_schedule_eyebrow' => 'required|string|max:120',
            'contact_schedule_title_primary' => 'required|string|max:180',
            'contact_schedule_title_highlight' => 'required|string|max:180',
            'contact_schedule_description' => 'required|string|max:1200',
            'contact_schedule_detail_title' => 'required|string|max:180',
            'contact_schedule_type_label' => 'required|string|max:120',
            'contact_schedule_type_placeholder' => 'required|string|max:180',
            'contact_schedule_types' => 'required|array|min:1|max:20',
            'contact_schedule_types.*' => 'required|string|max:180',
            'contact_schedule_name_label' => 'required|string|max:120',
            'contact_schedule_name_placeholder' => 'required|string|max:180',
            'contact_schedule_phone_label' => 'required|string|max:120',
            'contact_schedule_phone_placeholder' => 'required|string|max:180',
            'contact_schedule_email_label' => 'required|string|max:120',
            'contact_schedule_email_placeholder' => 'required|string|max:180',
            'contact_schedule_notes_label' => 'required|string|max:120',
            'contact_schedule_notes_placeholder' => 'required|string|max:1000',
            'contact_schedule_summary_title' => 'required|string|max:180',
            'contact_schedule_date_label' => 'required|string|max:120',
            'contact_schedule_time_label' => 'required|string|max:120',
            'contact_schedule_location_label' => 'required|string|max:120',
            'contact_schedule_submit_label' => 'required|string|max:180',
            'contact_schedule_submit_note' => 'required|string|max:1000',
            'contact_schedule_success_title' => 'required|string|max:180',
            'contact_schedule_success_description' => 'required|string|max:1200',
            'contact_schedule_reminder_text' => 'required|string|max:1200',
            'contact_schedule_again_label' => 'required|string|max:180',
            'contact_schedule_select_datetime_warning' => 'required|string|max:255',
            'contact_schedule_time_picker_title' => 'required|string|max:180',
            'contact_schedule_time_picker_hint' => 'required|string|max:255',
            'contact_schedule_morning_label' => 'required|string|max:120',
            'contact_schedule_afternoon_label' => 'required|string|max:120',
            'map_embed_url' => 'nullable|url|max:2000',
            'footer_map_title' => 'required|string|max:180',
            'footer_map_open_label' => 'required|string|max:120',
            'contact_hero_image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',
            'remove_contact_hero_image' => 'nullable|boolean',

            // Testimoni
            'testimonial_eyebrow' => 'required|string|max:120',
            'testimonial_title_primary' => 'required|string|max:180',
            'testimonial_title_highlight' => 'required|string|max:180',
            'testimonial_description' => 'required|string|max:1200',
            'testimonial_empty_text' => 'required|string|max:255',
            'testimonial_form_title' => 'required|string|max:180',
            'testimonial_form_description' => 'required|string|max:1200',
            'testimonial_submit_label' => 'required|string|max:120',
            'testimonial_success_message' => 'required|string|max:1200',
            'testimonial_review_notice' => 'required|string|max:1200',
            'testimonial_name_label' => 'required|string|max:120',
            'testimonial_name_placeholder' => 'required|string|max:180',
            'testimonial_email_label' => 'required|string|max:120',
            'testimonial_email_placeholder' => 'required|string|max:180',
            'testimonial_company_label' => 'required|string|max:120',
            'testimonial_company_placeholder' => 'required|string|max:180',
            'testimonial_position_label' => 'required|string|max:120',
            'testimonial_position_placeholder' => 'required|string|max:180',
            'testimonial_phone_label' => 'required|string|max:120',
            'testimonial_phone_placeholder' => 'required|string|max:180',
            'testimonial_service_label' => 'required|string|max:120',
            'testimonial_service_placeholder' => 'required|string|max:180',
            'testimonial_rating_label' => 'required|string|max:120',
            'testimonial_rating_5_label' => 'required|string|max:180',
            'testimonial_rating_4_label' => 'required|string|max:180',
            'testimonial_rating_3_label' => 'required|string|max:180',
            'testimonial_rating_2_label' => 'required|string|max:180',
            'testimonial_rating_1_label' => 'required|string|max:180',
            'testimonial_content_label' => 'required|string|max:120',
            'testimonial_content_placeholder' => 'required|string|max:1200',

            'mail_enabled' => 'required|boolean',
            'mail_smtp_host' => 'required_if:mail_enabled,1|nullable|string|max:255',
            'mail_smtp_port' => 'required_if:mail_enabled,1|nullable|integer|min:1|max:65535',
            'mail_smtp_username' => 'required_if:mail_enabled,1|nullable|string|max:255',
            'mail_smtp_password' => 'nullable|string|max:500',
            'mail_security' => ['required', Rule::in(['starttls', 'ssl'])],
            'mail_from_address' => 'required_if:mail_enabled,1|nullable|email|max:255',
            'mail_from_name' => 'required_if:mail_enabled,1|nullable|string|max:255',
            'mail_received_subject' => 'required|string|max:255',
            'mail_received_body' => 'required|string|max:8000',
            'mail_confirmed_subject' => 'required|string|max:255',
            'mail_confirmed_body' => 'required|string|max:8000',
            'mail_cancelled_subject' => 'required|string|max:255',
            'mail_cancelled_body' => 'required|string|max:8000',
            'mail_test_subject' => 'required|string|max:255',
            'mail_test_body' => 'required|string|max:8000',
            'remove_mail_smtp_password' => 'nullable|boolean',
            'logo_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'favicon_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,ico|max:2048',
            'hero_image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',
            'remove_logo' => 'nullable|boolean',
            'remove_favicon' => 'nullable|boolean',
            'remove_hero_image' => 'nullable|boolean',
        ]);

        $settings = CompanySetting::current();

        if ($request->boolean('remove_mail_smtp_password')) {
            $data['mail_smtp_password'] = null;
        } elseif (!$request->filled('mail_smtp_password')) {
            unset($data['mail_smtp_password']);
        }

        if ($request->boolean('mail_enabled')) {
            $hasStoredPassword = !empty($settings->mail_smtp_password);
            $hasNewPassword = $request->filled('mail_smtp_password');

            if (!$hasStoredPassword && !$hasNewPassword) {
                throw ValidationException::withMessages([
                    'mail_smtp_password' => 'App Password / password SMTP wajib diisi saat email diaktifkan.',
                ]);
            }
        }

        unset(
            $data['remove_mail_smtp_password'],
            $data['logo_file'],
            $data['favicon_file'],
            $data['hero_image_file'],
            $data['about_hero_image_file'],
            $data['about_story_image_file'],
            $data['organization_chart_file'],
            $data['service_hero_image_file'],
            $data['portfolio_hero_image_file'],
            $data['contact_hero_image_file'],
            $data['remove_logo'],
            $data['remove_favicon'],
            $data['remove_hero_image'],
            $data['remove_about_hero_image'],
            $data['remove_about_story_image'],
            $data['remove_organization_chart'],
            $data['remove_service_hero_image'],
            $data['remove_portfolio_hero_image'],
            $data['remove_contact_hero_image']
        );

        $logoChanged = $request->hasFile('logo_file') || $request->boolean('remove_logo');
        $faviconExplicitlyChanged = $request->hasFile('favicon_file') || $request->boolean('remove_favicon');

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'logo_file',
            'logo_path',
            'branding',
            'remove_logo'
        );

        // Secara default favicon mengikuti logo. Jika logo diganti dan admin tidak
        // memilih favicon khusus pada penyimpanan yang sama, favicon lama dilepas
        // agar icon tab browser otomatis memakai logo terbaru.
        if ($logoChanged && !$faviconExplicitlyChanged) {
            if ($settings->favicon_path && $settings->favicon_path !== $settings->logo_path) {
                Storage::disk('public')->delete($settings->favicon_path);
            }

            $data['favicon_path'] = null;
        }

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'favicon_file',
            'favicon_path',
            'branding',
            'remove_favicon'
        );

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'hero_image_file',
            'hero_image_path',
            'branding',
            'remove_hero_image'
        );

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'about_hero_image_file',
            'about_hero_image_path',
            'about',
            'remove_about_hero_image'
        );

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'about_story_image_file',
            'about_story_image_path',
            'about',
            'remove_about_story_image'
        );

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'organization_chart_file',
            'organization_chart_path',
            'about',
            'remove_organization_chart'
        );

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'service_hero_image_file',
            'service_hero_image_path',
            'services',
            'remove_service_hero_image'
        );

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'portfolio_hero_image_file',
            'portfolio_hero_image_path',
            'portfolio',
            'remove_portfolio_hero_image'
        );

        $this->handleSettingFile(
            $request,
            $settings,
            $data,
            'contact_hero_image_file',
            'contact_hero_image_path',
            'contact',
            'remove_contact_hero_image'
        );

        $settings->update($data);

        return response()->json([
            'message' => 'Pengaturan website berhasil disimpan.',
            'settings' => array_merge($settings->fresh()->publicData(), $settings->fresh()->mailAdminData()),
        ]);
    }

    public function testEmail(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            $settings = CompanySetting::current();
            $company = $settings->publicData();

            $templates = app(EmailTemplateService::class);
            $subject = $templates->renderCompanyTemplate('mail_test_subject', $settings, $company);
            $body = $templates->renderCompanyTemplate('mail_test_body', $settings, $company);

            app(DynamicMailer::class)->sendRaw(
                $data['email'],
                $subject,
                $body
            );

            return response()->json([
                'message' => 'Email tes berhasil dikirim ke '.$data['email'].'.',
                'mail_sent' => true,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Email tes gagal: '.$this->mailErrorMessage($e),
                'mail_sent' => false,
            ], 422);
        }
    }

    private function mailErrorMessage(\Throwable $e): string
    {
        $message = trim($e->getMessage());

        if ($message === '') {
            return 'Tidak ada detail error dari server email.';
        }

        return mb_substr($message, 0, 700);
    }

    private function handleSettingFile(
        Request $request,
        CompanySetting $settings,
        array &$data,
        string $input,
        string $column,
        string $directory,
        string $removeInput
    ): void {
        if ($request->hasFile($input)) {
            if ($settings->{$column}) {
                Storage::disk('public')->delete($settings->{$column});
            }

            $data[$column] = $request->file($input)->store($directory, 'public');
            return;
        }

        if ($request->boolean($removeInput)) {
            if ($settings->{$column}) {
                Storage::disk('public')->delete($settings->{$column});
            }

            $data[$column] = null;
        }
    }
}
