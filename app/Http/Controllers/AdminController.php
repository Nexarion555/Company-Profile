<?php
namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\CompanySetting;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
class AdminController extends Controller {
    public function index(Request $request): View { return view('admin',['authenticated'=>(bool)$request->session()->get('admin_authenticated')]); }
    public function login(Request $request): JsonResponse {
        $data=$request->validate(['email'=>'required|email','password'=>'required|string']);
        $admin=Admin::where('email',$data['email'])->first();
        if(!$admin || !Hash::check($data['password'],$admin->password))return response()->json(['message'=>'Email atau password salah.'],422);
        $request->session()->regenerate();
        $request->session()->put(['admin_authenticated'=>true,'admin_id'=>$admin->id]);
        return response()->json(['message'=>'Login berhasil.']);
    }
    public function logout(Request $request): JsonResponse {
        $request->session()->forget(['admin_authenticated','admin_id']);
        $request->session()->regenerateToken();
        return response()->json(['message'=>'Logout berhasil.']);
    }
    public function data(): JsonResponse {
        $portfolios=Portfolio::latest('updated_at')->get()->map(fn($p)=>[
            'id'=>$p->id,'title'=>$p->title,'client'=>$p->client,'category'=>$p->category,'year'=>(string)$p->year,'location'=>$p->location,
            'description'=>$p->description,'image'=>$p->image,'updated'=>$p->updated_at->format('d M Y')]);
        $appointments=Appointment::orderByDesc('date')->orderByDesc('time')->get()->map(fn($a)=>[
            'id'=>$a->id,'name'=>$a->name,'phone'=>$a->phone,'email'=>$a->email,'type'=>$a->type,'date'=>$a->date->format('Y-m-d'),'time'=>substr($a->time,0,5),'status'=>$a->status]);
        $clients=Client::orderBy('id')->get()->map(fn($c)=>['id'=>$c->id,'name'=>$c->name,'pic'=>$c->pic,'phone'=>$c->phone,'email'=>$c->email,'projects'=>$c->projects,'total'=>$c->total]);
        $messages=Message::latest()->get()->map(fn($m)=>['id'=>$m->id,'name'=>$m->name,'email'=>$m->email,'subject'=>$m->subject,'msg'=>$m->msg,'date'=>$m->created_at->format('Y-m-d H:i'),'read'=>(bool)$m->is_read]);
        $team=TeamMember::orderBy('id')->get()->map(fn($t)=>['id'=>$t->id,'name'=>$t->name,'role'=>$t->role,'email'=>$t->email,'phone'=>$t->phone,'img'=>$t->img]);
        $s=CompanySetting::firstOrCreate([],['company'=>'PT Karya Struktur Nusantara','address'=>'Jl. Sudirman Kav. 52-53, Lantai 15, Jakarta Selatan 12190','phone'=>'(021) 1234-567','email'=>'info@ksn-konstruksi.co.id','whatsapp'=>'+62 812-3456-7890']);
        return response()->json(['portfolios'=>$portfolios,'appointments'=>$appointments,'clients'=>$clients,'messages'=>$messages,'team'=>$team,'settings'=>['company'=>$s->company,'address'=>$s->address,'phone'=>$s->phone,'email'=>$s->email,'whatsapp'=>$s->whatsapp]]);
    }
    private function portfolioValidated(Request $r): array { return $r->validate(['title'=>'required|string|max:180','client'=>'nullable|string|max:180','category'=>'required|string|max:120','year'=>'nullable|integer|min:1900|max:2100','location'=>'nullable|string|max:180','image'=>'required|url|max:1000','description'=>'required|string|max:5000']); }
    public function storePortfolio(Request $r): JsonResponse { $p=Portfolio::create($this->portfolioValidated($r)); return response()->json(['message'=>'Portfolio ditambahkan.','id'=>$p->id],201); }
    public function updatePortfolio(Request $r, Portfolio $portfolio): JsonResponse { $portfolio->update($this->portfolioValidated($r)); return response()->json(['message'=>'Portfolio diperbarui.']); }
    public function destroyPortfolio(Portfolio $portfolio): JsonResponse { $portfolio->delete(); return response()->json(['message'=>'Portfolio dihapus.']); }
    public function updateAppointmentStatus(Request $r, Appointment $appointment): JsonResponse { $d=$r->validate(['status'=>['required',Rule::in(['pending','confirmed','done','cancelled'])]]); $appointment->update($d); return response()->json(['message'=>'Status diperbarui.']); }
    public function markMessageRead(Message $message): JsonResponse { $message->update(['is_read'=>true]); return response()->json(['message'=>'Pesan ditandai dibaca.']); }
    public function updateSettings(Request $r): JsonResponse {
        $d=$r->validate(['company'=>'required|string|max:180','email'=>'required|email|max:180','phone'=>'required|string|max:50','whatsapp'=>'required|string|max:50','address'=>'required|string|max:500']);
        CompanySetting::query()->firstOrCreate([])->update($d); return response()->json(['message'=>'Pengaturan disimpan.']);
    }
}
