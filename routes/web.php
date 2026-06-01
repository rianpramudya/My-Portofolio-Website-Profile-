<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman Depan (Public)
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Halaman Admin (Protected / Butuh Login)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard & Profile Edit
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // --- RESOURCE ROUTES (CRUD) ---
    Route::resource('projects', ProjectController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('services', ServiceController::class);

    // Inbox Routes
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::patch('/contacts/{id}/read', [AdminContactController::class, 'markAsRead'])->name('contacts.markRead');
    Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // --- GENERATOR ROUTES ---
    // CV Generator
    Route::get('/cv', [App\Http\Controllers\Admin\CvController::class, 'index'])->name('cv.index');
    Route::post('/cv/generate', [App\Http\Controllers\Admin\CvController::class, 'generate'])->name('cv.generate');
    // RUTE CADANGAN
    Route::get('/cv/generate', function () {
        return redirect()->route('admin.cv.index');
    });

    // Cover Letter Generator
    Route::get('/letter', [App\Http\Controllers\Admin\CoverLetterController::class, 'index'])->name('letter.index');
    Route::post('/letter/generate', [App\Http\Controllers\Admin\CoverLetterController::class, 'generate'])->name('letter.generate');
    // RUTE CADANGAN
    Route::get('/letter/generate', function () {
        return redirect()->route('admin.letter.index');
    });
});

// Route Bawaan Breeze (Untuk Profile User Login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';