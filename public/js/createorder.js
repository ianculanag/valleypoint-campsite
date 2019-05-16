jQuery(document).ready(function() {
    jQuery(document).on('click', '.menu-item', function() {
        jQuery('.menu-item').css('background-color', 'white');
        jQuery(this).css('background-color', 'rgb(119, 232, 255)');

        getFoodItem(jQuery(this).attr('id'));
    });

    jQuery('#itemQuantity').change(function() {
        updateItemPrice();
    })

    jQuery('#addItemButton').click(function() {
        showItemAddedMessage();
        addRowInOrderSlip();
        removeItemEntries();
    })
});

function showItemAddedMessage() {
    var translator = new T2W("EN_US");
    jQuery('#snackbar').html('Order of '+translator.toWords(parseInt(jQuery('#itemQuantity').val()))+' ('+jQuery('#itemQuantity').val()+') '+jQuery('#itemDescription').val()+' added!');
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }

function removeItemEntries() {    
    jQuery('#itemDescription').val('');
    jQuery('#itemQuantity').val(1);
    jQuery('#itemUnitPrice').val('');
    jQuery('#itemTotalPrice').val('');
    jQuery('.menu-item').css('background-color', 'white');
}

function addRowInOrderSlip() {
    htmlString = "";

    htmlString += "<tr>";
    htmlString += "<td>"+jQuery('#itemDescription').val()+"</td>";
    htmlString += "<td style='text-align:right'>"+jQuery('#itemQuantity').val()+"</td>";
    htmlString += "<td style='text-align:right'>"+parseFloat(jQuery('#itemUnitPrice').val()).toFixed(2)+"</td>";
    htmlString += "<td style='text-align:right'>"+parseFloat(jQuery('#itemTotalPrice').val()).toFixed(2)+"</td>";
    htmlString += "</tr>";

    jQuery('#emptyEntryHolder').remove();
    jQuery('#orderSlip').append(htmlString);
}

function getFoodItem(foodID) {
    jQuery.get('/get-food-item/'+foodID, function(data) {
        console.log(data);
        jQuery('#itemDescription').val(data[0].foodName);
        jQuery('#itemUnitPrice').val(data[0].price);
        updateItemPrice();
    })
}

function updateItemPrice() {
    var unitPrice = jQuery('#itemUnitPrice').val();
    var quantity = jQuery('#itemQuantity').val();
    jQuery('#itemTotalPrice').val(unitPrice * quantity);
}