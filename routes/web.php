<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiAkademikController;
use App\Http\Controllers\FormPengajuanSuratMahasiswaAktifController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengantarMagangController;
use App\Http\Controllers\PengantarPenelitianController;
use App\Http\Controllers\PengunduranDiriController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\staff\PengantarMagangStaffController;
use App\Http\Controllers\staff\PengantarPenelitianStaffController;
use App\Http\Controllers\staff\RedirectToRightViewController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TranscriptVerification;
use App\Http\Controllers\TranskripAkademikSementaraController;
use App\Http\Controllers\VerificationDocument;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function(){
    return view('page.unauthorized');
}
);

// Route::group(['middleware' => ['auth', 'role:admin']], function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin_page');
    // Rute lain untuk admin
    Route::get('/admin/template/{filename}/show', [AdminController::class, 'show']);
    Route::post('admin/template/store', [AdminController::class, 'store'])->name('template.store');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/template/{filename}', [AdminController::class, 'show'])->name('admin.show');
// });

// Route::group(['middleware' => ['auth', 'role:staff']], function() {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff_page');
    Route::get('/staff/pengajuan-surat/download/{id}', [StaffController::class, 'downloadFile'])->name('staff_page.download.surat');

    Route::get('staff/lihat/redirect/{id}', [RedirectToRightViewController::class, 'redirectToLihat'])->name('redirectToLihat');

    Route::get('staff/pengantar-magang/show/{id}', [PengantarMagangStaffController::class, 'show'])->name('pengantar-magang-staff-show');
    Route::post('/staff/pengajuan-surat/setujui/{id}', [PengantarMagangStaffController::class, 'setujui'])->name('staff_page.setujui.surat');
    Route::get('/staff/pengajuan-surat/show/tolak/{id}', [PengantarMagangStaffController::class, 'showTolak'])->name('staff_page.show.tolak.surat');
    Route::post('/staff/pengajuan-surat/tolak/{id}', [PengantarMagangStaffController::class, 'tolak'])->name('staff_page.tolak.surat');
    Route::get('/staff/edit/pengajuan-surat/pengantar-magang/{id}', [PengantarMagangStaffController::class, 'editPengantarMagang'])->name('staff_page.edit.pengantar_magang');
    Route::put('/staff/update/pengajuan-surat/pengantar-magang/{id}', [PengantarMagangStaffController::class, 'updatePengantarMagang'])->name('staff_page.update.pengantar_magang');

    Route::get('staff/edit/pengajuan-surat/mahasiswa-aktif/{id}', [FormPengajuanSuratMahasiswaAktifController::class, 'edit'])->name('mahasiswa-aktif-edit');
    Route::put('staff/edit/pengajuan-surat/mahasiswa-aktif/{id}', [FormPengajuanSuratMahasiswaAktifController::class, 'update'])->name('mahasiswa-aktif-update');


    Route::get('staff/show/pengajuan-surat/pengantar-penelitian/{id}', [PengantarPenelitianStaffController::class, 'show'])->name('staff-pengantar-penelitian-show');
    Route::post('staff/show/pengajuan-surat/setujui/pengantar-penelitian/{id}', [PengantarPenelitianStaffController::class, 'setujui'])->name('staff-pengantar-penelitian-setujui');
// });


    // Rute lain untuk staff
    // Route::get('staff', function () {
    //     return view('page.staff.main');
    // });
// });

Route::group(['middleware' => ['auth', 'role:mahasiswa']], function() {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/autocomplete', [MahasiswaController::class, 'autocomplete'])->name('autocomplete');

    // Rute lain untuk mahasiswa
    Route::get('/', function () {
        return view('page.home.main');
    });
    Route::get('deskripsi/mahasiswa-aktif', function () {
        return view('page.deskripsi.mahasiswa-aktif');
    });
    Route::get('deskripsi/mahasiswa-aktif', [FormPengajuanSuratMahasiswaAktifController::class, 'index'])->name('mahasiswa-aktif-index');
    Route::get('deskripsi/mahasiswa-aktif/buat', [FormPengajuanSuratMahasiswaAktifController::class, 'create']);
    Route::post('deskripsi/mahasiswa-aktif/buat', [FormPengajuanSuratMahasiswaAktifController::class, 'store'])->name('mahasiswa-aktif-store');
    Route::get('deskripsi/mahasiswa-aktif/alasan-di-tolak/{id}', [FormPengajuanSuratMahasiswaAktifController::class, 'showAlasanDiTolak'])->name('showAlasanDiTolakMahasiswaAktif');
    Route::post('deskripsi/mahasiswa-aktif/setujui/{id}', [FormPengajuanSuratMahasiswaAktifController::class, 'setujui'])->name('setujuiMahasiswaAktif');


    Route::get('/mahasiswa', [StudentController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa-fetch', [StudentController::class, 'fetchDataMahasiswa'])->name('mahasiswa.fetch');

    Route::get('deskripsi/cuti-akademik', [CutiAkademikController::class, 'index'])->name('cuti-akademik-deskripsi');
    Route::get('deskripsi/cuti-akademik/buat', [CutiAkademikController::class, 'create'])->name('cuti-akademik-create');
    Route::post('deskripsi/cuti-akademik/buat', [CutiAkademikController::class, 'store'])->name('cuti-akademik-store');
    Route::get('deskripsi/cuti-akademik/download/file', [CutiAkademikController::class, 'downloadFile'])->name('downloadFileCutiAkademik');
    Route::get('deskripsi/cuti-akademik/lihat/file/{id}', [CutiAkademikController::class, 'show'])->name('show-surat');
    Route::get('deskripsi/cuti-akademik/setujui/{id}', [CutiAkademikController::class, 'setujui'])->name('cuti-akademik-setujui');
    Route::get('deskripsi/cuti-akademik/detail/{id}', [CutiAkademikController::class, 'detail'])->name('cuti-akademik-detail');
    Route::get('deskripsi/cuti-akademik/alasan-di-tolak/{id}', [CutiAkademikController::class, 'showAlasanDiTolak'])->name('showAlasanDiTolakCutiAkademik');

    Route::get('deskripsi/pengantar-magang', [PengantarMagangController::class, 'index'])->name('deskripsi.magang');
    Route::get('deskripsi/pengantar-magang/buat', [PengantarMagangController::class, 'create']);
    Route::post('deskripsi/pengantar-magang/buat', [PengantarMagangController::class, 'store'])->name('store.pengantar-magang');
    Route::get('deskripsi/pengantar-magang/alasan-di-tolak/{id}', [PengantarMagangController::class, 'showAlasanDiTolak'])->name('showAlasanDiTolak');

    Route::get('deskripsi/pengantar-penelitian', [PengantarPenelitianController::class, 'index'])->name('deskripsi-pengantar-penelitian');
    Route::get('deskripsi/pengantar-penelitian/buat', [PengantarPenelitianController::class, 'create'])->name('create-pengantar-penelitian');
    Route::post('deskripsi/pengantar-penelitian/buat', [PengantarPenelitianController::class, 'store'])->name('post-pengantar-penelitian');
    Route::get('deskripsi/pengantar-penelitian/alasan-di-tolak/{id}', [PengantarPenelitianController::class, 'showAlasanDiTolak'])->name('showAlasanDiTolakPengantarPenelitian');




    Route::get('deskripsi/transkrip-akademik-sementara',[TranskripAkademikSementaraController::class, 'index'])->name('transkrip-akademik-sementara-index');
    Route::post('deskripsi/transkrip-akademik-sementara/download',[TranskripAkademikSementaraController::class, 'store'])->name('transkrip-akademik-sementara-store');
    Route::get('deskripsi/legalisir-mahasiswa/buat', function () {
        return view('page.deskripsi.buat-legalisir-mahasiswa');
    });


    Route::get('deskripsi/pengunduran-diri', [PengunduranDiriController::class, 'index'])->name('pengunduranDiriIndex');
    Route::get('deskripsi/pengunduran-diri/download-file', [PengunduranDiriController::class, 'downloadFile'])->name('pengunduranDiriDownloadFile');
    Route::get('deskripsi/pengunduran-diri/buat', [PengunduranDiriController::class, 'create'])->name('pengunduranDiriCreate');
    Route::post('deskripsi/pengunduran-diri/buat', [PengunduranDiriController::class, 'store'])->name('pengunduranDiriStore');
    Route::get('deskripsi/pengunduran-diri/alasan-di-tolak/{id}', [PengunduranDiriController::class, 'showAlasanDiTolak'])->name('alasanDiTolakPengunduranDiri');
    Route::get('deskripsi/pengunduran-diri/lihat/file/{id}', [PengunduranDiriController::class, 'show'])->name('show-surat-pengunduran-diri');
    Route::get('deskripsi/pengunduran-diri/setujui/{id}', [PengunduranDiriController::class, 'setujui'])->name('setujui-surat-pengunduran-diri');
    Route::get('deskripsi/pengunduran-diri/download-file-setuju/{id}', [PengunduranDiriController::class, 'downloadFileYangDisetujui'])->name('download-surat-pengunduran-diri');

});

Route::get('qrcode/{id}', [VerificationDocument::class, 'show'])->name('qrcode-page');
Route::get('qrcode/transkrip/{id}', [TranscriptVerification::class, 'show'])->name('qrcode-page-transkrip');


Route::get('/pending', function(){
    return view('page.pending');
})->name('page.pending');