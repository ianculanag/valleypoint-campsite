jQuery(document).ready(function(){
    jQuery('.load-glamping-details').click(function(){
        jQuery.get('load-glamping-details/'+$(this).attr('id'), function(data){

            console.log(data);
            
            var htmlString = "";
 
            htmlString += "<h5 class='text-center'>Unit Details</h5>";
            htmlString += "<div class='container'>";
            htmlString += "<table class='table table-sm borderless'>";
            htmlString += "<tr><td style='width:35%'>Unit ID: </td>";
            htmlString += "<td>" + data[0].unitID + "</td></tr>";
            htmlString += "<tr><td style='width:35%'>Unit Number: </td>";
            htmlString += "<td>" + data[0].unitNumber + "</td></tr>";
            htmlString += "<tr><td style='width:35%'>Capacity: </td>";
            htmlString += "<td>" + data[0].capacity + "</td></tr></table></div>";
            htmlString += "<hr><h5 class='text-center'>Guest Details</h5>";
            htmlString += "<div class='container'>";
            htmlString += "<table class='table table-sm borderless'>";
            htmlString += "<tr><td style='width:35%'>Guest Name: </td>";
            htmlString += "<td>" + data[0].firstName + " " + data[0].lastName + "</td></tr>";
            htmlString += "<tr><td style='width:30%'>Service: </td>";
            htmlString += "<td>" + data[0].serviceName + "</td></tr>";
            htmlString += "<tr><td>Checked-in: </td>";
            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkinDatetime).format('LLLL') + "</td></tr>";
            htmlString += "<tr><td>Check-out: </td>";
            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkoutDatetime).format('LLLL') + "</td></tr>";
            htmlString += "<tr><td class='pt-3'f colspan='2'><a href='' id='checkout'><button type='button' class='btn btn-secondary' style='float:right'>Check-out</button></a>";
            htmlString += "<a href='' id='editDetails'><button type='button' class='btn btn-info mx-2' style='float:right'>View Details</button></a></td></tr></table></div>";

            jQuery('#modal-body').html(htmlString);
            jQuery('#modal-head1').html(data[0].unitNumber);

            jQuery("#reserve").attr("href", "reserve-glamping/"+data[0].unitID);
            jQuery("#editDetails").attr("href", "edit-details/"+data[0].unitID);

            var checkoutDatetime = moment(data[0].checkoutDatetime).format('L');
            var today = new Date();
            var currentDate = moment(today).format('L');
            var availedUnits = data[data.length-1];
            
            console.log(availedUnits);
            if(checkoutDatetime == currentDate && availedUnits != 1) {
                jQuery("#checkout").attr("href", "checkout-glamping/"+data[0].unitID);
            } else {
                jQuery("#checkout").attr("href", "checkout-glamping/"+data[0].unitID);
            }
        })
    });

    
    jQuery('[data-toggle="tooltip"]').tooltip(); 
}); 

jQuery(document).ready(function(){
    jQuery('.load-glamping-available-unit').click(function(){
        console.log('gumana');
        jQuery.get('load-glamping-available-unit/'+$(this).attr('id'), function(data){
            console.log(data);
            var htmlString = "";

            if(data[0].reservationID) {
                htmlString += "<h5 class='text-center'>Unit Details</h5>";
                htmlString += "<div class='container'>";
                htmlString += "<table class='table table-sm borderless'>";
                htmlString += "<tr><td style='width:35%'>Unit ID: </td>";
                htmlString += "<td>" + data[0].unitID + "</td></tr>";
                htmlString += "<tr><td style='width:35%'>Unit Number: </td>";
                htmlString += "<td>" + data[0].unitNumber + "</td></tr>";
                htmlString += "<tr><td style='width:35%'>Capacity: </td>";
                htmlString += "<td>" + data[0].capacity + "</td></tr></table></div>";

                var checkinDatetime = moment(data[0].checkinDatetime).format('L');
                var today = new Date();
                var currentDate = moment(today).format('L');
                console.log(checkinDatetime);
                console.log(currentDate);

                if(checkinDatetime == currentDate) {
                    console.log('OH YEA');
                    //if(data[1]) {
                    htmlString += "<hr><h5 class='text-center'>Checks-in today</h5>";
                    htmlString += "<div class='container'>";
                    htmlString += "<table class='table table-sm borderless'>";
                    //htmlString += "<tr><td rowspan='4' style='font-weight:bold; width:7%'> 1 </td>";
                    htmlString += "<td style='width:35%'>Guest name: </td>";
                    htmlString += "<td>" + data[0].firstName + " " + data[0].lastName + "</td></tr>";
                    htmlString += "<tr><td style='width:35%'>Service: </td>";
                    htmlString += "<td>" + data[0].serviceName + "</td></tr>";
                    htmlString += "<tr><td>Check-in: </td>";
                    htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkinDatetime).format('LLLL') + "</td></tr>";
                    htmlString += "<tr><td>Check-out: </td>";
                    htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkoutDatetime).format('LLLL') + "</td></tr>";
                    htmlString += "<tr><td class='pt-3' colspan='3'><a href='/view-reservation-details/"+data[0].unitID+"/"+data[0].reservationID+"' id='editResrvationDetails'><button type='button' class='btn btn-info' style='float:right'>View Details</button></a>";
                    htmlString += "<a href='/checkin/"+data[0].unitID+"/"+data[0].reservationID+"' id='checkin'><button type='button' class='btn btn-success mx-2' style='float:right'>Check-in</button></a></td></tr></table></div>"
                     
                } else {
                    htmlString += "<hr><h5 class='text-center'>Reservation</h5>";
                    htmlString += "<div class='container'>";
                    htmlString += "<table class='table table-sm borderless'>";
                    //htmlString += "<tr><td rowspan='4' style='font-weight:bold; width:7%'> 1 </td>";
                    htmlString += "<td style='width:35%'>Guest name: </td>";
                    htmlString += "<td>" + data[0].firstName + " " + data[0].lastName + "</td></tr>";
                    htmlString += "<tr><td style='width:35%'>Service: </td>";
                    htmlString += "<td>" + data[0].serviceName + "</td></tr>";
                    htmlString += "<tr><td>Check-in: </td>";
                    htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkinDatetime).format('LLLL') + "</td></tr>";
                    htmlString += "<tr><td>Check-out: </td>";
                    htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkoutDatetime).format('LLLL') + "</td></tr>";
                    htmlString += "<tr><td class='pt-3' colspan='3'><a href='/view-reservation-details/"+data[0].unitID+"/"+data[0].reservationID+"' id='editResrvationDetails'><button type='button' class='btn btn-info' style='float:right'>View Details</button></a>";
                    htmlString += "<a href='/checkin/"+data[0].unitID+"/"+data[0].reservationID+"' id='checkin'><button type='button' class='btn btn-success mx-2' style='float:right'>Check-in</button></a></td></tr></table></div>"
                }
            } else {
                console.log('OH NO');
                htmlString += "<h5 class='text-center'>Unit Details</h5>";
                htmlString += "<div class='container'>";
                htmlString += "<table class='table table-sm borderless'>";
                htmlString += "<tr><td style='width:35%'>Unit ID: </td>";
                htmlString += "<td>" + data[0].unitID + "</td></tr>";
                htmlString += "<tr><td style='width:35%'>Unit Number: </td>";
                htmlString += "<td>" + data[0].unitNumber + "</td></tr>";
                htmlString += "<tr><td style='width:35%'>Capacity: </td>";
                htmlString += "<td>" + data[0].capacity + "</td></tr></table></div>";
            }

            jQuery('#modal-body-empty').html(htmlString);
            jQuery('#modal-head2').html(data[0].unitNumber);
          
            jQuery("#checkinMain").attr("href", "checkin/"+data[0].unitID);
            jQuery("#reserveEmpty").attr("href", "reserve-glamping/"+data[0].unitID);
        })
    });
}); 

//Dynamic adding of forms: Firstname, Lastname, Contact Number depending on the number of Pax
jQuery("#numPax").change(function() {
    var htmlString = "";
    var len = jQuery(this).val();
    for (var i = 1; i < len; i++) {
        if (len > 1) {
            htmlString += "<h5>Accompanying Guests</h5>";
            htmlString += "<div class='row'>";
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<label for='fname'>First Name</label>";
            htmlString += "<input type='text' name='firstName1' required='required' class='form-control' placeholder='Juan'>";
            htmlString += "</div>";
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<label for='lname'>Last Name</label>";
            htmlString += "<input type='text' name='lastName1' required='required' class='form-control' placeholder='Dela Cruz'>";
            htmlString += "</div>";
            
            for (var i = 2; i < len; i++) {
                htmlString += "<div class='form-group col-md-6'>";
                htmlString += "<input type='text' name='firstName" + i + "' required='required' class='form-control' placeholder='Juan'>";
                htmlString += "</div>";
                htmlString += "<div class='form-group col-md-6'>";
                htmlString += "<input type='text' name='lastName" + i + "' required='required' class='form-control' placeholder='Dela Cruz'>";
                htmlString += "</div>";  
            }        
            htmlString +="</div>";
        }
    }
        jQuery("#outputArea").html(htmlString);
});

//Dynamic adding of forms: Firstname Lastname
jQuery("input[type=radio][name=numberOfPax]").change(function() {
    var htmlString = "";
    var len = jQuery(this).val();
    console.log(len);
    if (len > 1) {
        htmlString += "<h5>Accompanying Guests</h5>";
        htmlString += "<div class='row'>";
        htmlString += "<div class='form-group col-md-6'>";
        htmlString += "<label for='fname'>First Name</label>";
        htmlString += "<input type='text' name='firstName1' required='required' class='form-control' placeholder='Juan'>";
        htmlString += "</div>";
        htmlString += "<div class='form-group col-md-6'>";
        htmlString += "<label for='lname'>Last Name</label>";
        htmlString += "<input type='text' name='lastName1' required='required' class='form-control' placeholder='Dela Cruz'>";
        htmlString += "</div>";
        
        for (var i = 2; i < len; i++) {
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<input type='text' name='firstName" + i + "' required='required' class='form-control' placeholder='Juan'>";
            htmlString += "</div>";
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<input type='text' name='lastName" + i + "' required='required' class='form-control' placeholder='Dela Cruz'>";
            htmlString += "</div>";  
        }        
        htmlString +="</div>";
    }
    jQuery("#outputDiv").html(htmlString);
});

jQuery(document).on('click','.collapse.in',function(e) {
    if(jQuery(e.target).is('div') ) {
        jQuery(this).collapse('hide');
    }
});

jQuery(document).ready(function(){    
    
    //var source =["Tent1", "Tent2", "Tent3", "Tent4", "Tent5", "Tent6", "Tent7", "Tent8", "Tent9", "Tent10",
    //            "Tent11", "Tent12", "Tent13", "Tent14", "Tent15", "Tent16", "Tent17", "Tent18", "Tent19", "Tent20"];

    var source = jQuery('#unitSource').val().split(',');

    //console.log(source);
    //console.log(sourceNew);
                 
    jQuery('#tokenfield').tokenfield({
        autocomplete: {
        source: source,
        delay: 100
        },
        showAutocompleteOnFocus: false
    });

    jQuery('#tokenfield').on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        jQuery.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });

        var exists = false;
        jQuery.each(source, function(index, value) {
                if (event.attrs.value === value) {
                    exists = true;
                }
        });
        if(!exists) {
                event.preventDefault(); //prevents creation of token
                alert('Please select the unit from the choices.')
        }

        /*var available_tokens = bloodhound_tokens.index.datums
        var exists = true;
        jQuery.each(available_tokens, function(index, token) {
            if (token.value === event.attrs.value)
                exists = false;
        });
        if(exists === true)
            event.preventDefault();*/
    });
    
    jQuery('#tokenfield').on('tokenfield:removetoken', function (e) {
        if (e.attrs.value == jQuery('#selectedUnit').val()) {
            alert('You cannot remove the selected unit.');
            e.preventDefault();
        }
    });

    jQuery('#tokenfield').on('tokenfield:removedtoken', function (e) {
        var numberOfUnits = jQuery('#numberOfUnits').val();
        numberOfUnits--;
        jQuery('#numberOfUnits').val(numberOfUnits);
        removeRow(e.attrs.value);
        removeInvoiceEntry(e.attrs.value);
        //checkAvailability();
        var checkoutDatesComplete = true;
            for (var count = 0; count < jQuery('.checkoutDates').length; count++) {
                if(jQuery('.checkoutDates').eq(count).val() == '') {
                    checkoutDatesComplete = false;
                }
            }

            //console.log(checkout);
            if(checkoutDatesComplete) {    
                if(checkDateSeparation() == false) {
                    checkAvailability();
                    updateTotal();
                }      
            }
    });

    jQuery('#tokenfield').on('tokenfield:createdtoken', function (e) {
        var numberOfUnits = jQuery('#numberOfUnits').val();
        numberOfUnits++;
        jQuery('#numberOfUnits').val(numberOfUnits);
        makeRow(e.attrs.value);
        makeInvoiceEntry(e.attrs.value);
        if(jQuery('#checkoutDate'+e.attrs.value).val() >= jQuery('#checkinDate'+e.attrs.value).val()){
            //checkAvailability(); 
            var checkoutDatesComplete = true;
            for (var count = 0; count < jQuery('.checkoutDates').length; count++) {
                if(jQuery('.checkoutDates').eq(count).val() == '') {
                    checkoutDatesComplete = false;
                }
            }

            //console.log(checkout);
            if(checkoutDatesComplete) {    
                if(checkDateSeparation() == false) {
                    checkAvailability();
                    updateTotal();
                }      
            }
        }
        //checkAvailability();
    });
});

/*Charges Modal*/
jQuery('#proceedToPayment').click(function() {
    var chargesRows = jQuery('#chargesRows');
    chargesRows.html("");

    var htmlString = "";
    console.log(jQuery('.invoiceQuantities').length);

    var chargesGrandTotal = 0;

    var checked = "";

    for(var index = 0; index < jQuery('.invoiceQuantities').length; index++) {
        if(jQuery('.invoiceCheckboxes').eq(index).prop('checked') == true) {
            checked = "checked";
        } else {
            checked = "";
        }

        htmlString += "<tr>";
        htmlString += "<td></td>";
        htmlString += "<td class='chargesDescriptions'>";
        htmlString += "<input class='form-check-input paymentCheckboxes' type='checkbox' id='charge"+index+"' "+checked+">"+jQuery('.invoiceDescriptions').eq(index).html()+'</td>';
        htmlString += "<td style='text-align:right;' class='chargesQuantities'>"+jQuery('.invoiceQuantities').eq(index).html()+"</td>";
        htmlString += "<td style='text-align:right;' class='chargesUnitPrices'>"+jQuery('.invoiceUnitPrices').eq(index).html()+"</td>";
        htmlString += "<td style='text-align:right;' class='chargesInvoicePrices'>"+jQuery('.invoicePrices').eq(index).html()+"</td>";
        htmlString += "</tr>";

        if(jQuery('.invoiceCheckboxes').eq(index).prop('checked') == true) {
            chargesGrandTotal += numeral(jQuery('.invoicePrices').eq(index).html()).value(); 
        }
    }

    chargesRows.html(htmlString);

    jQuery('#chargesGrandTotal').html(toPeso(numeral(chargesGrandTotal).format('0,0.00')));
});

jQuery('#selectAll').change(function() {
    //var checkboxes = jQuery(this).closest('form').find(':checkbox');
    //checkboxes.prop('checked', jQuery(this).is(':checked'));

    for(var count = 0; count < jQuery('.paymentCheckboxes').length; count++) {
        jQuery('.paymentCheckboxes').eq(count).prop('checked', jQuery(this).is(':checked'));
    }

    updateChargesTotal();
});

function updateChargesTotal() {
    var chargesGrandTotal = 0;
    if(jQuery('#selectAll').prop('checked') == false){        
        jQuery('#chargesGrandTotal').html(0);
    } else {
        for(var index = 0; index < jQuery('.invoicePrices').length; index++) {
            console.log(jQuery('.invoicePrices').eq(index).html());
            chargesGrandTotal += numeral(jQuery('.invoicePrices').eq(index).html()).value();
        }              
        jQuery('#chargesGrandTotal').html(toPeso(numeral(chargesGrandTotal).format('0,0.00')));
    }
}

jQuery(document).on('change', '.paymentCheckboxes', function() {
    var chargesGrandTotal = numeral(jQuery('#chargesGrandTotal').html()).value();
    var chargeNumber = jQuery(this).attr('id').slice(6);
    var invoicePrice = numeral(jQuery('.invoicePrices').eq(chargeNumber).html()).value();
    console.log(chargesGrandTotal);
    if(!(jQuery(this).is(':checked'))) {
        var newGrandTotal = chargesGrandTotal-invoicePrice;
        jQuery('.invoiceCheckboxes').eq(chargeNumber).prop('checked', false);      
        jQuery('#chargesGrandTotal').html(toPeso(numeral(newGrandTotal).format('0,0.00')));
    } else {
        var newGrandTotal = chargesGrandTotal+invoicePrice;            
        jQuery('.invoiceCheckboxes').eq(chargeNumber).prop('checked', true);       
        jQuery('#chargesGrandTotal').html(toPeso(numeral(newGrandTotal).format('0,0.00')));
    }

    checkToggledCheckboxes();
});

function checkToggledCheckboxes(){
    var hit = 0;
    for (var index = 0; index < jQuery('.paymentCheckboxes').length; index++) {
        if(jQuery('.paymentCheckboxes').eq(index).prop('checked') == false) {
            hit++;
        }
    }
    if (hit == 0) {
        jQuery('#selectAll').prop('checked', true);
    } else {
        jQuery('#selectAll').prop('checked', false);
    }
}

jQuery('#savePayments').click(function() {
    jQuery('#selectedPayments').html("");
    var htmlString = "";
    for(var index = 0; index < jQuery('.paymentCheckboxes').length; index++){
        if(jQuery('.paymentCheckboxes').eq(index).prop('checked')){
            htmlString += "<input type='number' name='payment"+index+"' value='"+numeral(jQuery('.chargesInvoicePrices').eq(index).html()).value()+"' style='display:none;'>";
        }
    }
    jQuery('#selectedPayments').html(htmlString);

    jQuery('#rowAmountPaid').css('display', '');
    jQuery('#invoiceAmountPaid').html(toPeso(numeral(jQuery('#amount').val()).format('0,0.00')));
});
/**/

function makeInvoiceEntry(unitNumber) {
    var invoiceRows = jQuery('#invoiceRows');

    htmlString = "";
    htmlString += "<tr id='invoiceUnit"+unitNumber+"'>";
    htmlString += "<td style='display:none;'><input id='invoiceCheckBox'"+unitNumber+"' class='form-check-input invoiceCheckboxes' type='checkbox' checked></td>";
    htmlString += "<td id='invoiceDescription"+unitNumber+"' class='invoiceDescriptions'>Glamping Solo</td>";
    htmlString += "<td id='invoiceQuantity"+unitNumber+"' style='text-align:right;' class='invoiceQuantities'>1x1</td>";
    htmlString += "<td id='invoiceUnitPrice"+unitNumber+"' style='text-align:right;' class='invoiceUnitPrices'>1,350.00</td>";
    htmlString += "<td id='invoiceTotalPrice"+unitNumber+"' style='text-align:right;' class='invoicePrices'>1,350.00</td>";
    htmlString += "</tr>";

    invoiceRows.append(htmlString);

    if(jQuery('.checkoutDates').val() != "") {
        //DUPLICATE CODE!!
        var checkinDate = '#checkinDate'+unitNumber;
        var checkoutDate = '#checkoutDate'+unitNumber;

        var checkin = Date.parse(jQuery(checkinDate).val());
        var checkout = Date.parse(jQuery(checkoutDate).val());

        var timeDiff = checkout-checkin;
        daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));

        var invoiceQuantity;

        var packagePrice;
        var totalPrice;

        var invoiceUnitPrice;
        var invoiceTotalPrice;

        var hiddenTotalPrice;

        invoiceQuantity = '#invoiceQuantity'+unitNumber;
        accommodationPackage = '#accommodationPackage'+unitNumber;
        invoiceUnitPrice = '#invoiceUnitPrice'+unitNumber;
        invoiceTotalPrice = '#invoiceTotalPrice'+unitNumber;

        hiddenTotalPrice = '#totalPrice'+unitNumber;

        jQuery(invoiceQuantity).html(jQuery(accommodationPackage).val()+'x'+(daysDiff));

        packagePrice = numeral(jQuery(invoiceUnitPrice).html()).value();  

        console.log(packagePrice);
        totalPrice = packagePrice * jQuery(accommodationPackage).val() * (daysDiff);                       
        
        jQuery(invoiceUnitPrice).html(numeral(packagePrice).format('0,0.00'));            
        jQuery(invoiceTotalPrice).html(numeral(totalPrice).format('0,0.00'));   
                    
        jQuery(hiddenTotalPrice).val(totalPrice);   
        //NEEDS REFACTORING
    } else {
        //DUPLICATED CODE
        daysDiff = 1;

        var invoiceQuantity;

        var packagePrice;
        var totalPrice;

        var invoiceUnitPrice;
        var invoiceTotalPrice;

        var hiddenTotalPrice;

        invoiceQuantity = '#invoiceQuantity'+unitNumber;
        accommodationPackage = '#accommodationPackage'+unitNumber;
        invoiceUnitPrice = '#invoiceUnitPrice'+unitNumber;
        invoiceTotalPrice = '#invoiceTotalPrice'+unitNumber;

        hiddenTotalPrice = '#totalPrice'+unitNumber;

        jQuery(invoiceQuantity).html(jQuery(accommodationPackage).val()+'x'+(daysDiff));

        packagePrice = numeral(jQuery(invoiceUnitPrice).html()).value();  

        console.log(packagePrice);
        totalPrice = packagePrice * jQuery(accommodationPackage).val() * (daysDiff);                       
        
        jQuery(invoiceUnitPrice).html(numeral(packagePrice).format('0,0.00'));            
        jQuery(invoiceTotalPrice).html(numeral(totalPrice).format('0,0.00'));   
                    
        jQuery(hiddenTotalPrice).val(totalPrice);   
        //NEEDS REFACTORING
    }
    
    
    updateTotal();
}

function makeRow(unitNumber) {
    var htmlString = "";
    htmlString += "<div class='col-md-2 mb-1' id='divUnitNumber"+unitNumber+"'>";
    htmlString += "<input type='text' class='form-control' value='"+unitNumber+"' disabled>";
    htmlString += "<input class='' name='totalPrice"+unitNumber+"' id='totalPrice"+unitNumber+"' type='number' style='display:none;position:absolute' value=''>";
    htmlString += "</div>";
    htmlString += "<div class='col-md-2 mb-1' id='divAccommodationPackage"+unitNumber+"'>";
    htmlString += "<select class='form-control accommodationPackages' name='accommodationPackage"+unitNumber+"' id='accommodationPackage"+unitNumber+"'>";
    htmlString += "<option value='1'>Solo</option>";
    htmlString += "<option value='2'>2 Pax</option>";
    htmlString += "<option value='3'>3 pax</option>";
    htmlString += "<option value='4'>4 pax</option>";
    htmlString += "</select>";
    htmlString += "</div>";
    htmlString += "<div class='col-md-4 mb-1' id='divCheckinDate"+unitNumber+"'>";
    htmlString += "<div class='input-group'>";
    htmlString += "<div class='input-group-prepend'>";
    htmlString += "<span class='input-group-text'>";
    htmlString += "<i class='far fa-calendar-alt' aria-hidden='true'></i>";
    htmlString += "</span>";
    htmlString += "</div>";
    htmlString += "<input type='date' name='checkinDate"+unitNumber+"' required='required' class='form-control checkinDates' id='checkinDate"+unitNumber+"' value='"+jQuery('.checkinDates').val()+"'>";
    htmlString += "</div>";
    htmlString += "</div>";
    htmlString += "<div class='col-md-4 mb-1' id='divCheckoutDate"+unitNumber+"'>";
    htmlString += "<div class='input-group'>";
    htmlString += "<div class='input-group-prepend'>";
    htmlString += "<span class='input-group-text'>";
    htmlString += "<i class='far fa-calendar-alt' aria-hidden='true'></i>";
    htmlString += "</span>";
    htmlString += "</div>";
    htmlString += "<input type='date' name='checkoutDate"+unitNumber+"' required='required' class='form-control checkoutDates' id='checkoutDate"+unitNumber+"' value='"+jQuery('.checkoutDates').val()+"'>";
    //htmlString += "<input type='text' name='stayDuration"+unitNumber+"' id='stayDuration"+unitNumber+"' required='required' style='display:none;position:absolute;' value=''>";
    htmlString += "</div>";
    htmlString += "</div>";

    jQuery('#divUnits').append(htmlString);
}

function removeInvoiceEntry(unitNumber) {
    var invoiceUnit = '#invoiceUnit'+unitNumber;
    //console.log(invoiceUnit);
    jQuery(invoiceUnit).remove();
    updateTotal();
}

function removeRow(unitNumber) {
    var divUnitNumber = '#divUnitNumber'+unitNumber;
    var divAccommodationPackage = '#divAccommodationPackage'+unitNumber;
    var divCheckinDate = '#divCheckinDate'+unitNumber;
    var divCheckoutDate = '#divCheckoutDate'+unitNumber;
    
    jQuery(divUnitNumber).remove();
    jQuery(divAccommodationPackage).remove();
    jQuery(divCheckinDate).remove();
    jQuery(divCheckoutDate).remove();
}

function checkDateSeparation() {
    var hit = false;
    if(jQuery('.checkoutDates').length > 1) {
        for (var count = 0; count < jQuery('.checkoutDates').length-1; count++) {    
            if(jQuery('.checkoutDates').eq(count).val() >= jQuery('.checkinDates').eq(count+1).val()) {
                //console.log('Intersects');
            } else {
                hit = true;
            }
        }
    }

    if(hit) {        
        jQuery('#alertContainer').css('display', 'none');
        jQuery('#dateAlertContainer').css('display', 'none');
        jQuery('#dateGapContainer').css('display', 'block');
        
        jQuery('#checkinButton').prop('disabled', true);
        return true;
    } else {        
        jQuery('#dateGapContainer').css('display', 'none');
        
        jQuery('#checkinButton').prop('disabled', false);
        return false;
    }
}

function checkDateValidity() {
    console.log(jQuery('.checkoutDates').length);
    var invalidCount = 0;

    for (var count = 0; count < jQuery('.checkoutDates').length; count++) {    
        var daysDiff = 0;    
        var checkin = Date.parse(jQuery('.checkinDates').eq(count).val());
        var checkout = Date.parse(jQuery('.checkoutDates').eq(count).val());

        var timeDiff = checkout-checkin;
        daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));

        if(daysDiff < 1) {
            invalidCount++;
        }
    }

    if(invalidCount > 0) {        
        jQuery('#alertContainer').css('display', 'none');
        jQuery('#dateAlertContainer').css('display', 'block');
        
        jQuery('#checkinButton').prop('disabled', true);
        return true;
    } else {        
        jQuery('#dateAlertContainer').css('display', 'none');
        
        jQuery('#checkinButton').prop('disabled', false);
        return false;
    }
}

jQuery(document).ready(function(){
    //var daysDiff = 1;

    jQuery(document).on('change', '.checkoutDates', function() {
        if (checkDateValidity() == false) {
            var daysDiff = 0;
            var unitNumber = jQuery(this).attr('id').slice(12);


            var checkinDate = '#checkinDate'+unitNumber;
            var checkoutDate = '#checkoutDate'+unitNumber;

            var checkin = Date.parse(jQuery(checkinDate).val());
            var checkout = Date.parse(jQuery(checkoutDate).val());

            var timeDiff = checkout-checkin;
            daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));

            //console.log(daysDiff);
            var invoiceQuantity;
            var numberOfPaxGlamping;

            var packagePrice;
            var totalPrice;

            var invoiceUnitPrice;
            var invoiceTotalPrice;

            var hiddenTotalPrice;

            invoiceQuantity = '#invoiceQuantity'+unitNumber;
            accommodationPackage = '#accommodationPackage'+unitNumber;
            invoiceUnitPrice = '#invoiceUnitPrice'+unitNumber;
            invoiceTotalPrice = '#invoiceTotalPrice'+unitNumber;

            hiddenTotalPrice = '#totalPrice'+unitNumber;

            jQuery(invoiceQuantity).html(jQuery(accommodationPackage).val()+'x'+(daysDiff));

            packagePrice = numeral(jQuery(invoiceUnitPrice).html()).value();  

            console.log(packagePrice);
            totalPrice = packagePrice * jQuery(accommodationPackage).val() * (daysDiff);                       
            
            jQuery(invoiceUnitPrice).html(numeral(packagePrice).format('0,0.00'));            
            jQuery(invoiceTotalPrice).html(numeral(totalPrice).format('0,0.00'));   
                        
            jQuery(hiddenTotalPrice).val(totalPrice);   
            
            //document.getElementById('stayDuration').value = daysDiff;   
            var checkoutDatesComplete = true;
            for (var count = 0; count < jQuery('.checkoutDates').length; count++) {
                if(jQuery('.checkoutDates').eq(count).val() == '') {
                    checkoutDatesComplete = false;
                }
            }

            //console.log(checkout);
            if(checkoutDatesComplete) {    
                if(checkDateSeparation() == false) {
                    checkAvailability();
                    updateTotal();
                }      
            }
            //checkAvailability(); 
            //checkDateSeparation();
        }
    });

    jQuery(document).on('change', '.checkinDates', function() {
        if (checkDateValidity() == false) {

            var daysDiff = 0;
            var unitNumber = jQuery(this).attr('id').slice(11);


            var checkinDate = '#checkinDate'+unitNumber;
            var checkoutDate = '#checkoutDate'+unitNumber;

            var checkin = Date.parse(jQuery(checkinDate).val());
            var checkout = Date.parse(jQuery(checkoutDate).val());

            var timeDiff = checkout-checkin;
            daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));

            //console.log(daysDiff);
            var invoiceQuantity;
            var numberOfPaxGlamping;

            var packagePrice;
            var totalPrice;

            var invoiceUnitPrice;
            var invoiceTotalPrice;

            var hiddenTotalPrice;

            invoiceQuantity = '#invoiceQuantity'+unitNumber;
            accommodationPackage = '#accommodationPackage'+unitNumber;
            invoiceUnitPrice = '#invoiceUnitPrice'+unitNumber;
            invoiceTotalPrice = '#invoiceTotalPrice'+unitNumber;

            hiddenTotalPrice = '#totalPrice'+unitNumber;

            jQuery(invoiceQuantity).html(jQuery(accommodationPackage).val()+'x'+(daysDiff));

            packagePrice = numeral(jQuery(invoiceUnitPrice).html()).value();  

            console.log(packagePrice);
            totalPrice = packagePrice * jQuery(accommodationPackage).val() * (daysDiff);                       
            
            jQuery(invoiceUnitPrice).html(numeral(packagePrice).format('0,0.00'));            
            jQuery(invoiceTotalPrice).html(numeral(totalPrice).format('0,0.00'));   
                        
            jQuery(hiddenTotalPrice).val(totalPrice);   
            
            var checkoutDatesComplete = true;
            for (var count = 0; count < jQuery('.checkoutDates').length; count++) {
                //console.log(jQuery('.checkoutDates').eq(count).val()+'fuck');
                if(jQuery('.checkoutDates').eq(count).val() == '') {
                    checkoutDatesComplete = false;
                }
            }

            console.log(checkoutDatesComplete);
            if(checkoutDatesComplete) {   
                if(checkDateSeparation() == false) {
                    checkAvailability();
                }             
            }
        }
    });

    jQuery(document).on('change','.accommodationPackages', function(){
        var daysDiff = 0;
        var unitNumber = jQuery(this).attr('id').slice(20);
        var unitNumberId = '#'+jQuery(this).attr('id');

        //console.log(unitNumberId);
        var invoiceQuantity = '#invoiceQuantity'+unitNumber;

        var checkinDate = '#checkinDate'+unitNumber;
        var checkoutDate = '#checkoutDate'+unitNumber;

        if (jQuery(checkoutDate).val() == "") {
              
            daysDiff = 1;
            jQuery(invoiceQuantity).html(jQuery(this).val()+'x'+(daysDiff));

            var packagePrice;
            var totalPrice;
            var invoiceDescription = '#invoiceDescription'+unitNumber;
            var invoiceUnitPrice = '#invoiceUnitPrice'+unitNumber;
            var invoiceTotalPrice = '#invoiceTotalPrice'+unitNumber;
            
            var hiddenTotalPrice = '#totalPrice'+unitNumber;
            
            jQuery.get('/getService/'+jQuery(unitNumberId).val(), function(data){ 
                packagePrice = data[0].price;        
                packageName = data[0].serviceName;       
                
                jQuery(invoiceDescription).html(packageName);                    
                jQuery(invoiceUnitPrice).html(numeral(packagePrice).format('0,0.00'));
                //console.log(daysDiff);
                totalPrice = packagePrice * jQuery(unitNumberId).val() * (daysDiff);
                jQuery(invoiceTotalPrice).html(numeral(totalPrice).format('0,0.00')); 

                jQuery(hiddenTotalPrice).val(totalPrice);

                updateTotal();
            })
        } else {
            var checkin = Date.parse(jQuery(checkinDate).val());
            var checkout = Date.parse(jQuery(checkoutDate).val());
    
            var timeDiff = checkout-checkin;
            var daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));
      
            jQuery(invoiceQuantity).html(jQuery(this).val()+'x'+(daysDiff));
    
            var packagePrice;
            var totalPrice;
            var invoiceDescription = '#invoiceDescription'+unitNumber;
            var invoiceUnitPrice = '#invoiceUnitPrice'+unitNumber;
            var invoiceTotalPrice = '#invoiceTotalPrice'+unitNumber;
            
            var hiddenTotalPrice = '#totalPrice'+unitNumber;
            
            jQuery.get('/getService/'+jQuery(unitNumberId).val(), function(data){ 
                packagePrice = data[0].price;        
                packageName = data[0].serviceName;       
                
                jQuery(invoiceDescription).html(packageName);                    
                jQuery(invoiceUnitPrice).html(numeral(packagePrice).format('0,0.00'));
                //console.log(daysDiff);
                totalPrice = packagePrice * jQuery(unitNumberId).val() * (daysDiff);
                jQuery(invoiceTotalPrice).html(numeral(totalPrice).format('0,0.00')); 
    
                jQuery(hiddenTotalPrice).val(totalPrice);
    
                updateTotal();
            })
        }    
    });

    var servicePrice;

    jQuery('.serviceSelect').change(function(){
        jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
            servicePrice = data[0].price;
            console.log(servicePrice);

            document.getElementsByClassName('additionalServiceUnitPrice')[0].value = servicePrice;
            document.getElementsByClassName('additionalServiceUnitPrice')[1].value = servicePrice;
            var numberOfPax = document.getElementById('additionalServiceNumberOfPax').value;

            if(numberOfPax) {
                console.log('yeah');
                document.getElementsByClassName('additionalServiceTotalPrice')[0].value = servicePrice * numberOfPax;                
                document.getElementsByClassName('additionalServiceTotalPrice')[1].value = servicePrice * numberOfPax;
                jQuery('.additionalServiceFormAdd').prop('disabled', false);
                jQuery('#additionalServiceFormAddExtra').prop('disabled', false);
            }
        })
    });


    jQuery('#additionalServiceNumberOfPax').change(function(){
        console.log('Wooh');
        var numberOfPax = document.getElementById('additionalServiceNumberOfPax').value;
        if(document.getElementById('serviceSelect').value) {
            document.getElementsByClassName('additionalServiceTotalPrice')[0].value = servicePrice * numberOfPax;            
            document.getElementsByClassName('additionalServiceTotalPrice')[1].value = servicePrice * numberOfPax;
            jQuery('.additionalServiceFormAdd').prop('disabled', false);
            jQuery('#additionalServiceFormAddExtra').prop('disabled', false);
        }
    });

    let additionalServices = jQuery('#additionalServicesCount').val();
    jQuery('.additionalServiceFormAdd').click(function(){
        jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
            console.log(jQuery('#additionalServicesCount').val());
            additionalServices++;
            var htmlStringRow = "";

            //let tbody = jQuery('#invoiceRows');
            //let tr =  document.createElement('TR');
            //tr.id = 'invoiceRow'+additionalServices;

            htmlStringRow += "<tr id='invoiceRow"+additionalServices+"'>";
            htmlStringRow += "<td style='display:none;'><input id='invoiceCheckBox"+additionalServices+"' class='form-check-input invoiceCheckboxes' type='checkbox' checked></td>";
            htmlStringRow += "<td id='invoiceDescription"+additionalServices+"' class='invoiceDescriptions'>"+data[0].serviceName+"</td>";
            htmlStringRow += "<td id='invoiceQuantity"+additionalServices+"' style='text-align:right;' class='invoiceQuantities'>"+jQuery('#additionalServiceNumberOfPax').val()+"</td>";
            htmlStringRow += "<td id='invoiceUnitPrices"+additionalServices+"' style='text-align:right;' class='invoiceUnitPrices'>"+numeral(document.getElementsByClassName('additionalServiceUnitPrice')[0].value).format('0,0.00')+"</td>";
            htmlStringRow += "<td id='invoiceTotalPrice"+additionalServices+"' style='text-align:right;' class='invoicePrices'>"+numeral(document.getElementsByClassName('additionalServiceTotalPrice')[0].value).format('0,0.00')+"</td>";
            htmlStringRow += "</tr>";
            
            jQuery('#invoiceRows').append(htmlStringRow);

            updateTotal();

            jQuery('#additionalServicesCount').val(additionalServices);

            let htmlString = "";
            //htmlString += "<input type='number' style='display:none;float:left;' name='additionalServicesCount' value='"+additionalServices+"'>";
            htmlString += "<input type='text' style='display:none;float:left;' id='additionalServiceID"+additionalServices+"' name='additionalServiceID"+additionalServices+"' value='"+data[0].id+"'>";
            htmlString += "<div class='col-md-3 mb-1' id='divServiceName"+additionalServices+"'>";
            htmlString += "<input class='form-control paxSelect' type='text' name='additionalServiceName"+additionalServices+"' value='"+data[0].serviceName+"' readonly>";
            htmlString += "</div>";
            htmlString += "<div class='col-md-2 mb-1' id='divQuantity"+additionalServices+"'>";
            htmlString += "<input class='form-control paxSelect' type='number' id='additionalServiceNumberOfPax' name='additionalServiceNumberOfPax"+additionalServices+"' value='"+jQuery('#additionalServiceNumberOfPax').val()+"' min='1' max='10' {{--form='serviceForm'--}} readonly>";
            htmlString += "</div>";
            htmlString += "<div class='col-md-3 mb-1' id='divUnitPrice"+additionalServices+"'>";
            htmlString += "<div class='input-group'>";
            htmlString += "<div class='input-group-prepend'>";
            htmlString += "<span class='input-group-text'>₱</span>";
            htmlString += "</div>";
            htmlString += "<input class='form-control additionalServiceUnitPrice' type='text' id='additionalServiceUnitPrice' name='additionalServiceUnitPrice"+additionalServices+"' placeholder='' value='"+document.getElementsByClassName('additionalServiceUnitPrice')[0].value+"' readonly>";
            htmlString += "</div>";
            htmlString += "</div>";
            htmlString += "<div class='col-md-3 mb-1' id='divTotalPrice"+additionalServices+"'>";
            htmlString += "<div class='input-group'>";
            htmlString += "<div class='input-group-prepend'>";
            htmlString += "<span class='input-group-text'>₱</span>";
            htmlString += "</div>";
            htmlString += "<input class='form-control additionalServiceTotalPrice' type='text' id='additionalServiceTotalPrice' name='additionalServiceTotalPrice"+additionalServices+"' placeholder='' value='"+document.getElementsByClassName('additionalServiceTotalPrice')[0].value+"' readonly>";
            htmlString += "</div>";
            htmlString += "</div>";
            htmlString += "<div id='divButton"+additionalServices+"'>";
            htmlString += "<div class='input-group'>";
            htmlString += "<button type='button' id='additionalServiceFormRemove"+additionalServices+"' value='"+additionalServices+"' class='btn btn-danger additionalServiceFormRemove'>";
            htmlString += "<span class='fa fa-minus' aria-hidden='true'></span>";
            htmlString += "</button>";
            htmlString += "</div>";
            htmlString += "</div>";

            jQuery('#divAdditionalServices').append(htmlString);
            jQuery('#serviceSelect').val('choose');
            jQuery('#additionalServiceNumberOfPax').val('');            
            jQuery('#additionalServiceUnitPrice').val('');           
            jQuery('#additionalServiceTotalPrice').val('');

            jQuery('#additionalServiceFormAdd').prop('disabled', true);
        })
    });

    jQuery(document).on('click', '.additionalServiceFormRemove', function() {
        var id = jQuery(this).attr('id').slice(27);  
        var divServiceID = '#additionalServiceID'+id;
        var divServiceName = '#divServiceName'+id;
        var divQuantity = '#divQuantity'+id;
        var divUnitPrice = '#divUnitPrice'+id;
        var divTotalPrice = '#divTotalPrice'+id;
        var divButton = '#divButton'+id;

        jQuery(divServiceID).remove();
        jQuery(divServiceName).remove();
        jQuery(divQuantity).remove();
        jQuery(divUnitPrice).remove();
        jQuery(divTotalPrice).remove();
        jQuery(divButton).remove();

        var divInvoiceRow = '#invoiceRow'+id;
        jQuery(divInvoiceRow).remove();
        
        console.log(id);
        updateTotal();
    });
}); 

function updateTotal() {
    var totalPrice = 0;
    var prices =  jQuery('.invoicePrices');

    for (var index = 0; index < prices.length; index++) {
        //console.log(document.getElementsByClassName('invoicePrices')[index].innerHTML);
        totalPrice += numeral(prices.eq(index).html()).value();
        //console.log(totalPrice);
    }

    jQuery('#invoiceGrandTotal').html(toPeso(numeral(totalPrice).format('0,0.00')));
}

jQuery(document).on('click','.collapse.in',function(e) {
    if(jQuery(e.target).is('div') ) {
        jQuery(this).collapse('hide');
    }
});

jQuery(document).ready( function () {
    jQuery('.dataTable').DataTable();
});

//Date Validation
jQuery('#checkAvailability').click( function() {
    checkAvailability();
});

function checkAvailability() {    
    var selectedUnits = jQuery('#tokenfield').tokenfield('getTokens');
    jQuery.get('/getDates', function(data) {
        //console.log(data.length);
        //console.log(selectedUnits);
        var alertMessage = "";

        var selectedUnit;
        var selectedCheckinDate;
        var selectedCheckoutDate;

        var currentUnit;
        var currentCheckinDate;
        var currentCheckoutDate;

        var occupiedUnits = 0;
        var occupiedUnitNumbers = new Array();
        var occupiedCheckinDates = new Array();
        var occupiedCheckoutDates = new Array();

        var reservedUnits = 0;
        var reservedUnitNumbers = new Array();
        var reservedCheckinDates = new Array();
        var reservedCheckoutDates = new Array();

        /**
         * 1. Get the units from tokenfield
         * 2. For every unit, compare the dates
         * 3. Build the alert message 
         */

         for(var count = 0; count < selectedUnits.length; count++) {             
            selectedUnit = selectedUnits[count].value;            
            selectedCheckinDate = moment(jQuery('#checkinDate'+selectedUnit).val()).format('L');
            selectedCheckoutDate = moment(jQuery('#checkoutDate'+selectedUnit).val()).format('L');

            //console.log(selectedUnit);
            //console.log(selectedCheckinDate);
            //console.log(selectedCheckoutDate);
            for(var index=0; index < data.length; index++) {
                currentUnit = data[index].unitNumber;
                currentCheckinDate = moment(data[index].checkinDatetime).format('L');
                currentCheckoutDate = moment(data[index].checkoutDatetime).format('L');
                if(selectedUnit == currentUnit && (
                    (selectedCheckinDate >= currentCheckinDate && selectedCheckoutDate <= currentCheckoutDate) ||
                    (selectedCheckinDate <= currentCheckinDate && selectedCheckoutDate >= currentCheckoutDate) || 
                    (selectedCheckinDate > currentCheckinDate && selectedCheckinDate < currentCheckoutDate) ||
                    (selectedCheckoutDate > currentCheckinDate && selectedCheckoutDate < currentCheckoutDate)
                    )
                ) {
                    if(data[index].accommodationID) {                        
                        occupiedUnits++;
                        occupiedUnitNumbers.push(currentUnit);
                        occupiedCheckinDates.push(currentCheckinDate);
                        occupiedCheckoutDates.push(currentCheckoutDate);
                    } else if(data[index].reservationID) {  
                        if(!(data[index].reservationID == jQuery('#reservationID').val())) {
                            reservedUnits++;
                            reservedUnitNumbers.push(currentUnit);
                            reservedCheckinDates.push(currentCheckinDate);
                            reservedCheckoutDates.push(currentCheckoutDate);
                        }                   
                    }
                }
            }
         }

        if(occupiedUnits > 0) {
            alertMessage += '<strong>Occupied!</strong><br>';
            for(var count = 0; count < occupiedUnits; count++) {
                console.log(occupiedUnitNumbers[count]);
                console.log(occupiedCheckinDates[count]);
                console.log(occupiedCheckoutDates[count]);
                alertMessage += occupiedUnitNumbers[count] + ' is occupied from ' + moment(occupiedCheckinDates[count]).format('MMMM D') + ' to ' + moment(occupiedCheckoutDates[count]).format('MMMM D') + '.<br>';
            }
            jQuery('#alertMessage').html(alertMessage);            
            jQuery('#alertContainer').removeClass('alert-success');
            jQuery('#alertContainer').addClass('alert-danger');
            jQuery('#alertContainer').css('display','block');
            jQuery('#checkinButton').prop('disabled', true);
        } 

        if(reservedUnits > 0) {
            alertMessage += '<strong>Reserved!</strong><br>';
            for(var count = 0; count < reservedUnits; count++) {
                console.log(reservedUnitNumbers[count]);
                console.log(reservedCheckinDates[count]);
                console.log(reservedCheckoutDates[count]);
                alertMessage += reservedUnitNumbers[count] + ' is reserved from ' + moment(reservedCheckinDates[count]).format('MMMM D') + ' to ' + moment(reservedCheckoutDates[count]).format('MMMM D') + '.<br>';
            }
            jQuery('#alertMessage').html(alertMessage);            
            jQuery('#alertContainer').removeClass('alert-success');
            jQuery('#alertContainer').addClass('alert-danger');
            jQuery('#alertContainer').css('display','block');
            jQuery('#checkinButton').prop('disabled', true);
        }

        if (occupiedUnits == 0 && reservedUnits == 0) {
            alertMessage += '<strong>Available! </strong>';
            for(var count = 0; count < selectedUnits.length; count++) {
                if(count==selectedUnits.length-1 && selectedUnits.length > 1) {
                    alertMessage += 'and ' + selectedUnits[count].value;
                } else if(count==selectedUnits.length-1) {                    
                    alertMessage += selectedUnits[count].value;
                } else {
                    alertMessage += selectedUnits[count].value + ', ';
                }
            }
            if(selectedUnits.length == 1) {
                alertMessage += ' is available within the specified dates.';
            } else {
                alertMessage += ' are available within the specified dates.';
            }
            //alertMessage += moment(selectedCheckinDate).format('MMMM DD') + ' to ' + moment(selectedCheckoutDate).format('MMMM DD') + '.';
            console.log(selectedUnits);
            jQuery('#alertMessage').html(alertMessage);
            jQuery('#alertContainer').removeClass('alert-danger');
            jQuery('#alertContainer').addClass('alert-success');
            jQuery('#alertContainer').css('display', 'block');
            jQuery('#checkinButton').prop('disabled', false);
        }

        jQuery('#alertMessage').html(alertMessage);

    })
}

jQuery(document).ready(function(){
    jQuery('.cancel-reservation-modal').click(function(){
        var id = jQuery(this).attr('id').split('-');
        var reservationID = id[0];
        var unitID = id[1];
        jQuery.get('/cancel-reservation-modal/' + reservationID + '/' + unitID, function(data){
            
            console.log(data);

            var htmlString = "";

            htmlString += "<p class='mx-3'><strong>Warning!</strong> Are you sure you want to cancel this reservation? This operation cannot be undone.</p>";
            htmlString += "<div class='card'><div class='card-body'><table class='table table-sm borderless mb-0'>";
            htmlString += "<tr><td style='width:28%'>Guest name: </td>";
            htmlString += "<td>" + data[0].firstName +" "+ data[0].lastName + "</td></tr>";
            htmlString += "<tr><td style='width:28%'>Service: </td>";
            htmlString += "<td>" + data[0].serviceName + "</td></tr>";
            htmlString += "<tr><td style='width:28%'>Check-in: </td>";
            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkinDatetime).format('LLLL') + "</td></tr>";
            htmlString += "<tr><td style='width:28%'>Check-out: </td>";
            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkoutDatetime).format('LLLL') + "</td></tr></table></div></div>";

            jQuery('#cancelReservationModalBody').html(htmlString);
            jQuery("#confirmCancel").attr('href', '/cancel-reservation/' + data[0].reservationID + '/' + data[0].unitID);
        })
    });
}); 

jQuery(document).ready(function(){
    jQuery('.cancel-all-reservations-modal').click(function(){
        jQuery.get('/cancel-all-reservations-modal/' + jQuery(this).attr('id'), function(data){
            
            console.log(data);

            var htmlString = "";

            htmlString += "<p class='mx-3'><strong>Warning!</strong> Are you sure you want to cancel this reservation? This operation cannot be undone.</p>";
            htmlString += "<div class='card'><div class='card-body'><table class='table table-sm borderless mb-0'>";
            htmlString += "<tr><td style='width:28%'>Guest name: </td>";
            htmlString += "<td>" + data[0].firstName +" "+ data[0].lastName + "</td></tr>";
            htmlString += "<tr><td style='width:28%'>No. of units: </td>";
            htmlString += "<td>" + data[0].numberOfUnits + "</td></tr></table></div></div>";

            jQuery('#cancelAllReservationsModalBody').html(htmlString);
            jQuery("#confirmCancel").attr('href', '/cancel-all-reservations/' + data[0].reservationID);
        })
    });
}); 