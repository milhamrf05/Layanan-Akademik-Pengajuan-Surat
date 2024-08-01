<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/mahasiswa.json'); // Sesuaikan path dengan lokasi file JSON Anda

        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $students = json_decode($jsonData, true); // Decode JSON menjadi array PHP

            return response()->json($students);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
    public function search(Request $request)
    {
        // Path menuju file JSON
        $jsonFilePath = storage_path('app/mahasiswa.json');

        // Membaca dan mendecode isi file JSON menjadi array PHP
        $students = json_decode(file_get_contents($jsonFilePath), true);

        // Implementasi logika pencarian di sini
        $query = $request->input('query');
        $results = [];

        if (!empty($query)) {
            foreach ($students as $student) {
                // Jika nama mahasiswa mengandung substring dari query
                if (strpos(strtolower($student['Nama']), strtolower($query)) !== false) {
                    $results[] = [
                        'NIM' => $student['NIM'],
                        'Nama' => $student['Nama'],
                        'email' => $student['e-mail']
                    ];
                }
            }
        }

        // Return JSON response
        return response()->json($results);
    }

    public function fetchDataMahasiswa(Request $request)
    {
        // Ambil email dari query parameter
        $email = $request->query('email');

        // Buat URL untuk permintaan ke API
        $apiUrl = "https://testing.uisi.ac.id/siakad/api/get_data_mahasiswa?id=" . urlencode($email);

        // Lakukan permintaan ke API
        $response = Http::get($apiUrl);

        // Ambil dan kembalikan data JSON dari respons
        return response()->json($response->json());
    }
}
