<?php

use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'onboarding'])->name('dashboard');

// Onboarding routes
Route::get('/onboarding/step1', [OnboardingController::class, 'showStep1'])->middleware(['auth', 'verified'])->name('onboarding.step1');
Route::post('/onboarding/step1', [OnboardingController::class, 'processStep1'])->middleware(['auth', 'verified'])->name('onboarding.step1.post');

Route::get('/onboarding/step2', [OnboardingController::class, 'showStep2'])->middleware(['auth', 'verified'])->name('onboarding.step2');
Route::post('/onboarding/step2', [OnboardingController::class, 'processStep2'])->middleware(['auth', 'verified'])->name('onboarding.step2.post');

require __DIR__.'/auth.php';
