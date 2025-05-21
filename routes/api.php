<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SpaService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route to get services for a specific spa
Route::get('/spas/{spaId}/services', function ($spaId) {
    $services = SpaService::where('spa_id', $spaId)
                ->where('is_active', true)
                ->get();
    return response()->json($services);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Weather API route
Route::get('/weather', 'App\Http\Controllers\WeatherController@getWeather');
