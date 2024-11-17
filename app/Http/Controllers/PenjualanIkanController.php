<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PenjualanIkanController extends Controller
{
    /**
     * Menampilkan daftar penjualan ikan.
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
        $validToken = $this->validateToken($token);
        if (!$validToken) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }

        try {
            // Ambil data penjualan ikan dari API eksternal
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/penjualan_ikan');

            // Pastikan respons sukses
            if ($response->successful()) {
                return view('admin.data_keluar', ['data' => $response->json()]); // Menampilkan data pada view 'data_keluar'
            } else {
                throw new \Exception('Gagal mengambil data penjualan ikan: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error fetching penjualan ikan: ' . $e->getMessage());
            return redirect()->route('admin.penjualan_ikan')
                ->withErrors(['error' => 'Gagal mengambil data penjualan ikan.']);
        }
    }

    /**
     * Menyimpan data penjualan ikan baru.
     */
    public function store(Request $request)
    {
        $token = session('auth_token');
    
        // Cek jika token tidak ada
        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
    
        // Validasi token melalui API
        $validToken = $this->validateToken($token);
        if (!$validToken) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }
    
        // Validasi input dari form
        $validated = $request->validate([
            'nama_ikan' => 'required|string|max:255', // Nama ikan wajib diisi dan berupa string dengan panjang maksimal 255 karakter
            'deskripsi' => 'nullable|string',          // Deskripsi opsional dan berupa string
            'nama_kolam' => 'required|string',         // Nama kolam wajib diisi dan berupa string
            'jumlah_penjualan' => 'required|integer',  // Jumlah penjualan wajib diisi dan berupa integer
        ]);
    
        try {
            // Kirim data penjualan ikan ke API eksternal
            $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/penjualan_ikan', [
                'nama_ikan' => $validated['nama_ikan'],
                'deskripsi' => $validated['deskripsi'] ?? null,  // Gunakan null jika deskripsi kosong
                'nama_kolam' => $validated['nama_kolam'],        // Menggunakan nama kolam dari input
                'jumlah_penjualan' => $validated['jumlah_penjualan'],
            ]);
    
            // Cek apakah response berhasil
            if ($response->successful()) {
                return redirect()->route('data_keluar') // Redirect ke halaman data_keluar.blade.php setelah berhasil
                    ->with('message', 'Penjualan ikan berhasil ditambahkan.');
            } else {
                // Log dan throw error jika gagal
                $errorMessage = 'Gagal menambahkan penjualan ikan: ' . $response->body();
                Log::error($errorMessage);
                return redirect()->route('admin.penjualan_ikan')
                    ->withErrors(['error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan selama request
            Log::error('Error storing penjualan ikan: ' . $e->getMessage());
            return redirect()->route('admin.penjualan_ikan')
                ->withErrors(['error' => 'Gagal menambahkan penjualan ikan.']);
        }
    }
    

    /**
     * Menghapus data penjualan ikan.
     */
    public function destroy($id)
    {
        $token = session('auth_token');

        // Cek jika token tidak ada
        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi token melalui API
        $validToken = $this->validateToken($token);
        if (!$validToken) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }

        try {
            // Hapus data penjualan ikan dari API eksternal
            $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/penjualan_ikan/{$id}");

            // Cek apakah response berhasil
            if ($response->successful()) {
                return redirect()->route('admin.penjualan_ikan')
                    ->with('message', 'Penjualan ikan berhasil dihapus.');
            } else {
                // Log dan throw error jika gagal
                $errorMessage = 'Gagal menghapus penjualan ikan: ' . $response->body();
                Log::error($errorMessage);
                return redirect()->route('admin.penjualan_ikan')
                    ->withErrors(['error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan selama request
            Log::error('Error deleting penjualan ikan: ' . $e->getMessage());
            return redirect()->route('admin.penjualan_ikan')
                ->withErrors(['error' => 'Gagal menghapus penjualan ikan.']);
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

            // Jika response sukses, token valid
            return $response->successful();
        } catch (\Exception $e) {
            // Log error jika terjadi masalah saat validasi token
            Log::error('Error validating token: ' . $e->getMessage());
            return false; // Token tidak valid jika gagal
        }
    }

    public function dataKeluar()
    {
        $token = session('auth_token');

        // Cek apakah token ada, jika tidak redirect ke halaman login
        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi token melalui API
        $validToken = $this->validateToken($token);
        if (!$validToken) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
        }

        try {
            // Ambil data penjualan ikan dari API eksternal
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/penjualan_ikan');

            // Pastikan respons sukses
            if ($response->successful()) {
                return view('admin.data_keluar', ['data' => $response->json()]); // Menampilkan data pada view 'data_keluar'
            } else {
                throw new \Exception('Gagal mengambil data penjualan ikan: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error fetching penjualan ikan: ' . $e->getMessage());
            return redirect()->route('admin.penjualan_ikan')
                ->withErrors(['error' => 'Gagal mengambil data penjualan ikan.']);
        }
    }
}
