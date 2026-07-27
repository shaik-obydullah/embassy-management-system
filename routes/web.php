<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Client;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('pages.services');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('pages.contact');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin routes (require auth + admin/superadmin role)
Route::middleware(['auth', 'role:superadmin|admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('citizens', Admin\CitizenController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('services', Admin\ServiceController::class);
    Route::get('/appointments', [Admin\AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [Admin\AppointmentController::class, 'show'])->name('appointments.show');
    Route::patch('/appointments/{appointment}/status', [Admin\AppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::get('/passports', [Admin\PassportController::class, 'index'])->name('passports.index');
    Route::get('/passports/{passport}', [Admin\PassportController::class, 'show'])->name('passports.show');
    Route::patch('/passports/{passport}/status', [Admin\PassportController::class, 'updateStatus'])->name('passports.update-status');
    Route::get('/consulars', [Admin\ConsularController::class, 'index'])->name('consulars.index');
    Route::get('/consulars/{consular}', [Admin\ConsularController::class, 'show'])->name('consulars.show');
    Route::resource('contents', Admin\ContentController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/reports', [Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [Admin\UserController::class, 'update'])->name('users.update');
});

// Client routes (require auth + client role)
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [Client\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [Client\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [Client\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Client\ProfileController::class, 'update'])->name('profile.update');
    Route::resource('appointments', Client\AppointmentController::class)->only(['index', 'create', 'store']);
    Route::get('/services', [Client\ServiceController::class, 'index'])->name('services.index');
});
