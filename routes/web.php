<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// Маршрут для проверки уникальности имени
Route::get('/check-name', function (Request $request) {
    $nameExists = User::where('name', $request->name)->exists();
    return response()->json(['exists' => $nameExists]);
});

Route::get('/check-email', function (Request $request) {
    $emailExists = User::where('email', $request->email)->exists();
    return response()->json(['exists' => $emailExists]);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

