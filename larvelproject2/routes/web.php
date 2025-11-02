<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\EmployerAuthController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('index');
});
Route::get('/multiface', function () {
    return view('multiface');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/single-blog', function () {
    return view('single-blog');
});
Route::get('/elements', function () {
    return view('elements');
});
Route::get('/job_details', function () {
    return view('job_details');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/job_details', function () {
    return view('job_details');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});
 Route::get('/register/employer', [RegisterController::class, 'employerregistration'])->name('employer.register');
 Route::post('/register/employer', [RegisterController::class, 'store'])->name('employer.store');
 Route::get('/register/candidate', [RegisterController::class, 'candidateregistration'])->name('candidate.register');

 Route::post('/register/candidate', [RegisterController::class, 'store'])->name('candidate.store');
  Route::get('/login/candidate', [RegisterController::class, 'candidatelogin'])->name('candidate.login');
  Route::post('/login/candidate', [RegisterController::class, 'store'])->name('candidate.login.store');
  Route::get('/login/employer', [RegisterController::class, 'employerlogin'])->name('employer.login');
  Route::post('/login/employer', [RegisterController::class, 'loginstore'])->name('employerlogin.store');
// Route::post('/employer/login', [EmployerAuthController::class, 'login'])->name('employer.login');
Route::post('/attendance', [AttendanceController::class, 'store']);
Route::post('/uploadfacerecognition', [AttendanceController::class, 'uploadimageforfacerecognition']);
Route::get('/facerecognition', function () {
    return view('facerecognition');
});
require __DIR__.'/auth.php';
