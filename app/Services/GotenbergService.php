<?php

namespace App\Services;

use Gotenberg\Gotenberg;
use Gotenberg\Stream;
use Illuminate\Support\Facades\Storage;

class GotenbergService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('GOTENBERG_URL');
    }

    public function convertDocxToPdf($filePath)
    {
        // Membuat request konversi
        $request = Gotenberg::libreOffice($this->apiUrl)
            ->convert(Stream::path(storage_path('app/' . $filePath)));

        // Tentukan path output untuk file PDF
        $outputPath = 'pdf/' . basename($filePath, '.docx') . '.pdf';

        // Simpan file PDF yang telah dikonversi ke storage
        $response = Gotenberg::save($request, storage_path('app/pdf/'));

        // Pindahkan file PDF ke lokasi yang benar dalam storage
        Storage::put($outputPath, file_get_contents($response));

        return $outputPath;
    }
}