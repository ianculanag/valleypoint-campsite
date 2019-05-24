jQuery(document).ready(function () {
	jQuery(document).on('click', '.restaurant-occupied-tables', function () {
        jQuery.get('load-table-order-slip/'+jQuery(this).attr('id'), function(data){
            jQuery('.hidden-elements').show();
            jQuery('#billOut').prop('disabled', false);
            jQuery('#orderTableNumber').val(data[0][0].tableNumber);
            jQuery('#orderQueueNumber').val(data[0][0].queueNumber);

            var htmlString = "";

            for(var index = 0; index < data[1].length; index++) {
                //console.log(index);
                htmlString += "<tr><td class='py-2'>" + data[1][index].productName + "</td>";
                htmlString += "<td class='py-2'>" + data[1][index].quantity + "</td>";
                htmlString += "<td class='py-2'>" + (numeral(data[1][index].price).format('0,0.00')) + "</td>";
                htmlString += "<td class='py-2 orderItemPrice'>" + (numeral(data[1][index].totalPrice).format('0,0.00')) + "</td>";
                htmlString += "<td class='py-2'>" + data[1][index].paymentStatus + "</td></tr>";
                jQuery('#orderSlip').html(htmlString);
            }

            jQuery('#orderID').val(data[1][0].orderID);
            jQuery('#ordersGrandTotal').html('');
            jQuery('#ordersGrandTotal').html(toPeso(numeral(data[1][0].totalBill).format('0,0.00')));

            jQuery('#oldTableNumber').val(data[0][0].tableNumber);
            jQuery('#oldQueueNumber').val(data[0][0].queueNumber);
        })
	})
});

jQuery(document).ready(function () {
	jQuery(document).on('click', '.restaurant-available-tables', function () {
		jQuery.get('load-table/'+jQuery(this).attr('id'), function(data){
			jQuery('.hidden-elements').hide();
			jQuery('#billOut').prop('disabled', true);
			jQuery('#orderTableNumber').val(data[0].id);

			var htmlString = "";
			htmlString += "<tr><td class='py-2 text-center' colspan='5'> No order items to show </td></tr>";

			jQuery('#orderSlip').html(htmlString);
			
			updateOrderTotal();
		})
	})
});

jQuery(document).ready(function () {
	jQuery(document).on('click', '#editTableNumber', function () {
		jQuery('#orderTableNumber').prop('disabled', false);

		htmlString = "";
		htmlString += "<button class='btn btn-sm btn-success update-table-button'><i id='saveTable' class='fa fa-check'></i></button>";

		jQuery('#editTableNumber').html(htmlString);
		jQuery('#editTableNumber').removeClass();
		jQuery('#editTableNumber').addClass('col-sm-2 input-group-addon hidden-elements saveTable px-2 mx-0');
	})
});

jQuery(document).ready(function () {
	jQuery(document).on('click', '#editQueueNumber', function () {
		jQuery('#orderQueueNumber').prop('disabled', false);

		htmlString = "";
		htmlString += "<button class='btn btn-sm btn-success update-queue-button'><i id='saveQueue' class='fa fa-check'></i></button>";

		jQuery('#editQueueNumber').html(htmlString);
		jQuery('#editQueueNumber').removeClass();
		jQuery('#editQueueNumber').addClass('col-sm-2 input-group-addon hidden-elements saveQueue px-2 mx-0');
	})
});

jQuery(document).ready(function () {
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
});

jQuery(document).ready(function () {
	jQuery(document).on('click', '.saveQueue', function () {
		jQuery('#orderQueueNumber').prop('disabled', true); 

		jQuery.get("update-queue-number/" + jQuery('#orderID').val() + "/"  + jQuery('#orderQueueNumber').val() + "/" + jQuery('#oldQueueNumber').val(), function(data) {
		});

		var newQueueNumber = jQuery('#orderQueueNumber').val();
		jQuery('#oldQueueNumber').val(newQueueNumber);

		htmlString = "";
		htmlString += "<i id='editQueue' class='fa fa-pencil-alt' style='color:#3b3f44 !important;'></i>";

		jQuery('#editQueueNumber').html(htmlString);
		jQuery('#editQueueNumber').removeClass();
		jQuery('#editQueueNumber').addClass('col-sm-2 input-group-addon hidden-elements px-3 mx-0');
	})
});

function reloadTableView() {
	//console.log("It worked!");
	jQuery.get("/reload-table-view", function(data) {
		//console.log("It worked again!");
			
		tableCards = "";

		for(var index = 0; index < data.length; index++) {
			console.log("It worked again, again!");
			tableCards += "<a style='cursor:pointer'>";

			if(data[index].status == 'available') {
				tableCards += "<div class='card mx-2 restaurant-available-tables' id='" + data[index].id + "' style='width:12.5rem; height:7em;'>";
			} else if(data[index].status == 'occupied') {
				tableCards += "<div class='card mx-2 restaurant-occupied-tables' id='" + data[index].id + "' style='width:12.5rem; height:7em;'>";
			}

			tableCards += "<div class='card-body'>";
			tableCards += "<h5 class='card-title'>" + data[index].tableNumber;

			if(data[index].status == 'available') {
				tableCards += "<span class='badge badge-info float-right badgeStatus' style='font-size:.55em;'>Available</span></h5>";
			} else if(data[index].status == 'occupied') {
				tableCards += "<span class='badge badge-dark float-right badgeStatus' style='font-size:.55em;'>Occupied</span></h5>";
				tableCards += "<p class='card-text pt-3'> Total bill:";
				tableCards += "<span class='float-right'> ₱" + numeral(data[index].totalBill).format('0, 0.00') + "</span></p>";
			}
			
			tableCards += "</div></div></a>";
		}

		jQuery('#restaurantTableRow').html(tableCards);
	});
}