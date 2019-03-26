function makeInvoiceEntry2(unitNumber) {
    var invoiceRows2 = jQuery('#invoiceRows2');

    htmlString = "";
    htmlString += "<tr id='invoiceUnit"+unitNumber+"'>";
    htmlString += "<td id='invoiceDescription"+unitNumber+"'>Glamping Solo</td>";
    htmlString += "<td id='invoiceQuantity"+unitNumber+"' style='text-align:right;'>1</td>";
    htmlString += "<td id='invoiceUnitPrice"+unitNumber+"' style='text-align:right;'>750</td>";
    htmlString += "<td id='invoiceTotalPrice"+unitNumber+"' style='text-align:right;' class='invoicePrices'>750</td>";
    htmlString += "</tr>";

    invoiceRows2.append(htmlString);
    updateTotal();
}

function makeRow(unitNumber) {
    console.log('It Works')
    var htmlString = "";
    htmlString += "<div class='row mt-1' id='divUnit"+unitNumber+"'>";
    htmlString += "<div class='col-md-4 mb-1' id='divUnitNumber"+unitNumber+"'>";
    htmlString += "<input type='text' class='form-control' value='"+unitNumber+"' disabled>";
    htmlString += "</div>";
    htmlString += "<div class='col-md-3 mb-1' id='divNumberOfPax"+unitNumber+"'>";
    htmlString += "<div class='input-group'>";
    htmlString += "<div class='input-group-prepend'>";
    htmlString += "<span class='input-group-text'>";
    htmlString += "<i class='fa fa-users' aria-hidden='true'></i>";
    htmlString += "</span>";
    htmlString += "</div>";
    htmlString += "<input class='form-control paxSelect numberOfPaxBackpacker' name='numberOfPaxBackpacker"+unitNumber+"' id='numberOfPaxBackpacker"+unitNumber+"' type='number' name='additionalServiceNumberOfPax' placeholder='' value='' min='1' max='4'>";
    htmlString += "<input class='' name='totalPrice"+unitNumber+"' id='totalPrice"+unitNumber+"' type='number' style='display:none;position:absolute' value=''>";
    htmlString += "</div>";
    htmlString += "</div>";
    htmlString += "</div>";

    jQuery('#divUnits').append(htmlString);
}

function removeInvoiceEntry(unitNumber) {
    var invoiceUnit = '#invoiceUnit2'+unitNumber;
    //console.log(invoiceUnit);
    jQuery(invoiceUnit).remove();
    updateTotal();
}

function removeRow(unitNumber) {
    var divUnit = '#divUnit'+unitNumber;
    jQuery(divUnit).remove();
}

jQuery(document).ready(function(){
    var daysDiff = 1;

    jQuery(document).on('change', '#checkoutDate', function() {
        var checkin = Date.parse(jQuery('#checkinDate').val());
        var checkout = Date.parse(jQuery('#checkoutDate').val());

        var timeDiff = checkout-checkin;
        daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 * 24));

        var selectedUnits = jQuery('#tokenfield').tokenfield('getTokens');
        //console.log(daysDiff);
        //console.log(selectedUnits);

        var currentUnit;
        var invoiceQuantity;
        var numberofPaxBackpacker;

        var packagePrice;
        var totalPrice;

        var invoiceUnitPrice;
        var invoiceTotalPrice;

        var hiddenTotalPrice;

        for(var index = 0; index < selectedUnits.length; index++) {
            currentUnit = selectedUnits[index].value;
        
            invoiceQuantity = '#invoiceQuantity'+currentUnit;
            numberofPaxBackpacker = '#numberofPaxBackpacker'+currentUnit;
            invoiceUnitPrice = '#invoiceUnitPrice'+currentUnit;
            invoiceTotalPrice = '#invoiceTotalPrice'+currentUnit;

            hiddenTotalPrice = '#totalPrice'+currentUnit;

            jQuery(invoiceQuantity).html(jQuery(numberofPaxBackpacker).val()+'x'+(daysDiff));

            packagePrice = jQuery(invoiceUnitPrice).html();  

            console.log(packagePrice);
            totalPrice = packagePrice * jQuery(numberofPaxBackpacker).val() * (daysDiff);                       
            
            jQuery(invoiceUnitPrice).html(packagePrice);            
            jQuery(invoiceTotalPrice).html(totalPrice);   
                      
            jQuery(hiddenTotalPrice).val(totalPrice);   
            
            document.getElementById('stayDuration').value = daysDiff;
            
            updateTotal();
        }
    });
    /*jQuery('#checkoutDate').change(function(){
        var checkin = Date.parse(jQuery('#checkinDate').val());
        var checkout = Date.parse(jQuery('#checkoutDate').val());

        var timeDiff = checkout-checkin;
        daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 * 24));

        jQuery('#accommodationType').val(jQuery('.numberofPaxBackpacker').val());            
        jQuery('#invoiceQuantity').html(jQuery('.numberofPaxBackpacker').val()+'x'+(daysDiff));

        var packagePrice;
        var totalPrice;
        
        jQuery.get('/getService/'+$('.numberofPaxBackpacker').val(), function(data){ 
            packagePrice = data[0].price;                         
            jQuery('#invoiceUnitPrice').html(packagePrice);
            //console.log(daysDiff);
            totalPrice = packagePrice * jQuery('.numberofPaxBackpacker').val() * (daysDiff);
            jQuery('#invoiceTotalPrice').html(totalPrice);      
            
            //jQuery('#stayDuration').val(daysDiff);
            document.getElementById('stayDuration').value = daysDiff;
            //console.log(jQuery('#stayDuration').val());
            updateTotal();
        })
        //console.log(daysDiff);
        //call Glamping method
    });*/



    jQuery(document).on('change','.numberofPaxBackpacker', function(){
        if(jQuery(this).val() > 0 && jQuery(this).val() < 5) {
            //console.log('Hello');
            var unitNumber = jQuery(this).attr('id').slice(19);
            var unitNumberId = '#'+jQuery(this).attr('id');
            //console.log(unitNumber);

            var accommodationType = '#accommodationType'+unitNumber;
            var invoiceQuantity = '#invoiceQuantity'+unitNumber;

            jQuery(accommodationType).val(jQuery(this).val());            
            jQuery(invoiceQuantity).html(jQuery(this).val()+'x'+(daysDiff));

            var packagePrice;
            var totalPrice;
            var invoiceDescription = '#invoiceDescription'+unitNumber;
            var invoiceUnitPrice = '#invoiceUnitPrice'+unitNumber;
            var invoiceTotalPrice = '#invoiceTotalPrice'+unitNumber;
            
            var hiddenTotalPrice = '#totalPrice'+unitNumber;
            
            jQuery.get('/getService/'+jQuery(unitNumberId).val(), function(data){ 
                packagePrice = data[0].price;        
                packageName = data[0].serviceName;       
                
                jQuery(invoiceDescription).html(packageName);                    
                jQuery(invoiceUnitPrice).html(packagePrice);
                //console.log(daysDiff);
                totalPrice = packagePrice * jQuery(unitNumberId).val() * (daysDiff);
                jQuery(invoiceTotalPrice).html(totalPrice); 

                jQuery(hiddenTotalPrice).val(totalPrice);

                updateTotal();
            })
        } else {
            jQuery('#accommodationType').val(1);
            console.log('Out of bounds');
        }
    });

    var servicePrice;

    jQuery('.serviceSelect').change(function(){
        jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
            //console.log(data[0].price);
            servicePrice = data[0].price;
            console.log(servicePrice);

            document.getElementsByClassName('additionalServiceUnitPrice')[0].value = servicePrice;
            document.getElementsByClassName('additionalServiceUnitPrice')[1].value = servicePrice;
            var numberOfPax = document.getElementById('additionalServiceNumberOfPax').value;

            if(numberOfPax) {
                console.log('yeah');
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
    /*jQuery('.additionalServiceFormAdd').click(function(){
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
        
            jQuery('#serviceSelect').val('choose');
            jQuery('#additionalServiceNumberOfPax').val('');            
            jQuery('#additionalServiceUnitPrice').val('');           
            jQuery('#additionalServiceTotalPrice').val('');

            jQuery('#additionalServiceFormAdd').prop('disabled', true);
        })
    });*/

    jQuery(document).on('click', '.additionalServiceFormRemove', function() {
        //console.log('FUUCK!');
        //console.log(jQuery(this).attr('id'));
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