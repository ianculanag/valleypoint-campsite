/* Tent Finder */
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

            /* Tents */
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
                populateCalendar(dates);

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

function populateCalendar(dates) {
    for(var count = 0; count < dates.length; count++) {
        console.log(dates[count]);
    }
    
    var selectedCheckinDate = moment(jQuery('#finderCheckinDate').val()).format('M-D');
    var selectedCheckoutDate = moment(jQuery('#finderCheckoutDate').val()).format('M-D');

    console.log(selectedCheckinDate);
    console.log(selectedCheckoutDate);

    var htmlString = "<td scope='col'></td>";
    var columns = 0;

    for(var checkin = moment(selectedCheckinDate).format('D'); checkin <= moment(selectedCheckoutDate).format('D'); checkin++){
        htmlString += "<td>"+checkin+"</td>";
        columns++;
    }

    var unitNumbers = new Array();
    
    for(var count = 0; count < dates.length; count++) {
        if(jQuery.inArray(dates[count].unitNumber, unitNumbers)) {
            unitNumbers.push(dates[count].unitNumber);
            console.log('Hit');
        } else {            
        }
    }

    var bodyString = "";

    for(var index = 0; index < unitNumbers.length; index++) {
        bodyString += "<tr>";
        bodyString += "<td>"+unitNumbers[index]+"</td>";
        for(var columnCount = 0; columnCount < columns; columnCount++) {
            bodyString += "<td></td>";
        }
        bodyString += "</tr>";
    }

    jQuery('#calendarBody').html(bodyString);
    jQuery('#calendarHead').html(htmlString);
}

/* Room Finder */
jQuery(document).on('change', '.roomFinderInputs', function() {
    var unitFinderComplete = true;
    for (var count = 0; count < jQuery('.roomFinderInputs').length; count++) {
        if(jQuery('.roomFinderInputs').eq(count).val() == '') {
            unitFinderComplete = false;
        }
    }

    if(unitFinderComplete) {   

        var unitIDs = new Array();
        var unitNumbers = new Array();
        var unitAvailability = new Array();

        var availableUnitIDs = new Array();
        var availableUnitNumbers = new Array();


        jQuery.get('/getDates', function(dates) {

            jQuery.get('/get-backpacker-rooms', function(units) {
                for(var count = 0; count < units.length; count++){
                    unitIDs.push(units[count].id);
                    unitNumbers.push(units[count].unitNumber);
                    unitAvailability.push(false);
                }

                var selectedCheckinDate = moment(jQuery('#roomFinderCheckinDate').val()).format('L');
                var selectedCheckoutDate = moment(jQuery('#roomFinderCheckoutDate').val()).format('L');
                
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

                displayUnitNumbers(availableUnitIDs, availableUnitNumbers, jQuery('#roomFinderUnitCount').val());
                getCheckedUnits();              
                //populateCalendar(dates);

                jQuery('#roomFinderCheckin').prop('disabled', false);
                jQuery('#roomFinderReserve').prop('disabled', false);
            })
        })
    }
});

function displayUnitNumbers(availableUnitIDs, availableUnitNumbers, numberOfUnits) {

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

    jQuery('#checkedUnits').val(checkedUnits);
}

//CALENDAAAAR
jQuery(document).ready(function(){
    jQuery('.load-calendar-units').click(function(){
        console.log('gumana');
        var parentID = jQuery(this).parent().attr('id');

        //console.log(parentID.slice(parentID.length-12,parentID.length-2));
        var unitID = parentID.slice(0, parentID.indexOf('-'));
        var date = parentID.slice(parentID.length-12,parentID.length-2);

        console.log(unitID);

        jQuery.get('load-glamping-available-unit/'+unitID, function(data){
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

            jQuery('#modal-body-empty').html(htmlString);
            jQuery('#modal-head2').html(data[0].unitNumber);
          
            jQuery("#checkinMain").attr("href", "checkin-glamping/"+data[0].unitID+"/"+date);
            jQuery("#reserveEmpty").attr("href", "reserve-glamping/"+data[0].unitID+"/"+date);
            //jQuery("#checkin-backpacker").attr("href", "checkin-backpacker/"+data[0].unitID);
            //jQuery("#reserveBackpackerEmpty").attr("href", "reserve-backpacker/"+data[0].unitID);
        })
    });
});

/*
jQuery('#loadCalendarGlamping').click(function(){
    var glampingCalendarInputsComplete = true;
    for (var count = 0; count < jQuery('.glampingCalendarInputs').length; count++) {
        if(jQuery('.glampingCalendarInputs').eq(count).val() == '') {
            glampingCalendarInputsComplete = false;
            console.log('1');
        }
    }

    if(glampingCalendarInputsComplete) {  
        console.log('2');

        jQuery.get('/getDates', function(dates) {
            refreshCalendar(dates);   
        })
    }
});

function refreshCalendar(dates) {
    for(var count = 0; count < dates.length; count++) {
        console.log(dates[count]);
    }
    
    var glampingCalendarFrom = moment(jQuery('#glampingCalendarFrom').val()).format('M-D');
    var glampingCalendarTo = moment(jQuery('#glampingCalendarTo').val()).format('M-D');

    console.log(glampingCalendarFrom);
    console.log(glampingCalendarTo);

    var htmlString = "<th style='text-align:center; position:sticky; top:0; background-color:rgb(233, 236, 239); z-index:100;'></th>";
    var columns = 0;

    for(var checkin = glampingCalendarFrom; checkin <= moment(glampingCalendarTo).format('D'); checkin++){
        htmlString += "<td style='text-align:center; position:sticky; top:0; background-color:rgb(233, 236, 239);' scope='col' colspan='2'>"+checkin;
        htmlString += moment(checkin).format('D') + "<hr class='py-0 my-0'>" + moment(checkin).format('M j') + "</td>";
        columns++;
    }

    var unitNumbers = new Array();
    
    for(var count = 0; count < dates.length; count++) {
        if(jQuery.inArray(dates[count].unitNumber, unitNumbers)) {
            unitNumbers.push(dates[count].unitNumber);
            console.log('Hit');
        } else {            
        }
    }

    var bodyString = "";

    for(var index = 0; index < unitNumbers.length; index++) {
        bodyString += "<tr>";
        bodyString += "<td>"+unitNumbers[index]+"</td>";
        for(var columnCount = 0; columnCount < columns; columnCount++) {
            bodyString += "<td></td>";
        }
        bodyString += "</tr>";
    }

    jQuery('#glampingCalendarBody').html(bodyString);
    jQuery('#glampingCalendarHead').html(htmlString);
}*/

/*View guest details highlight*/
jQuery('.guestChargesRows').hover(
    function(){
        var id = jQuery(this).attr('id');

        console.log(jQuery('.guestChargesRows').length);
        for(var index = 0; index < jQuery('.guestChargesRows').length; index++) {
            jQuery('.guestChargesRows').eq(index).css('background-color', 'white');
            //jQuery('.guestChargesRows').eq(index).css('font-weight', '100');
        }

        
        for(var index = 0; index < jQuery('.guestPaymentsRows').length; index++) {
            jQuery('.guestPaymentsRows').eq(index).css('background-color', 'white');
            //jQuery('.guestPaymentsRows').eq(index).css('font-weight', '100');
        }

        jQuery(this).css('background-color', '#c2ffde');
        jQuery('.'+id).css('background-color', '#c2ffde');

        //jQuery(this).css('font-weight', '600');
        //jQuery('.'+id).css('font-weight', '600');
        //c2ffde
    },
    function() {        
        var id = jQuery(this).attr('id');
        
        jQuery(this).css('background-color', 'white');
        jQuery('.'+id).css('background-color', 'white');
    }
);