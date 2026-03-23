<?php

use App\Http\Controllers\category;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payment routes
    Route::get('/payment', function () {
        return view('payment.index');
    })->name('payment.index');
    Route::get('/payment/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/category', [category::class, 'index'])->name('category.index');
    Route::post('/category', [category::class, 'store'])->name('category.store');
    Route::put('/category/{id}/update', [category::class, 'update'])->name('category.update');
    Route::patch('/category/{id}/edit', [category::class, 'edit'])->name('category.edit');
    Route::delete('/category/{id}/delete', [category::class, 'destroy'])->name('category.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::post('/subcategory', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::put('/subcategory/{id}/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::patch('/subcategory/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::delete('/subcategory/{id}/delete', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/product', [productcontroller::class, 'index'])->name('product.index');
    Route::post('/product/store', [productcontroller::class, 'store'])->name('product.store');
    Route::patch('/product/{id}/edit', [productcontroller::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}/update', [productcontroller::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/delete', [productcontroller::class, 'destroy'])->name('product.destroy');
});

Route::get('/test-email', function () {
    $mailData = [
        'title' => 'Test Email from Laravel',
        'body' => 'This is a test email sent from your new Mailable class!',
        'button_text' => 'Visit Site',
        'url' => url('/')
    ];

    \Illuminate\Support\Facades\Mail::to('test@example.com')->send(new \App\Mail\SendMail($mailData));

    return 'Test email sent! Check your storage/logs/laravel.log file to see it.';
});

require __DIR__.'/auth.php';