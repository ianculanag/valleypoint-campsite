/* Table View */
jQuery(document).ready(function () {
	jQuery(document).on('click', '.restaurant-occupied-tables', function () {
        jQuery.get('load-table-order-slip/'+jQuery(this).attr('id'), function(data){
            jQuery('.hidden-elements').show();
            jQuery('#billOut').prop('disabled', false);
            jQuery('#orderTableNumber').val(data[0][0].tableNumber);
            jQuery('#orderQueueNumber').val(data[0][0].queueNumber);

			var htmlString = "";
			var subTotal = 0;

            for (var index = 0; index < data[1].length; index++) {
                htmlString += "<tr><td class='py-2'>" + data[1][index].productName + "</td>";
				htmlString += "<td class='text-right py-2'>" + data[1][index].quantity + "</td>";

				var unitPrice = data[1][index].totalPrice/data[1][index].quantity;

                htmlString += "<td class='text-right py-2'>" + (numeral(unitPrice).format('0,0.00')) + "</td>";
                htmlString += "<td class='text-right py-2 orderItemPrice'>" + (numeral(data[1][index].totalPrice).format('0,0.00')) + "</td>";
                htmlString += "<td class='py-2'>" + data[1][index].paymentStatus + "</td></tr>";
				jQuery('#orderSlip').html(htmlString);
				
				subTotal += data[1][index].totalPrice;
            }

			jQuery('#orderID').val(data[1][0].orderID);
			
			jQuery('#ordersGrandTotal').html(toPeso(numeral(data[1][0].totalBill).format('0,0.00')));
			jQuery('#ordersSubtotal').html(toPeso(numeral(subTotal).format('0,0.00')));
			jQuery('#ordersDiscount').html(toPeso(numeral(data[1][0].discountAmount).format('0,0.00')));

            jQuery('#oldTableNumber').val(data[0][0].tableNumber);
			
			var billOutLink = "<a href='/bill-out/"+data[1][0].orderID+"' style='text-decoration:none;color:white'></a>";

			jQuery('#billOut').wrap(billOutLink);

			var addOrderLink = "<a href='/add-order/"+data[1][0].orderID+"' style='text-decoration:none;color:white'></a>";

			jQuery('#addOrder').wrap(addOrderLink);
        })
	})

	jQuery(document).on('click', '.restaurant-available-tables', function () {
		jQuery.get('load-table/'+jQuery(this).attr('id'), function(data){
			jQuery('.hidden-elements').hide();
			jQuery('#billOut').prop('disabled', true);
			jQuery('#orderTableNumber').val(data[0].id);

			var htmlString = "";
			htmlString += "<tr><td class='py-2 text-center' colspan='5'> No order items to show </td></tr>";

			jQuery('#orderSlip').html(htmlString);

			jQuery('#ordersGrandTotal').html('₱&nbsp;0.00');
			jQuery('#ordersSubtotal').html('₱&nbsp;0.00');
			jQuery('#ordersDiscount').html('₱&nbsp;0.00');
		})

		var addOrderLink = "<a href='/create-order' style='text-decoration:none;color:white'></a>";
		jQuery('#addOrder').wrap(addOrderLink);
	})
	
	jQuery(document).on('click', '#editTableNumber', function () {
		jQuery('#orderTableNumber').prop('disabled', false);

		htmlString = "";
		htmlString += "<button class='btn btn-sm btn-success update-table-button'><i id='saveTable' class='fa fa-check'></i></button>";

		jQuery('#editTableNumber').html(htmlString);
		jQuery('#editTableNumber').removeClass();
		jQuery('#editTableNumber').addClass('col-sm-2 input-group-addon hidden-elements saveTable px-2 mx-0');
	})
	
	jQuery(document).on('click', '#editQueueNumber', function () {
		jQuery('#orderQueueNumber').prop('disabled', false);

		htmlString = "";
		htmlString += "<button class='btn btn-sm btn-success update-queue-button'><i id='saveQueue' class='fa fa-check'></i></button>";

		jQuery('#editQueueNumber').html(htmlString);
		jQuery('#editQueueNumber').removeClass();
		jQuery('#editQueueNumber').addClass('col-sm-2 input-group-addon hidden-elements saveQueue px-2 mx-0');
	})
	
	jQuery(document).on('click', '.saveTable', function () {
		jQuery('#orderTableNumber').prop('disabled', true);

		jQuery.get("update-table-number/" + jQuery('#orderID').val() + "/"  + jQuery('#orderTableNumber').val() + "/" + jQuery('#oldTableNumber').val(), function(data) {
			reloadTableView();
		});

		var newTableNumber = jQuery('#orderTableNumber').val();
		jQuery('#oldTableNumber').val(newTableNumber);

		htmlString = "";
		htmlString += "<i id='editTable' class='fa fa-pencil-alt' style='color:#3b3f44 !important;'></i>";

		jQuery('#editTableNumber').html(htmlString);
		jQuery('#editTableNumber').removeClass();
		jQuery('#editTableNumber').addClass('col-sm-2 input-group-addon hidden-elements px-3 mx-0');
	})
	
	jQuery(document).on('click', '.saveQueue', function () {
		jQuery('#orderQueueNumber').prop('disabled', true); 

		jQuery.get("update-queue-number/" + jQuery('#orderID').val() + "/"  + jQuery('#orderQueueNumber').val(), function(data) {
		});

		htmlString = "";
		htmlString += "<i id='editQueue' class='fa fa-pencil-alt' style='color:#3b3f44 !important;'></i>";

		jQuery('#editQueueNumber').html(htmlString);
		jQuery('#editQueueNumber').removeClass();
		jQuery('#editQueueNumber').addClass('col-sm-2 input-group-addon hidden-elements px-3 mx-0');
	})
});

function reloadTableView() {
	jQuery.get("/reload-table-view", function(data) {
			
		tableCards = "";

		for (var index = 0; index < data.length; index++) {
			tableCards += "<a style='cursor:pointer'>";

			if (data[index].status == 'available') {
				tableCards += "<div class='card mx-2 restaurant-available-tables' id='" + data[index].id + "' style='width:12.5rem; height:7em;'>";
			} else if (data[index].status == 'occupied') {
				tableCards += "<div class='card mx-2 restaurant-occupied-tables' id='" + data[index].id + "' style='width:12.5rem; height:7em;'>";
			}

			tableCards += "<div class='card-body'>";
			tableCards += "<h5 class='card-title'>" + data[index].tableNumber;

			if (data[index].status == 'available') {
				tableCards += "<span class='badge badge-info float-right badgeStatus' style='font-size:.55em;'>Available</span></h5>";
			} else if (data[index].status == 'occupied') {
				tableCards += "<span class='badge badge-dark float-right badgeStatus' style='font-size:.55em;'>Occupied</span></h5>";
				tableCards += "<p class='card-text pt-3'> Total bill:";
				tableCards += "<span class='float-right'> ₱" + numeral(data[index].totalBill).format('0, 0.00') + "</span></p>";
			}
			
			tableCards += "</div></div></a>";
		}

		jQuery('#restaurantTableRow').html(tableCards);
	});
}

/* View Order Slips */
jQuery(document).ready(function () {
	jQuery(document).on('click', '.edit-table-number', function () {

		var id = jQuery(this).attr('id').split('-');
        var orderID = id[1];
		jQuery('#tableNumber' + orderID).prop('disabled', false);
  
		htmlString = "";
		htmlString += "<button class='btn btn-sm btn-success update-table-button'><i id='saveTable-" + orderID + "' class='fa fa-check'></i></button>";

		jQuery('#editTableNumber-' + orderID).html(htmlString);
		jQuery('#editTableNumber-' + orderID).removeClass();
		jQuery('#editTableNumber-' + orderID).addClass('col-sm-2 input-group-addon save-table px-2 mx-0');
	})
	
	jQuery(document).on('click', '.edit-queue-number', function () {

		var id = jQuery(this).attr('id').split('-');
        var orderID = id[1];
		jQuery('#queueNumber' + orderID).prop('disabled', false);

		htmlString = "";
		htmlString += "<button class='btn btn-sm btn-success update-queue-button'><i id='saveQueue-" + orderID + "' class='fa fa-check'></i></button>";

		jQuery('#editQueueNumber-' + orderID).html(htmlString);
		jQuery('#editQueueNumber-' + orderID).removeClass();
		jQuery('#editQueueNumber-' + orderID).addClass('col-sm-2 input-group-addon save-queue px-2 mx-0');
	})
	
	jQuery(document).on('click', '.save-table', function () {

		var id = jQuery(this).attr('id').split('-');
        var orderID = id[1];
		jQuery('#tableNumber' + orderID).prop('disabled', true);

		jQuery.get("update-table-number/" + orderID + "/"  + jQuery('#tableNumber' + orderID).val() + "/" + jQuery('#oldTableNumber' + orderID).val(), function(data) {
		});

		var newTableNumber = jQuery('#orderTableNumber' + orderID).val();
		jQuery('#oldTableNumber' + orderID).val(newTableNumber);

		htmlString = "";
		htmlString += "<i id='editTable-" + orderID + "' class='fa fa-pencil-alt' style='color:#3b3f44 !important;'></i>";

		jQuery('#editTableNumber-' + orderID).html(htmlString);
		jQuery('#editTableNumber-' + orderID).removeClass();
		jQuery('#editTableNumber-' + orderID).addClass('col-sm-2 input-group-addon px-3 mx-0');
	})
	
	jQuery(document).on('click', '.save-queue', function () {

		var id = jQuery(this).attr('id').split('-');
		var orderID = id[1];
		jQuery('#queueNumber' + orderID).prop('disabled', true); 

		jQuery.get("update-queue-number/"  + orderID + "/"  + jQuery('#queueNumber' + orderID).val(), function(data) {
		});

		htmlString = "";
		htmlString += "<i id='editQueue-" + orderID + "' class='fa fa-pencil-alt' style='color:#3b3f44 !important;'></i>";

		jQuery('#editQueueNumber-' + orderID).html(htmlString);
		jQuery('#editQueueNumber-' + orderID).removeClass();
		jQuery('#editQueueNumber-' + orderID).addClass('col-sm-2 input-group-addon px-3 mx-0');
	})
});