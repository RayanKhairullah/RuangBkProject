<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PenjadwalanKonselingController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\SuratPanggilanController;
use App\Livewire\RoomTable;

//Users Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('biodatas/create', [BiodataController::class, 'create'])->name('biodatas.create');
    Route::post('biodatas', [BiodataController::class, 'store'])->name('biodatas.store');
    Route::get('biodatas/edit', [BiodataController::class, 'edit'])->name('biodatas.edit');
    Route::put('biodatas', [BiodataController::class, 'update'])->name('biodatas.update');
    Route::get('biodatas', [BiodataController::class, 'show'])->name('biodatas.show');
    Route::resource('penjadwalan', PenjadwalanKonselingController::class)->except(['show']);
    Route::post('penjadwalan/{penjadwalan}/send', [PenjadwalanKonselingController::class, 'send'])->name('penjadwalan.send');
    Route::resource('catatans', CatatanController::class)->except(['show']);
});

//Teachers Routes
Route::view('teacher/dashboard', 'teacher.dashboard')
    ->middleware(['auth', 'verified', 'teacher'])
    ->name('teacher.dashboard');

Route::middleware(['auth', 'verified', 'teacher'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('jurusans', JurusanController::class);
    Route::resource('rooms', RoomController::class);
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::get('users/{user}/download-biodata', [UserController::class, 'downloadBiodata'])->name('users.downloadBiodata');
    Route::get('penjadwalan/download', [PenjadwalanKonselingController::class, 'downloadAll'])->name('penjadwalan.download');
    // Form untuk memilih siswa
    Route::get('catatans/download-by-user', [CatatanController::class, 'showDownloadByUser'])
         ->name('catatans.downloadForm');
    // Proses download sesuai user_id terpilih
    Route::post('catatans/download-by-user', [CatatanController::class, 'downloadByUser'])
         ->name('catatans.downloadByUser');
    Route::get('catatans/download-all', [CatatanController::class, 'downloadAll'])
        ->name('catatans.downloadAll');
    Route::resource('catatans', CatatanController::class)->except(['show']);
    Route::get('penjadwalan/{penjadwalan}', [PenjadwalanKonselingController::class, 'show'])->name('penjadwalan.show');
    Route::get('catatans/{catatan}', [CatatanController::class, 'show'])->name('catatans.show');
    Route::resource('surat-panggilan', SuratPanggilanController::class);
    Route::get('surat-panggilan/{id}/download', [SuratPanggilanController::class, 'generate'])
            ->name('surat-panggilan.download');
    Route::get('users/{user}/biodata', [UserController::class, 'showBiodata'])->name('users.biodata');
    Route::get('rooms-livewire', RoomTable::class)->name('rooms.livewire');
    Route::get('jurusans/{jurusan}', [JurusanController::class, 'show'])->name('jurusans.show');
});

//Settings Routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/forbidden', function () {
    abort(403);
});


require __DIR__.'/auth.php';