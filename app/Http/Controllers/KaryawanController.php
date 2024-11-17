<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{
    // Menampilkan data karyawan
    public function karyawan(Request $request)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Pastikan token tersedia
        if (!$token) {
            // Jika token tidak ada, arahkan ke halaman login dengan pesan error
            return redirect()->route('Showlogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        try {
            // Gunakan token untuk API request (misalnya mendapatkan data karyawan)
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/karyawan');

            // Cek apakah request API berhasil
            if ($response->successful()) {
                // Ambil data karyawan dari response API
                $dataKaryawan = $response->json();

                // Kembalikan tampilan karyawan dengan data karyawan
                return view('admin.karyawan', ['karyawan' => $dataKaryawan]);
            }

            // Jika API gagal (response tidak berhasil), arahkan ke halaman karyawan dengan pesan error
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Gagal mengambil data karyawan.']);

        } catch (\Exception $e) {
            // Jika ada kesalahan dalam proses request, arahkan ke halaman karyawan dengan pesan error
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Menambahkan data karyawan
    public function tambahKaryawan(Request $request)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Pastikan token tersedia
        if (!$token) {
            return redirect()->route('Showlogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // start_date tidak wajib dalam validasi
        ]);

        try {
            // Tetapkan start_date default jika tidak diberikan


            // Gunakan token untuk API request untuk menambahkan karyawan
            $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/karyawan/', [
                'username' => $validated['username'],
                'email' => $validated['email'],
                // Tambahkan start_date di payload
            ]);

            // Cek apakah request API berhasil
            if ($response->successful()) {
                return redirect()->route('admin.karyawan')->with('message', 'Karyawan berhasil ditambahkan.');
            }

            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Gagal menambahkan karyawan.']);
        } catch (\Exception $e) {
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Mengedit data karyawan
    public function editKaryawan($id, Request $request)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Pastikan token tersedia
        if (!$token) {
            // Jika token tidak ada, arahkan ke halaman login dengan pesan error
            return redirect()->route('Showlogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        try {
            // Gunakan token untuk API request untuk mendapatkan data karyawan berdasarkan ID
            $response = Http::withToken($token)->get("http://127.0.0.1:8000/api/karyawan/{$id}");

            // Cek apakah request API berhasil
            if ($response->successful()) {
                // Ambil data karyawan dari response API
                $dataKaryawan = $response->json();

                // Kembalikan tampilan untuk mengedit data karyawan
                return view('admin.edit_karyawan', ['karyawan' => $dataKaryawan]);
            }

            // Jika API gagal, arahkan ke halaman karyawan dengan pesan error
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Karyawan tidak ditemukan.']);
        } catch (\Exception $e) {
            // Jika ada kesalahan dalam proses request, arahkan ke halaman karyawan dengan pesan error
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Memperbarui data karyawan
    public function updateKaryawan(Request $request, $id)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Pastikan token tersedia
        if (!$token) {
            return redirect()->route('Showlogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // start_date tidak wajib dalam validasi
        ]);

        try {
            // Tetapkan start_date default jika tidak diberikan
            $startDate = $request->start_date ?? now()->toDateString();

            // Gunakan token untuk API request untuk memperbarui data karyawan
            $response = Http::withToken($token)->put("http://127.0.0.1:8000/api/karyawan/{$id}", [
                'username' => $validated['username'],
                'email' => $validated['email'],
                'start_date' => $startDate, // Tambahkan start_date di payload
            ]);

            // Cek apakah request API berhasil
            if ($response->successful()) {
                return redirect()->route('admin.karyawan')->with('message', 'Karyawan berhasil diperbarui.');
            }

            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Gagal memperbarui data karyawan.']);
        } catch (\Exception $e) {
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Menghapus data karyawan
    public function hapusKaryawan($id, Request $request)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Pastikan token tersedia
        if (!$token) {
            // Jika token tidak ada, arahkan ke halaman login dengan pesan error
            return redirect()->route('Showlogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        try {
            // Gunakan token untuk API request untuk menghapus data karyawan berdasarkan ID
            $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/karyawan/{$id}");

            // Cek apakah request API berhasil
            if ($response->successful()) {
                // Redirect ke halaman karyawan dengan pesan sukses
                return redirect()->route('admin.karyawan')->with('message', 'Karyawan berhasil dihapus.');
            }

            // Jika API gagal, arahkan ke halaman karyawan dengan pesan error
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Gagal menghapus karyawan.']);
        } catch (\Exception $e) {
            // Jika ada kesalahan dalam proses request, arahkan ke halaman karyawan dengan pesan error
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Fitur Import Karyawan
    public function import(Request $request)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Pastikan token tersedia
        if (!$token) {
            // Jika token tidak ada, arahkan ke halaman login dengan pesan error
            return redirect()->route('Showlogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi token melalui API eksternal
        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');

        // Cek apakah token valid
        if (!$response->successful()) {
            // Jika token tidak valid, arahkan ke halaman login dengan pesan error
            return redirect()->route('Showlogin')->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }

        // Validasi file yang di-upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        // Jika file valid, lanjutkan proses import
        try {
            // Ambil data file yang di-upload
            $file = $request->file('file');

            // Kirim file ke API eksternal untuk diimport
            $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/karyawan/import', [
                'file' => $file,
            ]);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                // Redirect ke halaman karyawan dengan pesan sukses
                return redirect()->route('admin.karyawan')->with('message', 'Data karyawan berhasil diimpor.');
            } else {
                // Jika gagal, tampilkan pesan error
                return redirect()->route('admin.karyawan')->withErrors(['error' => 'Gagal mengimpor data: ' . $response->body()]);
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Jika ada kesalahan dalam validasi Excel
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Validasi file gagal: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Jika ada kesalahan lain, seperti kesalahan API atau lainnya
            return redirect()->route('admin.karyawan')->withErrors(['error' => 'Gagal mengimpor data: ' . $e->getMessage()]);
        }
    }

    private function validateToken($token)
    {
        try {
            // Kirim request untuk memvalidasi token
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');

            // Jika response sukses, token valid
            return $response->successful();
        } catch (\Exception $e) {
            // Log error jika terjadi masalah saat validasi token
            Log::error('Error validating token: ' . $e->getMessage());
            return false;  // Token tidak valid jika gagal
        }
    }
}
