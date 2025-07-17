<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Teacher\BiodataController as TeacherBiodataController;

Route::get('/', \App\Livewire\Home::class)->name('home');

Route::get('/dashboard', \App\Livewire\Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function (): void {

    // Impersonations
    Route::post('/impersonate/{user}', [\App\Http\Controllers\ImpersonationController::class, 'store'])->name('impersonate.store')->middleware('can:impersonate');
    Route::delete('/impersonate/stop', [\App\Http\Controllers\ImpersonationController::class, 'destroy'])->name('impersonate.destroy');
    
    // Settings
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', \App\Livewire\Settings\Profile::class)->name('settings.profile');
    Route::get('settings/password', \App\Livewire\Settings\Password::class)->name('settings.password');
    Route::get('settings/appearance', \App\Livewire\Settings\Appearance::class)->name('settings.appearance');
    Route::get('settings/locale', \App\Livewire\Settings\Locale::class)->name('settings.locale');
    
    // Admin
    Route::prefix('admin')->as('admin.')->group(function (): void {
        //Dashboard
        Route::get('/', \App\Livewire\Admin\Index::class)->middleware(['auth', 'verified'])->name('index')->middleware('can:access admin dashboard');

        //Users Routes
        Route::get('/users', \App\Livewire\Admin\Users::class)->name('users.index')->middleware('can:view users');
        Route::get('/users/create', \App\Livewire\Admin\Users\CreateUser::class)->name('users.create')->middleware('can:create users');
        Route::get('/users/{user}', \App\Livewire\Admin\Users\ViewUser::class)->name('users.show')->middleware('can:view users');
        Route::get('/users/{user}/edit', \App\Livewire\Admin\Users\EditUser::class)->name('users.edit')->middleware('can:update users');
        
        //Roles Routes
        Route::get('/roles', \App\Livewire\Admin\Roles::class)->name('roles.index')->middleware('can:view roles');
        Route::get('/roles/create', \App\Livewire\Admin\Roles\CreateRole::class)->name('roles.create')->middleware('can:create roles');
        Route::get('/roles/{role}/edit', \App\Livewire\Admin\Roles\EditRole::class)->name('roles.edit')->middleware('can:update roles');
        
        //Permissions Routes
        Route::get('/permissions', \App\Livewire\Admin\Permissions::class)->name('permissions.index')->middleware('can:view permissions');
        Route::get('/permissions/create', \App\Livewire\Admin\Permissions\CreatePermission::class)->name('permissions.create')->middleware('can:create permissions');
        Route::get('/permissions/{permission}/edit', \App\Livewire\Admin\Permissions\EditPermission::class)->name('permissions.edit')->middleware('can:update permissions');
    });

    // Teacher
    Route::prefix('teacher')->as('teacher.')->group(function (): void {
        //Dashboard
        Route::get('/', \App\Livewire\Teacher\Index::class)
            ->middleware(['auth', 'verified'])
            ->name('index')
            ->middleware('can:access teacher dashboard');

        //Jurusan routes
        Route::get('/jurusans', \App\Livewire\Teacher\Jurusans::class)->name('jurusans.index')->middleware('can:view jurusan');
        Route::get('/jurusans/create', \App\Livewire\Teacher\Jurusans\CreateJurusan::class)->name('jurusans.create')->middleware('can:create jurusan');
        Route::get('/jurusans/{jurusan}', \App\Livewire\Teacher\Jurusans\ViewJurusan::class)->name('jurusans.show')->middleware('can:view jurusan');

        // Rooms Routes
        Route::get('/rooms', \App\Livewire\Teacher\Rooms::class)->name('rooms.index')->middleware('can:view kelas');
        Route::get('/rooms/create', \App\Livewire\Teacher\Rooms\CreateRoom::class)->name('rooms.create')->middleware('can:create kelas');
        Route::get('/rooms/{room}/edit', \App\Livewire\Teacher\Rooms\EditRoom::class)->name('rooms.edit')->middleware('can:update kelas');
        Route::get('/rooms/{room}', \App\Livewire\Teacher\Rooms\ViewRoom::class)->name('rooms.show')->middleware('can:view kelas');
        Route::get('/rooms/biodatas/view', \App\Livewire\Teacher\Rooms\ViewBiodata::class)->name('rooms.biodatas.view')->middleware('can:view biodata student');
        Route::get('/biodata/{id}/export-pdf', [\App\Http\Controllers\Teacher\BiodataController::class, 'exportPdf'])
            ->name('biodata.export.pdf')
            ->middleware('can:view biodata student');
            
        // PDF Preview Route
        Route::get('/biodata/{id}/pdf-preview', [\App\Http\Controllers\Teacher\BiodataController::class, 'previewPdf'])
            ->name('biodata.pdf-preview')
            ->middleware('can:view biodata student');

        //Jadwal Konseling Routes
        Route::get('/jadwal-konselings/export', [\App\Http\Controllers\Teacher\JadwalKonselingController::class, 'export'])
            ->name('jadwal-konselings.export')
            ->middleware('can:view konselings student');
        Route::get('jadwal-konselings/{jadwal}/accept-calendar', [\App\Http\Controllers\Teacher\JadwalKonselingController::class, 'acceptAndRedirectToCalendar'])->name('jadwal-konselings.accept_and_calendar');
        Route::get('jadwal-konselings/{jadwal}/reject', [\App\Http\Controllers\Teacher\JadwalKonselingController::class, 'showRejectForm'])
            ->name('jadwal-konselings.reject_form');
        Route::post('jadwal-konselings/{jadwal}/reject', [\App\Http\Controllers\Teacher\JadwalKonselingController::class, 'reject'])
            ->name('jadwal-konselings.reject');

        Route::get('/jadwal-konselings', \App\Livewire\Teacher\JadwalKonselings::class)->name('jadwal-konselings.index')->middleware('can:view konselings student');
        Route::get('/jadwal-konselings/{jadwal}/edit', \App\Livewire\Teacher\JadwalKonselings\EditJadwalKonseling::class)->name('jadwal-konselings.edit')->middleware('can:update konselings');
        Route::get('/jadwal-konselings/{jadwal}', \App\Livewire\Teacher\JadwalKonselings\ViewJadwalKonseling::class)->name('jadwal-konselings.show')->middleware('can:view konselings student');
        
        //Catatan Routes
        Route::get('/catatans', \App\Livewire\Teacher\Catatans::class)->name('catatans.index')->middleware('can:view catatan teacher');
        Route::get('/catatans/export', [\App\Http\Controllers\Teacher\CatatanController::class, 'exportAll'])->name('catatans.export')->middleware('can:view catatan teacher');
        Route::get('/catatans/export/user/{user_id}', [\App\Http\Controllers\Teacher\CatatanController::class, 'exportByUser'])->name('catatans.export.user')->middleware('can:view catatan teacher');
        Route::get('/catatans/create', \App\Livewire\Teacher\Catatans\CreateCatatan::class)->name('catatans.create')->middleware('can:create catatan');
        Route::get('/catatans/{catatan}/edit', \App\Livewire\Teacher\Catatans\EditCatatan::class)->name('catatans.edit')->middleware('can:update catatan');
        Route::get('/catatans/{catatan}', \App\Livewire\Teacher\Catatans\ViewCatatan::class)->name('catatans.show')->middleware('can:view catatan teacher');

        //Surat Panggilan Routes
        Route::get('/surat-panggilans', \App\Livewire\Teacher\SuratPanggilans::class)->name('surat-panggilans.index')->middleware('can:view surat panggilan');
        Route::get('/surat-panggilans/create', \App\Livewire\Teacher\SuratPanggilans\CreateSuratPanggilan::class)->name('surat-panggilans.create')->middleware('can:create surat panggilan');
        Route::get('/surat-panggilans/{surat}/edit', \App\Livewire\Teacher\SuratPanggilans\EditSuratPanggilan::class)->name('surat-panggilans.edit')->middleware('can:update surat panggilan');
        Route::get('/surat-panggilans/{surat}', \App\Livewire\Teacher\SuratPanggilans\ViewSuratPanggilan::class)->name('surat-panggilans.show')->middleware('can:view surat panggilan');
        // PDF Export & Preview
        Route::get('/surat-panggilans/{id}/export-pdf', [\App\Http\Controllers\Teacher\SuratPanggilanController::class, 'exportPdf'])->name('surat-panggilans.export.pdf')->middleware('can:view surat panggilan');
        Route::get('/surat-panggilans/{id}/pdf-preview', [\App\Http\Controllers\Teacher\SuratPanggilanController::class, 'previewPdf'])->name('surat-panggilans.pdf-preview')->middleware('can:view surat panggilan');

    });

    // Student
    Route::prefix('student')->as('student.')->group(function (): void {
        //Dashboard
        Route::get('/', \App\Livewire\Student\Index::class)
            ->middleware(['auth', 'verified'])
            ->name('index')
            ->middleware('can:access student dashboard');

        //Biodata Routes
        Route::get('/biodatas', \App\Livewire\Student\Biodatas::class)->name('biodatas.index')->middleware(['can:view biodata', \App\Http\Middleware\RedirectIfHasBiodata::class]);
        Route::get('/biodatas/view', \App\Livewire\Student\Biodatas\ViewBiodata::class)->name('biodatas.view')->middleware('can:view biodata');
        Route::get('/biodatas/edit', \App\Livewire\Student\Biodatas\EditBiodata::class)->name('biodatas.edit')->middleware('can:update biodata');

        //Jadwal Konseling Routes
        Route::get('/jadwal-konselings', \App\Livewire\Student\JadwalKonselings::class)->name('jadwal-konselings.index')->middleware('can:view konselings');
        Route::get('/jadwal-konselings/create', \App\Livewire\Student\JadwalKonselings\CreateJadwalKonseling::class)->name('jadwal-konselings.create')->middleware('can:create konselings');
        Route::get('/jadwal-konselings/{jadwal}/edit', \App\Livewire\Student\JadwalKonselings\EditJadwalKonseling::class)->name('jadwal-konselings.edit')->middleware('can:update konselings');
        Route::get('/jadwal-konselings/{jadwal}', \App\Livewire\Student\JadwalKonselings\ViewJadwalKonseling::class)->name('jadwal-konselings.show')->middleware('can:view konselings');

        //Catatan Routes
        Route::get('/catatans', \App\Livewire\Student\Catatans::class)->name('catatans.index')->middleware('can:view catatan student');
        Route::get('/catatans/{catatan}', \App\Livewire\Student\Catatans\ViewCatatan::class)->name('catatans.show')->middleware('can:view catatan student');
    });

});

require __DIR__.'/auth.php';