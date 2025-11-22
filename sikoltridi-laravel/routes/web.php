<?php 

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminFileController;
use App\Http\Controllers\AdminPlanningController;
use App\Http\Controllers\AdminOrganizingController;
use App\Http\Controllers\AdminVideoController;
use App\Http\Controllers\AdminFotoController;
use App\Http\Controllers\AdminControllingController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard (Sudah ada sebelumnya)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // 1. Manajemen User (Khusus Superadmin)
    Route::middleware('can:superadmin')->group(function() {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::put('/users/{id}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });

    // 2. Manajemen File (MoU, dll)
    Route::resource('files', AdminFileController::class);

    // 3. Planning
    Route::resource('planning', AdminPlanningController::class);

    // 4. Organizing
    Route::resource('organizing', AdminOrganizingController::class);

    // 5. Actuating (Video & Foto)
    Route::resource('video', AdminVideoController::class);
    Route::resource('foto', AdminFotoController::class);

    // 6. Controlling (Hasil Kuesioner)
    Route::get('/controlling', [AdminControllingController::class, 'index'])->name('controlling.index');
});