<?php

namespace App\Http\Controllers;

use App\Models\FormSurat;
use App\Models\Surat;
use App\Services\FetchMahasiswaService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PengantarMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriSurat = DB::table('kategori_surat')->where('nama', 'surat pengantar magang')->first();

        if (!$kategoriSurat) {
            return redirect()->back()->with('error', 'Kategori surat tidak ditemukan.');
        }

        $riwayat = Surat::with('user', 'kategoriSurat')
                        ->where('user_id', Auth::id())
                        ->where('kategori_surat_id', $kategoriSurat->id)
                        ->get();

        return view('page.deskripsi.pengantar-magang', compact('riwayat'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();

        // Mengecek apakah ada surat dengan status 'pending' untuk user ini
        $pendingSurat = Surat::where('user_id', $userId)
                             ->where('status', Surat::STATUS_PENDING)->where('kategori_surat_id', 1)
                             ->first();

        // Jika ada surat dengan status 'pending', alihkan ke halaman 'pending'
        if ($pendingSurat) {
            return redirect()->route('page.pending');
        }
        $fetchmahasiswa = new FetchMahasiswaService();
        $data_mahasiswa = $fetchmahasiswa->fetchDataMahasiswa(Auth::user()->email);

        
        return view('page/deskripsi/buat-pengantar-magang', compact('data_mahasiswa'));
    }

    public function store(Request $request){
        
        $kategoriSurat = DB::table('kategori_surat')->where('nama', '=' ,'surat pengantar magang')->first();
        $surat = Surat::create([
            'user_id' => Auth::id(),
            'kategori_surat_id' => $kategoriSurat->id,
            'status' => 'pending',
            'file_surat' => $request->file_surat
        ]);

        $lembar_pengesahan = $request->file('lembar_pengesahan');
        $lembar_pengesahan->storeAs('public/pengantar-magang/lembar-pengesahan', $lembar_pengesahan->hashName());


        $additionalFields = $request->except([
            'user_id', 'kategori_surat_id', 'disetujui', 'file_surat',
            'nama_mahasiswa_1', 'nim_1', 'no_hp', 'email_mahasiswa', 'jurusan', 'opsi_surat', 'lembar_pengesahan'
        ]);

        FormSurat::create([
            'surat_id' => $surat->id,
            'nama_mahasiswa_1' => $request->nama_mahasiswa_1,
            'nim_1' => $request->nim_1,
            'no_hp' => $request->no_hp,
            'email_mahasiswa' => $request->email_mahasiswa,
            'tanggal_mulai_magang' => $request->tanggal_mulai_magang,
            'tanggal_mulai_magang' => $request->tanggal_mulai_magang,
            'jurusan' => $request->jurusan,
            'opsi_surat' => $request->opsi_surat,
            'lembar_pengesahan' => $lembar_pengesahan->hashName(),
            'additional_fields' => $additionalFields
        ]);

        session()->flash('success', 'Surat berhasil diajukan.');

         return redirect()->route('deskripsi.magang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    //  public function generateDoc(Request $request)
    //  {
    //      $outputDirectory = storage_path('app/documents');
    //      if (!File::isDirectory($outputDirectory)) {
    //          File::makeDirectory($outputDirectory, 0755, true);
    //      }

         function formatTanggal($tanggal) {
             $date = new DateTime($tanggal);
             $bulan = array(
                 1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
             );
             $formattedTanggal = $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
             return $formattedTanggal;
         }

    public function showAlasanDiTolak($id){
            $surat = Surat::findOrFail($id);
            $alasan = $surat->alasan_ditolak;
            return view('page.tolak.pengantar-magang-tolak', compact('alasan'));
        }

        public function getMahasiswaSugestion($keyword){
            $apiUrl = "https://dashboard.uisi.ac.id/api/queries/102/results";
            $headers = [
                'Authorization' => 'Key HCCJsoZoBgOQdqj889ihIqLfla0CF1upezdGj1BF',
                'Content-Type' => 'application/json',
            ];
    
            $payload = [
                'max_age' => 600,
                'apply_auto_limit' => false,
                'parameters' => [
                    'filter' => $keyword
                ],
            ];
            $response = Http::withHeaders($headers)->post($apiUrl, $payload);
            if ($response->successful()) {
                $responseData = $response->json();
                // Proses data dari API sesuai kebutuhan
                return response()->json($responseData);
            } else {
                // Menangani error
                return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
            }
    
        }
}