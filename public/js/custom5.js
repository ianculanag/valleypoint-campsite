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
          
            jQuery("#checkinMain").attr("href", "checkin/"+data[0].unitID+"/"+date);
            jQuery("#reserveEmpty").attr("href", "reserve-glamping/"+data[0].unitID+"/"+date);
            //jQuery("#checkin-backpacker").attr("href", "checkin-backpacker/"+data[0].unitID);
            //jQuery("#reserveBackpackerEmpty").attr("href", "reserve-backpacker/"+data[0].unitID);
        })
    });
});