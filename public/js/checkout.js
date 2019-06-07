let additionalServices = 0;
jQuery('#additionalServiceFormAddExtra').click(function(){
    jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
        additionalServices++;
        var htmlStringRow = "";

        htmlStringRow += "<tr id='invoiceRow"+additionalServices+"'>";
        htmlStringRow += "<td style='display:none;'><input id='invoiceCheckBox"+additionalServices+"' class='form-check-input invoiceCheckboxes' type='checkbox' checked></td>";
        htmlStringRow += "<td id='invoiceDescription"+additionalServices+"' class='invoiceDescriptions'>"+data[0].serviceName+"</td>";
        htmlStringRow += "<td id='invoiceQuantity"+additionalServices+"' style='text-align:right;' class='invoiceQuantities'>"+jQuery('#additionalServiceNumberOfPax').val()+"</td>";
        htmlStringRow += "<td id='invoiceTotalPrice"+additionalServices+"' style='text-align:right;' class='invoicePrices'>"+numeral(document.getElementsByClassName('additionalServiceTotalPrice')[0].value).format('0,0.00')+"</td>";
        htmlStringRow += "<td id='invoiceTotalBalance"+additionalServices+"' style='text-align:right;' class='invoiceBalances'>"+numeral(document.getElementsByClassName('additionalServiceTotalPrice')[0].value).format('0,0.00')+"</td>";
        htmlStringRow += "</tr>";
        
        jQuery('#invoiceRows').append(htmlStringRow);

        updateTotal();
        updateBalance();

        let htmlString = "";
        htmlString += "<input type='number' style='display:none;float:left;' name='additionalServicesCount' value='"+additionalServices+"'>";
        htmlString += "<input type='text' style='display:none;float:left;' id='additionalServiceID"+additionalServices+"' name='additionalServiceID"+additionalServices+"' value='"+data[0].id+"'>";
        htmlString += "<div class='col-md-3 mb-1' id='divServiceName"+additionalServices+"'>";
        htmlString += "<input class='form-control paxSelect' type='text' name='additionalServiceName"+additionalServices+"' value='"+data[0].serviceName+"' readonly>";
        htmlString += "</div>";
        htmlString += "<div class='col-md-2 mb-1' id='divQuantity"+additionalServices+"'>";
        htmlString += "<input class='form-control paxSelect' type='number' id='additionalServiceNumberOfPax' name='additionalServiceNumberOfPax"+additionalServices+"' value='"+jQuery('#additionalServiceNumberOfPax').val()+"' min='1' max='10' {{--form='serviceForm'--}} readonly>";
        htmlString += "</div>";
        htmlString += "<div class='col-md-3 mb-1' id='divUnitPrice"+additionalServices+"'>";
        htmlString += "<div class='input-group'>";
        htmlString += "<div class='input-group-prepend'>";
        htmlString += "<span class='input-group-text'>₱</span>";
        htmlString += "</div>";
        htmlString += "<input class='form-control additionalServiceUnitPrice' type='text' id='additionalServiceUnitPrice' name='additionalServiceUnitPrice"+additionalServices+"' placeholder='' value='"+document.getElementsByClassName('additionalServiceUnitPrice')[0].value+"' readonly>";
        htmlString += "</div>";
        htmlString += "</div>";
        htmlString += "<div class='col-md-3 mb-1' id='divTotalPrice"+additionalServices+"'>";
        htmlString += "<div class='input-group'>";
        htmlString += "<div class='input-group-prepend'>";
        htmlString += "<span class='input-group-text'>₱</span>";
        htmlString += "</div>";
        htmlString += "<input class='form-control additionalServiceTotalPrice' type='text' id='additionalServiceTotalPrice' name='additionalServiceTotalPrice"+additionalServices+"' placeholder='' value='"+document.getElementsByClassName('additionalServiceTotalPrice')[0].value+"' readonly>";
        htmlString += "</div>";
        htmlString += "</div>";
        htmlString += "<div id='divButton"+additionalServices+"'>";
        htmlString += "<div class='input-group'>";
        htmlString += "<button type='button' id='additionalServiceFormRemove"+additionalServices+"' value='"+additionalServices+"' class='btn btn-danger additionalServiceFormRemove'>";
        htmlString += "<span class='fa fa-minus' aria-hidden='true'></span>";
        htmlString += "</button>";
        htmlString += "</div>";
        htmlString += "</div>";

        jQuery('#divAdditionalServices').append(htmlString);
        jQuery('#serviceSelect').val('choose');
        jQuery('#additionalServiceNumberOfPax').val('');            
        jQuery('#additionalServiceUnitPrice').val('');           
        jQuery('#additionalServiceTotalPrice').val('');
        jQuery('#noPendingPayments').hide();
        jQuery('#showChargesModal').prop('disabled', false);

        //jQuery('#additionalServiceFormAddExtra').prop('disabled', true);
    })
});

jQuery(document).on('click', '.additionalServiceFormRemove', function() {
    var id = jQuery(this).attr('id').slice(27);  
    var divServiceID = '#additionalServiceID'+id;
    var divServiceName = '#divServiceName'+id;
    var divQuantity = '#divQuantity'+id;
    var divUnitPrice = '#divUnitPrice'+id;
    var divTotalPrice = '#divTotalPrice'+id;
    var divButton = '#divButton'+id;

    jQuery(divServiceID).remove();
    jQuery(divServiceName).remove();
    jQuery(divQuantity).remove();
    jQuery(divUnitPrice).remove();
    jQuery(divTotalPrice).remove();
    jQuery(divButton).remove();

    var divInvoiceRow = '#invoiceRow'+id;
    jQuery(divInvoiceRow).remove();
    
    if(jQuery('.invoiceBalances').val() != "") {
        updateTotal();
        updateBalance();
        jQuery('#noPendingPayments').show();
        jQuery('#showChargesModal').prop('disabled', true);
    } else {
        updateTotal();
        updateBalance();
    }

});

function updateBalance() {
    var totalBalance = 0;
    var balance =  jQuery('.invoiceBalances');

    for (var index = 0; index < balance.length; index++) {
        totalBalance += numeral(balance.eq(index).html()).value();
        console.log(totalBalance);
    }

    //console.log(jQuery('#rowAmountPaid').css('display'));

    if(!(jQuery('#rowAmountPaid').css('display') == 'none')) {
        totalBalance -= numeral(jQuery('#invoiceAmountPaid').html()).value();
        //console.log('tumatama');
    }

    //console.log(totalBalance);
    jQuery('#invoiceTotalBalance').html(toPeso(numeral(totalBalance).format('0,0.00')));
    checkUnpaid();
}

/*Charges Modal*/
jQuery(document).on('click', '#showChargesModal', function() {
    var chargesRows = jQuery('#chargesRows');
    chargesRows.html("");
    var htmlString = "";

    var checked = "";

    var balancesGrandTotal = 0;

    for(var index = 0; index < jQuery('.invoiceQuantities').length; index++) {
        if(jQuery('.invoiceCheckboxes').eq(index).prop('checked') == true) {
            checked = "checked";
        } else {
            checked = "";
        }

        htmlString += "<tr>";
        htmlString += "<td></td>";
        htmlString += "<td class='chargesDescriptions'>";
        htmlString += "<input class='form-check-input balancePaymentCheckboxes' type='checkbox' id='charge"+index+"' "+checked+">"+jQuery('.invoiceDescriptions').eq(index).html()+"</td>";
        htmlString += "<td style='text-align:right;' class='chargeQuantities'>"+jQuery('.invoiceQuantities').eq(index).html()+"</td>";
        htmlString += "<td style='text-align:right;' class='chargePrices'>"+jQuery('.invoicePrices').eq(index).html()+"</td>";
        htmlString += "<td style='text-align:right;' class='chargeBalances'>"+jQuery('.invoiceBalances').eq(index).html()+"</td>";
        //htmlString += "<td><button type='button' id='deleteCharge' class='btn btn-sm btn-danger deleteCharge'><span class='fa fa-minus' aria-hidden='true'></span></button></td>";
        htmlString += "</tr>";
        
        if(jQuery('.invoiceCheckboxes').eq(index).prop('checked') == true) {
            balancesGrandTotal += numeral(jQuery('.invoiceBalances').eq(index).html()).value();
        }
    }

    chargesRows.html(htmlString);

    jQuery('#invoiceTotalBalanceModal').html(toPeso(numeral(balancesGrandTotal).format('0,0.00')));
});

jQuery('#selectAllBalances').change(function() {
    //var checkboxes = jQuery(this).closest('body').find(':checkbox');
    //checkboxes.prop('checked', jQuery(this).is(':checked'));
    for(var count = 0; count < jQuery('.balancePaymentCheckboxes').length; count++) {
        jQuery('.balancePaymentCheckboxes').eq(count).prop('checked', jQuery(this).is(':checked'));
    }

    updateBalancesTotal();
});

jQuery(document).on('change', '.balancePaymentCheckboxes', function() {
    var balancesGrandTotal = numeral(jQuery('#invoiceTotalBalanceModal').html()).value();
    var chargeNumber = jQuery(this).attr('id').slice(6);
    var balancePrice = numeral(jQuery('.chargeBalances').eq(chargeNumber).html()).value();
    //console.log(balancesGrandTotal);
    console.log(chargeNumber);
    //console.log(balancePrice);
    if(!(jQuery(this).is(':checked'))) {
        var newBalanceGrandTotal = balancesGrandTotal-balancePrice;
        jQuery('.invoiceCheckboxes').eq(chargeNumber).prop('checked', false);      
        jQuery('#invoiceTotalBalanceModal').html(toPeso(numeral(newBalanceGrandTotal).format('0,0.00')));
    } else {
        var newBalanceGrandTotal = balancesGrandTotal+balancePrice;            
        jQuery('.invoiceCheckboxes').eq(chargeNumber).prop('checked', true);       
        jQuery('#invoiceTotalBalanceModal').html(toPeso(numeral(newBalanceGrandTotal).format('0,0.00')));
    }

    checkToggledBalanceCheckboxes();
});

function checkToggledBalanceCheckboxes(){
    var hit = 0;
    for (var index = 0; index < jQuery('.balancePaymentCheckboxes').length; index++) {
        if(jQuery('.balancePaymentCheckboxes').eq(index).prop('checked') == false) {
            hit++;
        }
    }
    if (hit == 0) {
        jQuery('#selectAllBalances').prop('checked', true);
    } else {
        jQuery('#selectAllBalances').prop('checked', false);
    }
}

function updateBalancesTotal() {
    var balancesGrandTotal = 0;
    if(jQuery('#selectAllBalances').prop('checked') == false){        
        jQuery('#invoiceTotalBalanceModal').html(0);
    } else {
        for(var index = 0; index < jQuery('.chargeBalances').length; index++) {
            //console.log(jQuery('.invoicePrices').eq(index).html());
            balancesGrandTotal += numeral(jQuery('.chargeBalances').eq(index).html()).value();
        }              
        jQuery('#invoiceTotalBalanceModal').html(toPeso(numeral(balancesGrandTotal).format('0,0.00')));
    }
}

jQuery('#saveAdditionalPayments').click(function() {
    console.log(jQuery('.balancePaymentCheckboxes').length);
    jQuery('#selectedAdditionalPayments').html("");
    var htmlString = "";
    for(var index = 0; index < jQuery('.balancePaymentCheckboxes').length; index++){
        if(jQuery('.balancePaymentCheckboxes').eq(index).prop('checked')){
            htmlString += "<input type='number' class='paymentRecords' name='payment"+index+"' value='"+numeral(jQuery('.chargeBalances').eq(index).html()).value()+"' style='display:none;'>";
        //console.log('fuck');
        }
    }
    jQuery('#selectedAdditionalPayments').html(htmlString);    

    jQuery('#rowAmountPaid').css('display', '');
    jQuery('#invoiceAmountPaid').html(toPeso(numeral(jQuery('#amount').val()).format('0,0.00')));

    updateBalance();
});

//CHECK OUT
jQuery('#saveAllPayments').click(function() {
    console.log(jQuery('.balancePaymentCheckboxes').length);
    jQuery('#selectedAdditionalPayments').html("");
    var htmlString = "";
    for(var index = 0; index < jQuery('.balancePaymentCheckboxes').length; index++){
        if(jQuery('.balancePaymentCheckboxes').eq(index).prop('checked')){
            htmlString += "<input type='number' class='paymentRecords' name='payment"+index+"' value='"+numeral(jQuery('.chargeBalances').eq(index).html()).value()+"' style='display:none;'>";
        //console.log('fuck');
        }
    }
    jQuery('#selectedAdditionalPayments').html(htmlString);

    jQuery('#rowAmountPaid').css('display', '');
    jQuery('#invoiceAmountPaid').html(toPeso(numeral(jQuery('#amount').val()).format('0,0.00')));

    checkUnpaid();
    updateBalance();
});

function checkUnpaid() {
    if(jQuery('.paymentRecords').length == jQuery('.invoiceBalances').length){
        console.log(jQuery('#amount').val());
        console.log(jQuery('#invoiceTotalBalance').html());
        if(numeral(jQuery('#invoiceTotalBalance').html()).value() <= 0) {
            //jQuery('#checkoutButton').prop('disabled', false);            
            jQuery('#checkoutButton').css('display', 'inline-block');
            jQuery('#checkoutWarning').css('display', 'none');
            jQuery('#checkoutDueTodayButton').prop('disabled', false);
        } else {
            jQuery('#checkoutButton').css('display', 'none');
            jQuery('#checkoutWarning').css('display', 'inline-block');
        }
    } else {
        jQuery('#checkoutButton').css('display', 'none');
        jQuery('#checkoutWarning').css('display', 'inline-block');
        //jQuery('#checkoutButton').prop('disabled', true);
        jQuery('#checkoutDueTodayButton').prop('disabled', false);
    }
}


/**/

/*jQuery(document).ready(function(){
    myHTMLNumberInput.onchange = setTwoNumberDecimal;
});*/


        /*let tbody = jQuery('#invoiceRows');
        let tr =  document.createElement('TR');
        tr.id = 'invoiceRow'+additionalServices;
        
        let tdDescription = document.createElement('TD');
        let tdDescriptionBody = document.createTextNode(data[0].serviceName);
        tdDescription.appendChild(tdDescriptionBody);
        tdDescription.className = 'invoiceDescriptions';

        let tdQuantity = document.createElement('TD');
        let tdQuantityBody = document.createTextNode(jQuery('#additionalServiceNumberOfPax').val());
        tdQuantity.appendChild(tdQuantityBody);
        tdQuantity.className = 'invoiceQuantities';
        tdQuantity.style.textAlign = 'right';

        let tdUnitPrice = document.createElement('TD');
        let tdUnitPriceBody = document.createTextNode(document.getElementsByClassName('additionalServiceUnitPrice')[0].value);
        tdUnitPrice.appendChild(tdUnitPriceBody);
        tdUnitPrice.className = 'invoiceUnitPrices';
        tdUnitPrice.style.textAlign = 'right';
        
        let tdTotalPrice = document.createElement('TD');
        let tdTotalPriceBody = document.createTextNode(document.getElementsByClassName('additionalServiceTotalPrice')[0].value);
        tdTotalPrice.appendChild(tdTotalPriceBody);
        tdTotalPrice.className = 'invoicePrices';
        tdTotalPrice.style.textAlign = 'right';

        let tdTotalBalance = document.createElement('TD');
        let tdTotalBalanceBody = document.createTextNode(document.getElementsByClassName('additionalServiceTotalPrice')[0].value);
        tdTotalBalance.appendChild(tdTotalBalanceBody);
        tdTotalBalance.className = 'invoiceBalances';
        tdTotalBalance.style.textAlign = 'right';

        tr.append(tdDescription);
        tr.append(tdQuantity);
        tr.append(tdUnitPrice);
        tr.append(tdTotalPrice);
        tr.append(tdTotalBalance);
        tbody.append(tr);*/

/*jQuery(document).ready(function(){
    
        jQuery(window).bind('beforeunload', function(e){
            e.preventDefault();
        });
        jQuery("#unsavedChangesModal").modal('toggle');  
});

window.onbeforeunload = function() {
    return 'message';
}*/

/* RESERVATIONS TABLE */
jQuery('.load-reservation-details').click(function() {
    var reservationID = jQuery(this).attr('id');
    //console.log(reservationID);
    jQuery('#confirmCancel').attr('href', '/cancel-reservation/'+reservationID);
});
   

jQuery('#selectAllUnitCheckoutCheckboxes').change(function() {
    for(var count = 0; count < jQuery('.unitCheckoutCheckboxes').length; count++) {
        jQuery('.unitCheckoutCheckboxes').eq(count).prop('checked', jQuery(this).is(':checked'));
    }
    checkToggledCheckoutCheckboxes();
});

jQuery('.unitCheckoutCheckboxes').change(function() {
    checkToggledCheckoutCheckboxes();
});

function checkToggledCheckoutCheckboxes(){
    var hit = 0;
    var unitIDs = new Array();

    for (var count = 0; count < jQuery('.unitCheckoutCheckboxes').length; count++) {
        if(jQuery('.unitCheckoutCheckboxes').eq(count).prop('checked') == false) {
            hit++;
        } else {
            var unitID = jQuery('.unitCheckoutCheckboxes').eq(count).attr('id').slice(20);
            //console.log(unitID);
            unitIDs.push(unitID);
        }
    }
    
    unitIDs = unitIDs.toString();
    jQuery('#unitCheckout').val(unitIDs);

    if (hit == 0) {
        jQuery('#selectAllUnitCheckoutCheckboxes').prop('checked', true);
        if(jQuery('.paymentRecords').length == jQuery('.invoiceBalances').length){
            jQuery('#checkoutButton').prop('disabled', false);
        } else {
            jQuery('#checkoutButton').prop('disabled', true);
        }
    } else if(hit == (jQuery('.unitCheckoutCheckboxes').length)) {
        jQuery('#selectAllUnitCheckoutCheckboxes').prop('checked', false);
        jQuery('#checkoutButton').prop('disabled', true);
    } else {
        jQuery('#selectAllUnitCheckoutCheckboxes').prop('checked', false);
        jQuery('#checkoutButton').prop('disabled', false);
    } 
}