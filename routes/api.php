<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TabulkaApiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tabulka', [TabulkaApiController::class, 'index']);
    Route::post('/tabulka', [TabulkaApiController::class, 'store']);
    Route::get('/tabulka/{tabulka}', [TabulkaApiController::class, 'show']);
    Route::put('/tabulka/{tabulka}', [TabulkaApiController::class, 'update']);
    Route::delete('/tabulka/{tabulka}', [TabulkaApiController::class, 'destroy']);
});

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token], 201);
});

Route::post('/login', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $validated['email'])->first();

    if (!$user || !Hash::check($validated['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token], 200);
});

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out'], 200);
})->middleware('auth:sanctum');