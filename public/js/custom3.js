/*jQuery(document).ready(function(){
    
    var servicePrice;

    jQuery('.serviceSelect').change(function(){
        jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
            servicePrice = data[0].price;
            console.log(servicePrice);

            document.getElementsByClassName('additionalServiceUnitPrice')[0].value = servicePrice;
            document.getElementsByClassName('additionalServiceUnitPrice')[1].value = servicePrice;
            var numberOfPax = document.getElementById('additionalServiceNumberOfPax').value;

            if(numberOfPax) {
                document.getElementsByClassName('additionalServiceTotalPrice')[0].value = servicePrice * numberOfPax;                
                document.getElementsByClassName('additionalServiceTotalPrice')[1].value = servicePrice * numberOfPax;
                jQuery('.additionalServiceFormAdd').prop('disabled', false);
            }
        })
    });


    jQuery('#additionalServiceNumberOfPax').change(function(){
        console.log('Wooh');
        var numberOfPax = document.getElementById('additionalServiceNumberOfPax').value;
        if(document.getElementById('serviceSelect').value) {
            document.getElementsByClassName('additionalServiceTotalPrice')[0].value = servicePrice * numberOfPax;            
            document.getElementsByClassName('additionalServiceTotalPrice')[1].value = servicePrice * numberOfPax;
            jQuery('.additionalServiceFormAdd').prop('disabled', false);
        }
    });

    let additionalServices = 0;
    jQuery('.additionalServiceFormAdd').click(function(){
        jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
            additionalServices++;
            let tbody = jQuery('#invoiceRows');
            let tr =  document.createElement('TR');
            tr.id = 'invoiceRow'+additionalServices;
            
            let tdDescription = document.createElement('TD');
            let tdDescriptionBody = document.createTextNode(data[0].serviceName);
            tdDescription.appendChild(tdDescriptionBody);

            let tdQuantity = document.createElement('TD');
            let tdQuantityBody = document.createTextNode(jQuery('#additionalServiceNumberOfPax').val());
            tdQuantity.appendChild(tdQuantityBody);
            tdQuantity.style.textAlign = 'right';

            let tdUnitPrice = document.createElement('TD');
            let tdUnitPriceBody = document.createTextNode(document.getElementsByClassName('additionalServiceUnitPrice')[0].value);
            tdUnitPrice.appendChild(tdUnitPriceBody);
            tdUnitPrice.style.textAlign = 'right';
            
            let tdTotalPrice = document.createElement('TD');
            let tdTotalPriceBody = document.createTextNode(document.getElementsByClassName('additionalServiceTotalPrice')[0].value);
            tdTotalPrice.appendChild(tdTotalPriceBody);
            tdTotalPrice.className = 'invoicePrices';
            tdTotalPrice.style.textAlign = 'right';

            tr.append(tdDescription);
            tr.append(tdQuantity);
            tr.append(tdUnitPrice);
            tr.append(tdTotalPrice);
            console.log('Tama');
            tbody.append(tr);

            updateTotal();

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
            console.log('Hit');
            jQuery('#serviceSelect').val('choose');
            jQuery('#additionalServiceNumberOfPax').val('');            
            jQuery('#additionalServiceUnitPrice').val('');           
            jQuery('#additionalServiceTotalPrice').val('');

            jQuery('#additionalServiceFormAdd').prop('disabled', true);
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
        
        console.log(id);
        updateTotal();
    });
}); 

function updateTotal() {
    var totalPrice = 0;
    var prices =  document.getElementsByClassName('invoicePrices');
    for (var index = 0; index < prices.length; index++) {
        console.log(document.getElementsByClassName('invoicePrices')[index].innerHTML);
        totalPrice += parseInt(prices[index].innerHTML);
        console.log(totalPrice);
    }
    document.getElementById('invoiceGrandTotal').innerHTML="";
    document.getElementById('invoiceGrandTotal').innerHTML = totalPrice;
}*/

