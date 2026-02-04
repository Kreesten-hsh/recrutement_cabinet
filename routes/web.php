<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\Admin\JobPostingController as AdminJobPostingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobPostingController::class, 'index'])->name('home');
Route::get('/avis', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/avis/{id}', [JobPostingController::class, 'show'])->name('jobs.show');
Route::post('/candidatures', [ApplicationController::class, 'store'])->name('applications.store');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminJobPostingController::class, 'index'])->name('dashboard');
    Route::resource('postes', AdminJobPostingController::class)
        ->except(['show'])
        ->parameters(['postes' => 'jobPosting']);
});

Route::redirect('/dashboard', '/admin')->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';
