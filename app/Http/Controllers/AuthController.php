<?php

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use \Illuminate\Support\Facades\Validator;
    use App\Models\User;

    class AuthController extends Controller
    {
        public function tampillogin()
        {
            return view('/login');
        }
        public function submitlogin(Request $request)
        {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ], [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 karakter',
            ]);
            
            // Jika validasi gagal
            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->first()
                    ], 422);
                }
                
                return redirect()->route('login')
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Coba login
            $credentials = $request->only('email', 'password');   
            if (Auth::attempt($credentials)) {
                // Jika request AJAX
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login berhasil!',
                        'redirect' => route('dashboard')
                    ]);
                }
                
                // Jika request biasa
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            }
            // Jika login gagal
            $errorMessage = 'Login gagal! Email atau password salah.';
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 401);
            }
            
            return redirect()->route('login')
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
    }