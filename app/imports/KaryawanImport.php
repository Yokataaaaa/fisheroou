<?php

namespace App\Imports;

use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class KaryawanImport implements ToCollection, WithHeadingRow
{
    /**
     * Proses setiap baris dari file Excel yang diimpor.
     *
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // Ambil token dari session
        $token = session('auth_token');

        // Cek apakah token valid dengan API
        if (!$this->isTokenValid($token)) {
            \Log::error('Token tidak valid');
            return; // Jika token tidak valid, hentikan proses import
        }

        foreach ($rows as $row) {
            // Convert Collection to array
            $rowArray = $row->toArray();

            // Validasi data sebelum diproses (optional, jika diperlukan)
            if ($this->isValidData($rowArray)) {
                $this->importKaryawan($rowArray, $token);
            } else {
                \Log::error('Data tidak valid', $rowArray);
            }
        }
    }

    /**
     * Validasi apakah token masih valid dengan API eksternal.
     *
     * @param string $token
     * @return bool
     */
    private function isTokenValid(string $token): bool
    {
        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');

        // Cek apakah response berhasil
        return $response->successful();
    }

    /**
     * Validasi apakah baris memiliki data yang diperlukan.
     *
     * @param array $row
     * @return bool
     */
    private function isValidData(array $row): bool
    {
        // Validasi data jika diperlukan (misalnya cek apakah kolom wajib ada)
        return isset($row['username'], $row['password'], $row['email'], $row['nama']);
    }

    /**
     * Kirim data karyawan ke API eksternal.
     *
     * @param array $row
     * @param string $token
     */
    private function importKaryawan(array $row, string $token): void
    {
        // Kirim data ke API eksternal untuk disimpan menggunakan token
        $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/karyawan/import', [
            'username' => $row['username'],
            'password' => Hash::make($row['password']), // Menggunakan hash untuk password
            'email' => $row['email'],
            'nama' => $row['nama'],
            'no_telp' => $row['no_telp'],
            'alamat' => $row['alamat'],
            'role' => 'karyawan',
        ]);

        // Cek apakah request API berhasil dan log responsnya
        if ($response->successful()) {
            // Jika berhasil, log data yang berhasil disimpan
            $this->logSuccess($row);
        } else {
            // Jika gagal, log kesalahan
            $this->logError($response, $row);
        }
    }

    /**
     * Log data yang berhasil disimpan.
     *
     * @param array $row
     */
    private function logSuccess(array $row): void
    {
        // Implementasikan logging yang sesuai, misalnya:
        \Log::info('Karyawan berhasil disimpan', $row);
    }

    /**
     * Log kesalahan saat mengirim data ke API.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @param array $row
     */
    private function logError($response, array $row): void
    {
        // Implementasikan logging kesalahan, misalnya:
        \Log::error('Gagal menyimpan karyawan', [
            'row' => $row,
            'error' => $response->body(),
            'status' => $response->status(),
        ]);
    }
}
