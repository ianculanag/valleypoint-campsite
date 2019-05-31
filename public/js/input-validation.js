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

//lodgin validations
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


//pos validations
function validateTableNumber() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('#tableNumber').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#tableNumber').val(inputValue.replace(allowedCharacters, ''));
    }

}

function validateQueueNumber() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('#queueNumber').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#queueNumber').val(inputValue.replace(allowedCharacters, ''));
    }
}

function validateItemQuantity() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('#itemQuantity').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#itemQuantity').val(inputValue.replace(allowedCharacters, ''));
    }
}

function validateAmountTendered() {
    var allowedCharacters = /[^0-9.]/gi;
    inputValue = jQuery('#amountTendered').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#amountTendered').val(inputValue.replace(allowedCharacters, ''));
    }
}

function validateNumberofPaxPos() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('#numberOfPax').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#numberOfPax').val(inputValue.replace(allowedCharacters, ''));
    }
}

function validateDiscountRate() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('#discountRate').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#discountRate').val(inputValue.replace(allowedCharacters, ''));
    }
}

function validateDiscountPesoAmount() {
    var allowedCharacters = /[^0-9]/gi;
    inputValue = jQuery('#discountPesoAmount').val();

    if (allowedCharacters.test(inputValue)) {
        jQuery('#discountPesoAmount').val(inputValue.replace(allowedCharacters, ''));
    }
}


jQuery(document).ready(function () {

    jQuery(document).on('input', '#tableNumber', function () {
        validateTableNumber();
    })

    jQuery(document).on('input', '#queueNumber', function () {
        validateQueueNumber();
    })

    jQuery(document).on('input', '#itemQuantity', function () {
        validateItemQuantity();
    })

    jQuery(document).on('input', '#amountTendered', function () {
        validateAmountTendered();
    })

    jQuery(document).on('input', '#numberOfPax', function () {
        validateNumberofPaxPos();
    })

    jQuery(document).on('input', '#discountRate', function () {
        validateDiscountRate();
    })

    jQuery(document).on('input', '#discountPesoAmount', function () {
        validateDiscountPesoAmount();
    })
})