<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\NfcTagController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NfcAccessLogController;
use App\Http\Controllers\UidMappingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/access', [AccessController::class, 'validateNFC']);

Route::middleware('auth')->prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // NFC Tags routes
    Route::resource('nfc-tags', NfcTagController::class);
    // UID Mappings routes
    Route::resource('uid-mappings', UidMappingController::class);
    // NFC Access Logs routes
    Route::get('nfc-access-logs', [NfcAccessLogController::class, 'index'])->name('nfc-access-logs.index');
    Route::delete('nfc-access-logs/{log}', [NfcAccessLogController::class, 'destroy'])->name('nfc-access-logs.destroy');
});


Auth::routes();

// Login Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'login']);
