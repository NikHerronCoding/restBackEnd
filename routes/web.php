<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use App\Http\Middleware\CorsMiddleWare;

Route::options('{any}', function () {
    return response('', 204)
        ->header('Access-Control-Allow-Origin', 'http://localhost:4200')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ->header('Access-Control-Allow-Credentials', 'true');
})->where('any', '.*');

Route::middleware([CorsMiddleWare::class])->group(function () {
    Route::get('/hello/{userId}', function (int $userId) {
        return response()->json(['message' => 'Hello from Laravel u fucker', "userId"=> $userId * 3]);
    });

    Route::get('/{lang}/product/{id}/review/{reviewId}', function( string $lang, string $id, string $reviewId) {
        return response()->json(['message'=> "Product ID=$id", "language" => $lang, "reviewId" => $reviewId]);
    });

    Route::get('/product/{category?}', function( string $category = null) {
        return response()->json(["category" => $category]);
    });
    

    // add more API routes here
});