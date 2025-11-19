<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BarterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\TokenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', [ItemController::class, 'index'])->name('home');
Route::get('/tentang-kami', function () { return view('about'); })->name('about');
Route::get('/kontak', function () { return view('contact'); })->name('contact');

// Rute detail barang & profil user (Publik)
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/users/{user}', [UserProfileController::class, 'show'])->name('users.show');


// ==========================================
// 2. RUTE OTENTIKASI (Wajib Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard & Profil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Barang (Create, Store, Edit, Update, Destroy)
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    // Barter & Penawaran
    Route::get('/dashboard/barters', [BarterController::class, 'index'])->name('barters.index');
    Route::post('/barter/offer', [BarterController::class, 'makeOffer'])->name('barter.offer');
    Route::post('/barter/respond/{barter}', [BarterController::class, 'respondOffer'])->name('barter.respond');
    
    // Fitur Baru: Resi & Konfirmasi Barter
    Route::patch('/barter/{barter}/resi', [BarterController::class, 'updateResi'])->name('barter.resi');
    Route::post('/barter/{barter}/confirm', [BarterController::class, 'confirmTransaction'])->name('barter.confirm');

    // Pesan (Messaging)
    Route::get('/messages', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/barters/{barter}/messages', [MessageController::class, 'index'])->name('messages.show');
    Route::post('/barters/{barter}/messages', [MessageController::class, 'store'])->name('messages.store');

    // Rating & Ulasan
    Route::get('/barters/{barter}/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/barters/{barter}/ratings', [RatingController::class, 'store'])->name('ratings.store');

    // Notifikasi
    Route::get('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Sistem Token (Top Up) - INI YANG DIPERBAIKI
    Route::get('/tokens', [TokenController::class, 'index'])->name('tokens.index');
    Route::post('/tokens/checkout', [TokenController::class, 'checkout'])->name('tokens.checkout'); 
    Route::get('/tokens/saldo', [TokenController::class, 'getSaldo'])->name('tokens.saldo');
});

require __DIR__ . '/auth.php';