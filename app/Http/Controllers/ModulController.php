<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ModulController extends Controller
{
    /**
     * Menampilkan data modul dari API eksternal.
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
            // Ambil data modul dari API eksternal
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/modul');

            // Pastikan respons sukses (kode status 2xx)
            if ($response->successful()) {
                return view('admin.modul', ['moduls' => $response->json()]); // Menampilkan data pada view 'modul'
            } else {
                // Tangani respon gagal dari API
                throw new \Exception('Gagal mengambil data modul: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Log error dan tampilkan pesan kesalahan kepada pengguna
            Log::error('Error fetching modul data: ' . $e->getMessage());
            return redirect()->route('admin.modul')
                ->withErrors(['error' => 'Gagal mengambil data modul. Silakan coba lagi nanti.']);
        }
    }

    /**
     * Menyimpan data modul baru ke API eksternal.
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

    // Validasi token melalui API eksternal
    if (!$this->validateToken($token)) {
        return redirect()->route('showLogin')
            ->withErrors(['error' => 'Token tidak valid, silakan login kembali.']);
    }

    // Validasi input data dari form
    $validated = $request->validate([
        'judul' => 'required|string|max:255',                   // Judul wajib diisi dan berupa string
        'deskripsi' => 'required|string|max:255',               // Deskripsi wajib diisi dan berupa string
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional, tipe jpeg/png/jpg, max 2MB
        'file_path' => 'nullable|mimes:pdf|max:10240',           // File opsional, tipe PDF, max 10MB
    ]);

    try {
        // Siapkan data untuk dikirim ke API
        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
        ];

        // Jika ada file gambar yang diunggah, simpan dan encode ke base64
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->move(public_path('images'), $imageName); // Simpan gambar ke folder 'public/images'
            $data['image_path'] = base64_encode(file_get_contents($imagePath));
        }

        // Jika ada file PDF yang diunggah, simpan dan encode ke base64
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('modul'), $fileName); // Simpan file ke folder 'public/modul'
            $data['file_path'] = base64_encode(file_get_contents($filePath));
        }

        // Kirim data modul ke API eksternal
        $response = Http::withToken($token)
            ->post('http://127.0.0.1:8000/api/modul', $data);

        // Cek apakah respons berhasil
        if ($response->successful()) {
            return redirect()->route('admin.modul')
                ->with('message', 'Modul berhasil ditambahkan.');
        } else {
            throw new \Exception('Gagal menambahkan modul: ' . $response->body());
        }
    } catch (\Exception $e) {
        // Log dan tampilkan pesan kesalahan
        Log::error('Error adding modul: ' . $e->getMessage());
        return redirect()->route('admin.modul')
            ->withErrors(['error' => 'Gagal menambahkan modul. Silakan coba lagi nanti.']);
    }
}




    /**
     * Menghapus data modul dari API eksternal.
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
            // Hapus data modul dari API eksternal
            $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/modul/{$id}");

            // Cek apakah respons berhasil
            if ($response->successful()) {
                return redirect()->route('admin.modul')
                    ->with('message', 'Modul berhasil dihapus.');
            } else {
                throw new \Exception('Gagal menghapus modul: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Log dan tampilkan pesan kesalahan
            Log::error('Error deleting modul: ' . $e->getMessage());
            return redirect()->route('admin.modul')
                ->withErrors(['error' => 'Gagal menghapus modul. Silakan coba lagi nanti.']);
        }
    }
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
            'judul' => 'required|string',                  // Judul wajib diisi dan berupa string
            'deskripsi' => 'required|string',              // Deskripsi wajib diisi dan berupa string
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional, tipe jpeg, png, jpg, max 2MB
            'file' => 'nullable|mimes:pdf|max:10240',      // File opsional, tipe pdf, max 10MB
        ]);

        try {
            // Siapkan data untuk dikirim ke API
            $data = [
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
            ];

            // Jika ada file gambar yang diunggah, tambahkan ke data
            if ($request->hasFile('image')) {
                $data['image'] = base64_encode(file_get_contents($request->file('image')->getRealPath()));
            }

            // Jika ada file PDF yang diunggah, tambahkan ke data
            if ($request->hasFile('file')) {
                $data['file'] = base64_encode(file_get_contents($request->file('file')->getRealPath()));
            }

            // Kirim data modul yang sudah diperbarui ke API eksternal
            $response = Http::withToken($token)->put("http://127.0.0.1:8000/api/modul/{$id}", $data);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                return redirect()->route('admin.modul')
                    ->with('message', 'Modul berhasil diperbarui.');
            } else {
                throw new \Exception('Gagal memperbarui modul: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Log dan tampilkan pesan kesalahan
            Log::error('Error updating modul: ' . $e->getMessage());
            return redirect()->route('admin.modul')
                ->withErrors(['error' => 'Gagal memperbarui modul. Silakan coba lagi nanti.']);
        }
    }
    /**
     * Memvalidasi token dengan API eksternal.
     */

    public function create()
    {
        // Pastikan nama view sesuai dengan nama file Blade Anda
        return view('admin.tambah_modul');
    }
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
}
