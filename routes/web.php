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

/* Lodging */
//Dashboard: Physical view
Route::get('/transient-backpacker', 'UnitsController@transientBackpacker'); 
Route::get('/glamping', 'UnitsController@glamping'); 

//Dashboard: Calendar view
Route::get('/calendar-glamping', 'UnitsController@calendarGlamping'); 
Route::get('/calendar-backpacker', 'UnitsController@calendarBackpacker'); 

//Dashboard: Reload calendar
Route::post('/reload-calendar-glamping', 'UnitsController@reloadCalendarGlamping'); 
Route::post('/reload-calendar-backpacker', 'UnitsController@reloadCalendarBackpacker'); 

Route::get('/guest-checkout/{id}', 'UnitsController@loadGuestDetails');
//Route::resource('staff', 'StaffController');
Route::get('/load-tents', 'unitsController@loadTents');

//Modals
Route::get('/load-glamping-details/{id}', 'UnitsController@loadGlampingUnit');
Route::get('/load-glamping-available-unit/{id}', 'UnitsController@loadGlampingAvailableUnit');

Route::get('/load-backpacker-details/{id}', 'UnitsController@loadBackpackerUnit');
Route::get('/load-backpacker-available-unit/{id}', 'UnitsController@loadBackpackerAvailableUnit');

Route::post('/guests', 'GuestsController@addGuest');
Auth::routes();

//Route::get('/dashboard', 'UnitsController@glamping');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Unit finder: Get glamping tents
Route::get('/get-glamping-tents', 'UnitsController@getGlampingTents');

//Unit finder: Get backpacker rooms
Route::get('/get-backpacker-rooms', 'UnitsController@getBackpackerRooms');

//Check-in guests glamping
//Route::get('/checkin/{unitID}', 'GuestsController@showCheckinForm');
//Route::post('/checkinAt', 'GuestsController@checkin');
Route::get('/checkin/{unitID}', 'AccommodationsController@showCheckinForm');
Route::post('/checkin-glamping', 'AccommodationsController@checkinGlamping');

//Check-in glamping guests from reservation
Route::get('/checkin/{unitdID}/{reservationID}', 'ReservationsController@showCheckinForm');
Route::post('/checkin-glamping-reservation', 'ReservationsController@checkinGlamping');

//Check-in backpacker guests from reservation
Route::get('/checkin-backpacker/{unitdID}/{reservationID}', 'ReservationsController@showBackpackerCheckinForm');
Route::post('/checkin-backpacker-reservation', 'ReservationsController@checkinBackpacker');

//Find Package
Route::get('/getService/{serviceID}', 'ServicesController@getPrices');

//Unit finder: Tent finder
Route::post('/checkin-glamping-finder', 'AccommodationsController@showGlampingCheckinFromFinder');
Route::post('/reserve-glamping-finder', 'ReservationsController@showGlampingReserveFromFinder');

//Unit finder: Room finder
Route::post('/checkin-backpacker-finder', 'AccommodationsController@showBackpackerCheckinFromFinder');
Route::post('/reserve-backpacker-finder', 'ReservationsController@showBackpackerReserveFromFinder');

//Calendar
Route::get('/checkin-glamping/{unitID}/{checkinDate}', 'AccommodationsController@showCheckinFromCalendar');
Route::get('/reserve-glamping/{unitID}/{checkinDate}', 'ReservationsController@showReserveFromCalendar');


//Make reservation
Route::get('/reserve-glamping/{unitID}', 'ReservationsController@showGlampingReservationForm');
Route::post('/reserve-glamping', 'ReservationsController@reserveGlamping');

//Cancel reservation
Route::get('/cancel-reservation-modal/{reservationID}', 'ReservationsController@cancelReservationModal');
Route::post('/cancel-reservation/{reservationID}','ReservationsController@cancelReservation');

//Reservation backpacker
Route::get('/reserve-backpacker/{unitID}', 'ReservationsController@showBackpackerReservationForm');
Route::post('/reserve-backpacker','ReservationsController@reserveBackpacker');

//Check-in backpacker
Route::get('/checkin-backpacker/{unitID}' , 'AccommodationsController@showcheckinBackpackerForm');
Route::post('/checkin-backpacker','AccommodationsController@checkinBackpacker');

//Edit guest details
Route::get('/edit-details/{unitID}', 'GuestsController@viewGuestDetails');
Route::post('/updateDetails', 'GuestsController@updateDetails');

//AddReservation
//Route::get('/addReservation/{unitID}', 'AccommodationsController@showAddReserveForm');
//Route::post('/addReservation','AccommodationsController@addReservation');
 
//ViewGuests
Route::get('/view-guests', 'GuestsController@viewguests');

//ViewReservations
Route::get('/view-reservations', 'ReservationsController@viewReservations');
//Route::get('/viewReservations', 'AccommodationsController@viewReservation');

//View Reservation Details
Route::get('/view-reservation-details/{unitID}/{reservationID}', 'ReservationsController@viewReservationDetails');
Route::post('/save-glamping-reservation-details', 'ReservationsController@saveGlampingReservation');

//CancelReservations
Route::get('/cancel-reservation/{reservationID}', 'ReservationsController@cancelReservation');

//View payment transactions
Route::get('/view-payments', 'PaymentsController@viewLodgingSales');

//View charges
Route::get('/view-charges', 'ChargesController@viewLodgingCharges');

//Select Service	
Route::get('/serviceSelect/{serviceID}', 'ServicesController@getPrices'); 

//Post additional services
Route::post('/addAdditionalService', 'ChargesController@addAdditionalService');

Route::get('/getDates', 'UnitsController@getDates');

//Check-out guests
Route::get('/checkout/{unitID}', 'GuestsController@showCheckoutForm');
Route::post('/checkoutGlamping', 'AccommodationsController@checkoutGlamping');

Route::get('/checkout-due-today/{unitID}', 'GuestsController@showCheckoutFormDueToday');
Route::post('/checkoutDueTodayGlamping', 'AccommodationsController@checkoutGlamping');

//Daily lodging reports
Route::get('/todays-lodging-report', 'UnitsController@todaysLodgingReport');
Route::post('/reload-daily-lodging-report', 'UnitsController@reloadDailyLodgingReport');

//Weekly lodging reports
Route::get('/this-weeks-lodging-report', 'UnitsController@thisWeeksLodgingReport');
Route::post('/reload-weekly-lodging-report', 'UnitsController@reloadWeeklyLodgingReport');

//Monthly lodging reports
Route::get('/this-months-lodging-report', 'UnitsController@thisMonthsLodgingReport');
Route::post('/reload-monthly-lodging-report', 'UnitsController@reloadMonthlyLodgingReport');

//Custom lodging reports
Route::get('/custom-lodging-report', 'UnitsController@customLodgingReport');
Route::post('/reload-custom-lodging-report', 'UnitsController@reloadCustomLodgingReport');

//View Guest Payments
Route::get('/view-guests-payments/{accommodationID}', 'GuestsController@viewGuestsPayments');

/* Admin */
//Dashboard
Route::get('/admin-dashboard', 'UnitsController@loadAdminDashboard');

//View users
Route::get('/view-users', 'UsersController@viewUsers');

//Add user
Route::get('/add-user', 'UsersController@showAddUserForm');
Route::post('user-added', 'UsersController@addUser');

//View units
Route::get('/view-units', 'UnitsController@viewUnits');
Route::get('/view-units-tent', 'UnitsController@viewTents');
Route::get('/view-units-room', 'UnitsController@viewRooms');

//Add unit
Route::get('/add-unit', 'UnitsController@showAddUnitForm');
Route::post('/unit-added', 'UnitsController@addUnit');

//Edit unit
Route::get('/edit-unit/{unitID}', 'UnitsController@viewUnitDetails');
Route::post('/update-unit', 'UnitsController@updateUnit');

//Delete unit
Route::get('/delete-unit-modal/{unitID}', 'UnitsController@deleteUnitModal');
Route::post('/confirm-unit-deletion/{unitID}', 'UnitsController@deleteUnit');
 
//View services
Route::get('/view-services', 'ServicesController@viewServices');
Route::get('/view-services-package', 'ServicesController@viewPackages');
Route::get('/view-services-service', 'ServicesController@viewServicesOnly');
Route::get('/view-services-extra', 'ServicesController@viewExtra');
Route::get('/view-services-damage', 'ServicesController@viewDamageFees');

//Add service
Route::get('/add-service', 'ServicesController@showAddServiceForm');
Route::post('/service-added', 'ServicesController@addService');

//Edit service
Route::get('/edit-service/{serviceID}', 'ServicesController@viewServiceDetails');
Route::post('/update-service', 'ServicesController@updateService');

//Delete service
Route::get('/delete-service-modal/{serviceID}', 'ServicesController@deleteServiceModal');
Route::post('/confirm-service-deletion/{serviceID}', 'ServicesController@deleteService');

//Load room capacity
Route::get('/load-room-capacity/{unitNumber}', 'UnitsController@loadRoomCapacity');

//Bar and restaurant checkout Bill
Route::get('/checkoutBill', 'SalesController@showCheckOutBillForm');

//Bar and Restaurant Sales Report
Route::get('/salesreport', 'SalesController@showSalesReport');
