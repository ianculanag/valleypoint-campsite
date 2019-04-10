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

Route::get('/calendar', 'UnitsController@calendar'); 

Route::get('/guest-checkout/{id}', 'UnitsController@loadGuestDetails');

//Route::resource('staff', 'StaffController');
Route::get('/load-tents', 'unitsController@loadTents');

//
Route::get('/load-glamping-details/{id}', 'UnitsController@loadGlampingUnit');
Route::get('/load-glamping-available-unit/{id}', 'UnitsController@loadGlampingAvailableUnit');

Route::post('/guests', 'GuestsController@addGuest');
Auth::routes();

Route::get('/dashboard', 'UnitsController@glamping');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


//Check-in guests glamping
//Route::get('/checkin/{unitID}', 'GuestsController@showCheckinForm');
//Route::post('/checkinAt', 'GuestsController@checkin');
Route::get('/checkin/{unitID}', 'AccommodationsController@showCheckinForm');
Route::post('/checkin-glamping', 'AccommodationsController@checkinGlamping');
Route::post('/checkin-glamping-reservation', 'ReservationsController@checkinGlamping');

//Check-in glamping guests from reservation
Route::get('/checkin/{unitdID}/{reservationID}', 'ReservationsController@showCheckinForm');

//Find Package
Route::get('/getService/{serviceID}', 'ServicesController@getPrices');


//Make reservation
Route::get('/reservation/{unitID}', 'ReservationsController@showReservationForm');
Route::post('/reservation', 'ReservationsController@makeReservation');

//Cancel reservation
Route::get('/cancel-reservation-modal/{reservationID}', 'ReservationsController@cancelReservationModal');
Route::post('/cancel-reservation/{reservationID}','ReservationsController@cancelReservation');

//Reservation backpacker
Route::get('/reserve-backpacker/{unitID}', 'ReservationsController@showReservationBackpackerForm');
Route::post('/reserve-backpacker','ReservationsController@reserveBackpacker');

//Check-in backpacker
Route::get('/checkin-backpacker/{unitID}' , 'AccommodationsController@showcheckinBackpackerForm');
Route::post('/checkin-backpacker','AccommodationsController@checkinBackpacker');
Route::get('load-backpacker-details/');

//Edit guest details
Route::get('/edit-details/{unitID}', 'GuestsController@viewGuestDetails');
Route::post('/updateDetails', 'GuestsController@updateDetails');

//Check-out guests
Route::get('/checkout/{unitID}', 'GuestsController@showCheckoutForm');

//AddReservation
//Route::get('/addReservation/{unitID}', 'AccommodationsController@showAddReserveForm');
//Route::post('/addReservation','AccommodationsController@addReservation');

//ViewGuests
Route::get('/view-guests', 'GuestsController@viewguests');

//bruteforce do not touch
Route::get('/checkin-backpacker', function() {
    return view('lodging.checkinBackpacker');
});

//ViewReservations
Route::get('/view-reservations', 'ReservationsController@viewReservations');
//Route::get('/viewReservations', 'AccommodationsController@viewReservation');

//View Reservation Details
Route::get('/view-reservation-details/{unitID}/{reservationID}', 'ReservationsController@viewReservationDetails');
Route::post('/save-glamping-reservation-details', 'ReservationsController@saveGlampingReservation');

//CancelReservations
Route::get('/cancel-reservation/{reservationID}', 'ReservationsController@cancelReservation');

//Payment Transactions
Route::get('/view-payments', 'PaymentsController@viewLodgingSales');

//Select Service	
Route::get('/serviceSelect/{serviceID}', 'ServicesController@getPrices'); 

//Post additional services
Route::post('/addAdditionalService', 'ChargesController@addAdditionalService');

Route::get('/getDates', 'UnitsController@getDates');

//Check-out guests
Route::post('/checkoutGlamping', 'AccommodationsController@checkoutGlamping');

/* Admin */

//View users
Route::get('/view-users', 'UsersController@viewUsers');

//Add user
Route::get('/add-user', 'UsersController@showAddUserForm');
Route::post('user-added', 'UsersController@addUser');

//View units
Route::get('/view-units', 'UnitsController@viewUnits');

//Add unit
Route::get('/add-unit', 'UnitsController@showAddUnitForm');
Route::post('/unit-added', 'UnitsController@addUnit');

//Edit unit
Route::get('/edit-unit/{unitID}', 'UnitsController@viewUnitDetails');
Route::post('/update-unit', 'UnitsController@updateUnit');

//View services
Route::get('/view-services', 'ServicesController@viewServices');

//Add service
Route::get('/add-service', 'ServicesController@showAddServiceForm');
Route::post('/service-added', 'ServicesController@addService');

//Edit service
Route::get('/edit-service/{serviceID}', 'ServicesController@viewServiceDetails');
Route::post('/update-service', 'ServicesController@updateService');

//Delete service
Route::get('/delete-service-modal/{serviceID}', 'ServicesController@deleteServiceModal');
