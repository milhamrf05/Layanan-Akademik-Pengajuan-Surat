<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FetchMahasiswaService
{
    protected $apiUrl;

    public function fetchDataMahasiswa($email)
    {

        // Buat URL untuk permintaan ke API
        $apiUrl = "https://testing.uisi.ac.id/siakad/api/get_data_mahasiswa?id=" . urlencode($email) . '&token=' .  env('API_TOKEN');

        // Lakukan permintaan ke API
        $response = Http::get($apiUrl);
        $data = $response->json();

        // Ambil dan kembalikan data JSON dari respons
        return $data['data'];
    }
}