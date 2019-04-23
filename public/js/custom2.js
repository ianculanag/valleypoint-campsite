jQuery(document).ready(function(){
    jQuery('#additionalbed').click(function(){
        var bunkNumber = jQuery('.numBunks').attr('id').slice(17);
        //alert(bunkNumber);
        var counter = null; 
        console.log("Gumana");
        var htmlString ="";
        
        //htmlString += "<div class='form-group row'>";
        htmlString +="<div class='col-md-3 mb-1'>";
        //htmlString +="<label for='unitID'> No. of bunk/s</label>";
        htmlString +="<div class='input-group'>";
        htmlString +="<div class='input-group-prepend2'>";
        htmlString +="<span class='input-group-text' name='WAWITS'>";
        htmlString +="<i class='fa fa-bed' id='icon' aria-hidden='true'></i>";
        htmlString +="</span>";
        htmlString +="</div>";
        htmlString +="<input class='form-control' type='number' id='numberOfBunks"+bunkNumber+"' name='numberOfBunks"+bunkNumber+"' required placeholder='' value='1' min='1' max='10'>";
        htmlString +="</div>";
        htmlString +="</div>";
        htmlString +="<div class='col-md-7 mb-1'>";
        //htmlString +="<label for='roomNumber'>Room/s</label>";
        htmlString +="<input type='text' name='roomNumber"+bunkNumber+"' class='form-control' id='rooms"+bunkNumber+"'>";
        htmlString +="</div>";
        htmlString += "<div id='divButton'>"
        htmlString += "<div class='input-group ulul'>";
        htmlString += "<button type='button' id='divButton"+bunkNumber+"' value='"+bunkNumber+"' class='btn btn-danger removeBedForm'>";
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
        counter++;
    });
});
var source=["Room1","Room2","Room3","Room4","Room5","Room6","Room7","Room8","Room9"];

jQuery('#room').tokenfield({
    autocomplete: {
        source: source,
        delay: 100
    },
    showAutocompleteOnFocus: false
    });
    jQuery('#tokenfield').on('tokenfield:createtoken', function (event) {
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

    jQuery('#room').on('tokenfield:createdtoken', function (e){
        console.log(e.attrs.value);
        addRowBunks(e.attrs.value);
    })
//})
function addRowBunks(bunkNumber){
    var htmlString ="";
        //htmlString += "<div class='form-group row'>";
        htmlString +="<div class='col-md-3 mb-1'>";
        //htmlString +="<label for='unitID'> No. of bunk/s</label>";
        htmlString +="<div class='input-group'>";
        htmlString +="<div class='input-group-prepend2'>";
        htmlString +="<span class='input-group-text' name='WAWITS'>";
        htmlString +="<i class='fa fa-bed' id='icon' aria-hidden='true'></i>";
        htmlString +="</span>";
        htmlString +="</div>";
        htmlString +="<input class='form-control' type='number' id='numberOfBunks"+bunkNumber+"' name='numberOfBunks"+bunkNumber+"' required placeholder='' value='1' min='1' max='10'>";
        htmlString +="</div>";
        htmlString +="</div>";
        htmlString +="<div class='col-md-7 mb-1'>";
        //htmlString +="<label for='roomNumber'>Room/s</label>";
        htmlString +="<input='text' name='roomNumber"+bunkNumber+"' class='form-control' id='rooms"+bunkNumber+"'>";
        htmlString +="</div>";
        htmlString += "<div id='divButton'>"
        htmlString += "<div class='input-group ulul'>";
        htmlString += "<button type='button' id='divButton"+bunkNumber+"' value='"+bunkNumber+"' class='btn btn-danger removeBedForm'>";
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
}

//Remove bunks
jQuery(document).on('click', '.removeBedForm', function(){

    var id = jQuery('.numBunks').attr('id').slice(17);
    var numberOfBunks='#numberOfBunks'+id;
    var roomNumber='#rooms'+id;
    var divButton='#divButton'+id;
    


    jQuery(numberOfBunks).remove();
    jQuery(roomNumber).remove();
    jQuery(divButton).remove();
    jQuery('.input-group-prepend2').remove();

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
    jQuery(document).on('change','.numberOfPaxbackpacker', function(){
        var unitNumber = jQuery(this).attr('id').slice(4);
        var roomPriceTotal = null;
        var quantity = jQuery(this).val();
        roomPriceTotal = jQuery(this).val() * 750;
        
        
        jQuery('#invoiceQuantityRoom'+unitNumber).html(quantity);
        jQuery('#invoiceTotalPriceRoom'+unitNumber).html(roomPriceTotal);

        var grandTotal= roomPriceTotal;
        jQuery('#invoiceGrandTotal').html(grandTotal);

        var daysDiff = null;
        var checkinDate = '#checkinDateRoom'+unitNumber+'-1';
        var checkoutDate = '#checkoutDateRoom'+unitNumber+'-1';
        
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
    jQuery(document).on('change','.checkoutDatesbackpacker', function(){
        var unitNumber = jQuery('.numberOfPaxBackpacker').attr('id').slice(4);
        var roomPriceTotal = null;
        var quantity = jQuery('.numberOfPaxBackpacker').val();
        roomPriceTotal = jQuery('.numberOfPaxBackpacker').val() * 750;

        jQuery('#invoiceQuantityRoom'+unitNumber).html(quantity);
        jQuery('#invoiceTotalPriceRoom'+unitNumber).html(roomPriceTotal);

        var grandTotal = roomPriceTotal;
        jQuery('#invoiceGrandTotal').html(grandTotal);

        var daysDiff = null;
        var checkinDate = '#checkinDateRoom'+unitNumber+'-1';
        var checkoutDate = '#checkoutDateRoom'+unitNumber+'-1';

        console.log(checkinDate+ ',' +checkoutDate);
        
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
    jQuery(document).on('change', '.numberOfPaxbackpacker', function(){
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
