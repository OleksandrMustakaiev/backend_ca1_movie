<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProductionCompanyController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// every route within these curly brackets require authentication token
Route::middleware('auth:sanctum')->group(function (){
    Route::post('/auth/logout',[AuthController::class, 'logout']);
    Route::get('/auth/user',[AuthController::class, 'user']);

    // You need to be logged in for all movies functionality except get all and get by id
    Route::apiResource('/movies', MovieController::class)->except((['index', 'show']));
});


// Books - Define the get all and get by ID routes outside the authentication group
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);

// this line create all routes for ProductionCompanyController
Route::apiResource('/production_company', ProductionCompanyController::class);


Route::resource('/year', YearController::class)->only(['index', 'show']); // dont need it for now