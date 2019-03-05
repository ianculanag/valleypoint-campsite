<?php

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

Route::get('/', 'PagesController@index');
Route::get('/lodging', 'PagesController@lodging');
Route::get('/pos', 'PagesController@pos');

//Route::resource('guests', 'GuestsController');
Route::get('/transient-backpacker', 'UnitsController@transientBackpacker'); 
Route::get('/glamping', 'UnitsController@glamping'); 
Route::get('/guestcheckout/{id}', 'UnitsController@loadGuestDetails');

//Route::get('/addusers', 'PagesController@addusers');
Route::resource('staff', 'StaffController');

//
Route::get('/loadDetails/{id}', 'UnitsController@loadUnit'); 

Route::post('/guests', 'GuestsController@addGuest');
Auth::routes();

Route::get('/dashboard', 'UnitsController@glamping');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


//Check-in guests
Route::get('/checkin/{unitID}', 'GuestsController@showCheckinForm');
Route::post('/checkinAt', 'GuestsController@checkin');

//AddReservation
Route::post('/addReservation','GuestController@addReservation');
