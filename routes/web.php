    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\BiodataController;
    use App\Http\Controllers\CatatanController;
    use App\Http\Controllers\JurusanController;
    use App\Http\Controllers\RoomController;
    use App\Http\Controllers\SuratPanggilanController;
    use App\Http\Controllers\PenjadwalanKonselingController;
    use App\Livewire\Settings\Profile;
    use App\Livewire\Settings\Password;
    use App\Livewire\Settings\Appearance;
    use App\Http\Controllers\DocumentationController; // Pastikan controller diimpor

    // Halaman awal
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/dokumentasi', [DocumentationController::class, 'index'])
    ->name('documentation'); // Beri nama route 'documentation'
    
    // Untuk semua user yang sudah login & terverifikasi
    Route::middleware(['auth', 'verified'])->group(function () {
        // Biodata
        Route::get('biodatas/create', [BiodataController::class, 'create'])->name('biodatas.create');
        Route::post('biodatas', [BiodataController::class, 'store'])->name('biodatas.store');
        Route::get('biodatas/edit', [BiodataController::class, 'edit'])->name('biodatas.edit');
        Route::put('biodatas', [BiodataController::class, 'update'])->name('biodatas.update');
        Route::get('biodatas', [BiodataController::class, 'show'])->name('biodatas.show');

        // Konseling
        Route::resource('penjadwalan', PenjadwalanKonselingController::class)->except(['show']);
        Route::post('penjadwalan/{penjadwalan}/send', [PenjadwalanKonselingController::class, 'send'])->name('penjadwalan.send');
    });

    // Dashboard khusus guru
    Route::get('dashboard/teacher', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified', 'teacher'])
        ->name('dashboard.teacher');

    // Route khusus guru (admin/teacher)
    Route::middleware(['auth', 'verified', 'teacher'])->group(function () {
        // Master Data
        Route::resource('jurusans', JurusanController::class);
        Route::resource('rooms', RoomController::class);

        // Manajemen pengguna berdasarkan room (menggunakan kode_rooms)
        Route::prefix('rooms/{room}')->group(function () {
            Route::get('users/{user}/biodata', [RoomController::class, 'showUserBiodata'])->name('rooms.users.biodata');
            Route::get('users/{user}/download-biodata', [RoomController::class, 'downloadUserBiodata'])->name('rooms.users.downloadBiodata');
            Route::delete('users/{user}', [RoomController::class, 'destroyUser'])->name('rooms.users.destroy');
        }); 

        // Penjadwalan lengkap
        Route::get('penjadwalan/download', [PenjadwalanKonselingController::class, 'downloadAll'])->name('penjadwalan.download');
        Route::post('penjadwalan/{penjadwalan}/accept-and-calendar', [PenjadwalanKonselingController::class, 'acceptAndRedirectToCalendar'])
            ->name('penjadwalan.accept_and_calendar');
        Route::get('penjadwalan/{penjadwalan}/accept-and-calendar', [PenjadwalanKonselingController::class, 'acceptAndRedirectToCalendar'])
            ->name('penjadwalan.accept_and_calendar');
        Route::get('penjadwalan/{penjadwalan}/reject', 
            [PenjadwalanKonselingController::class,'reject'])
            ->name('penjadwalan.reject');
        Route::post('penjadwalan/{penjadwalan}/reject', 
            [PenjadwalanKonselingController::class,'reject'])
            ->name('penjadwalan.reject');

        // Catatan
        Route::resource('catatans', CatatanController::class)->except(['show']); // lengkap, termasuk show
        Route::get('catatans/download-by-user', [CatatanController::class, 'showDownloadByUser'])->name('catatans.downloadForm');
        Route::post('catatans/download-by-user', [CatatanController::class, 'downloadByUser'])->name('catatans.downloadByUser');
        Route::get('catatans/download-all', [CatatanController::class, 'downloadAll'])->name('catatans.downloadAll');

        // Surat Panggilan
        Route::get('surat_panggilans/{id}/stream-pdf', [SuratPanggilanController::class, 'streamPdf'])->name('surat_panggilans.stream_pdf');
        // Rute kustom untuk download PDF (EXISTING)
        Route::get('surat_panggilans/{id}/download', [SuratPanggilanController::class, 'generate'])->name('surat_panggilans.download');
        // Rute BARU untuk halaman preview yang meng-embed PDF
        Route::get('surat_panggilans/{id}/preview', [SuratPanggilanController::class, 'previewPdfPage'])->name('surat_panggilans.preview_page');
        // Rute resource untuk Surat Panggilan
        Route::resource('surat_panggilans', SuratPanggilanController::class);
    });

    // Settings
    Route::middleware(['auth'])->group(function () {
        Route::redirect('settings', 'settings/profile');
        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });

    // General Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth', 'verified');

    // Auth routes
    require __DIR__.'/auth.php';