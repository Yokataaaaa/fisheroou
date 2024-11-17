<?php

// app/Http/Middleware/CheckAuthToken.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckAuthToken
{
// app/Http/Middleware/CheckAuthToken.php
public function handle(Request $request, Closure $next)
{
    $token = session('auth_token');

    // Debug: Cek apakah token ada
    \Log::info('Token session: ', ['token' => $token]);

    if (!$token) {
        return redirect()->route('showLogin')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
    }

    // Verifikasi token
    $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/validate-token');
    if ($response->failed()) {
        return redirect()->route('showLogin')->withErrors(['error' => 'Token tidak valid.']);
    }

    return $next($request);
}

}
