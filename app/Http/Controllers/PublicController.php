<?php
namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Message;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class PublicController extends Controller {
    public function storeMessage(Request $request): JsonResponse {
        $data=$request->validate([
            'name'=>'required|string|max:120','email'=>'required|email|max:160','phone'=>'required|string|max:40',
            'service'=>'nullable|string|max:120','budget'=>'nullable|string|max:120','detail'=>'required|string|max:5000',
        ]);
        $subject='Permintaan '.($data['service'] ?: 'Konsultasi');
        $parts=['Telepon: '.$data['phone']];
        if(!empty($data['service']))$parts[]='Layanan: '.$data['service'];
        if(!empty($data['budget']))$parts[]='Anggaran: '.$data['budget'];
        $parts[]='Detail: '.$data['detail'];
        $m=Message::create(['name'=>$data['name'],'email'=>$data['email'],'subject'=>$subject,'msg'=>implode("\n",$parts),'is_read'=>false]);
        return response()->json(['message'=>'Pesan berhasil dikirim.','id'=>$m->id],201);
    }
    public function storeAppointment(Request $request): JsonResponse {
        $data=$request->validate([
            'name'=>'required|string|max:120','phone'=>'required|string|max:40','email'=>'required|email|max:160','type'=>'required|string|max:120',
            'date'=>'required|date|after_or_equal:today','time'=>['required','regex:/^(08|09|10|11|13|14|15|16):00$/'],'notes'=>'nullable|string|max:2000',
        ]);
        $exists=Appointment::query()->whereDate('date',$data['date'])->where('time',$data['time'])->whereIn('status',['pending','confirmed'])->exists();
        if($exists)return response()->json(['message'=>'Jadwal tersebut baru saja terisi. Silakan pilih waktu lain.'],422);
        try{
            $a=Appointment::create($data+['status'=>'pending']);
        }catch(QueryException $e){
            return response()->json(['message'=>'Jadwal tersebut baru saja terisi. Silakan pilih waktu lain.'],422);
        }
        try {
            Mail::raw(
                "Halo {$a->name},\n\nJadwal pertemuan Anda telah diterima.\nTanggal: {$a->date->format('d-m-Y')}\nWaktu: {$a->time} WIB\nJenis: {$a->type}\n\nTim KSN akan menghubungi Anda untuk konfirmasi lanjutan.",
                fn($mail) => $mail->to($a->email)->subject('Konfirmasi Jadwal Pertemuan KSN')
            );
        } catch (\Throwable $e) { report($e); }
        return response()->json(['message'=>'Jadwal berhasil dibuat.','id'=>$a->id],201);
    }
}
