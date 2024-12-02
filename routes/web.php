<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

// Home route (public page)
Route::get('/', function () {
    return view('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Contact route
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
});

Route::middleware(['auth'])->group(function () {
    // Job Listings
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index'); // Show job listings

    // Create Job
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create'); // Show form to create a job
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store'); // Store a new job

    // View a specific job
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show'); // Show specific job details

    // Edit a specific job
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit'); // Show edit form for a job
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update'); // Update job details

    // Delete a job
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy'); // Delete a job
});


// Authentication Routes (login, register)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register.submit']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// This will include the default routes provided by Laravel Breeze (if installed)
require __DIR__.'/auth.php';

