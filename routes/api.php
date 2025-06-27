<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdSlotController;
use App\Http\Controllers\BidController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
     Route::get('/slots', [AdSlotController::class, 'index']);
    Route::post('/slots', [AdSlotController::class, 'store']); // <-- Create Ad Slot
    Route::post('/bids', [BidController::class, 'store']);
    Route::get('/bids/{slot}', [BidController::class, 'index']);
    Route::get('/winner/{slot}', [BidController::class, 'winner']);
    Route::get('/my-bids', [BidController::class, 'myBids']);
});

