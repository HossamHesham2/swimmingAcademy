<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'superAdmin') {
            return redirect()->route('superAdmin.index');
        } elseif (Auth::user()->role === 'admin') {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('user.index');
        }
    } else {
        return view('auth.login');
    }
});


Auth::routes();
Route::middleware(['auth', 'role:superAdmin'])->group(function () {
    Route::prefix('superAdmin')->group(function () {
        Route::controller(SuperAdminController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('superAdmin.index');
            Route::get('/addMember', 'create')->name('superAdmin.create');
            Route::get('/storeMember', 'store')->name('superAdmin.store');
            Route::get('/destroyMember/{id}', 'destroy')->name('superAdmin.destroy');
            Route::get('/editMember/{id}', 'edit')->name('superAdmin.edit');
            Route::get('/updateMember/{id}', 'update')->name('superAdmin.update');
            Route::get('/returnMember', 'return')->name('superAdmin.return');
            Route::get('/cancelMember/{id}', 'cancel')->name('superAdmin.cancel');
            Route::get('/acceptMember/{id}', 'accept')->name('superAdmin.accept');
            Route::get('/showMember/{id}', 'show')->name('superAdmin.show');
            Route::get('/revenue', 'revenue')->name('superAdmin.revenue');


        });
    });
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin.index');
            Route::get('/addMember', 'create')->name('admin.create');
            Route::get('/storeMember', 'store')->name('admin.store');
            Route::get('/destroyMember/{id}', 'destroy')->name('admin.destroy');
            Route::get('/editMember/{id}', 'edit')->name('admin.edit');
            Route::get('/updateMember/{id}', 'update')->name('admin.update');
            Route::get('/returnMember', 'return')->name('admin.return');
            Route::get('/cancelMember/{id}', 'cancel')->name('admin.cancel');
            Route::get('/showMember/{id}', 'show')->name('admin.show');

        });
    });
});
