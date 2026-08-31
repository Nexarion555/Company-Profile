<?php
namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\CompanySetting;
use App\Models\Portfolio;
use Illuminate\View\View;
class LandingController extends Controller {
    public function index(): View {
        $portfolios = Portfolio::query()->latest('updated_at')->get()->values()->map(function (Portfolio $p) {
            $cat = strtolower($p->category ?? '');
            $filter = str_contains($cat, 'interior') ? 'interior' : (str_contains($cat, 'renov') || str_contains($cat, 'restor') ? 'renovasi' : (str_contains($cat, 'landscape') ? 'landscape' : 'gedung'));
            return [
                'id'=>$p->id,'title'=>$p->title,'cat'=>$p->category,'filter'=>$filter,'loc'=>$p->location ?: '-',
                'year'=>(string)($p->year ?: '-'),'area'=>$p->area ?: '-','client'=>$p->client ?: '-',
                'desc'=>$p->description,'img'=>$p->image,
            ];
        })->all();
        $s = CompanySetting::query()->first();
        $phone = $s?->phone ?: '(021) 1234-567';
        $settings = [
            'company'=>$s?->company ?: 'PT Karya Struktur Nusantara',
            'address'=>$s?->address ?: 'Jl. Sudirman Kav. 52-53, Lantai 15, Jakarta Selatan 12190',
            'phone'=>$phone,'email'=>$s?->email ?: 'info@ksn-konstruksi.co.id','whatsapp'=>$s?->whatsapp ?: '+62 812-3456-7890',
            'phone_href'=>'tel:'.preg_replace('/[^0-9+]/','',$phone),
        ];
        $bookedSlots = Appointment::query()->whereIn('status',['pending','confirmed'])->get(['date','time'])->map(fn($a) => $a->date->format('Y-n-j').'|'.substr($a->time,0,5))->values()->all();
        return view('landing', compact('portfolios','settings','bookedSlots'));
    }
}
