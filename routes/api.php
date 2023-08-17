<?php

use App\Http\Controllers\HabitationController;
use App\Http\Controllers\UserController;
use App\Models\Habitation;
use App\Models\User;
use App\MyStaff\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function(){
    
    // index route 
    Route::get('/', function() {

        return ResponseHelper::json([
            'message' => 'No view defined for this route',
            'current_api_version' => config('api.CURRENT_VERSION')
        ]);
    })->name('index');

    Route::apiResource('habitation', HabitationController::class);

    Route::apiResource('user', UserController::class);

});

Route::redirect('', 'api/' . config('api.CURRENT_VERSION'));

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/