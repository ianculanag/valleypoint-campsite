jQuery('#guestNameConfirm').keyup(function() {
    if(jQuery(this).val().toLowerCase() == jQuery('#guestLastName').val().toLowerCase() && jQuery('#reasonForVoid').val() != '') {
        jQuery('#confirmVoidTransaction').attr('disabled', false);
    } else {
        jQuery('#confirmVoidTransaction').attr('disabled', true);
    }
})

jQuery('#reasonForVoid').change(function() {
    if(jQuery('#guestNameConfirm').val().toLowerCase() == jQuery('#guestLastName').val().toLowerCase() && jQuery(this).val() != '') {
        jQuery('#confirmVoidTransaction').attr('disabled', false);
    } else {
        jQuery('#confirmVoidTransaction').attr('disabled', true);
    }
})

jQuery('#confirmVoidTransaction').click(function() {
    jQuery( "#voidTransaction" ).submit();
});