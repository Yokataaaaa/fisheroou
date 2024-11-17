<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\KaryawanImport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    // Menampilkan daftar karyawan ke halaman web
    public function index()
    {
        // Mengambil data karyawan yang role-nya bukan "manager"
        $karyawan = User::where('role', '!=', 'manager')->get();

        // Mengembalikan view dengan data karyawan
        return view('karyawan.index', compact('karyawan'));
    }

    // Method untuk mengimpor data karyawan
    public function import(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        // Mengimpor data karyawan
        Excel::import(new KaryawanImport, $request->file('file'));

        // Redirect kembali dengan pesan sukses
        return redirect()->route('karyawan.index')->with('message', 'Data karyawan berhasil diimpor');
    }

    // Method untuk menghapus karyawan
    public function destroy($id)
    {
        // Mencari karyawan berdasarkan ID
        $karyawan = User::find($id);

        // Jika data karyawan tidak ditemukan
        if (!$karyawan) {
            return redirect()->route('karyawan.index')->with('error', 'Data karyawan tidak ditemukan.');
        }

        // Menghapus data karyawan
        $karyawan->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('karyawan.index')->with('message', 'Data karyawan berhasil dihapus.');
    }
}
