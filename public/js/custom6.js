jQuery(document).ready(function(){
    jQuery('.load-backpacker-details').click(function(){
        console.log('gumana');
        jQuery.get('load-backpacker-details/'+$(this).attr('id'), function(data){
            console.log(data);
            var htmlString = "";

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
            jQuery('#modal-header').html(data[0].unitNumber);

            jQuery("#reserve").attr("href", "reserve-backpacker/"+data[0].unitID);

            var checkoutDatetime = moment(data[0].checkoutDatetime).format('L');
            var today = new Date();
            var currentDate = moment(today).format('L');
            
            if(checkoutDatetime == currentDate) {
                jQuery("#checkout").attr("href", "checkout-due-today/"+data[0].unitID);
            } else {
                jQuery("#checkout").attr("href", "checkout/"+data[0].unitID);
            }
        })
    });
}); 

jQuery(document).ready(function(){
    jQuery('.load-backpacker-available-unit').click(function(){
        console.log('gumana');
        jQuery.get('load-backpacker-available-unit/'+$(this).attr('id'), function(data){
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
          
            jQuery("#checkinBackpacker").attr("href", "checkin-backpacker/"+data[0].unitID);
            jQuery("#reserveBackpackerEmpty").attr("href", "reserve-backpacker/"+data[0].unitID);
        })
    });
}); 