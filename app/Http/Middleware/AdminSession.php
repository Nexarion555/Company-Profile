<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class AdminSession {
    public function handle(Request $request, Closure $next): Response {
        if (!$request->session()->get('admin_authenticated')) {
            return response()->json(['message' => 'Sesi admin tidak aktif. Silakan login kembali.'], 401);
        }
        return $next($request);
    }
}
