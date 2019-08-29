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

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

/* Lodging */
Route::group(['middleware' => ['auth', 'lodging']], function() {
    
    //Dashboard: Physical view
    Route::get('/backpacker', 'UnitsController@backpacker'); 
    Route::get('/glamping', 'UnitsController@glamping'); 

    //Dashboard: Calendar view
    Route::get('/calendar-glamping', 'UnitsController@calendarGlamping'); 
    Route::get('/calendar-backpacker', 'UnitsController@calendarBackpacker'); 

    //Dashboard: Reload calendar
    Route::post('/reload-calendar-glamping', 'UnitsController@reloadCalendarGlamping'); 
    Route::post('/reload-calendar-backpacker', 'UnitsController@reloadCalendarBackpacker'); 

    Route::get('/guest-checkout/{id}', 'UnitsController@loadGuestDetails');
    Route::get('/load-tents', 'UnitsController@loadTents');

    //Modals
    Route::get('/load-glamping-details/{id}', 'UnitsController@loadGlampingUnit');
    Route::get('/load-glamping-available-unit/{id}', 'UnitsController@loadGlampingAvailableUnit');

    Route::get('/load-backpacker-details/{id}', 'UnitsController@loadBackpackerUnit');
    Route::get('/load-backpacker-available-unit/{id}', 'UnitsController@loadBackpackerAvailableUnit');

    Route::post('/guests', 'GuestsController@addGuest');

    //Unit finder: Get glamping tents
    Route::get('/get-glamping-tents', 'UnitsController@getGlampingTents');

    //Unit finder: Get backpacker rooms
    Route::get('/get-backpacker-rooms', 'UnitsController@getBackpackerRooms');

    //Check-in guests glamping
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

    //Cancel unit reservation
    Route::get('/cancel-reservation-modal/{reservationID}/{unitID}', 'ReservationsController@cancelReservationModal');
    Route::get('/cancel-reservation/{reservationID}/{unitID}','ReservationsController@cancelReservation');

    //Cancel all reservations made by this guest
    Route::get('/cancel-all-reservations-modal/{reservationID}', 'ReservationsController@cancelGuestReservationModal');
    Route::get('/cancel-all-reservations/{reservationID}','ReservationsController@cancelGuestReservation');

    //Reservation backpacker
    Route::get('/reserve-backpacker/{unitID}', 'ReservationsController@showBackpackerReservationForm');
    Route::post('/reserve-backpacker','ReservationsController@reserveBackpacker');

    //Check-in backpacker
    Route::get('/checkin-backpacker/{unitID}' , 'AccommodationsController@showcheckinBackpackerForm');
    Route::post('/checkin-backpacker','AccommodationsController@checkinBackpacker');

    //Edit guest details
    Route::get('/edit-details/{unitID}', 'GuestsController@viewGuestDetails');
    Route::post('/updateDetails', 'GuestsController@updateDetails');
    Route::post('/update-backpacker-details', 'GuestsController@updateBackpackerDetails');

    //Edit backpacker guests
    Route::get('/edit-backpacker-details/{unitID}/{accommodationID}', 'GuestsController@viewBackpackerGuestDetails');

    //View guests
    Route::get('/view-guests', 'GuestsController@viewguests');

    //View reservations
    Route::get('/view-reservations', 'ReservationsController@viewReservations');
    //Route::get('/viewReservations', 'AccommodationsController@viewReservation');

    //View reservation details
    Route::get('/view-reservation-details/{unitID}/{reservationID}', 'ReservationsController@viewReservationDetails');
    Route::post('/save-glamping-reservation-details', 'ReservationsController@saveGlampingReservation');

    //Cancel reservations
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
    Route::get('/get-room-dates', 'UnitsController@getRoomDates');

    //Check-out glamping guests
    Route::get('/checkout-glamping/{unitID}', 'GuestsController@showGlampingCheckoutForm');
    Route::post('/checkoutGlamping', 'AccommodationsController@checkoutGlamping');

    Route::get('/checkout-glamping-due-today/{unitID}', 'GuestsController@showGlampingCheckoutFormDueToday');
    Route::post('/checkoutDueTodayGlamping', 'AccommodationsController@checkoutGlamping');

    //Check-out backpacker guests
    Route::get('/checkout-backpacker/{unitID}', 'GuestsController@showBackpackerCheckoutForm');
    Route::post('/checkoutBackpacker', 'AccommodationsController@checkoutBackpacker');

    Route::get('/checkout-backpacker-due-today/{unitID}', 'GuestsController@showBackpackerCheckoutFormDueToday');
    Route::post('/checkoutDueTodayBackpacker', 'AccommodationsController@checkoutBackpacker');

    //Daily lodging reports
    Route::get('/todays-lodging-report', 'UnitsController@todaysLodgingReport');
    Route::post('/reload-daily-lodging-report', 'UnitsController@reloadDailyLodgingReport');
    Route::get('/dailyLodgingPrint','UnitsController@todaysLodgingReportPrint');

    //Weekly lodging reports
    Route::get('/this-weeks-lodging-report', 'UnitsController@thisWeeksLodgingReport');
    Route::post('/reload-weekly-lodging-report', 'UnitsController@reloadWeeklyLodgingReport');
    Route::get('/weeklyLodgingPrint', 'UnitsController@thisWeeksLodgingReportPrint');

    //Monthly lodging reports
    Route::get('/this-months-lodging-report', 'UnitsController@thisMonthsLodgingReport');
    Route::post('/reload-monthly-lodging-report', 'UnitsController@reloadMonthlyLodgingReport');
    Route::get('/monthlyLodgingPrint', 'UnitsController@thisMonthsLodgingReportPrint');

    //Custom lodging reports
    Route::get('/custom-lodging-report', 'UnitsController@customLodgingReport');
    Route::post('/reload-custom-lodging-report', 'UnitsController@reloadCustomLodgingReport');
    Route::get('/customLodgingPrint', 'UnitsController@customLodgingReportPrint');

    //View Guest Payments
    Route::get('/view-guests-payments/{accommodationID}', 'GuestsController@viewGuestsPayments');

    //View side by side charges-payments
    Route::get('/side-by-side/charges-payments', 'GuestsController@viewAllGuestsPayments');

    //Load room capacity
    Route::get('/load-room-capacity/{unitNumber}', 'UnitsController@loadRoomCapacity');


    //DANGER
    //Void Transaction
    Route::post('/voidTransaction', 'AccommodationsController@voidTransaction');
});

/* Admin */
Route::group(['middleware' => ['auth', 'admin']], function() {

    //Dashboard
    Route::get('/admin-dashboard', 'UnitsController@loadAdminDashboard');

    /* Users */
    //View users
    Route::get('/view-users', 'UsersController@viewUsers');

    //Edit users
    Route::get('/edit-user-info/{userId}', 'UsersController@viewUserInfo');
    Route::post('/update-user', 'UsersController@updateUser');

    //delete users
    Route::get('/delete-user/{userId}', 'UsersController@deleteUser');

    //Add user
    Route::get('/add-user', 'UsersController@showAddNewUserForm');
    Route::post('/addNewUser', 'UsersController@addNewUser');
   

    /* Units */
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
    
    /* Services: Packages, Services, Extra Utilities, Damage Fees */
    //View services
    Route::get('/view-services', 'ServicesController@viewServices');
    Route::get('/view-services-package', 'ServicesController@viewPackages');
    Route::get('/view-services-service', 'ServicesController@viewServicesOnly');
    Route::get('/view-services-extra', 'ServicesController@viewExtra');
    Route::get('/view-services-damage', 'ServicesController@viewDamageFees');

    //Add service
    Route::get('/add-service', 'ServicesController@showAddServiceForm');
    Route::post('/service-added', 'ServicesController@addService');

    //Add menu item
    Route::get('/add-menu-item', 'ProductsController@showAddMenuItemForm');
    Route::post('/menu-item-added', 'ProductsController@addNewMenuItem');

    //delete item
    Route::get('/delete-item/{productId}/', 'ProductsController@deleteItem');

    //Add Category
    Route::get('/add-category', 'ProductsController@showAddCategoryForm');
    Route::post('/category-added', 'ProductsController@addNewCategory');

    //Add Ingredient
    Route::get('/add-ingredient', 'IngredientsController@showAddIngredientForm');
    Route::post('/ingredient-added', 'IngredientsController@addNewIngredient');

    //Edit service
    Route::get('/edit-service/{serviceID}', 'ServicesController@viewServiceDetails');
    Route::post('/update-service', 'ServicesController@updateService');

    //Delete service
    Route::get('/delete-service-modal/{serviceID}', 'ServicesController@deleteServiceModal');
    Route::post('/confirm-service-deletion/{serviceID}', 'ServicesController@deleteService');

    /* Inventory */
    //Display all ingredient categories
    Route::get('/view-inventory', 'InventoryController@viewTodaysInventory');

    //Reload daily inventory
    Route::get('/view-inventory/daily/{category}/{onDate}', 'InventoryController@viewDailyInventory');

    //Reload monthly inventory
    Route::get('/view-inventory/monthly/{category}/{onMonth}/{onYear}', 'InventoryController@viewMonthlyInventory');

    //Reload custom inventory
    Route::get('/view-inventory/custom/{category}/{fromDate}/{toDate}', 'InventoryController@viewCustomInventory');

    /* Menu and Recipes */
    //View menu
    Route::get('/view-menu-recipe', 'ProductsController@viewMenuItems');

    //View menu by category
    Route::get('/view-menu-recipe/{category}', 'ProductsController@viewMenuCategories');

    //View recipe of a menu item
    Route::get('/load-recipe/{menuItem}', 'ProductsController@viewMenuItemRecipe');

    /* Ingredients */
    //View ingredients
    Route::get('/view-ingredients', 'IngredientsController@viewIngredients');

    //View ingredients by category
    Route::get('/view-ingredients/{category}', 'IngredientsController@viewIngredientCategories');

    //Add ingredient
    // Route::get('/add-ingredient', 'IngredientsController@showAddIngredientForm');
    // Route::post('/ingredient-added', 'IngredientController@addIngredient');

    //Edit ingredient
    // Route::get('/edit-ingredient/{ingredientID}', 'IngredientsController@viewServiceDetails');
    // Route::post('/update-ingredient', 'IngredientsController@updateService');

    //Delete ingredient
    Route::get('/delete-ingredient-modal/{ingredientID}', 'IngredientsController@deleteIngredientModal');
    //Route::post('/confirm-ingredient-deletion/{ingredientID}', 'IngredientsController@deleteIngredient');


});

/* Restaurant */
Route::group(['middleware' => ['auth', 'cashier']], function() {
    
    //POS Dashboard Pages
    Route::get('/start-shift', 'ProductsController@viewShiftStartPage');
    Route::get('/started-shift', 'ProductsController@shiftStart');
    Route::get('/create-order', 'ProductsController@createOrder');
    Route::get('/view-tables', 'OrdersController@viewTables');
    Route::get('/view-order-slips', 'OrdersController@viewOrderSlips');
    Route::get('/shiftEnd', 'ProductsController@shiftEnd');
    Route::get('/cashStart', 'ShiftsController@cashStart');
    
    //View menu
    Route::get('/view-menu', 'ProductsController@viewMenuItems');

    //View menu by category
    Route::get('/view-menu/{category}', 'ProductsController@viewMenuCategories');

    //Make Order POS
    Route::get('/view-menu/{productCategory}', 'ProductsController@viewMenu');
    /*Route::get('/view-appetizers', 'FoodsController@viewAppetizers');
    Route::get('/view-breads', 'FoodsController@viewBreads');
    Route::get('/view-breakfast', 'FoodsController@viewBreakfast');
    Route::get('/view-group-meals', 'FoodsController@viewGroupmeals');
    Route::get('/view-noodles', 'FoodsController@viewNoodles');
    Route::get('/view-rice-bowl', 'FoodsController@viewRicebowl' );
    Route::get('/view-soup', 'FoodsController@viewSoup');
    Route::get('/view-beverages', 'FoodsController@viewBeverages');*/

    //Save Order
    Route::post('/save-order', 'OrdersController@saveOrder');
    Route::post('/save-additional-order', 'OrdersController@saveAdditionalOrder');

    //Add order
    Route::get('/add-order/{orderID}', 'OrdersController@addOrder');

    //Finish Order Transaction
    Route::post('/finish-order-transaction', 'OrdersController@finishOrderTransaction');

    Route::get('/get-product-item/{productID}', 'ProductsController@getProductItem');

    //View table details
    Route::get('/load-table/{tableNumber}', 'OrdersController@loadTable');

    //View table orders
    Route::get('/load-table-order-slip/{tableNumber}', 'OrdersController@loadTableOrders');

    //Update table number
    Route::get('/update-table-number/{orderID}/{tableNumber}/{oldTableNumber}', 'OrdersController@updateTableNumber');
    Route::get('/update-table-number/{orderID}/{tableNumber}', 'OrdersController@addTableNumber');

    //Update queue number
    Route::get('/update-queue-number/{orderID}/{queueNumber}', 'OrdersController@updateQueueNumber');

    //Reload table view on table number update
    Route::get('/reload-table-view', 'OrdersController@reloadTables');

    //Bar and restaurant checkout Bill
    Route::get('/bill-out/{orderID}', 'OrdersController@showBilloutOrderSlip');

    //Cashier shift report
    Route::get('/cashier-shift-report', 'CashierController@showCashierReport');
    Route::get('/reload-cashier-shift-report', 'CashierController@reloadShowCashierReport');
    Route::get('/print-cashier-shift-report', 'CashierController@printCashierShiftReport');

    //Daily restaurant reports
    Route::get('/todays-restaurant-report', 'OrdersController@todaysRestaurantReport');
    Route::get('/reload-todays-restaurant-report', 'OrdersController@reloadTodaysRestaurantReport');
    Route::get('/daily-sales-report-print','OrdersController@todaysRestaurantReportPrint');


    //Weekly restaurant reports
    Route::get('/this-weeks-restaurant-report', 'OrdersController@thisWeeksRestaurantReport');
    Route::get('/reload-this-weeks-restaurant-report', 'OrdersController@reloadthisWeeksRestaurantReport');
    Route::get('/weekly-sales-report-print','OrdersController@weeklyRestaurantReportPrint');

    //Monthly restaurant reports
    Route::get('/this-months-restaurant-report', 'OrdersController@thisMonthsRestaurantReport');
    Route::get('/reload-this-months-restaurant-report', 'OrdersController@reloadThisMonthsRestaurantReport');
    Route::get('/monthly-sales-report-print', 'OrdersController@monthlyRestaurantReportPrint');

    //Custom restaurant reports
    Route::get('/custom-restaurant-report', 'OrdersController@customRestaurantReport');
    Route::get('/reload-custom-restaurant-report', 'OrdersController@reloadCustomRestaurantReport');
    Route::get('/custom-sales-report-print', 'OrdersController@customRestaurantReportPrint');

    //View orders for restaurant 
    Route::get('/view-orders', 'OrdersController@viewOrders');

    //View payments for restaurant
    Route::get('/view-restaurant-payments', 'PaymentsController@viewRestoPayments');

    //Search item from order slip
    Route::get('/search-item/{searchQuery}', 'ProductsController@searchItem');

    //Route::get('/update-inventory-test/{productID}/{quantity}', 'OrdersController@updateInventory');
});