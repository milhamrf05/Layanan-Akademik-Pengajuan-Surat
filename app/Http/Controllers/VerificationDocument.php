<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use NcJoes\OfficeConverter\OfficeConverter;
use Ramsey\Uuid\Uuid;

class VerificationDocument extends Controller
{
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $surat = Surat::findOrFail($decryptedId);
            $filePath = str_replace('C:\skripsi\storage\app/', '', $surat->file_surat);

        // Pastikan path benar untuk penyimpanan di Laravel
        $fullPath = storage_path('app/' . $filePath);

            $uuid = Uuid::uuid4()->toString();
            $randomFileName = $uuid . '.pdf';
            
            $converter = new OfficeConverter($fullPath, null, 'soffice', false);
            $converter->convertTo('../public/pdf/'.$randomFileName);
            $outputFileName = basename($randomFileName);
            $outputPath = 'storage/pdf/' . $outputFileName;

            
            return view('page.qrcode', [
                'id' => $decryptedId,
                'surat' => $outputPath
            ]);
        } catch (DecryptException $e) {
            return abort(404);
        }
    }


}