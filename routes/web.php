<?php

use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
    Route::post('/siswa/import_excel', [SiswaController::class, 'import'])->name('admin.import.siswa');
    Route::get('/siswa/pdf', [SiswaController::class, 'pdf'])->name('admin.siswa.pdf');
    Route::get('/siswa/pdf/read/{nis}', [SiswaController::class, 'read_pdf'])->name('admin.siswa.read.pdf');

    Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('admin.registrasi');
    Route::get('/registrasi/export', [RegistrasiController::class, 'export'])->name('admin.registrasi.export');


    Route::get('/scan', [RegistrasiController::class, 'scan'])->name('admin.scan');
    Route::post('/submit-preview', [RegistrasiController::class, 'submit_preview'])->name('admin.submit-preview');
    Route::get('/preview/{barcode}', [RegistrasiController::class, 'preview'])->name('admin.preview');
});



Auth::routes();

Route::get('/', function () {
    if (Auth::user()) {
        return redirect()->route('admin.scan');
    }
    return redirect('/login');
});

Route::get('/home', function () {
    if (Auth::user()) {
        return redirect()->route('admin.scan');
    }
    return redirect('/login');
});
