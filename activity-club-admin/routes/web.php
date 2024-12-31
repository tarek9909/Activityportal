<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LookupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutUsController;


Route::get('admin/guides/members/{event}', [GuideController::class, 'getMembersByEvent']);
// Route to get members by event
Route::get('/admin/guides/members/{event}', [GuideController::class, 'getMembersByEvent']);

// Route to get member info
Route::get('/admin/guides/member-info/{member}', [GuideController::class, 'getMemberInfo']);
Route::get('/admin/events', [EventController::class, 'index'])->name('admin.events.index');
Route::get('/admin/guides', [GuideController::class, 'index'])->name('admin.guides.index');
Route::get('/admin/lookups', [LookupController::class, 'index'])->name('admin.lookups.index');
Route::get('/admin/members', [MemberController::class, 'index'])->name('admin.members.index');
Route::get('/admin/about_us', [AboutUsController::class, 'index'])->name('admin.about_us.index');
Route::put('/admin/about_us', [AboutUsController::class, 'update'])->name('admin.about_us.update');

// Home page route
Route::get('/', function () {
    return redirect()->route('login');
})->name('home'); 

// Dashboard route for regular users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes for regular users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin specific routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admins.index');

    // Manage Admins page (defined before the resource route to avoid conflicts)
    Route::get('/admins/manage', [AdminController::class, 'manage'])->name('admins.manage');

    // Admin CRUD routes (without index and show)
    Route::resource('admins', AdminController::class)->except(['index', 'show']);

    // Resource routes for other admin functionalities
    Route::resource('guides', GuideController::class);
    Route::resource('events', EventController::class);
    Route::resource('members', MemberController::class);
    Route::resource('lookups', LookupController::class);
    Route::resource('users', UserController::class); 
});

// Authentication routes (handled by Breeze or Fortify)
require __DIR__.'/auth.php';

// Logout Route (POST Request)
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
