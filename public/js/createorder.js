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

    htmlString += "<tr class='items'>";
    //htmlString += "<a data-toggle='tooltip' title='Click to remove'>";
    htmlString += "<td>"+jQuery('#itemDescription').val()+"</td>";
    //htmlString += "</a>";
    htmlString += "<td style='text-align:right class='orderItemQuantity>"+jQuery('#itemQuantity').val()+"</td>";
    htmlString += "<td style='text-align:right' class='orderItemUnitPrice'>"+parseFloat(jQuery('#itemUnitPrice').val()).toFixed(2)+"</td>";
    htmlString += "<td style='text-align:right' class='orderItemPrice'>"+parseFloat(jQuery('#itemTotalPrice').val()).toFixed(2)+"</td>";
    htmlString += "</tr>";

    jQuery('#emptyEntryHolder').remove();
    jQuery('#orderSlip').append(htmlString);
    
    updateOrderTotal();
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

function updateOrderTotal(){
    var totalPrice = 0;

    var prices = document.getElementsByClassName('orderItemPrice');

    for(var index = 0; index<prices.length; index++){
        totalPrice += parseInt(prices[index].innerHTML);
    }

    document.getElementById('ordersGrandTotal').innerHTML="";
    jQuery('#ordersGrandTotal').html(parseFloat(totalPrice).toFixed(2));
}

//remove item in the order slip
jQuery(document).ready(function(){
    jQuery(document).on('click', '.items', function(){
        jQuery(this).remove();
        updateOrderTotal();
    });
});