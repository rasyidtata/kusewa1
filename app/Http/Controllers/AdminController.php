<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin_fitur.pendaftaran');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:admin,pegawai',
            'password' => 'required|string|min:6',  
        ]);

        // Simpan data ke database
        $user = new \App\Models\User();
        $user->name = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        return redirect()->back()->with('success', 'Data akun baru berhasil disimpan!');
    }

    public function list()
    {
        $pegawai = User::where('role', 'pegawai')
                     ->get();
        
        return view('admin_fitur.list', compact('pegawai'));
    }

    public function destroy($id)
    {
        try {
            // Cari data user berdasarkan ID
            $user = User::findOrFail($id);
            
            // Cek apakah user yang akan dihapus adalah pegawai
            if ($user->role !== 'pegawai') {
                return redirect()->back()->with('error', 'Hanya data pegawai yang dapat dihapus!');
            }
            
            // Simpan nama untuk keperluan pesan
            $namaUser = $user->name;
            
            // Hapus data user
            $user->delete();
            
            // Redirect dengan pesan sukses
            return redirect()->route('admin.list')->with('success', 'Data pegawai "' . $namaUser . '" berhasil dihapus!');
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika data tidak ditemukan
            return redirect()->back()->with('error', 'Data pegawai tidak ditemukan!');
        } catch (\Exception $e) {
            // Jika terjadi error lain
            return redirect()->back()->with('error', 'Gagal menghapus data pegawai: ' . $e->getMessage());
        }
    }

    
}
 