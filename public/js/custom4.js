jQuery(document).on('change', '.finderInputs', function() {
    var unitFinderComplete = true;
    for (var count = 0; count < jQuery('.finderInputs').length; count++) {
        //console.log(jQuery('.checkoutDates').eq(count).val()+'fuck');
        if(jQuery('.finderInputs').eq(count).val() == '') {
            unitFinderComplete = false;
        }
    }

    if(unitFinderComplete) {   
        /*console.log('Complete with this info');
        for (var count = 0; count < jQuery('.finderInputs').length; count++) {
            console.log(jQuery('.finderInputs').eq(count).val());
        }*/

        var unitIDs = new Array();
        var unitNumbers = new Array();
        var unitAvailability = new Array();

        var availableUnitIDs = new Array();
        var availableUnitNumbers = new Array();


        jQuery.get('/getDates', function(dates) {
            //console.log(data);
            jQuery.get('/get-glamping-tents', function(units) {
                //console.log(dates);
                //console.log(units);
                for(var count = 0; count < units.length; count++){
                    unitIDs.push(units[count].id);
                    unitNumbers.push(units[count].unitNumber);
                    unitAvailability.push(false);
                }

                var selectedCheckinDate = moment(jQuery('#finderCheckinDate').val()).format('L');
                var selectedCheckoutDate = moment(jQuery('#finderCheckoutDate').val()).format('L');
                
                for(var index = 0; index < dates.length; index++) {
                    var currentCheckinDate = moment(dates[index].checkinDatetime).format('L');
                    var currentCheckoutDate = moment(dates[index].checkoutDatetime).format('L')
                    

                    if((selectedCheckinDate >= currentCheckinDate && selectedCheckoutDate <= currentCheckoutDate) || (selectedCheckinDate <= currentCheckinDate && selectedCheckoutDate >= currentCheckoutDate)) {
                        var arrayIndex = dates[index].unitID - 1;
                        unitAvailability[arrayIndex] = true;
                    }
                }

                for(var counter = 0; counter < unitAvailability.length; counter++) {
                    if (unitAvailability[counter] == false) {
                        availableUnitIDs.push(unitIDs[counter]);
                        availableUnitNumbers.push(unitNumbers[counter]);
                    }
                }

                //console.log(availableUnitNumbers);

                displayUnitNumbers(availableUnitIDs, availableUnitNumbers, jQuery('#finderUnitCount').val());


                //console.log(unitIDs);
                //console.log(unitNumbers);
                //console.log(unitAvailability);
            })
        })
    }
});

function displayUnitNumbers(availableUnitIDs, availableUnitNumbers, numberOfUnits) {
    console.log(availableUnitIDs);
    console.log(availableUnitNumbers);
    console.log(numberOfUnits);
}


/*jQuery.get('/getDates', function(data) {
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
             *
    
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
                    if(selectedUnit == currentUnit && ((selectedCheckinDate >= currentCheckinDate && selectedCheckoutDate <= currentCheckoutDate) || (selectedCheckinDate <= currentCheckinDate && selectedCheckoutDate >= currentCheckoutDate))) {
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
    
        })*/