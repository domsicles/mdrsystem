<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangayPopulationController;
use App\Http\Controllers\HazardDataController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Middleware\PreventBackHistory; // ✅ Import the middleware

// Redirect based on authentication status
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
});

// ================== AUTHENTICATION ================== //
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ================== PROTECTED ROUTES ================== //
Route::middleware(['auth', PreventBackHistory::class])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ========== ACCOUNT MANAGEMENT ==========
    Route::get('/account/change-password', [AccountController::class, 'showChangePasswordForm'])->name('account.show-change-password');
    Route::post('/account/change-password', [AccountController::class, 'changePassword'])->name('account.change-password');

    Route::get('/account/delete-account', [AccountController::class, 'showDeleteAccountForm'])->name('account.show-delete-account');
    Route::delete('/account/delete-account', [AccountController::class, 'deleteAccount'])->name('account.delete-account');

    // ========== DASHBOARD 1 (Barangay Population) ==========
    Route::get('/dashboard1', [BarangayPopulationController::class, 'index'])->name('dashboard1');
    Route::get('/dashboard1/create', [BarangayPopulationController::class, 'create'])->name('dashboard1.create');
    Route::post('/dashboard1', [BarangayPopulationController::class, 'store'])->name('dashboard1.store');
    Route::get('/dashboard1/{id}/edit', [BarangayPopulationController::class, 'edit'])->name('dashboard1.edit');
    Route::put('/dashboard1/{id}', [BarangayPopulationController::class, 'update'])->name('dashboard1.update');
    Route::delete('/dashboard1/{id}', [BarangayPopulationController::class, 'destroy'])->name('dashboard1.destroy');
    Route::get('/export-barangays', [BarangayPopulationController::class, 'exportBarangays'])->name('export.barangays');

    // ========== DASHBOARD 2 (Hazard Data) ==========
    Route::get('/dashboard2', [HazardDataController::class, 'index'])->name('dashboard2');
    Route::get('/dashboard2/create', [HazardDataController::class, 'create'])->name('dashboard2.create');
    Route::post('/dashboard2', [HazardDataController::class, 'store'])->name('dashboard2.store');
    Route::get('/dashboard2/{id}/edit', [HazardDataController::class, 'edit'])->name('dashboard2.edit');
    Route::put('/dashboard2/{id}', [HazardDataController::class, 'update'])->name('dashboard2.update');
    Route::delete('/dashboard2/{id}', [HazardDataController::class, 'destroy'])->name('dashboard2.destroy');
    Route::get('/export-hazards', [HazardDataController::class, 'exportHazards'])->name('export.hazards');
});
