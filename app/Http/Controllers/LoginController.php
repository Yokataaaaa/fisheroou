<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showlogin()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        // Validasi input login
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Panggil API login
        $response = Http::post(url('http://127.0.0.1:8000/api/login'), $validated);

        // Periksa apakah respons API menunjukkan login berhasil
        if ($response->successful()) {
            $data = $response->json();
        
            // Ambil data user dan token dari respons
            $userRole = $data['user']['role'];
            $token = $data['access_token'];
        
            // Simpan token di session
            session(['auth_token' => $token]);
        
            // Cek apakah role adalah 'admin'
            if ($userRole === 'manager') {
                return redirect()->route('admin.dashboard')->with('message', 'Admin logged in successfully');
            } else {
                // Jika bukan admin, arahkan kembali ke halaman login atau beri pesan error
                return redirect()->route('login')->with('error', 'You are not authorized to access this page');
            }
        }
        

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        // Menghapus token dari session
        $request->session()->forget('auth_token');
        
        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}