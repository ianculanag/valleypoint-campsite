//Validation
//[^a-z. ] all characters inside that bracket are excempted from checking
function validateFirstName() {

    var cursor = jQuery('#firstName').selectionStart,
        allowedCharacters = /[^a-z. ]/gi,
        inputValue = jQuery('#firstName').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#firstName').val(inputValue.replace(allowedCharacters, ''));
        cursor--;
    }
    jQuery('#firstName').setSelectionRange(cursor, cursor);

}

function validateLastName() {
    var cursor = jQuery('#lasttName').selectionStart,
        allowedCharacters = /[^a-z. ]/gi,
        inputValue = jQuery('#lastName').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#lastName').val(inputValue.replace(allowedCharacters, ''));
        cursor--;
    }
    jQuery('#lastName').setSelectionRange(cursor, cursor);
}

function validateNumberofPaxGlamping() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('.numberOfPaxGlamping').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('.numberOfPaxGlamping').val(inputValue.replace(allowedCharacters, ''));
    }
}

function validateContactNumber() {
    var cursor = jQuery('#contactNumber').selectionStart,
        allowedCharacters = /[^0-9]/gi,
        inputValue = jQuery('#contactNumber').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#contactNumber').val(inputValue.replace(allowedCharacters, ''));
        cursor--;
    }
    jQuery('#contactNumber').setSelectionRange(cursor, cursor);
}

function validateAdditionalService() {
    var cursor = jQuery('#additionalServiceNumberOfPax').selectionStart,
        allowedCharacters = /[^0-9]/gi,
        inputValue = jQuery('#additionalServiceNumberOfPax').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#additionalServiceNumberOfPax').val(inputValue.replace(allowedCharacters, ''));
        cursor--;
    }
    jQuery('#additionalServiceNumberOfPax').setSelectionRange(cursor, cursor);
}

function validatePayment() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('#amount').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#amount').val(inputValue.replace(allowedCharacters, ''));
    }

}

function validateNumberofPaxBackpacker() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('.numberOfPaxBackpacker').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('.numberOfPaxBackpacker').val(inputValue.replace(allowedCharacters, ''));
    }
}


jQuery(document).ready(function () {
    jQuery(document).on('input', '#firstName', function () {
        validateFirstName();
    })

    jQuery(document).on('input', '#lastName', function () {
        validateLastName();
    })

    jQuery(document).on('input', '.numberOfPaxGlamping', function () {
        validateNumberofPaxGlamping();
    })

    jQuery(document).on('input', '#contactNumber', function () {
        validateContactNumber();
    })

    jQuery(document).on('input', '#additionalServiceNumberOfPax', function () {
        validateAdditionalService();
    })

    jQuery(document).on('input', '#amount', function () {
        validatePayment();
    })

    jQuery(document).on('input', '.numberOfPaxBackpacker', function () {
        validateNumberofPaxBackpacker();
    })
});