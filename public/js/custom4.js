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
                    

                    if(
                        (selectedCheckinDate >= currentCheckinDate && selectedCheckoutDate <= currentCheckoutDate) ||
                        (selectedCheckinDate <= currentCheckinDate && selectedCheckoutDate >= currentCheckoutDate) || 
                        (selectedCheckinDate > currentCheckinDate && selectedCheckinDate < currentCheckoutDate) ||
                        (selectedCheckoutDate > currentCheckinDate && selectedCheckoutDate < currentCheckoutDate)
                        )
                    {
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
                getCheckedUnits();

                jQuery('#finderCheckin').prop('disabled', false);
                jQuery('#finderReserve').prop('disabled', false);
                
                //console.log(unitIDs);
                //console.log(unitNumbers);
                //console.log(unitAvailability);
            })
        })
    }
});

function displayUnitNumbers(availableUnitIDs, availableUnitNumbers, numberOfUnits) {
    //console.log(availableUnitIDs);
    //console.log(availableUnitNumbers);
    //console.log(numberOfUnits);

    htmlString = "";

    for(var index = 0; index < availableUnitNumbers.length; index++) {
        htmlString += "<div class='custom-control custom-checkbox mb-1'>";
        htmlString += "<input type='checkbox' class='custom-control-input unitCheckboxes' value='"+availableUnitIDs[index]+"' id='availableUnit"+availableUnitIDs[index]+"'>";
        htmlString += "<label class='custom-control-label' for='availableUnit"+availableUnitIDs[index]+"'>"+availableUnitNumbers[index]+"</label>";
        htmlString += "</div>";
    }

    jQuery('#divAvailableUnitsList').html(htmlString);

    for(var count = 0; count < numberOfUnits; count++) {
        jQuery('.unitCheckboxes').eq(count).prop('checked', true);
        //console.log( jQuery('.unitCheckboxes').eq(count).attr('id'));
        //return 'works';
    }
}

jQuery(document).on('change', '.unitCheckboxes', function() {
    getCheckedUnits();
});

jQuery('#finderUnitCount').change(function() {
    getCheckedUnits();
});


function getCheckedUnits() {
    var checkedUnits = new Array();
    for(var count = 0; count < jQuery('.unitCheckboxes').length; count++) {
        if(jQuery('.unitCheckboxes').eq(count).prop('checked') ==  true) {
            checkedUnits.push(jQuery('.unitCheckboxes').eq(count).val());
        }
    }
    checkedUnits = checkedUnits.toString();

    //console.log(checkedUnits);

    jQuery('#checkedUnits').val(checkedUnits);
}