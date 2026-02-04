<?php

use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobPostingController::class, 'index'])->name('home');
Route::get('/avis', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/avis/{id}', [JobPostingController::class, 'show'])->name('jobs.show');
Route::post('/candidatures', [ApplicationController::class, 'store'])->name('applications.store');
