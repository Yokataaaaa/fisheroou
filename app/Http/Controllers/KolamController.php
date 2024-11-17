<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KolamController extends Controller
{
    public function index()
    {
        $token = session('auth_token');
        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/kolam');

        return $response->successful()
            ? response()->json($response->json())
            : response()->json(['error' => 'Gagal mengambil data kolam.'], 500);
    }

    public function store(Request $request)
    {
        $token = session('auth_token');
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
        ]);

        $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/kolam', $validated);

        return $response->successful()
            ? response()->json(['message' => 'Kolam berhasil ditambahkan.'])
            : response()->json(['error' => 'Gagal menambahkan kolam.'], 500);
    }

    public function destroy($id)
    {
        $token = session('auth_token');
        $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/kolam/{$id}");

        return $response->successful()
            ? response()->json(['message' => 'Kolam berhasil dihapus.'])
            : response()->json(['error' => 'Gagal menghapus kolam.'], 500);
    }
}

