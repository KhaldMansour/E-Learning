<?php

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

Route::group(['namespace' => 'App\Http\Controllers\API'], function ($router) {

    Route::group(['prefix' => 'student'] , function ($router) {
        
        Route::post('login', 'StudentController@login');

        Route::post('register', 'StudentController@register');

        Route::get('requested-guardians', 'StudentController@getRequestedGuardians');

        Route::post('accept-guardians/{id}', 'StudentController@acceptdGuardian');

    });

    Route::group(['prefix' => 'teacher'] , function ($router) {
        
        Route::post('login', 'TeacherController@login');

        Route::post('register', 'TeacherController@register');
    });

    Route::group(['prefix' => 'guardian'] , function ($router) {
        
        Route::post('login', 'GuardianController@login');

        Route::post('register', 'GuardianController@register');

        route::post('student/{id}' ,'GuardianController@requestStudentCustody');
    });
});



Route::group([
    //User Routes
], function ($router) {
    Route::post('login', 'App\Http\Controllers\API\StudentController@index');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('isvalid', 'AuthController@isValidToken');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink' , 'PasswordController@sendEmail' );
    Route::post('resetPassword' , 'PasswordController@resetPassword' );
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
