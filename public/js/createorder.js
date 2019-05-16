jQuery(document).ready(function() {
    jQuery(document).on('click', '.menu-item', function() {
        jQuery('.menu-item').css('background-color', 'white');
        jQuery(this).css('background-color', 'rgb(119, 232, 255)');

        getFoodItem(jQuery(this).attr('id'));
    });

    jQuery('#itemQuantity').change(function() {
        updateItemPrice();
    })
});

function getFoodItem(foodID) {
    jQuery.get('/get-food-item/'+foodID, function(data) {
        console.log(data);
        jQuery('#itemDescription').val(data.foodName);
        jQuery('#itemUnitPrice').val(data.price);
        updateItemPrice();
    })
}

function updateItemPrice() {
    var unitPrice = jQuery('#itemUnitPrice').val();
    var quantity = jQuery('#itemQuantity').val();
    jQuery('#itemTotalPrice').value()
}