<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PembelianPakanController extends Controller
{
    /**
     * Menampilkan daftar pembelian pakan.
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
            // Ambil data pembelian pakan dari API eksternal
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/pembelian_pakan');

            // Pastikan respons sukses
            if ($response->successful()) {
                return view('admin.data_masuk', ['data' => $response->json()]);  // Menampilkan data pada view yang sesuai
            } else {
                throw new \Exception('Gagal mengambil data pembelian pakan: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error fetching pembelian pakan: ' . $e->getMessage());
            return redirect()->route('admin.pembelian_pakan')
                ->withErrors(['error' => 'Gagal mengambil data pembelian pakan.']);
        }
    }

    /**
     * Menyimpan data pembelian pakan baru.
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
        'nama_pakan' => 'required|string|max:255', // Nama pakan wajib diisi dan berupa string dengan panjang maksimal 255 karakter
        'deskripsi' => 'nullable|string',           // Deskripsi opsional dan berupa string
        'nama_kolam' => 'required|string',          // Nama kolam wajib diisi dan berupa string
        'jumlah_pembelian' => 'required|integer',   // Jumlah pembelian wajib diisi dan berupa integer
    ]);

    try {
        // Kirim data pembelian pakan ke API eksternal
        $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/pembelian_pakan', [
            'nama_pakan' => $validated['nama_pakan'],
            'deskripsi' => $validated['deskripsi'] ?? null,  // Gunakan null jika deskripsi kosong
            'nama_kolam' => $validated['nama_kolam'],        // Menggunakan nama kolam dari input
            'jumlah_pembelian' => $validated['jumlah_pembelian'],
        ]);

        // Cek apakah response berhasil
        if ($response->successful()) {
            return redirect()->route('data_masuk') // Redirect ke halaman data_masuk.blade.php setelah berhasil
                ->with('message', 'Pembelian pakan berhasil ditambahkan.');
        } else {
            // Log dan throw error jika gagal
            $errorMessage = 'Gagal menambahkan pembelian pakan: ' . $response->body();
            Log::error($errorMessage);
            return redirect()->route('admin.pembelian_pakan')
                ->withErrors(['error' => $errorMessage]);
        }
    } catch (\Exception $e) {
        // Log error jika terjadi kesalahan selama request
        Log::error('Error storing pembelian pakan: ' . $e->getMessage());
        return redirect()->route('admin.pembelian_pakan')
            ->withErrors(['error' => 'Gagal menambahkan pembelian pakan.']);
    }
}



    /**
     * Menghapus data pembelian pakan.
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
            // Hapus data pembelian pakan dari API eksternal
            $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/pembelian_pakan/{$id}");

            // Cek apakah response berhasil
            if ($response->successful()) {
                return redirect()->route('admin.pembelian_pakan')
                    ->with('message', 'Pembelian pakan berhasil dihapus.');
            } else {
                // Log dan throw error jika gagal
                $errorMessage = 'Gagal menghapus pembelian pakan: ' . $response->body();
                Log::error($errorMessage);
                return redirect()->route('admin.pembelian_pakan')
                    ->withErrors(['error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan selama request
            Log::error('Error deleting pembelian pakan: ' . $e->getMessage());
            return redirect()->route('admin.pembelian_pakan')
                ->withErrors(['error' => 'Gagal menghapus pembelian pakan.']);
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
            return false;  // Token tidak valid jika gagal
        }
    }
}
