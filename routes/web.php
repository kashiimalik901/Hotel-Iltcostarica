<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
})->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:Admin,Super Admin,Manager'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Hotels
    Route::resource('hotels', App\Http\Controllers\Admin\HotelController::class);
    Route::delete('hotels/{hotel}/images/{image}', [App\Http\Controllers\Admin\HotelController::class, 'deleteImage'])->name('hotels.images.destroy');
    
    // Rooms
    Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class);
    
    // Bookings
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
    
    // Customers
    Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);
});

require __DIR__.'/auth.php';
