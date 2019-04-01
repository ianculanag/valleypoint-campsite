jQuery(document).ready(function(){
    jQuery('#additionalbed').click(function(){
        console.log("Gumana");
        var htmlString ="";
        //htmlString += "<div class='form-group row'";
        htmlString +="<div class='col-md-3 mb-1'>";
        //htmlString +="<label for='unitID'> No. of bunk/s</label>";
        htmlString +="<div class='input-group'>";
        htmlString +="<div class='input-group-prepend'>";
        htmlString +="<span class='input-group-text'>";
        htmlString +="<i class='fa fa-bed' aria-hidden='true'></i>";
        htmlString +="</span>";
        htmlString +="</div>";
        htmlString +="<input class='form-control' type='number' id='numberOfBunks' name='numberOfBunks' required placeholder'' value='1' min='1' max='20'>";
        htmlString +="</div>";
        htmlString +="</div>";
        htmlString +="<div class='col-md-6 mb-1'>";
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
        htmlString += "<button type='button' id='' value='' class='btn btn-danger'>";
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

//Price depending on the numberOfPaxBackpacker
jQuery(document).ready(function(){
    jQuery('#PaxBackpacker').change(function(){
        //alert(jQuery(this).val());
        var roomPriceTotal = null;
        var quantity = jQuery(this).val();
        roomPriceTotal = jQuery(this).val() * 750;
        jQuery('#invoiceQuantityRoom'+unitNumber).html(quantity);
        jQuery('#invoiceTotalPriceRoom'+unitNumber).html(roomPriceTotal);

        var grandTotal= roomPriceTotal;
        jQuery('#invoiceGrandTotal').html(grandTotal);

    });
});

/*
jQuery(document).ready(function(){
    jQuery('.load-Backpacker-details').click(function(){
        jQuery.get('loadBackpackerDetails/');
    });
});
*/
