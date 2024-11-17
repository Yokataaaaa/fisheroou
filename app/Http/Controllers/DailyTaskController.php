<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DailyTaskController extends Controller
{
    /**
     * Menampilkan data task harian dari API eksternal.
     */
    public function index()
    {
        $token = session('auth_token');

        // Cek apakah token ada, jika tidak redirect ke halaman login
        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi token melalui API
        if (!$this->validateToken($token)) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }

        try {
            // Ambil data task harian dari API eksternal
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/daily_task');

            // Pastikan respons sukses (kode status 2xx)
            if ($response->successful()) {
                return view('admin.task', ['tasks' => $response->json()]); // Menampilkan data pada view 'daily_task'
            } else {
                // Tangani respon gagal dari API
                throw new \Exception('Gagal mengambil data task harian: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Log error dan tampilkan pesan kesalahan kepada pengguna
            Log::error('Error fetching daily task data: ' . $e->getMessage());
            return redirect()->route('admin.task')
                ->withErrors(['error' => 'Gagal mengambil data task harian. Silakan coba lagi nanti.']);
        }
    }

    /**
     * Menyimpan data task harian baru ke API eksternal.
     */
    public function store(Request $request)
    {
        // Ambil token autentikasi dari session
        $token = session('auth_token');

        // Jika token tidak ditemukan, arahkan ke halaman login
        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi input data dari form
        $validated = $request->validate([
            'nama_task' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => 'nullable|in:pending,completed',
            'karyawan_username' => 'required|string', // Pastikan username diterima sebagai string
            'due_date' => 'required|date', // Validasi format tanggal
            'completed' => 'nullable|boolean', // Menambahkan validasi untuk completed
        ]);

        try {
            // Siapkan data untuk dikirim ke API
            $data = [
                'nama_task' => $validated['nama_task'],
                'deskripsi' => $validated['deskripsi'] ?? '', // Mengatasi null di deskripsi
                'status' => $validated['status'] ?? 'pending', // Default status ke 'pending'
                'karyawan_username' => $validated['karyawan_username'],
                'due_date' => $validated['due_date'],
                'completed' => $validated['completed'] ?? 0, // Default completed ke 0 (false) jika tidak ada nilai
            ];

            // Kirim data task harian ke API eksternal
            $response = Http::withToken($token)
                ->post('http://127.0.0.1:8000/api/daily_task', $data);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                return redirect()->route('admin.task')
                    ->with('message', 'Task harian berhasil ditambahkan.');
            } else {
                // Menangani jika API tidak memberikan response sukses
                throw new \Exception('Gagal menambahkan task harian: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Log dan tampilkan pesan kesalahan
            Log::error('Error adding daily task: ' . $e->getMessage());
            return redirect()->route('admin.task')
                ->withErrors(['error' => 'Gagal menambahkan task harian. Silakan coba lagi nanti.']);
        }
    }




    /**
     * Menghapus data task harian dari API eksternal.
     */
    public function destroy($id)
    {
        $token = session('auth_token');

        // Cek apakah token ada, jika tidak redirect ke halaman login
        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi token melalui API
        if (!$this->validateToken($token)) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }

        try {
            // Hapus data task harian dari API eksternal
            $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/daily_task/{$id}");

            // Cek apakah respons berhasil
            if ($response->successful()) {
                return redirect()->route('admin.task')
                    ->with('message', 'Task harian berhasil dihapus.');
            } else {
                throw new \Exception('Gagal menghapus task harian: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Log dan tampilkan pesan kesalahan
            Log::error('Error deleting daily task: ' . $e->getMessage());
            return redirect()->route('admin.task')
                ->withErrors(['error' => 'Gagal menghapus task harian. Silakan coba lagi nanti.']);
        }
    }

    /**
     * Memperbarui data task harian di API eksternal.
     */
    public function update(Request $request, $id)
    {
        $token = session('auth_token');

        // Cek apakah token ada, jika tidak redirect ke halaman login
        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi token melalui API
        if (!$this->validateToken($token)) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }

        // Validasi input data dari form
        $validated = $request->validate([
            'nama_task' => 'required|string|max:255',               // Nama task wajib diisi dan berupa string
            'deskripsi' => 'required|string|max:255',               // Deskripsi wajib diisi dan berupa string
            'status' => 'required|in:pending,completed',            // Status harus 'pending' atau 'completed'
            'due_date' => 'required|date',                          // Due date wajib diisi dan berupa tanggal
        ]);

        try {
            // Siapkan data untuk dikirim ke API
            $data = [
                'nama_task' => $validated['nama_task'],
                'deskripsi' => $validated['deskripsi'],
                'status' => $validated['status'],
                'due_date' => $validated['due_date'],
            ];

            // Kirim data task harian yang sudah diperbarui ke API eksternal
            $response = Http::withToken($token)->put("http://127.0.0.1:8000/api/daily_task/{$id}", $data);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                return redirect()->route('admin.task')
                    ->with('message', 'Task harian berhasil diperbarui.');
            } else {
                throw new \Exception('Gagal memperbarui task harian: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Log dan tampilkan pesan kesalahan
            Log::error('Error updating daily task: ' . $e->getMessage());
            return redirect()->route('admin.task')
                ->withErrors(['error' => 'Gagal memperbarui task harian. Silakan coba lagi nanti.']);
        }
    }

    /**
     * Memvalidasi token dengan API eksternal.
     */
    private function validateToken($token)
    {
        try {
            // Kirim request untuk memvalidasi token
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');

            // Jika respons sukses, token valid
            return $response->successful();
        } catch (\Exception $e) {
            // Log error jika terjadi masalah saat validasi token
            Log::error('Error validating token: ' . $e->getMessage());
            return false; // Token tidak valid jika terjadi kesalahan
        }
    }

    /**
     * Menampilkan form untuk menambah task harian.
     */
    public function create()
    {
        return view('admin.tambah_task');
    }
}
