<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    use App\Http\Controllers\StudyEventController;

Route::middleware(['auth'])->group(function () {
    Route::get('/study-events', [StudyEventController::class, 'index'])->name('study-events.index');
    Route::post('/study-events', [StudyEventController::class, 'store'])->name('study-events.store');
    Route::patch('/study-events/{studyEvent}', [StudyEventController::class, 'update'])->name('study-events.update');
    Route::delete('/study-events/{studyEvent}', [StudyEventController::class, 'destroy'])->name('study-events.destroy');
});

use App\Http\Controllers\StudyMaterialController;

Route::middleware(['auth'])->group(function () {
    Route::get('/study-materials', [StudyMaterialController::class, 'index'])->name('study-materials.index');
    Route::post('/study-materials', [StudyMaterialController::class, 'store'])->name('study-materials.store');
    Route::delete('/study-materials/{studyMaterial}', [StudyMaterialController::class, 'destroy'])->name('study-materials.destroy');
});

use App\Http\Controllers\StudyEventAdminController;

Route::middleware(['auth'])->group(function () {
    
    Route::get('/admin/study-events', [StudyEventAdminController::class, 'index'])->name('admin.study-events.index');
    Route::post('/admin/study-events', [StudyEventAdminController::class, 'store'])->name('admin.study-events.store');
    Route::get('/admin/study-events/{studyEvent}/edit', [StudyEventAdminController::class, 'edit'])->name('admin.study-events.edit');
    Route::patch('/admin/study-events/{studyEvent}', [StudyEventAdminController::class, 'update'])->name('admin.study-events.update');
    Route::delete('/admin/study-events/{studyEvent}', [StudyEventAdminController::class, 'destroy'])->name('admin.study-events.destroy');
});

require __DIR__.'/auth.php';
