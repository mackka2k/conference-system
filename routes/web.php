<?php
use App\Http\Controllers\Admin\ConferenceController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// [MAIN DASHBOARD ROUTE]
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// [POST ROUTE FOR SETTING USER ROLE]
Route::post('/set-user-role', [ConferenceController::class, 'setUserRole'])->name('setUserRole');

// [CONFERENCE LISTING ROUTE]
Route::get('/conferences', [ConferenceController::class, 'index'])->name('conferences.index');

// [ADMIN CRUD ROUTES]
Route::prefix('admin/conferences')->name('conference.')->group(function () {
    Route::get('/create', [ConferenceController::class, 'create'])->name('create');
    Route::post('/store', [ConferenceController::class, 'store'])->name('store');
    Route::get('/{conference}/edit', [ConferenceController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ConferenceController::class, 'update'])->name('update');
    Route::delete('/{id}', [ConferenceController::class, 'destroy'])->name('destroy');
});

// [CONFERENCE REGISTRATION ROUTE]
Route::post('/conferences/{id}/register', [ConferenceController::class, 'register'])->name('conference.register');

// [CONFERENCE LIST PREVIEW ROUTE]
Route::get('/conferences/{id}', [ConferenceController::class, 'show'])->name('conferences.show');

// [ADMIN DASHBOARD ROUTE]
Route::get('/admin/dashboard', [ConferenceController::class, 'dashboard'])->name('admin.dashboard');
