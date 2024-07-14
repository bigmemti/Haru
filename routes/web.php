<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::get('/', [MainController::class, 'welcome']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');

        Route::name('dashboard.')->group(function(){

            Route::resources([
                'category' => CategoryController::class,
                'brand' => BrandController::class,
                'product' => ProductController::class,
            ]);

            Route::resources([
                'comment' => CommentController::class,
            ], [
                'only' => ['index', 'show', 'destroy']
            ]);
        });
    });
});

require __DIR__.'/auth.php';
