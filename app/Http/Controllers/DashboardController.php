<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard
    public function index()
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Pastikan token tersedia
        if (!$token) {
            // Jika token tidak ada, arahkan ke halaman login dengan pesan error
            return redirect()->route('showLogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        try {
            // Gunakan token untuk API request (misalnya mendapatkan data user)
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');

            // Cek apakah request API berhasil
            if ($response->successful()) {
                // Ambil data user dari response API
                $userData = $response->json();
                
                // Kembalikan tampilan dashboard dengan data pengguna
                return view('admin.dashboard', compact('userData'));
            }

            // Jika API gagal, beri pesan error dan arahkan kembali ke login
            return redirect()->route('showLogin')->withErrors(['error' => 'Token tidak valid atau kadaluarsa.']);

        } catch (\Exception $e) {
            // Jika terjadi error saat request, arahkan ke halaman login dengan pesan error
            return redirect()->route('showLogin')->withErrors(['error' => 'Gagal mengambil data pengguna. Coba lagi.']);
        }
    }

    // Validasi token
    public function checkToken(Request $request)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Jika token tidak ditemukan, kembalikan respons error
        if (!$token) {
            return response()->json([
                'message' => 'Token tidak ditemukan. Silakan login terlebih dahulu.'
            ], 401);
        }

        try {
            // Validasi token melalui API eksternal
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');
            
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Token valid',
                    'user' => $response->json()
                ]);
            }

            // Jika token tidak valid, kembalikan respons error
            return response()->json([
                'message' => 'Token tidak valid atau kadaluarsa.'
            ], 401);

        } catch (\Exception $e) {
            // Jika terjadi error saat request API, kembalikan error
            return response()->json([
                'message' => 'Gagal memvalidasi token. Coba lagi.'
            ], 500);
        }
    }
}
