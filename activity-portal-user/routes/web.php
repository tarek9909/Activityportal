<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuideController;

Route::get('/guides/{id}', [GuideController::class, 'show'])->name('guides.show');
Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/enroll', [EventController::class, 'enroll'])->name('events.enroll');
Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
// Dashboard route, requires authentication and email verification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.us.index');

// Custom user profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('user.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('user.destroy');
});

// Route for the combined login and register page
Route::get('/login-register', function () {
    return view('auth.login'); // Ensure this view exists in resources/views/auth
})->name('login-register');

// Custom route for login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');

// Custom route for registration
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');

// Include the Laravel Breeze authentication routes
require __DIR__.'/auth.php';
