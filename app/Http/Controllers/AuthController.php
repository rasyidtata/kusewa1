<?php

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use App\Models\User;

    class AuthController extends Controller
    {
        public function tampillogin()
        {
            return view('/login');
        }
        public function submitlogin(Request $request)
        {
            $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:6',
            ]);

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->route('dashboard');

            } else {
                return redirect()->route('login')->withErrors('Login Gagal! Silahkan Periksa Username dan Password Anda.');
            }
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
    }