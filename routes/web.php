<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ResultController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $lang = $request->session()->get('site_lang', 'id');
    if (! in_array($lang, ['id', 'en'], true)) {
        $lang = 'id';
    }

    $copy = [
        'id' => [
            'site_language' => 'Bahasa situs',
            'language_name' => 'Bahasa Indonesia',
            'headline' => 'Cara gratis, seru, dan efektif untuk belajar bahasa!',
            'start' => 'MULAI',
            'have_account' => 'AKU SUDAH PUNYA AKUN',
            'showcase_1' => 'Bahasa Inggris',
            'showcase_2' => 'Bahasa Indonesia',
        ],
        'en' => [
            'site_language' => 'Site language',
            'language_name' => 'English',
            'headline' => 'The free, fun, and effective way to learn a language!',
            'start' => 'GET STARTED',
            'have_account' => 'I ALREADY HAVE AN ACCOUNT',
            'showcase_1' => 'English',
            'showcase_2' => 'Indonesian',
        ],
    ];

    return view('landing', [
        'lang' => $lang,
        'copy' => $copy[$lang],
    ]);
})->name('landing');

Route::get('/language/{lang}', function (Request $request, string $lang) {
    if (in_array($lang, ['id', 'en'], true)) {
        $request->session()->put('site_lang', $lang);
    }

    return redirect()->route('landing');
})->name('language.switch');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/exercise/start', [ExerciseController::class, 'start'])->name('exercise.start');
    Route::get('/exercise', [ExerciseController::class, 'show'])->name('exercise.show');
    Route::post('/exercise', [ExerciseController::class, 'submit'])->name('exercise.submit');

    Route::get('/result/{result?}', [ResultController::class, 'show'])->name('result.show');
    Route::get('/review', [ResultController::class, 'review'])->name('review.index');
    Route::get('/history', [ResultController::class, 'history'])->name('history.index');
    Route::get('/music', [MusicController::class, 'index'])->name('music.index');
    Route::post('/music', [MusicController::class, 'update'])->name('music.update');
});
