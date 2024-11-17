<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    /**
     * menampilkan daftar produk dari api eksternal.
     */
    public function produk()
    {
        $token = session('auth_token'); // ambil token dari session

        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'anda harus login terlebih dahulu.']);
        }

        try {
            // ambil data produk dari api eksternal
            $response = Http::withToken($token)
                ->get('http://127.0.0.1:8000/api/kolam');

            if ($response->successful()) {
                $produk = $response->json(); // data array dari api
                return view('admin.produk', compact('produk'));
            } else {
                throw new \Exception('gagal mengambil data produk: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.dashboard')
                ->withErrors(['error' => 'gagal memuat data produk.']);
        }
    }

    /**
     * menyimpan produk baru ke api eksternal.
     */
    public function storeProduk(Request $request)
    {
        $token = session('auth_token');

        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'anda harus login terlebih dahulu.']);
        }

        // validasi input
        $request->validate([
            'nama_kolam' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'total_ikan' => 'required|integer',
            'total_pakan' => 'required|integer',
        ]);

        try {
            $response = Http::withToken($token)
                ->post('http://127.0.0.1:8000/api/kolam', $request->all());

            if ($response->successful()) {
                return redirect()->route('admin.produk')
                    ->with('message', 'produk berhasil ditambahkan.');
            } else {
                throw new \Exception('gagal menambahkan produk: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.produk')
                ->withErrors(['error' => 'gagal menambahkan produk.']);
        }
    }

    /**
     * menampilkan form edit produk.
     */
    public function editProduk($id)
    {
        $token = session('auth_token');

        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'anda harus login terlebih dahulu.']);
        }

        try {
            $response = Http::withToken($token)
                ->get("http://127.0.0.1:8000/api/kolam/{$id}");

            if ($response->successful()) {
                $produk = $response->json();
                return view('admin.produk_edit', compact('produk'));
            } else {
                throw new \Exception('gagal memuat data produk: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.produk')
                ->withErrors(['error' => 'gagal memuat data produk untuk di-edit.']);
        }
    }

    /**
     * memperbarui produk di api eksternal.
     */
    public function updateProduk(Request $request, $id)
    {
        $token = session('auth_token');

        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'anda harus login terlebih dahulu.']);
        }

        // validasi input
        $request->validate([
            'nama_kolam' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'total_ikan' => 'required|integer',
            'total_pakan' => 'required|integer',
        ]);

        try {
            $response = Http::withToken($token)
                ->put("http://127.0.0.1:8000/api/kolam/{$id}", $request->all());

            if ($response->successful()) {
                return redirect()->route('admin.produk')
                    ->with('message', 'produk berhasil diperbarui.');
            } else {
                throw new \Exception('gagal memperbarui produk: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.produk')
                ->withErrors(['error' => 'gagal memperbarui produk.']);
        }
    }

    /**
     * menghapus produk dari api eksternal.
     */
    public function hapusProduk($id)
    {
        $token = session('auth_token');

        if (!$token) {
            return redirect()->route('showLogin')
                ->withErrors(['error' => 'anda harus login terlebih dahulu.']);
        }

        try {
            $response = Http::withToken($token)
                ->delete("http://127.0.0.1:8000/api/kolam/{$id}");

            if ($response->successful()) {
                return redirect()->route('admin.produk')
                    ->with('message', 'produk berhasil dihapus.');
            } else {
                throw new \Exception('gagal menghapus produk: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin.produk')
                ->withErrors(['error' => 'gagal menghapus produk.']);
        }
    }
}
