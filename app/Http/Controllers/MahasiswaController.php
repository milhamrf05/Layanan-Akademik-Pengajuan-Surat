<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function index(){
        return 'ok';
    }
    
    public function autocomplete(Request $request)
    {
        $filePath = storage_path('app/mahasiswa.xlsx'); // Path ke file Excel Anda
        $rows = Excel::toArray([], $filePath)[0]; // Membaca data dari sheet pertama

        $query = $request->input('query');
        $data = array_filter($rows, function($row) use ($query) {
            return stripos($row[0], $query) !== false;
        });

        $result = array_map(function($row) {
            return [
                'nama' => $row[0],
                'nim' => $row[1],
            ];
        
        }, $data);

        return response()->json($result);
    }
}