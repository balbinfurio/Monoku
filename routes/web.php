<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use App\Http\Livewire\EmotionSelection;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\OpenAIController;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/save-emotion', [EmotionSelection::class, 'saveEmotion'])->name('save-emotion');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
});

require __DIR__.'/auth.php';

// Route::middleware('auth')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });
    
    
    // Route::get('/', [OpenAIController::class, 'index']);
    // Route::post('/ai', [OpenAIController::class, 'makeRequest']);
        // return view('welcome');