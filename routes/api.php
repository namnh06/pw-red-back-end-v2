<?php

use Illuminate\Http\Request;

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
use App\Models\Web\User as UserWeb;


Route::group(['prefix'=> 'v2'], function() {
    Route::group(['prefix'=> 'web'], function() {

        Route::post('login', 'Web\Auth\AuthController@login');
        Route::group(['middleware' => 'auth'], function () {
            Route::get('test', function () {
                $user = UserWeb::first();
                return response()->json([
                    'user' => $user
                ], 200);
            });
            Route::get('refresh-token', 'Web\Auth\AuthController@refresh');
            Route::post('logout', 'Web\Auth\AuthController@logout');
        });
    });

    Route::group(['prefix'=> 'phone'], function() {

        Route::post('login', 'Phone\Auth\AuthController@login');
        Route::group(['middleware' => 'auth'], function () {
            Route::get('test', function () {
                $user = App\Models\Phone\User::first();
                return response()->json([
                    'user' => $user
                ], 200);
            });
            Route::get('refresh-token', 'Phone\Auth\AuthController@refresh');
            Route::post('logout', 'Phone\Auth\AuthController@logout');
        });
    });
});
