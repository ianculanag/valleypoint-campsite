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

	jQuery(document).on('dblclick', '.menu-item', function() {
		showItemAddedMessage();
		addRowInOrderSlip();
		addOrderEntry(); //adds the order as hidden input

		removeItemEntries();
	});

	jQuery('.makeorder').click(function () {
		removeItemEntries();
		jQuery('#searchFoodItem').val('');

		var productCategory = jQuery(this).attr('id');

		displayCategoryItems(productCategory);

		jQuery('.makeorder').removeClass('active');
		jQuery(this).addClass('active');
		
		jQuery('#allProducts').html('All');
	})
});

function displayCategoryItems(productCategory) {	
	var htmlString = "";
	jQuery.get('/view-menu/' + productCategory, function (data) {
		if (data.length > 0) {
			for (var index = 0; index < data.length; index++) {
				htmlString += "<a class='px-1 mx-1'>";
				htmlString += "<div class='menu-item card px-0 mx-1' style='width:9.785rem; height:5.5em; cursor:pointer;' id='" + data[index].id + "'>";
				htmlString += "<div class='card-body text-center pt-2'>";
				htmlString += "<h6 class='card-text'>" + data[index].productName + "</h6>";
				if(checkOrderIsGuest() == true) {
					htmlString += "<p>₱"+numeral(data[index].guestPrice).format('0,0.00')+"</p>";
				} else {
					htmlString += "<p>₱"+numeral(data[index].price).format('0,0.00')+"</p>";
				}
				htmlString += "</div> </div> </a>";
				jQuery('#menu').html(htmlString);
			}
		} else {
			htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
			jQuery('#menu').html(htmlString);
		}
	})
}

function toPeso(valueString) {
	//console.log('₱'+valueString);
	return '₱&nbsp;'+valueString;
}

function addOrderEntry() {
	htmlString = "";

	orderIdentifier = jQuery('#numberOfOrders').val();

	htmlString += "<div id='itemOrderDiv" + orderIdentifier + "'>";
	htmlString += "<input type='number' value='" + jQuery('#itemID').val() + "' id='productID" + orderIdentifier + "' name='productID" + orderIdentifier + "'>";
	htmlString += "<input type='number' value='" + jQuery('#itemQuantity').val() + "' id='quantity" + orderIdentifier + "' name='quantity" + orderIdentifier + "'>";
	htmlString += "<input type='number' value='" + jQuery('#itemTotalPrice').val() + "' id='totalPrice" + orderIdentifier + "' name='totalPrice" + orderIdentifier + "'>";
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
	htmlString += "<td class='orderItemDescription py-2'>" + jQuery('#itemDescription').val() + "</td>";
	htmlString += "<td style='text-align:right' class='orderItemQuantity py-2'>" + jQuery('#itemQuantity').val() + "</td>";
	htmlString += "<td style='text-align:right' class='orderItemUnitPrice py-2'>" + numeral(jQuery('#itemUnitPrice').val()).format('0,0.00') + "</td>";
	htmlString += "<td style='text-align:right' class='orderItemPrice py-2'>" + numeral(jQuery('#itemTotalPrice').val()).format('0,0.00') + "</td>";
	htmlString += "<td style='cursor:pointer;' class='py-2 text-muted removeItem'><span class='fa fa-times-circle'></span></td>";
	htmlString += "</tr>";

	jQuery('#emptyEntryHolder').remove();
	jQuery('#orderSlip').append(htmlString);

	updateOrderSubtotal();
	enableOrderSlipButtons();
}

function getFoodItem(productID) {
	jQuery.get('/get-product-item/' + productID, function (data) {
		//console.log(data);
		jQuery('#itemID').val(data[0].id);
		jQuery('#itemDescription').val(data[0].productName);
		if(checkOrderIsGuest() == true) {
			jQuery('#itemUnitPrice').val(data[0].guestPrice);
		} else {
			jQuery('#itemUnitPrice').val(data[0].price);
		}
		updateItemPrice();
	})
}

function updateItemPrice() {
	var unitPrice = jQuery('#itemUnitPrice').val();
	var quantity = jQuery('#itemQuantity').val();
	jQuery('#itemTotalPrice').val(unitPrice * quantity);
}

function updateOrderSubtotal() {
	var totalPrice = 0;

	var prices = document.getElementsByClassName('orderItemPrice');

	for (var index = 0; index < prices.length; index++) {
		totalPrice += numeral(prices[index].innerHTML).value();
	}

	document.getElementById('ordersSubtotal').innerHTML = '';
	jQuery('#ordersSubtotal').html(toPeso(numeral(totalPrice).format('0,0.00')));

	updateOrderTotal();
}

function updateOrderTotal() {
	var subtotal = numeral(jQuery('#ordersSubtotal').html()).value();
	var discount = numeral(jQuery('#ordersDiscount').html()).value();

	var grandTotal = subtotal - discount;

	jQuery('#ordersGrandTotal').html('');
	jQuery('#ordersGrandTotal').html(toPeso(numeral(grandTotal).format('0,0.00')));

	//hidden totalbill input
	jQuery('#totalBill').val(grandTotal);
	console.log(grandTotal);
}

//remove item in the order slip
jQuery(document).ready(function () {
	jQuery(document).on('click', '.removeItem', function () {
		//jQuery(this).remove(); GAC
		//displayMessage = "Removed "+ translator.toWords(parseInt(jQuery('#itemQuantity'+jQuery(this).parent().attr('id').slice(13)).val())) + ' (' + jQuery('#itemQuantity').val() + ') ' + jQuery('#itemDescription').val() + "successfully";
		displayMessage = 'Item removed successfully.';
		jQuery('#snackbar').html(displayMessage);
		var x = document.getElementById("snackbar");
		x.className = "show";
		setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
		//jQuery(this).remove();

		jQuery('#orderSlipItem' + jQuery(this).parent().attr('id').slice(13)).remove(); //GAC
		jQuery('#itemOrderDiv' + jQuery(this).parent().attr('id').slice(13)).remove();
		updateOrderSubtotal();

		displayEmptyMenu();
		updateOrderSubtotal();
	});

	jQuery(document).on('dblclick', '.items', function() {
		displayMessage = 'Item removed successfully.';
		jQuery('#snackbar').html(displayMessage);
		var x = document.getElementById("snackbar");
		x.className = "show";
		setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
		//jQuery(this).remove();

		jQuery('#orderSlipItem' + jQuery(this).attr('id').slice(13)).remove(); //GAC
		jQuery('#itemOrderDiv' + jQuery(this).attr('id').slice(13)).remove();
		updateOrderSubtotal();

		displayEmptyMenu();
		updateOrderSubtotal();
	});

	//remove with clear button
	jQuery(document).on('click', '#clearItems', function () {
		jQuery('.items').remove();
		updateOrderSubtotal();
		jQuery('#snackbar').html('All items has been removed!');
		var x = document.getElementById("snackbar");
		x.className = "show";
		setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);

		jQuery('#ordersContainer').html('');
		jQuery('#ordersContainer').html('<input id="numberOfOrders" name="numberOfOrders" type="number" value="0"></input>');

		displayEmptyMenu();
	})
});

function displayEmptyMenu() {
	//Gac
	if (jQuery('.items').length == 0) {
		htmlString = "";

		htmlString += "<tr id='emptyEntryHolder'>";
		htmlString += "<td class='py-2' style='text-align:center' colspan='5'>Add items from the menu</td>";
		htmlString += "</tr>";

		jQuery('#orderSlip').html(htmlString);
	}
	//end
	disableOrderSlipButtons();
}

function enableOrderSlipButtons() {
	jQuery('#getPayment').attr('disabled', false);
	jQuery('#saveOrder').attr('disabled', false);
	jQuery('#discountButton').attr('disabled', false);
	jQuery('#clearItems').attr('disabled', false);
}

function disableOrderSlipButtons() {
	jQuery('#getPayment').attr('disabled', true);
	jQuery('#saveOrder').attr('disabled', true);
	jQuery('#discountButton').attr('disabled', true);
	jQuery('#clearItems').attr('disabled', true);
}

jQuery('#discountButton').click(function() {
	jQuery('#amountToPayDiscountPeso').html(jQuery('#ordersGrandTotal').html());
	jQuery('#amountToPayDiscount').html(jQuery('#ordersGrandTotal').html());

	displayDiscountMethod();
	/*OLD DISCOUNT IMPLEMENTATION
	htmlString += "<table class='table table-striped' style='font-size:.88em;'>";
	htmlString += "<thead>";
	htmlString += "<tr>";
	htmlString += "<th scope='col' style='width:30%;'>Description</th>";
	htmlString += "<th scope='col'>Qty.</th>";
	htmlString += "<th scope='col'>Price</th>";
	htmlString += "<th scope='col'>Total</th>";
	htmlString += "<th scope='col'>Discount</th>";
	htmlString += "</tr>";
	htmlString += "</thead>";
	htmlString += "<tbody>";

	for(var index = 0; index < jQuery('.orderItemDescription').length; index++) {
		htmlString += "<tr>";
		htmlString += "<td>" + jQuery('.orderItemDescription').eq(index).html() + "</td>";
		htmlString += "<td style='text-align:right'>" + jQuery('.orderItemQuantity').eq(index).html() + "</td>";
		htmlString += "<td style='text-align:right'>" + jQuery('.orderItemUnitPrice').eq(index).html() + "</td>";
		htmlString += "<td style='text-align:right' class='orderPricesDiscount'>" + jQuery('.orderItemPrice').eq(index).html() + "</td>";
		htmlString += "<td class='input-group input-group-sm pt-2 discountInputs'>";

		htmlString += "<div class='input-group-prepend'>";
		htmlString += "<span class='input-group-text discountIcons'>₱</span>";
		htmlString += "</div>";
		
		htmlString += "<input class='form-control pt-0 orderDiscounts' min='0' placeholder='0' type='number'>";

		htmlString += "</td>";
		
		htmlString += "</tr>";
	}

	htmlString += "</tbody>";

	
	htmlString += "<tfoot>";
	htmlString += "<tr>";
	htmlString += "<th colspan='4'>Total Discount:</th>";
	htmlString += "<th style='text-align:right' id='totalDiscount'>₱&nbsp;0.00</th>";
	htmlString += "</tr>";

	htmlString += "</tfoot>";	
	htmlString += "</table>";*/
})

function displayDiscountMethod() {
	if(jQuery('#discountMethod').prop('checked')) {
		jQuery('#discountRateBody').css('display', 'none');
		jQuery('#discountHelperTable').css('display', 'none');
		jQuery('#discountRatePeso').css('display', '');
	} else {		
		jQuery('#discountRateBody').css('display', '');
		jQuery('#discountHelperTable').css('display', '');
		jQuery('#discountRatePeso').css('display', 'none');
	}
}

jQuery('#discountMethod').change(function() {
	if(jQuery(this).prop('checked')) {
		jQuery('#discountMethodLabel').html('₱');
	} else {		
		jQuery('#discountMethodLabel').html('%');
	}
	displayDiscountMethod();
	jQuery('#totalDiscount').html(toPeso(numeral('0').format('0,0.00')));
	/*if(jQuery(this).prop('checked')) {
		for(var index = 0; index < jQuery('.discountInputs').length; index++) {
			htmlString = "";
			
			htmlString += "<input class='form-control pt-0 orderDiscounts input-group-prepend	' min='0' max='100' placeholder='0' type='number'>";
			
			htmlString += "<div class='input-group-prepend'>";
			htmlString += "<span class='input-group-text discountIcons'>%</span>";
			htmlString += "</div>";

			jQuery('.discountInputs').eq(index).html(htmlString);
		}
	} else {
		for(var index = 0; index < jQuery('.discountInputs').length; index++) {
			htmlString = "";

			htmlString += "<div class='input-group-prepend'>";
			htmlString += "<span class='input-group-text discountIcons'>₱</span>";
			htmlString += "</div>";
			
			htmlString += "<input class='form-control pt-0 orderDiscounts' min='0' placeholder='0' type='number'>";
			
			jQuery('.discountInputs').eq(index).html(htmlString);
		}
	}*/
})

jQuery(document).on('keyup', '#discountRate', function() {
	computeTotalDiscount();
})

jQuery(document).on('change', '#discountRate', function() {
	computeTotalDiscount();
})

jQuery(document).on('keyup', '#numberOfPax', function() {
	computeTotalDiscount();
})

jQuery(document).on('change', '#numberOfPax', function() {
	computeTotalDiscount();
})

jQuery('.discountButtons').click( function() {
	discountValue = numeral(jQuery(this).html()).value()*100;
	jQuery('#discountRate').val(discountValue);
	computeTotalDiscount();
})

function computeTotalDiscount() {
	var totalDiscount = 0;

	if(jQuery('#numberOfPax').val() != '' && jQuery('#discountRate').val() != '') {
		amountToPay = numeral(jQuery('#amountToPayDiscount').html()).value();
		numberOfPax = numeral(jQuery('#numberOfPax').val()).value();
		discountRate = numeral(jQuery('#discountRate').val()).value() / 100;

		totalDiscount = (amountToPay/numberOfPax) * discountRate;

		jQuery('#totalDiscount').html(toPeso(numeral(totalDiscount).format('0,0.00')));
	}
	/* OLD IMPLEMENTATION
	if(jQuery('#discountMethod').prop('checked') == true) {
		for(var index = 0; index < jQuery('.orderDiscounts').length; index++) {
			if(jQuery('.orderDiscounts').eq(index).val()) {
				var totalPrice = numeral(jQuery('.orderPricesDiscount').eq(index).html()).value();
				var discountPercentage = numeral(jQuery('.orderDiscounts').eq(index).val()).value();
				console.log(discountPercentage);

				var discountMultiplier = discountPercentage/100;

				var discountValue = totalPrice*discountMultiplier;

				totalDiscount += numeral(discountValue).value();
			}
		}
	} else {
		for(var index = 0; index < jQuery('.orderDiscounts').length; index++) {
			if(jQuery('.orderDiscounts').eq(index).val()) {
				totalDiscount += parseInt(jQuery('.orderDiscounts').eq(index).val());
			}
		}
	}*/
}

jQuery('#saveDiscountButton').click( function() {
	if(jQuery('#discountMethod').prop('checked') == true) {
		jQuery('#ordersDiscount').html(toPeso(numeral(jQuery('#discountPesoAmount').val()).format('0,0.00')));
		jQuery('#discountAmount').val(numeral(jQuery('#discountPesoAmount').val()).value());
	} else {
		jQuery('#ordersDiscount').html(toPeso(numeral(jQuery('#totalDiscount').html()).format('0,0.00')));
		jQuery('#discountAmount').val(numeral(jQuery('#totalDiscount').html()).value());
	}
	updateOrderTotal();
	//jQuery('#discountMethod').removeAttr('checked', false);
})

jQuery('#discountToAll').click( function() {
	htmlString = "";

	htmlString += "";
	htmlString += "<div class='row'>";
	htmlString += "<div class='form-group row col-md-7'>";
	htmlString += "<label class='col-sm-6 mr-0 pr-0' for='discountAmount'>Amount:</label>";
	htmlString += "<div class='input-group input-group-sm col-sm-6 ml-0 pl-0'>";
	htmlString += "<input id='discountAmount' class='form-control'>";
	htmlString += "</div>";
	htmlString += "</div>";
	htmlString += "<div class='col-md-5 row mb-3'>";
	htmlString += "<button style='width: 3.5em;' class='btn btn-secondary btn-sm mx-1'>5%</button>";
	htmlString += "<button style='width: 3.5em;' class='btn btn-secondary btn-sm mx-1'>10%</button>";
	htmlString += "<button style='width: 3.5em;' class='btn btn-secondary btn-sm mx-1'>20%</button>";
	htmlString += "</div>";
	htmlString += "</div>";
	htmlString += "<table class='table table-borderless'>";	
	htmlString += "<thead>";
	htmlString += "<tr>";
	htmlString += "<th scope='col' style='width:50%;'></th>";
	htmlString += "<th scope='col'></th>";
	htmlString += "</tr>";
	htmlString += "</thead>";
	htmlString += "<tfoot>";
	htmlString += "<tr>";
	htmlString += "<th>Total Discount:</th>";
	htmlString += "<th style='text-align: right'>P0.00</th>";
	htmlString += "</tr>";
	htmlString += "</tfoot>";
	htmlString += "</table>";

	jQuery('#discountModalBody').html(htmlString);
})

jQuery('#orderType').change(function() {
	if(jQuery(this).prop('checked') == true) {
		jQuery('#orderTypeText').html('Checked-in');
	} else {
		jQuery('#orderTypeText').html('Walk-in');
	}
	
	removeItemEntries();
	changePricesDisplay();
})

function checkOrderIsGuest() {
	return jQuery('#orderType').prop('checked');
}

function changePricesDisplay() {
	searchQuery = jQuery('#searchFoodItem').val();
	if(searchQuery == "") {		
		productCategory = jQuery('.makeorder.active').attr('id');
		displayCategoryItems(productCategory);
	} else {
		displaySearchedItems(searchQuery);
	}
}

/**PAYMENTS SA RESTO */

jQuery('#getPayment').click(function() {
	jQuery('#amountToPay').html(jQuery('#ordersGrandTotal').html());
})

jQuery('.cashButtons').click(function() {
	amountTendered = numeral(jQuery('#amountTendered').val()).value();

	amountToAdd = numeral(jQuery(this).html()).value();

	newAmountTendered = amountTendered + amountToAdd;
	jQuery('#amountTendered').val(newAmountTendered);

	computeChange();
})

jQuery('#exactPayment').click(function() {
	jQuery('#amountTendered').val(numeral(jQuery('#amountToPay').html()).value());
	computeChange();
})

jQuery('#clearPayment').click(function() {
	jQuery('#amountTendered').val('');
	jQuery('#changeToGive').html('₱&nbsp;0.00');
})

function computeChange() {	
	amountTendered = numeral(jQuery('#amountTendered').val()).value();
	amountToPay = numeral(jQuery('#amountToPay').html()).value();

	change = amountTendered - amountToPay;
	
	jQuery('#changeToGive').html(toPeso(numeral(change).format('0,0.00')));
}

jQuery('#savePaymentButton').click(function() {
	jQuery('#subtotalRow').css('display', 'none');
	jQuery('#discountRow').css('display', 'none');
	jQuery('#discountButton').attr('disabled', 'true');

	jQuery('#paymentContainer').css('display', '');

	jQuery('#amountTenderedDisplay').html(toPeso(numeral(jQuery('#amountTendered').val()).format('0,0.00')));
	jQuery('#changeDisplay').html(jQuery('#changeToGive').html());

	jQuery('#tenderedAmount').val(jQuery('#amountTendered').val());
	jQuery('#changeDue').val(numeral(jQuery('#changeToGive').html()).value());
})


/** SEARCH */
jQuery('#searchFoodItem').keyup(function() {
	if(jQuery(this).val() == "") {
		displayCategoryItems('allProducts');
		jQuery('#allProducts').html('All');
	} else {
		displaySearchedItems(jQuery(this).val());
	}	
	removeItemEntries();
	
	jQuery('.makeorder').removeClass('active');
	jQuery('#allProducts').addClass('active');
})

function displaySearchedItems(searchQuery) {
	htmlString = "";
	jQuery.get('/search-item/' + searchQuery, function (data) {
		if (data.length > 0) {
			for (var index = 0; index < data.length; index++) {
				htmlString += "<a class='px-1 mx-1'>";
				htmlString += "<div class='menu-item card px-0 mx-1' style='width:9.785rem; height:5.5em; cursor:pointer;' id='" + data[index].id + "'>";
				htmlString += "<div class='card-body text-center pt-2'>";
				htmlString += "<h6 class='card-text'>" + data[index].productName + "</h6>";
				if(checkOrderIsGuest() == true) {
					htmlString += "<p>₱"+numeral(data[index].guestPrice).format('0,0.00')+"</p>";
				} else {
					htmlString += "<p>₱"+numeral(data[index].price).format('0,0.00')+"</p>";
				}
				htmlString += "</div> </div> </a>";
				jQuery('#menu').html(htmlString);
			}
		} else {
			htmlString += "<div class='container'> <p style='font-style:italic;'> No products match the query </p></div>";
			jQuery('#menu').html(htmlString);
		}
	})
	jQuery('#allProducts').html("All 🡒 '"+searchQuery+"'");
}
