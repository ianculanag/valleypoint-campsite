jQuery(document).ready(function(){
    jQuery('.load-backpacker-details').click(function(){
        console.log('gumana');
        jQuery.get('load-backpacker-details/'+$(this).attr('id'), function(data){
            console.log(data);
            
            var today = new Date();
            var currentDate = moment(today).format('L');
            var numberAccommodation = 0;
            var numberReservation = 0;
            var capacity = data[0].capacity;
            var occupied = 0;
            var remaining = 0;
            var htmlString = "";
            var footer = "";

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

            //console.log(1);
            var firstCheckinDatetime = moment(data[0].checkinDatetime).format('L');
            var firstCheckoutDatetime = moment(data[0].checkoutDatetime).format('L');

            if(firstCheckinDatetime <= currentDate && firstCheckoutDatetime >= currentDate) {
                for(var index = 0; index < data.length; index++) {
                    if(data[index].accommodationID) {
                        numberAccommodation++;
                        var checkinDatetime = moment(data[index].checkinDatetime).format('L');
                        var checkoutDatetime = moment(data[index].checkoutDatetime).format('L');
                        if(checkinDatetime <= currentDate && checkoutDatetime >= currentDate) {
                            occupied += data[index].numberOfPax;
                            //console.log(2);
                            htmlString += "<div class='container'>";
                            htmlString += "<table class='table table-sm borderless'>";
                            htmlString += "<tr><td rowspan='6' style='font-weight:bold; width:7%'>" + numberAccommodation + "</td>";
                            htmlString += "<tr><td style='width:30%'> Guest Name: </td>";
                            htmlString += "<td>" + data[index].firstName + " " + data[index].lastName + "</td></tr>";
                            htmlString += "<tr><td style='width:30%'> Beds: </td>";
                            htmlString += "<td>" + data[index].numberOfBunks + "</td></tr>";
                            htmlString += "<tr><td>Checked-in: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].checkinDatetime).format('LLLL') + "</td></tr>";
                            htmlString += "<tr><td>Check-out: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].checkoutDatetime).format('LLLL') + "</td></tr>";
   
                            if(checkoutDatetime == currentDate) {
                                htmlString += "<tr><td class='pt-3'f colspan='2'><a href='checkout-backpacker-due-today/"+data[index].unitID+"' id='checkoutBackpacker'><button type='button' class='btn btn-secondary' style='float:right'>Check-out</button></a>";
                                htmlString += "<a href='edit-backpacker-details/"+data[index].unitID+"/"+data[index].accommodationID+"' id='editDetails'><button type='button' class='btn btn-info mx-2' style='float:right'>View Details</button></a></td></tr></table></div>";    
                                //jQuery("#checkoutBackpacker").attr("href", "checkout-backpacker-due-today/"+data[index].unitID);
                            } else {
                                htmlString += "<tr><td class='pt-3'f colspan='2'><a href='checkout-backpacker/"+data[index].unitID+"' id='checkoutBackpacker'><button type='button' class='btn btn-secondary' style='float:right'>Check-out</button></a>";
                                htmlString += "<a href='edit-backpacker-details/"+data[index].unitID+"/"+data[index].accommodationID+"' id='editDetails'><button type='button' class='btn btn-info mx-2' style='float:right'>View Details</button></a></td></tr></table></div>";    
                                //jQuery("#checkoutBackpacker").attr("href", "checkout-backpacker/"+data[index].unitID);
                            } 
                        }
                    }
                }
            }      

            var firstReservationCheckinDatetime = moment(data[0].reservationCheckinDatetime).format('L');

            if(firstReservationCheckinDatetime == currentDate) {
                htmlString += "<hr><h5 class='text-center'> Checks-in today </h5>";
                for(var index = 0; index < data.length; index++) {
                    if(data[index].accommodationID) {
                        var reservationCheckinDatetime = moment(data[index].reservationCheckinDatetime).format('L');
                        if(reservationCheckinDatetime == currentDate) {         
                            numberReservation++;
                            console.log('OH YEA');
                            htmlString += "<div class='container'>";
                            htmlString += "<table class='table table-sm borderless'>";
                            htmlString += "<tr><td rowspan='4' style='font-weight:bold; width:7%'>" + numberReservation + "</td>";
                            htmlString += "<td style='width:30%'>Guest name: </td>";
                            htmlString += "<td>" + data[index].reservationFirstName + " " + data[index].reservationLastName + "</td></tr>";
                            htmlString += "<tr><td style='width:30%'> Beds: </td>";
                            htmlString += "<td>" + data[index].reservationNumberOfBunks + "</td></tr>";
                            htmlString += "<tr><td>Check-in: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].reservationCheckinDatetime).format('LLLL') + "</td></tr>";
                            htmlString += "<tr><td>Check-out: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].reservationCheckoutDatetime).format('LLLL') + "</td></tr>";
                            htmlString += "<tr><td class='pt-3' colspan='3'><a href='/view-reservation-details/"+data[index].unitID+"/"+data[index].reservationID+"' id='editResrvationDetails'><button type='button' class='btn btn-info' style='float:right'>View Details</button></a>";
                            htmlString += "<a href='/checkin-backpacker/"+data[index].unitID+"/"+data[index].reservationID+"' id='checkin'><button type='button' class='btn btn-success mx-2' style='float:right'>Check-in</button></a></td></tr></table></div>"
                        }
                    }
                }
            }

            remaining = capacity - occupied;
            console.log(remaining == 0);
            if(remaining == 0) {
                footer += "<a href='' id='reserve'><button type='button' class='btn btn-success'>Add Reservation</button></a>";
            } else {
                footer += "<a href='' id='addCheckin'><button type='button' class='btn btn-primary'>Check-in</button></a>";
                footer += "<a href='' id='reserve'><button type='button' class='btn btn-secondary'>Add Reservation</button></a>";
            }

            jQuery('#availableRoomModalFooter').html(footer);
            jQuery('#modal-body').html(htmlString);
            jQuery('#modal-header').html(data[0].unitNumber);
            
            jQuery("#addCheckin").attr("href", "checkin-backpacker/"+data[0].unitID);
            jQuery("#reserve").attr("href", "reserve-backpacker/"+data[0].unitID);
        })
    });
}); 

jQuery(document).ready(function(){
    jQuery('.load-backpacker-available-unit').click(function(){
        console.log('gumana');
        jQuery.get('load-backpacker-available-unit/'+$(this).attr('id'), function(data){
            console.log(data);
            var htmlString = "";
            number = 0;
            var today = new Date();
            var currentDate = moment(today).format('L');

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
                
                var firstCheckinDatetime = moment(data[0].checkinDatetime).format('L');

                if(firstCheckinDatetime == currentDate) {
                    htmlString += "<hr><h5 class='text-center'> Checks-in today </h5>";

                    for(var index = 0; index < data.length; index++) {
                        var checkinDatetime = moment(data[index].checkinDatetime).format('L');
                        if(checkinDatetime == currentDate) {
                            number++;
                            console.log('OH YEA');
                            htmlString += "<div class='container'>";
                            htmlString += "<table class='table table-sm borderless'>";
                            htmlString += "<tr><td rowspan='4' style='font-weight:bold; width:7%'>" + number + "</td>";
                            htmlString += "<td style='width:30%'>Guest name: </td>";
                            htmlString += "<td>" + data[index].firstName + " " + data[index].lastName + "</td></tr>";
                            htmlString += "<tr><td style='width:30%'> Beds: </td>";
                            htmlString += "<td>" + data[index].numberOfBunks + "</td></tr>";
                            htmlString += "<tr><td>Check-in: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].checkinDatetime).format('LLLL') + "</td></tr>";
                            htmlString += "<tr><td>Check-out: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].checkoutDatetime).format('LLLL') + "</td></tr>";
                            htmlString += "<tr><td class='pt-3' colspan='3'><a href='/view-reservation-details/"+data[index].unitID+"/"+data[index].reservationID+"' id='editResrvationDetails'><button type='button' class='btn btn-info' style='float:right'>View Details</button></a>";
                            htmlString += "<a href='/checkin-backpacker/"+data[index].unitID+"/"+data[index].reservationID+"' id='checkin'><button type='button' class='btn btn-success mx-2' style='float:right'>Check-in</button></a></td></tr></table></div>"
                        }
                    }
                } else {
                    number++;

                    htmlString += "<hr><h5 class='text-center'>Reservation</h5>";
                    htmlString += "<div class='container'>";
                    htmlString += "<table class='table table-sm borderless'>";
                    htmlString += "<tr><td rowspan='4' style='font-weight:bold; width:7%'>" + number + "</td>";
                    htmlString += "<td style='width:30%'>Guest name: </td>";
                    htmlString += "<td>" + data[0].firstName + " " + data[0].lastName + "</td></tr>";
                    htmlString += "<tr><td style='width:30%'> Beds: </td>";
                    htmlString += "<td>" + data[0].numberOfBunks + "</td></tr>";
                    htmlString += "<tr><td>Check-in: </td>";
                    htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkinDatetime).format('LLLL') + "</td></tr>";
                    htmlString += "<tr><td>Check-out: </td>";
                    htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[0].checkoutDatetime).format('LLLL') + "</td></tr>";
                    htmlString += "<tr><td class='pt-3' colspan='3'><a href='/view-reservation-details/"+data[0].unitID+"/"+data[0].reservationID+"' id='editResrvationDetails'><button type='button' class='btn btn-info' style='float:right'>View Details</button></a>";
                    htmlString += "<a href='/checkin-backpacker/"+data[0].unitID+"/"+data[0].reservationID+"' id='checkin'><button type='button' class='btn btn-success mx-2' style='float:right'>Check-in</button></a></td></tr></table></div>"
                    
                    for(var index = 1; index < data.length; index++) {    
                        if(data[index].checkinDatetime == data[0].checkinDatetime) {
                            htmlString += "<div class='container'>";
                            htmlString += "<table class='table table-sm borderless'>";
                            htmlString += "<tr><td rowspan='4' style='font-weight:bold; width:7%'>" + number + "</td>";
                            htmlString += "<td style='width:35%'>Guest name: </td>";
                            htmlString += "<td>" + data[index].firstName + " " + data[index].lastName + "</td></tr>";
                            htmlString += "<tr><td style='width:35%'> Beds: </td>";
                            htmlString += "<td>" + data[index].numberOfBunks + "</td></tr>";
                            htmlString += "<tr><td>Check-in: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].checkinDatetime).format('LLLL') + "</td></tr>";
                            htmlString += "<tr><td>Check-out: </td>";
                            htmlString += "<td style='color:green; font-syle:italic;'>" + moment(data[index].checkoutDatetime).format('LLLL') + "</td></tr>";
                            htmlString += "<tr><td class='pt-3' colspan='3'><a href='/view-reservation-details/"+data[index].unitID+"/"+data[index].reservationID+"' id='editResrvationDetails'><button type='button' class='btn btn-info' style='float:right'>View Details</button></a>";
                            htmlString += "<a href='/checkin-backpacker/"+data[index].unitID+"/"+data[index].reservationID+"' id='checkin'><button type='button' class='btn btn-success mx-2' style='float:right'>Check-in</button></a></td></tr></table></div>"        
                        }
                    }
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

            jQuery("#checkinBackpacker").attr("href", "checkin-backpacker/"+data[0].unitID);
            jQuery("#reserveBackpackerEmpty").attr("href", "reserve-backpacker/"+data[0].unitID);
        })
    });
}); 

jQuery(document).ready(function() {
    jQuery("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        jQuery(this).siblings('a.active').removeClass("active");
        jQuery(this).addClass("active");
        var index = jQuery(this).index();
        jQuery("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        jQuery("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});