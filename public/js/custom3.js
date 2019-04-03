let additionalServices = 0;
jQuery('#additionalServiceFormAddExtra').click(function(){
    jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
        additionalServices++;
        var htmlStringRow = "";

        htmlStringRow += "<tr id='invoiceRow"+additionalServices+"'>";
        htmlStringRow += "<td style='display:none;'><input id='invoiceCheckBox"+additionalServices+"' class='form-check-input invoiceCheckboxes' type='checkbox' checked></td>";
        htmlStringRow += "<td id='invoiceDescription"+additionalServices+"' class='invoiceDescriptions'>"+data[0].serviceName+"</td>";
        htmlStringRow += "<td id='invoiceQuantity"+additionalServices+"' style='text-align:right;' class='invoiceQuantities'>"+jQuery('#additionalServiceNumberOfPax').val()+"</td>";
        htmlStringRow += "<td id='invoiceUnitPrice"+additionalServices+"' style='text-align:right;' class='invoiceUnitPrices'>"+document.getElementsByClassName('additionalServiceUnitPrice')[0].value+"</td>";
        htmlStringRow += "<td id='invoiceTotalPrice"+additionalServices+"' style='text-align:right;' class='invoicePrices'>"+document.getElementsByClassName('additionalServiceTotalPrice')[0].value+"</td>";
        htmlStringRow += "<td id='invoiceTotalBalance"+additionalServices+"' style='text-align:right;' class='invoiceBalances'>"+document.getElementsByClassName('additionalServiceTotalPrice')[0].value+"</td>";
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
        totalBalance += parseInt(balance.eq(index).html());
    }
    jQuery('#invoiceTotalBalance').html(totalBalance);
}

/*Charges Modal*/
jQuery(document).on('click', '#showChargesModal', function() {
    var chargesRows = jQuery('#chargesRows');
    chargesRows.html("");
    var htmlString = "";

    var checked = "";

    var balancesGrandTotal = parseFloat(0);

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
        htmlString += "<td><button type='button' id='deleteCharge' class='btn btn-sm btn-danger deleteCharge'><span class='fa fa-minus' aria-hidden='true'></span></button></td>";
        htmlString += "</tr>";
        
        if(jQuery('.invoiceCheckboxes').eq(index).prop('checked') == true) {
            balancesGrandTotal += parseFloat(jQuery('.invoiceBalances').eq(index).html());
        }
    }

    chargesRows.html(htmlString);

    /*var totalBalance = 0;
    var balance =  jQuery('.chargeBalances');

    for (var index = 0; index < balance.length; index++) {
        totalBalance += parseInt(balance.eq(index).html());
    }*/
    jQuery('#invoiceTotalBalanceModal').html(balancesGrandTotal);
});

jQuery('#selectAllBalances').change(function() {
    var checkboxes = jQuery(this).closest('form').find(':checkbox');
    checkboxes.prop('checked', jQuery(this).is(':checked'));

    updateBalancesTotal();
});

jQuery(document).on('change', '.balancePaymentCheckboxes', function() {
    var balancesGrandTotal = parseFloat(jQuery('#invoiceTotalBalanceModal').html());
    var chargeNumber = jQuery(this).attr('id').slice(6);
    var balancePrice = parseFloat(jQuery('.chargeBalances').eq(chargeNumber).html());
    //console.log(balancesGrandTotal);
    console.log(chargeNumber);
    //console.log(balancePrice);
    if(!(jQuery(this).is(':checked'))) {
        var newBalanceGrandTotal = balancesGrandTotal-balancePrice;
        jQuery('.invoiceCheckboxes').eq(chargeNumber).prop('checked', false);      
        jQuery('#invoiceTotalBalanceModal').html(newBalanceGrandTotal);
    } else {
        var newBalanceGrandTotal = balancesGrandTotal+balancePrice;            
        jQuery('.invoiceCheckboxes').eq(chargeNumber).prop('checked', true);       
        jQuery('#invoiceTotalBalanceModal').html(newBalanceGrandTotal);
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
            balancesGrandTotal += parseFloat(jQuery('.chargeBalances').eq(index).html());
        }              
        jQuery('#invoiceTotalBalanceModal').html(balancesGrandTotal);
    }
}

jQuery('#saveAdditionalPayments').click(function() {
    console.log(jQuery('.balancePaymentCheckboxes').length);
    jQuery('#selectedAdditionalPayments').html("");
    var htmlString = "";
    for(var index = 0; index < jQuery('.balancePaymentCheckboxes').length; index++){
        if(jQuery('.balancePaymentCheckboxes').eq(index).prop('checked')){
            htmlString += "<input type='number' name='payment"+index+"' value='"+jQuery('.chargeBalances').eq(index).html()+"' style='display:none;'>";
        //console.log('fuck');
        }
    }
    jQuery('#selectedAdditionalPayments').html(htmlString);
});
/**/

jQuery(document).ready(function(){
    myHTMLNumberInput.onchange = setTwoNumberDecimal;
});


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