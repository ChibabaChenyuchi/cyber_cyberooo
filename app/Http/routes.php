<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
	//return View::make('home');
//});

Route::resource('deletequestions','questionsController@deletequestions');

Route::resource('settings_picture_save','SettingsController@settings_picture_save');

Route::resource('user','usersController');

Route::resource('user.question','clientQuestionsController');



Route::group(array('before' => 'auth'), function(){
    // your routes
    Route::post('editquestion/radioresponses','questionsController@radioresponses');

    Route::post('editquestion/radioresponsesupdate','questionsController@radioresponsesupdate');

    Route::post('radioresponsesupdate','questionsController@radioresponsesupdate');

    Route::post('editquestion/checkresponses','questionsController@checkresponses');

    Route::post('editquestion/checkresponsesupdate','questionsController@checkresponsesupdate');

    Route::post('checkresponsesupdate','questionsController@checkresponsesupdate');

    Route::post('deletequestions','questionsController@deletequestions');

    Route::get('deletequestions','questionsController@deletequestions');
    
    Route::post('editquestion/rattingeresponses','questionsController@ratingresponses');

    Route::post('editquestion/slideresponses','questionsController@slideresponses');
    
    Route::post('editquestion/rattingbarresponseupdate','questionsController@rattingbarresponseupdate');

    Route::post('rattingbarresponseupdate','questionsController@rattingbarresponseupdate');

    Route::post('editquestion/slidingbaresponsesupdate','questionsController@slidingbaresponsesupdate');

    Route::post('slidingbaresponsesupdate','questionsController@slidingbaresponsesupdate');

    Route::get('newquestion','questionsController@newquestion');

    Route::get('editquestion/{quesionid}', 'questionsController@edit');

    Route::get('/', 'HomeController@index');
    
    Route::get('home', 'HomeController@index');

    Route::get('questions','questionsController@index');

    Route::get('survey_response','survey_responseController@index');

    Route::get('survey_details','survey_detailsController@index');

    Route::get('survey_details_ajax','survey_responseController@survey_responses');

    Route::get('dash_ajax','DashboardController@survey_responses');

    Route::get('dashboard','DashboardController@index');
    Route::get('profile','ProfileController@index');
    Route::get('settings','SettingsController@index');




    Route::get('/charts', function()
{
	return View::make('mcharts');
});

Route::get('/tables', function()
{
	return View::make('table');
});

Route::get('/forms', function()
{
	return View::make('form');
});

Route::get('/grid', function()
{
	return View::make('grid');
});

Route::get('/buttons', function()
{
	return View::make('buttons');
});


Route::get('/icons', function()
{
	return View::make('icons');
});

Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/typography', function()
{
	return View::make('typography');
});

Route::get('/notifications', function()
{
	return View::make('notifications');
});

Route::get('/blank', function()
{
	return View::make('blank');
});

// Route::get('/login', function()
// {
// 	return View::make('login');
// });

Route::get('/documentation', function()
{
	return View::make('documentation');
});

});

//Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);