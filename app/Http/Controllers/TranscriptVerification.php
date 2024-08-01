<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use NcJoes\OfficeConverter\OfficeConverter;
use Ramsey\Uuid\Uuid;

class TranscriptVerification extends Controller
{
    public function show($fileName)
    {
        // Tentukan path lengkap ke direktori penyimpanan
        $directoryPath = 'documents/transkrip/';
        
        // Tentukan path lengkap ke file
        $filePath = $directoryPath . $fileName;

        // Periksa apakah file ada di direktori tersebut
        if (Storage::exists($filePath)) {
            $filePath = str_replace('C:\skripsi\storage\app/', '', $filePath);

            // Pastikan path benar untuk penyimpanan di Laravel
            $fullPath = storage_path('app/' . $filePath);
    
                $uuid = Uuid::uuid4()->toString();
                $randomFileName = $uuid . '.pdf';
                
                $converter = new OfficeConverter($fullPath, null, 'soffice', false);
                $converter->convertTo('../../public/pdf/'.$randomFileName);
                $outputFileName = basename($randomFileName);
                $outputPath = 'storage/pdf/' . $outputFileName;
            
            return view('page.qrcode', [
                'surat' => $outputPath
            ]);
        } else {
            // Jika file tidak ada, tampilkan pesan error atau alihkan
            return abort(404, 'File not found.');
        }
    }
}