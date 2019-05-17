<<<<<<< HEAD
jQuery(document).ready(function() {
    jQuery(document).on('click', '.menu-item', function() {
        jQuery('.menu-item').css('background-color', 'white');
        jQuery(this).css('background-color', 'rgb(119, 232, 255)');

        getFoodItem(jQuery(this).attr('id'));
        jQuery('#addItemButton').attr('disabled', false);
    });

    jQuery('#itemQuantity').change(function() {
        updateItemPrice();
    })

    jQuery('#addItemButton').click(function() {
        showItemAddedMessage();
        addRowInOrderSlip();        
        addOrderEntry(); //adds the order as hidden input

        removeItemEntries();
    })

    jQuery('.makeorder').click(function() {
        removeItemEntries();
        
        var productCategory = jQuery(this).attr('id');
        var htmlString = "";

        jQuery.get('/view-menu/' + productCategory, function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString += "<a class='px-1 mx-1'>";
                    htmlString += "<div class='menu-item card px-0 mx-1' style='width:9.3rem; height:5em; cursor:pointer;' id='" + data[index].id + "'>";
                    htmlString += "<div class='card-body text-center my-auto'>";
                    htmlString += "<h6 class='card-text'>" + data[index].productName + "</h6></div> </div> </a>";
                    jQuery('#menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery(this).addClass('active');
    })
=======
jQuery(document).ready(function () {
	jQuery(document).on('click', '.menu-item', function () {
		jQuery('.menu-item').css('background-color', 'white');
		jQuery(this).css('background-color', 'rgb(119, 232, 255)');

		getFoodItem(jQuery(this).attr('id'));
		jQuery('#addItemButton').attr('disabled', false);
	});

	jQuery('#itemQuantity').change(function () {
		updateItemPrice();
	})

	jQuery('#addItemButton').click(function () {
		showItemAddedMessage();
		addRowInOrderSlip();
		addOrderEntry(); //adds the order as hidden input

		removeItemEntries();
	})

	jQuery('.makeorder').click(function () {
		removeItemEntries();

		var productCategory = jQuery(this).attr('id');
		var htmlString = "";

		jQuery.get('/view-menu/' + productCategory, function (data) {
			if (data.length > 0) {
				for (var index = 0; index < data.length; index++) {
					htmlString += "<a class='px-1 mx-1'>";
					htmlString += "<div class='menu-item card px-0 mx-1' style='width:9.3rem; height:5em; cursor:pointer;' id='" + data[index].id + "'>";
					htmlString += "<div class='card-body text-center px-2 py-2 mx-0'>";
					htmlString += "<h6 class='card-text'>" + data[index].productName + "</h6></div> </div> </a>";
					jQuery('#menu').html(htmlString);
				}
			} else {
				htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
				jQuery('#menu').html(htmlString);
			}
		})
		jQuery('.makeorder').removeClass('active');
		jQuery(this).addClass('active');
	})
>>>>>>> unfinished alert warning for removing an item
});

function addOrderEntry() {
	htmlString = "";

	orderIdentifier = jQuery('#numberOfOrders').val();

	htmlString += "<div id='itemOrderDiv" + orderIdentifier + "'>";
	htmlString += "<input type='number' value='" + jQuery('#itemID').val() + "' id='productID" + orderIdentifier + "' name='productID" + orderIdentifier + "'>";
	htmlString += "<input type='number' value='" + jQuery('#itemQuantity').val() + "' id='quantity" + orderIdentifier + "' name='quantity" + orderIdentifier + "'>";
	htmlString += "<input type='number' value='" + jQuery('#itemTotalPrice').val() + "' id='productID" + orderIdentifier + "' name='totalPrice" + orderIdentifier + "'>";
	htmlString += "</div>"

	jQuery('#ordersContainer').append(htmlString);
}

function showItemAddedMessage() {
	var translator = new T2W("EN_US");
	jQuery('#snackbar').html('Order of ' + translator.toWords(parseInt(jQuery('#itemQuantity').val())) + ' (' + jQuery('#itemQuantity').val() + ') ' + jQuery('#itemDescription').val() + ' added!');
	var x = document.getElementById("snackbar");
	x.className = "show";
	setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
}

function removeItemEntries() {
	jQuery('#itemID').val('');
	jQuery('#itemDescription').val('');
	jQuery('#itemQuantity').val(1);
	jQuery('#itemUnitPrice').val('');
	jQuery('#itemTotalPrice').val('');
	jQuery('.menu-item').css('background-color', 'white');
	jQuery('#addItemButton').attr('disabled', true);
}

function addRowInOrderSlip() {
	newOrderCount = parseInt(jQuery('#numberOfOrders').val()) + 1;
	jQuery('#numberOfOrders').val(newOrderCount);
	orderIdentifier = jQuery('#numberOfOrders').val();

	htmlString = "";

	htmlString += "<tr class='items' id='orderSlipItem" + orderIdentifier + "'>";
	//htmlString += "<a data-toggle='tooltip' title='Click to remove'>";
	htmlString += "<td>" + jQuery('#itemDescription').val() + "</td>";
	//htmlString += "</a>";
	htmlString += "<td style='text-align:right class='orderItemQuantity>" + jQuery('#itemQuantity').val() + "</td>";
	htmlString += "<td style='text-align:right' class='orderItemUnitPrice'>" + parseFloat(jQuery('#itemUnitPrice').val()).toFixed(2) + "</td>";
	htmlString += "<td style='text-align:right' class='orderItemPrice'>" + parseFloat(jQuery('#itemTotalPrice').val()).toFixed(2) + "</td>";
	htmlString += "</tr>";

	jQuery('#emptyEntryHolder').remove();
	jQuery('#orderSlip').append(htmlString);

	updateOrderTotal();
}

function getFoodItem(productID) {
	jQuery.get('/get-product-item/' + productID, function (data) {
		console.log(data);
		jQuery('#itemID').val(data[0].id);
		jQuery('#itemDescription').val(data[0].productName);
		jQuery('#itemUnitPrice').val(data[0].price);
		updateItemPrice();
	})
}

function updateItemPrice() {
	var unitPrice = jQuery('#itemUnitPrice').val();
	var quantity = jQuery('#itemQuantity').val();
	jQuery('#itemTotalPrice').val(unitPrice * quantity);
}

function updateOrderTotal() {
	var totalPrice = 0;

	var prices = document.getElementsByClassName('orderItemPrice');

	for (var index = 0; index < prices.length; index++) {
		totalPrice += parseInt(prices[index].innerHTML);
	}

	document.getElementById('ordersGrandTotal').innerHTML = '';
	jQuery('#ordersGrandTotal').html(parseFloat(totalPrice).toFixed(2));
}

//remove item in the order slip
jQuery(document).ready(function () {
	jQuery(document).on('click', '.items', function () {
		//jQuery(this).remove(); GAC
		jQuery('#orderSlipItem' + jQuery(this).attr('id').slice(13)).remove(); //GAC
		jQuery('#itemOrderDiv' + jQuery(this).attr('id').slice(13)).remove();
		updateOrderTotal();

		//Gac
		if (jQuery('.items').length == 0) {
			htmlString = "";

			htmlString += "<tr id='emptyEntryHolder'>";
			htmlString += "<td style='text-align:center' colspan='4'>Add items from the menu</td>";
			htmlString += "</tr>";

			jQuery('#orderSlip').html(htmlString);
		}
		//end

		alert("You removed" + this);
		console.log(this.attr('class'));
		jQuery(this).remove();
		updateOrderTotal();
	});
});
