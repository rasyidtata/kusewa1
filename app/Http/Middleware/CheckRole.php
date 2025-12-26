<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        $user = Auth::user();
        
        // Pastikan user model memiliki property 'role'
        if (!isset($user->role)) {
            return redirect()->route('login')->with('error', 'Role pengguna tidak ditemukan!');
        }


        if (!in_array($user->role, $roles)) {
            // Jika tidak punya akses, bisa redirect ke halaman tertentu
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut!');
        }

        return $next($request);
    }
}
