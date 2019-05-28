//Validation

function validateFirstName() {

    var c = jQuery('#firstName').selectionStart,
        restrictedCharacters = /[^a-z0-9]/gi,
        inputValue = jQuery('#firstName').val();

    if (restrictedCharacters.test(inputValue)) {
        jQuery('#firstName').val(inputValue.replace(restrictedCharacters, ''));
        c--;
    }
    jQuery('#firstName').setSelectionRange(c, c);

}

function validateLastName() {
    var c = jQuery('#lasttName').selectionStart,
        restrictedCharacters = /[^a-z0-9]/gi,
        inputValue = jQuery('#lastName').val();

    if (restrictedCharacters.test(inputValue)) {
        jQuery('#lastName').val(inputValue.replace(restrictedCharacters, ''));
        c--;
    }
    jQuery('#lastName').setSelectionRange(c, c);
}


jQuery(document).ready(function () {
    jQuery(document).on('input', '#firstName', function () {
        validateFirstName();
    })

    jQuery(document).on('input', '#lastName', function () {
        validateLastName();
    })

});