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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*
|--------------------------------------------------------------------------
| API Version 1
|--------------------------------------------------------------------------
|
| Currently our version is V1
| All routes are in v1
|
*/

Route::group(['prefix' => 'v1' , 'middleware' => 'cors'], function () {
    // make your routes
/*
|--------------------------------------------------------------------------
| Make auth routes so we have to make a group with auth
|--------------------------------------------------------------------------
*/
    Route::group(['prefix' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | @route  GET api/v1/auth/bootstrap
    | @desc   Bootstrap of auth
    | @access Public
    |--------------------------------------------------------------------------
    */
        Route::get('bootstrap', 'Auth\AuthController@bootstrap');
    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/auth/login
    | @desc   Login
    | @access Public
    |--------------------------------------------------------------------------
     */
        Route::post('login', 'Auth\AuthController@login');
    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/auth/Register
    | @desc   Register the user
    | @access Public
    |--------------------------------------------------------------------------
    */
        Route::post('register', 'Auth\AuthController@register');
    });

    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/school
    | @desc   get and post the school
    | @access Public
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'school'],function (){
        Route::post('/upload_csv', 'Core\School\SchoolController@upload_csv')->name('upload_csv');
        Route::group(['prefix'=>'/{id?}'],function () {
            Route::get('', 'Core\School\SchoolController@get');
            Route::post('', 'Core\School\SchoolController@store');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/batch
    | @desc   get and post the batch
    | @access Public
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'batch'],function (){
        Route::group(['prefix'=>'/{id?}'],function () {
            Route::get('', 'Core\Batch\BatchController@get');
            Route::post('', 'Core\Batch\BatchController@store');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/user_detail
    | @desc   Return all registered users
    | @access Private
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('user_detail', 'Auth\AuthController@user_detail');
    /*
    |--------------------------------------------------------------------------
    | @route  Post api/v1/profile
    | @desc   get and post the profile and also bootstrap
    | @access Private
    |--------------------------------------------------------------------------
    */
        Route::group(['prefix'=>'profile'],function (){
            Route::get('/bootstrap', 'Profile\ProfileController@bootstrap')->name('profile.bootstrap');
            Route::group(['prefix'=>'/{id?}'],function () {
                Route::get('', 'Profile\ProfileController@get');
                Route::post('', 'Profile\ProfileController@store');
            });

            /*
       |--------------------------------------------------------------------------
       | @route  Post api/v1/experiences
       | @desc   get and post the experience and also bootstrap
       | @access Private
       |--------------------------------------------------------------------------
       */
            Route::group(['prefix'=>'experiences'],function (){
                Route::get('/bootstrap', 'Profile\ProfileController@bootstrap')->name('profile.bootstrap');
                Route::group(['prefix'=>'/{id?}'],function () {
                    Route::get('', 'Profile\Experience\ExperienceController@get');
                    Route::post('', 'Profile\Experience\ExperienceController@store');
                });
            });
            /*
            |--------------------------------------------------------------------------
            | @route  Post api/v1/qualifications
            | @desc   get and post the qualification and also bootstrap
            | @access Private
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix'=>'qualification'],function (){
                Route::get('/bootstrap', 'Profile\ProfileController@bootstrap')->name('profile.bootstrap');
                Route::group(['prefix'=>'/{id?}'],function () {
                    Route::get('', 'Profile\Qualification\QualificationController@get');
                    Route::post('', 'Profile\Qualification\QualificationController@store');
                });
            });
            /*
            |--------------------------------------------------------------------------
            | @route  Post api/v1/achievements
            | @desc   get and post the achievements and also bootstrap
            | @access Private
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix'=>'achievements'],function (){
                Route::get('/bootstrap', 'Profile\AchievementController@bootstrap')->name('profile.bootstrap');
                Route::group(['prefix'=>'/{id?}'],function () {
                    Route::get('', 'Profile\Achievement\AchievementController@get');
                    Route::post('', 'Profile\Achievement\AchievementController@store');
                });
            });

        });
    });
});
