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

require __DIR__.'/auth.php';
