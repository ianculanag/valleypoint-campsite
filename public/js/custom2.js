jQuery(document).ready(function(){
    jQuery('#additionalbed').click(function(){
        
        var counter = null;
        console.log("Gumana");
        var htmlString ="";
        //htmlString += "<div class='form-group row'>";
        htmlString +="<div class='col-md-3 mb-1'>";
        //htmlString +="<label for='unitID'> No. of bunk/s</label>";
        htmlString +="<div class='input-group'>";
        htmlString +="<div class='input-group-prepend'>";
        htmlString +="<span class='input-group-text'>";
        htmlString +="<i class='fa fa-bed' id='icon' aria-hidden='true'></i>";
        htmlString +="</span>";
        htmlString +="</div>";
        htmlString +="<input class='form-control' type='number' id='numberOfBunks{{$unit->unitNumber}} name='numberOfBunks' required placeholder='' value='1' min='1' max='10'>";
        htmlString +="</div>";
        htmlString +="</div>";
        htmlString +="<div class='col-md-7 mb-1'>";
        //htmlString +="<label for='roomNumber'>Room/s</label>";
        htmlString +="<select name='roomNumber' class='form-control' id='room'>";
        htmlString +="<option value='1'>Room 1 </option>";
        htmlString +="<option value='2'>Room 2 </option>";
        htmlString +="<option value='3'>Room 3 </option>";
        htmlString +="<option value='4'>Room 4 </option>";
        htmlString +="<option value='5'>Room 5 </option>";
        htmlString +="<option value='6'>Room 6 </option>";
        htmlString +="<option value='7'>Room 7 </option>";
        htmlString +="<option value='8'>Room 8 </option>";
        htmlString +="<option value='9'>Room 9 </option>";
        htmlString +="</select>";
        htmlString +="</div>";
        htmlString += "<div id='divButton'>"
        htmlString += "<div class='input-group'>";
        htmlString += "<button type='button' id='divButton' value='' class='btn btn-danger removeBedForm'>";
        htmlString += "<span class='fa fa-minus' aria-hidden='true'></span>";
        htmlString += "</button>";
        htmlString += "</div>";
        htmlString += "</div>";
        //htmlString +="</div>";
        //htmlString +="</div>";
        htmlString +="";
        htmlString +="";
        htmlString +="";


        console.log(htmlString);

        jQuery('#unitDetails').append(htmlString);
    });
});

//Remove bunks
jQuery(document).on('click', '.removeBedForm', function(){

    var id = jQuery(this).attr('id').slice(13);
    var icon='#icon'+id;
    var numberOfBunks='#numberOfBunks'+id;
    var roomNumber='#room'+id;
    var divButton='#divButton'+id;

    jQuery(icon).remove();
    jQuery(numberOfBunks).remove();
    jQuery(roomNumber).remove();
    jQuery(divButton).remove();

    //console.log("Hello");
});

//Price depending on the numberOfPaxBackpacker
jQuery(document).ready(function(){
    /*jQuery('#PaxBackpacker').change(function(){
        //alert(jQuery(this).val());

        //var unitNumber = jQuery(this).attr('id').slice(19);
        var roomPriceTotal = null;
        var quantity = jQuery(this).val();
        roomPriceTotal = jQuery(this).val() * 750;
        jQuery('#invoiceQuantityRoom1').html(quantity);
        jQuery('#invoiceTotalPriceRoom1').html(roomPriceTotal);

        var grandTotal= roomPriceTotal;
        jQuery('#invoiceGrandTotal').html(grandTotal);

    })*/
    jQuery(document).on('change','.numberOfPaxBackpacker', function(){
        var unitNumber = jQuery(this).attr('id').slice(17);
        var roomPriceTotal = null;
        var quantity = jQuery(this).val();
        roomPriceTotal = jQuery(this).val() * 750;
        
        
        jQuery('#invoiceQuantityRoom'+unitNumber).html(quantity);
        jQuery('#invoiceTotalPriceRoom'+unitNumber).html(roomPriceTotal);

        var grandTotal= roomPriceTotal;
        jQuery('#invoiceGrandTotal').html(grandTotal);

        var daysDiff = null;
        var checkinDate = '#checkinDateRoom'+unitNumber;
        var checkoutDate = '#checkoutDateRoom'+unitNumber;
        
        //alert(jQuery(checkoutDate).val());

         //calculation of prices based on how many days   
        if (jQuery(checkoutDate).val() == ""){
                daysDiff = 1;
                jQuery('#invoiceQuantityRoom'+unitNumber).html(jQuery(this).val()+'x'+(daysDiff));
            } else{
                var BackpackerCheckin = Date.parse(jQuery(checkinDate).val());
                var BackpackerCheckout = Date.parse(jQuery(checkoutDate).val());

                var timeDiff = BackpackerCheckout - BackpackerCheckin;
                daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));
                
                jQuery('#invoiceQuantityRoom'+unitNumber).html(jQuery(this).val()+'x'+(daysDiff));

                var finalRoomPrice = roomPriceTotal * daysDiff;

                jQuery('#invoiceTotalPriceRoom'+unitNumber).html(finalRoomPrice);
                
            }
            updateTotal();
    });

});

//On Change date
jQuery(document).ready(function(){
    jQuery(document).on('change','.backpackerCheckoutDates', function(){
        var unitNumber = jQuery(this).attr('id').slice(16);
        var roomPriceTotal = null;
        var quantity = jQuery('.numberOfPaxBackpacker').val();
        
        roomPriceTotal = jQuery('.numberOfPaxBackpacker').val() * 750;
        
        jQuery('#invoiceQuantityRoom'+unitNumber).html(quantity);
        jQuery('#invoiceTotalPriceRoom'+unitNumber).html(roomPriceTotal);

        var grandTotal= roomPriceTotal;
        jQuery('#invoiceGrandTotal').html(grandTotal);

        var daysDiff = null;
        var checkinDate = '#checkinDateRoom'+unitNumber;
        var checkoutDate = '#checkoutDateRoom'+unitNumber;
        
        //alert(jQuery(checkoutDate).val());

         //calculation of prices based on how many days   
        if (jQuery(checkoutDate).val() == ""){
                daysDiff = 1;
                jQuery('#invoiceQuantityRoom'+unitNumber).html(jQuery('.numberOfPaxBackpacker').val()+'x'+(daysDiff));
            } else{
                var BackpackerCheckin = Date.parse(jQuery(checkinDate).val());
                var BackpackerCheckout = Date.parse(jQuery(checkoutDate).val());

                var timeDiff = BackpackerCheckout - BackpackerCheckin;
                daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 *24));
                
                jQuery('#invoiceQuantityRoom'+unitNumber).html(jQuery('.numberOfPaxBackpacker').val()+'x'+(daysDiff));

                var finalRoomPrice = roomPriceTotal * daysDiff;

                jQuery('#invoiceTotalPriceRoom'+unitNumber).html(finalRoomPrice);
                
            }
            updateTotal();
    });

    });

    //numberOfBunks will change depending on numberOfPax
jQuery(document).ready(function(){
    jQuery(document).on('change', '.numberOfPaxBackpacker', function(){
        numOfBunks = jQuery(this).val();

        currentBunks = numOfBunks;
        jQuery('#numberOfBunks').val(numOfBunks);
    });

    //number of bunks cannot exceed number of pax
    jQuery(document).on('change', '#numberOfBunks', function(){
        currentBunks = jQuery(this).val();
        numOfBunks = jQuery('.numberOfPaxBackpacker').val();
        if(jQuery(this).val() > jQuery('.numberOfPaxBackpacker').val()){
            jQuery(this).val(numOfBunks);
        }

    });

});
/*
jQuery(document).ready(function(){
    jQuery('.load-Backpacker-details').click(function(){
        jQuery.get('loadBackpackerDetails/');
    });
});
*/
