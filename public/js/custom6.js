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