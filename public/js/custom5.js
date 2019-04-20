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

    jQuery('#tokenfieldBackpacker').on('tokenfield:createdtoken', function (e) {
        var numberOfUnits = jQuery('#numberOfUnits').val();
        numberOfUnits++;
        jQuery('#numberOfUnits').val(numberOfUnits);
        makeRowBackpacker(e.attrs.value);
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

function makeRowBackpacker(unitNumber) {
    jQuery.get('../load-room-capacity/'+unitNumber, function(data) {
        var htmlString = "";
        htmlString += "<div class='col-md-2 mb-1' id='divUnitNumber"+unitNumber+"'>";
        htmlString += "<input type='text' class='form-control' value='"+unitNumber+"' disabled>";
        htmlString += "<input class='' name='totalPrice"+unitNumber+"' id='totalPrice"+unitNumber+"' type='number' style='display:none;position:absolute' value=''>";
        htmlString += "</div>";
        htmlString += "<div class='col-md-2 mb-1' id='divNumberOfBeds"+unitNumber+"'>";
        htmlString += "<select class='form-control numberOfBeds' name='numberOfBeds"+unitNumber+"' id='numberOfBeds"+unitNumber+"'>";
        
        for(var index = 1; index <= data; index++) {
            htmlString += "<option value='"+unitNumber+index+"'>"+index+"</option>";
        }

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
    })
}

function removeRow(unitNumber) {
    var divUnitNumber = '#divUnitNumber'+unitNumber;
    var divNumberOfBeds = '#divNumberOfBeds'+unitNumber;
    var divCheckinDate = '#divCheckinDate'+unitNumber;
    var divCheckoutDate = '#divCheckoutDate'+unitNumber;
    
    jQuery(divUnitNumber).remove();
    jQuery(divNumberOfBeds).remove();
    jQuery(divCheckinDate).remove();
    jQuery(divCheckoutDate).remove();
}