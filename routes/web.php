<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(Auth::check()) {
        return redirect()->route('home');
    } else {
    	return view('auth.login');
    }
});

Route::get('/clear-cache', function() {
        $clearCache = Artisan::call('cache:clear');
        $clearConfig = Artisan::call('config:clear'); 
         return Redirect::to('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['App\Http\Middleware\AdminMiddleware','auth']], function()
{
	Route::resource('event','EventController');
	Route::get('list_eventsadmin', 'EventController@listAllEvents')->name('list_eventsadmin');
	Route::get('event.delete/{id}', ['as' => 'event.delete','uses' => 'EventController@destroy']);
    Route::get('viewers_list/{id}', ['as' => 'viewers_list','uses' => 'EventController@viewers_list']);
    Route::post('importExcelSave', 'EventController@importExcelSave')->name('importExcelSave');
});

Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware','auth'], function()
{
    Route::get('list_todays_events', 'HomeController@list_todays_events')->name('list_todays_events');
	Route::get('show_events/{id}', ['as' => 'show_events','uses' => 'HomeController@show_events']);
    Route::post('like_video', 'HomeController@like_video')->name('like_video');
});

Route::get('list_events', 'HomeController@list_events')->name('list_events');
Route::get('list_future_events', 'HomeController@list_future_events')->name('list_future_events');
Route::get('list_past_events', 'HomeController@list_past_events')->name('list_past_events');

