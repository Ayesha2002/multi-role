<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;



//Routes for web
// Redirect home to login or dashboard
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect('/register');
});

// Main dashboard redirect logic
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

    if ($user->role->name === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role->name === 'user') {
        return redirect()->route('user.dashboard');
    }

    abort(403, 'Unauthorized.');
})->middleware(['auth'])->name('dashboard');

//routes for user

Route::middleware(['auth'])->group(function () {

    // User dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // User profile (view + update)
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/user/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Change Password (GET page)
    Route::get('/user/change-password', function () {
        return view('user.change-password');
    })->name('profile.change-password');

    //  Change Password (POST)
    Route::post('/user/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.change-password.post');
});

//Routes for Admin

Route::middleware(['auth'])->group(function () {

    // Admin dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    //  Admin profile (view)
    Route::get('/admin/profile', [ProfileController::class, 'show'])->name('admin.profile');

    //  Admin profile (update)
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    // Admin change password (GET)
    Route::get('/admin/change-password', function () {
        return view('admin.change-password');
    })->name('admin.change-password');

    //  Admin change password (POST)
    Route::post('/admin/change-password', [ProfileController::class, 'changePassword'])
        ->name('admin.change-password.post');
});


require __DIR__ . '/auth.php';
