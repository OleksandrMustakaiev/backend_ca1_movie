<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProductionCompanyController;
use App\Http\Controllers\YearController;
use App\Models\ProductionCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/movies', MovieController::class); // create all routes for the MovieController 

// this line create all routes for ProductionCompanyController
Route::apiResource('/production_company', ProductionCompanyController::class);


Route::resource('/year', YearController::class)->only(['index', 'show']); // dont need it for now