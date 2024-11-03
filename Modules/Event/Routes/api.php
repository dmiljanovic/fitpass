<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Event\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/event', function (Request $request) {
    return $request->user();
});

Route::get('events', [EventController::class, 'index']);
Route::post('events/{event_id}/purchase', [EventController::class, 'purchase']);
