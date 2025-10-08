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

Route::get('/', [ItemController::class, 'index'])->name('home');
Route::get('/tentang-kami', function () { return view('about'); })->name('about');
Route::get('/kontak', function () { return view('contact'); })->name('contact');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');


    Route::get('/dashboard/barters', [BarterController::class, 'index'])->name('barters.index');
    Route::post('/barter/offer', [BarterController::class, 'makeOffer'])->name('barter.offer');
    Route::post('/barter/respond/{barter}', [BarterController::class, 'respondOffer'])->name('barter.respond');
    
    Route::get('/messages', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/barters/{barter}/messages', [MessageController::class, 'index'])->name('messages.show');
    Route::post('/barters/{barter}/messages', [MessageController::class, 'store'])->name('messages.store');

    
    Route::get('/barters/{barter}/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/barters/{barter}/ratings', [RatingController::class, 'store'])->name('ratings.store');

    Route::get('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});


Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/users/{user}', [UserProfileController::class, 'show'])->name('users.show');

Route::get('/tokens', [TokenController::class, 'index'])->name('tokens.index');
Route::post('/tokens/purchase', [TokenController::class, 'purchase'])->name('tokens.purchase');

require __DIR__ . '/auth.php';