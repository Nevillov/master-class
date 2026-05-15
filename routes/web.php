<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoryController::class, 'index'])->name('home');

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'master') {
        return redirect('/cabinet');
    }

    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/register/{id}/confirm', [RegistrationController::class, 'confirm'])
        ->name('register.confirm');

    Route::post('/register/{id}/confirm', [RegistrationController::class, 'store'])
        ->name('register.store');
    Route::get('/master-class/{id}/edit', [MasterClassController::class, 'edit'])->name('master.edit');
    Route::post('/master-class/{id}/update', [MasterClassController::class, 'update'])->name('master.update');
    Route::post('/master-class/{id}/delete', [MasterClassController::class, 'destroy'])->name('master.delete');

    Route::get('/cabinet', [MasterClassController::class, 'index'])
        ->name('cabinet');

    Route::get('/form-master-class', function () {
        $categories = Category::all();

        return view('form_master-class', compact('categories'));
    })->name('master.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/master-class', [MasterClassController::class, 'store'])
        ->name('master.store');
});

require __DIR__.'/auth.php';
