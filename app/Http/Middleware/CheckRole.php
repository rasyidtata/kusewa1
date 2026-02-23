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

        if (!in_array($user->role, $roles)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            
            // Redirect ke dashboard sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut!');
            } else {
                return redirect()->route('dashboard.pegawai')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut!');
            }
        }

        return $next($request);
    }
}
