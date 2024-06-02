<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

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
    return new UserResource($request->user());
});

Route::group(['prefix' => 'rooms', 'namespace' => 'Room'], function () {
    Route::get('/', 'GetController');
    Route::get('/{room}', 'ShowController');
    Route::get('/{room}/edit', 'EditController');
    Route::put('/{room}', 'UpdateController');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/', 'PostController');
    });

    Route::group(['prefix' => '{room}/tasks', 'namespace' => 'Task'], function () {
        Route::get('/{task}', 'ShowController');
    });
});

Route::group(['prefix' => 'tasks', 'namespace' => 'Task'], function () {
    Route::post('/', 'CreateController');
    Route::get('/info', 'InfoController');
});

Route::group(['prefix' => 'groups', 'namespace' => 'Group'], function () {
    Route::get('/', 'GetController');
});

Route::group(['prefix' => 'students', 'namespace' => 'Student'], function () {
    Route::get('/', 'GetController');
});
