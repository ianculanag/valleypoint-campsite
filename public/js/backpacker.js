jQuery(document).ready(function(){    
    
    //var source =["Tent1", "Tent2", "Tent3", "Tent4", "Tent5", "Tent6", "Tent7", "Tent8", "Tent9", "Tent10",
    //            "Tent11", "Tent12", "Tent13", "Tent14", "Tent15", "Tent16", "Tent17", "Tent18", "Tent19", "Tent20"];

    var source = jQuery('#unitSource').val().split(',');

    //console.log(source);
    //console.log(sourceNew);
                 
    jQuery('#tokenfieldBackpacker').tokenfield({
        autocomplete: {
        source: source,
        delay: 100
        },
        showAutocompleteOnFocus: false
    });

    jQuery('#tokenfieldBackpacker').on('tokenfield:createtoken', function (event) {
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
    
    jQuery('#tokenfieldBackpacker').on('tokenfield:removetoken', function (e) {
        if (e.attrs.value == jQuery('#selectedUnit').val()) {
            alert('You cannot remove the selected unit.');
            e.preventDefault();
        }
    });

    jQuery('#tokenfieldBackpacker').on('tokenfield:removedtoken', function (e) {
        var numberOfUnits = jQuery('#numberOfUnits').val();
        numberOfUnits--;
        jQuery('#numberOfUnits').val(numberOfUnits);
        removeRowBackpacker(e.attrs.value);
        removeInvoiceEntry(e.attrs.value);

        
        //updateTotal();
        //checkAvailability();
        var checkoutDatesComplete = true;
        for (var count = 0; count < jQuery('.checkoutDatesBackpacker').length; count++) {
            if(jQuery('.checkoutDatesBackpacker').eq(count).val() == '') {
                checkoutDatesComplete = false;
            }
        }

        //console.log(checkout);
        if(checkoutDatesComplete) {    
            if(checkDateSeparation() == false) {
                checkBedAvailability();
                updateTotal();
            }      
        }
    });

    jQuery('#tokenfieldBackpacker').on('tokenfield:createdtoken', function (e) {
        var numberOfUnits = jQuery('#numberOfUnits').val();
        numberOfUnits++;
        jQuery('#numberOfUnits').val(numberOfUnits);
        makeRowBackpacker(e.attrs.value);
        //makeInvoiceEntry(e.attrs.value);
        if(jQuery('#checkoutDate'+e.attrs.value).val() >= jQuery('#checkinDate'+e.attrs.value).val()){
            //checkAvailability(); 
            var checkoutDatesComplete = true;
            for (var count = 0; count < jQuery('.checkoutDatesBackpacker').length; count++) {
                if(jQuery('.checkoutDatesBackpacker').eq(count).val() == '') {
                    checkoutDatesComplete = false;
                }
            }

            //console.log(checkout);
            if(checkoutDatesComplete) {    
                if(checkDateSeparation() == false) {
                    checkBedAvailability();
                    updateTotal();
                }      
            }
        }
        //checkAvailability();
    });
});

function makeRowBackpacker(unitNumber) {
    jQuery.get('/load-room-capacity/'+unitNumber, function(data) {
        var htmlString = "";
        htmlString += "<div class='form-group row mb-0 pb-0' id='divUnits"+unitNumber+"'>";
        htmlString += "<div class='col-md-2 mb-1' id='divUnitNumber"+unitNumber+"'>";
        htmlString += "<input type='text' class='form-control unit"+unitNumber+"' value='"+unitNumber+"' readonly>";
        htmlString += "<input class='' name='totalPrice"+unitNumber+"' id='totalPrice"+unitNumber+"' type='number' style='display:none;position:absolute' value=''>";
        htmlString += "</div>";
        //htmlString += "<input type='hidden' value='1' name='numberOfGroupsIn"+unitNumber+"' id='numberOfGroupsIn"+unitNumber+"'>";
        htmlString += "<div class='col-md-2 mb-1' id='divNumberOfBeds"+unitNumber+"'>";
        htmlString += "<select class='form-control numberOfBeds' name='numberOfBeds"+unitNumber+"' id='numberOfBeds"+unitNumber+"'>";0
        
        for(var index = 1; index <= data; index++) {
            htmlString += "<option value='"+index+"'>"+index+"</option>";
        }

        htmlString += "</select>";
        htmlString += "<input type='hidden' id='maxCapacity"+unitNumber+"' value='"+data+"'>";
        htmlString += "</div>";
        htmlString += "<div class='col-md-4 mb-1' id='divCheckinDate"+unitNumber+"'>";
        htmlString += "<div class='input-group'>";
        htmlString += "<div class='input-group-prepend'>";
        htmlString += "<span class='input-group-text'>";
        htmlString += "<i class='far fa-calendar-alt' aria-hidden='true'></i>";
        htmlString += "</span>";
        htmlString += "</div>";
        htmlString += "<input type='date' name='checkinDate"+unitNumber+"' required='required' class='form-control checkinDatesBackpacker' id='checkinDate"+unitNumber+"' value='"+jQuery('.checkinDatesBackpacker').eq(0).val()+"'>";
        htmlString += "</div>";
        htmlString += "</div>";
        htmlString += "<div class='col-md-4 mb-1' id='divCheckoutDate"+unitNumber+"'>";
        htmlString += "<div class='input-group'>";
        htmlString += "<div class='input-group-prepend'>";
        htmlString += "<span class='input-group-text'>";
        htmlString += "<i class='far fa-calendar-alt' aria-hidden='true'></i>";
        htmlString += "</span>";
        htmlString += "</div>";
        htmlString += "<input type='date' name='checkoutDate"+unitNumber+"' required='required' class='form-control checkoutDatesBackpacker' id='checkoutDate"+unitNumber+"' value='"+jQuery('.checkoutDatesBackpacker').eq(0).val()+"'>";
        //htmlString += "<input type='text' name='stayDuration"+unitNumber+"' id='stayDuration"+unitNumber+"' required='required' style='display:none;position:absolute;' value=''>";
        htmlString += "</div>";
        htmlString += "</div>";
        htmlString += "</div>";
    
        jQuery('#divUnits').append(htmlString);
        
        updateQuantity();
    })
}

function removeRowBackpacker(unitNumber) {
    var divUnit = '#divUnits'+unitNumber;
    var divUnitNumber = '#divUnitNumber'+unitNumber;
    var divNumberOfBeds = '#divNumberOfBeds'+unitNumber+'-1';
    var divCheckinDate = '#divCheckinDate'+unitNumber+'-1';
    var divCheckoutDate = '#divCheckoutDate'+unitNumber+'-1';
    
    jQuery(divUnit).remove();
    jQuery(divNumberOfBeds).remove();
    jQuery(divCheckinDate).remove();
    jQuery(divCheckoutDate).remove();

    updateQuantity();
}

jQuery(document).on('click', '.roomNumber', function() {
    addGroupRow(jQuery(this).val());
    updateQuantity();
});

jQuery(document).on('click', '.removeSplitButton', function() {
    var rawString = jQuery(this).attr('id').slice(17);
    var arrayString = rawString.split('-');

    var unitNumber = arrayString[0];
    var groupIdentifier = '-'+arrayString[1];
    
    removeGroupRow(unitNumber, groupIdentifier);
    updateQuantity();
});

function addGroupRow(unitNumber) {
    var roomIdentifier = '.unit'+unitNumber;
    var numberOfGroups =  jQuery('#numberOfGroupsIn'+unitNumber).val();

    var newGroupIdentifier = '-'+(parseInt(numberOfGroups)+1);

    console.log(numberOfGroups);

    jQuery('#numberOfGroupsIn'+unitNumber).val(newGroupIdentifier.slice(1));
    
    var htmlString = "";

    htmlString += "<div class='col-md-2 mb-1' style='float:right' id='divRemoveSplitButton"+unitNumber+newGroupIdentifier+"'>";
    htmlString += "<div class='input-group'>";
    htmlString += "<button type='button' style='margin-left:auto' id='removeSplitButton"+unitNumber+newGroupIdentifier+"' class='btn btn-danger removeSplitButton unit"+unitNumber+"'>";
    htmlString += "<span class='fa fa-minus' aria-hidden='true'></span>";
    htmlString += "</button>";
    htmlString += "</div>";
    htmlString += "</div>";


    htmlString += "<div class='col-md-2 mb-1' id='divNumberOfBeds"+unitNumber+newGroupIdentifier+"'>";
    htmlString += "<select class='form-control numberOfBeds' name='numberOfBeds"+unitNumber+newGroupIdentifier+"' id='numberOfBeds"+unitNumber+newGroupIdentifier+"'>";
    
    for(var index = 1; index <= jQuery('#maxCapacity'+unitNumber).val(); index++) {
        htmlString += "<option value='"+index+"'>"+index+"</option>";
    }

    htmlString += "</select>";
    htmlString += "</div>";
    htmlString += "<div class='col-md-4 mb-1' id='divCheckinDate"+unitNumber+newGroupIdentifier+"'>";
    htmlString += "<div class='input-group'>";
    htmlString += "<div class='input-group-prepend'>";
    htmlString += "<span class='input-group-text'>";
    htmlString += "<i class='far fa-calendar-alt' aria-hidden='true'></i>";
    htmlString += "</span>";
    htmlString += "</div>";
    htmlString += "<input type='date' name='checkinDate"+unitNumber+newGroupIdentifier+"' required='required' class='form-control checkinDatesBackpacker' id='checkinDate"+unitNumber+newGroupIdentifier+"' value='"+jQuery('.checkinDatesBackpacker').eq(0).val()+"'>";
    htmlString += "</div>";
    htmlString += "</div>";
    htmlString += "<div class='col-md-4 mb-1' id='divCheckoutDate"+unitNumber+newGroupIdentifier+"'>";
    htmlString += "<div class='input-group'>";
    htmlString += "<div class='input-group-prepend'>";
    htmlString += "<span class='input-group-text'>";
    htmlString += "<i class='far fa-calendar-alt' aria-hidden='true'></i>";
    htmlString += "</span>";
    htmlString += "</div>";
    htmlString += "<input type='date' name='checkoutDate"+unitNumber+newGroupIdentifier+"' required='required' class='form-control checkoutDatesBackpacker' id='checkoutDate"+unitNumber+newGroupIdentifier+"' value='"+jQuery('.checkoutDatesBackpacker').eq(0).val()+"'>";
    //htmlString += "<input type='text' name='stayDuration"+unitNumber+"' id='stayDuration"+unitNumber+"' required='required' style='display:none;position:absolute;' value=''>";
    htmlString += "</div>";
    htmlString += "</div>";

    jQuery('#divUnits'+unitNumber).append(htmlString);

    updateRoomCapacity(unitNumber);
}

function removeGroupRow(unitNumber, groupIdentifier) {
    var divSplitButton = '#divRemoveSplitButton'+unitNumber+groupIdentifier;
    var divNumberOfBeds = '#divNumberOfBeds'+unitNumber+groupIdentifier;
    var divCheckinDate = '#divCheckinDate'+unitNumber+groupIdentifier;
    var divCheckoutDate = '#divCheckoutDate'+unitNumber+groupIdentifier;
    
    jQuery(divSplitButton).remove();
    jQuery(divNumberOfBeds).remove();
    jQuery(divCheckinDate).remove();
    jQuery(divCheckoutDate).remove();

    updateRoomCapacity(unitNumber);
}

function updateRoomCapacity(unitNumber){
    var numberOfGroups = jQuery('.unit'+unitNumber).length;
    var maximumCapacity = jQuery('#maxCapacity'+unitNumber).val();

    var totalOccupants = 0;
    var unitIdentifiers = new Array();
    var setCapacity = new Array();

    if(numberOfGroups == 1) {
        var htmlString = "";
        for(var index = 1; index <= maximumCapacity; index++) {            
            if(jQuery('.numberOfBeds').eq(0).val() == index) {
                htmlString += "<option value='"+index+"' selected>"+index+"</option>";
            } else {
                htmlString += "<option value='"+index+"'>"+index+"</option>";
            }
        }
        jQuery('.numberOfBeds').eq(0).html(htmlString);
    }/* else {
        for(var index = 0; index < numberOfGroups; index++){
            totalOccupants += parseInt(jQuery('.numberOfBeds').eq(index).val());
            unitIdentifiers.push(jQuery('.numberOfBeds').eq(index).attr('id').slice(12));
            //console.log(jQuery('.numberOfBeds').eq(index).attr('id').slice(12));
        }


    }    */
}

//BACKPACKER DATES
jQuery(document).on('change', '.checkinDatesBackpacker', function() {
    updateQuantity();
    var checkoutDatesComplete = true;
    for (var count = 0; count < jQuery('.checkoutDatesBackpacker').length; count++) {
        if(jQuery('.checkoutDatesBackpacker').eq(count).val() == '') {
            checkoutDatesComplete = false;
        }
    }

    //console.log(checkout);
    if(checkoutDatesComplete) {    
        if(checkDateSeparation() == false) {
            checkBedAvailability();
            updateTotal();
        }      
    }
});

jQuery(document).on('change', '.checkoutDatesBackpacker', function() {
    updateQuantity();
    var checkoutDatesComplete = true;
    for (var count = 0; count < jQuery('.checkoutDatesBackpacker').length; count++) {
        if(jQuery('.checkoutDatesBackpacker').eq(count).val() == '') {
            checkoutDatesComplete = false;
        }
    }

    //console.log(checkout);
    if(checkoutDatesComplete) {    
        if(checkDateSeparation() == false) {
            checkBedAvailability();
            updateTotal();
        }      
    }
});

jQuery(document).on('change', '.numberOfBeds', function() {
    updateQuantity();
    var checkoutDatesComplete = true;
    for (var count = 0; count < jQuery('.checkoutDatesBackpacker').length; count++) {
        if(jQuery('.checkoutDatesBackpacker').eq(count).val() == '') {
            checkoutDatesComplete = false;
        }
    }

    //console.log(checkout);
    if(checkoutDatesComplete) {    
        if(checkDateSeparation() == false) {
            checkBedAvailability();
            updateTotal();
        }      
    }
});

function updateQuantity() {
    var checkoutDatesComplete = true;
    for (var count = 0; count < jQuery('.checkoutDatesBackpacker').length; count++) {
        //console.log(jQuery('.checkoutDates').eq(count).val()+'fuck');
        if(jQuery('.checkoutDatesBackpacker').eq(count).val() == '') {
            checkoutDatesComplete = false;
        }
    }

    console.log(checkoutDatesComplete);
    if(checkoutDatesComplete) {   
        var numberOfBedsArray = new Array();
        var stayDurationsArray = new Array();
        for(var count = 0; count < jQuery('.checkinDatesBackpacker').length; count++) {
            numberOfBedsArray.push(parseInt(jQuery('.numberOfBeds').eq(count).val()));

            console.log(parseInt(jQuery('.numberOfBeds').eq(count).val()));

            var checkin = Date.parse(jQuery('.checkinDatesBackpacker').eq(count).val());
            var checkout = Date.parse(jQuery('.checkoutDatesBackpacker').eq(count).val());

            var timeDiff = checkout-checkin;
            daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));

            stayDurationsArray.push(daysDiff);
        }

        var priceMultiplier = 0;

        for(var index = 0; index < numberOfBedsArray.length; index++) {
            priceMultiplier += numberOfBedsArray[index] * stayDurationsArray[index];
        }

        totalPrice = parseInt(priceMultiplier*750);
        //jQuery('.invoiceUnitPrices').html('750');
        jQuery('.invoicePrices').eq(0).html(numeral(totalPrice).format('0,0.00'));
        jQuery('.invoiceQuantities').eq(0).html(priceMultiplier);      

        jQuery('#totalPrice').val(parseFloat(parseInt(priceMultiplier*750)).toFixed(2));
        jQuery('#backpackerQuantity').val(priceMultiplier);
        
        updateTotal();
    }
}

function checkBedAvailability() {    
    var selectedUnits = jQuery('#tokenfieldBackpacker').tokenfield('getTokens');
    jQuery.get('/get-room-dates', function(data) {
        var alertMessage = "";

        var selectedUnit;
        var selectedCheckinDate;
        var selectedCheckoutDate;
        var maxCapacity = 0;
        var availableBeds = 0;

        var roomDates;

        var selectedUnitAvailableBeds = new Array();

        /**
         * 1. Get the units from tokenfield
         * 2. For every unit, get the number of available beds within the date
         * 3. Compare the user input
         * 4. Build the alert message
         */

         for(var count = 0; count < selectedUnits.length; count++) {             
            selectedUnit = selectedUnits[count].value; 
            maxCapacity = parseInt(jQuery('#maxCapacity'+selectedUnit).val());   
            availableBeds = maxCapacity;  
            //console.log(availableBeds);
            selectedCheckinDate = moment(jQuery('#checkinDate'+selectedUnit).val()).format('L');
            selectedCheckoutDate = moment(jQuery('#checkoutDate'+selectedUnit).val()).format('L');

            unitArrayIndex = parseInt(selectedUnit.replace(/[^\d]/g, '')) - 1;
            
            roomDates = data[0][unitArrayIndex];

            for(var index = 0; index < roomDates.length; index++) {
                currentCheckinDate = moment(roomDates[index].checkinDatetime).format('L');
                currentCheckoutDate = moment(roomDates[index].checkoutDatetime).format('L');
                if((selectedCheckinDate >= currentCheckinDate && selectedCheckoutDate <= currentCheckoutDate) ||
                   (selectedCheckinDate <= currentCheckinDate && selectedCheckoutDate >= currentCheckoutDate) || 
                   (selectedCheckinDate > currentCheckinDate && selectedCheckinDate < currentCheckoutDate) ||
                   (selectedCheckoutDate > currentCheckinDate && selectedCheckoutDate < currentCheckoutDate)
                   ) {
                    availableBeds -= parseInt(roomDates[index].numberOfBunks);            
                }
            }            
            selectedUnitAvailableBeds.push(availableBeds);
         }

         console.log(selectedUnitAvailableBeds);
         
         var withAvailable = false;
         var withUnavailable = false;

         for(var count = 0; count < selectedUnits.length; count++) {             
            selectedUnit = selectedUnits[count].value; 
            selectedUnitAvailableBed = selectedUnitAvailableBeds[count];
            bedRequestCount = jQuery('#numberOfBeds'+selectedUnit).val();

            var translator = new T2W("EN_US");
            // one thousand two hundred thirty-four
            //translator.toWords(1234)


            console.log(bedRequestCount);

            if(bedRequestCount <= selectedUnitAvailableBed) {
                //if(selectedUnitAvailableBed == 0) {
                alertMessage += '<strong>'+selectedUnit+'</strong> has available beds during the specified dates. <span class="fa fa-check"></span><br>';
                /*} else if(selectedUnitAvailableBed == 1) {
                    alertMessage += '<strong>'+selectedUnit+'</strong> has '+translator.toWords(selectedUnitAvailableBed)+' ('+selectedUnitAvailableBed+')'+' available bed during the specified dates. <br>';
                } else {
                    alertMessage += '<strong>'+selectedUnit+'</strong> has '+translator.toWords(selectedUnitAvailableBed)+' ('+selectedUnitAvailableBed+')'+' available beds during the specified dates. <br>';       
                }*/
                withAvailable = true;
            } else {
                if(selectedUnitAvailableBed == 0) {
                    alertMessage += '<strong>'+selectedUnit+'</strong> has no available beds during the specified dates. <span class="fa fa-times"></span><br>';
                } else if(selectedUnitAvailableBed == 1) {
                    alertMessage += '<strong>'+selectedUnit+'</strong> only has '+translator.toWords(selectedUnitAvailableBed)+' ('+selectedUnitAvailableBed+')'+' available bed during the specified dates. <span class="fa fa-times"></span><br>';
                } else {
                    alertMessage += '<strong>'+selectedUnit+'</strong> only has '+translator.toWords(selectedUnitAvailableBed)+' ('+selectedUnitAvailableBed+')'+' available beds during the specified dates. <span class="fa fa-times"></span><br>';       
                }
                withUnavailable = true
            }
        }

        if(withAvailable && !withUnavailable) {       
            jQuery('#alertContainer').removeClass('alert-danger');
            jQuery('#alertContainer').removeClass('alert-warning')
            jQuery('#alertContainer').addClass('alert-success');
            jQuery('#checkinButton').prop('disabled', false);
        } else if(withUnavailable && !withAvailable) {
            jQuery('#alertContainer').addClass('alert-danger');
            jQuery('#alertContainer').removeClass('alert-warning')
            jQuery('#alertContainer').removeClass('alert-success');
            jQuery('#checkinButton').prop('disabled', true);
        } else if(withAvailable && withUnavailable) {
            jQuery('#alertContainer').removeClass('alert-danger');
            jQuery('#alertContainer').addClass('alert-warning')
            jQuery('#alertContainer').removeClass('alert-success');
            jQuery('#checkinButton').prop('disabled', true);
        }

        jQuery('#alertMessage').html(alertMessage);        
        jQuery('#alertContainer').css('display', 'block');

    })
}