jQuery(document).ready(function(){
    jQuery('.load-details').click(function(){
        jQuery.get('loadDetails/'+$(this).attr('id'), function(data){
            console.log(data);
            
            let modal = document.getElementById('modal-body');
            modal.innerHTML = ""

            let hr = document.createElement('HR');

            let unitH5 =  document.createElement('H5');
            unitH5.classList.add('text-center');
            let unitH5Body = document.createTextNode('Unit Details');
            unitH5.appendChild(unitH5Body);
            
            //first div
            let firstDiv = document.createElement('DIV');
            firstDiv.classList.add('container');

            let firstTable = document.createElement('TABLE');
            firstTable.classList.add('table');
            firstTable.classList.add('table-sm');
            firstTable.classList.add('borderless');

            let firstTableBody = document.createElement('TBODY');
            
            let unitID = document.createElement('TR');
            let unitIDLabel = document.createElement('TD');
            let unitIDLabelData = document.createTextNode('Unit ID: ');
            unitIDLabel.appendChild(unitIDLabelData);
            unitIDLabel.style.width='35%';
            let unitIDBody = document.createElement('TD');
            let unitIDBodyData = document.createTextNode(data[0].unitID);
            unitIDBody.appendChild(unitIDBodyData);
            unitID.appendChild(unitIDLabel);
            unitID.appendChild(unitIDBody);
            
            let unitNumber = document.createElement('TR');
            let unitNumberLabel = document.createElement('TD');
            let unitNumberLabelData = document.createTextNode('Unit Number: ');
            unitNumberLabel.appendChild(unitNumberLabelData);
            unitNumberLabel.style.width='35%';
            let unitNumberBody = document.createElement('TD');
            let unitNumberBodyData = document.createTextNode(data[0].unitNumber);
            unitNumberBody.appendChild(unitNumberBodyData);
            unitNumber.appendChild(unitNumberLabel);
            unitNumber.appendChild(unitNumberBody);
            
            let capacity = document.createElement('TR');
            let capacityLabel = document.createElement('TD');
            let capacityLabelData = document.createTextNode('Capacity: ');
            capacityLabel.appendChild(capacityLabelData);
            capacityLabel.style.width='35%';
            let capacityBody = document.createElement('TD');
            let capacityBodyData = document.createTextNode(data[0].capacity);
            capacityBody.appendChild(capacityBodyData);
            capacity.appendChild(capacityLabel);
            capacity.appendChild(capacityBody);

            firstDiv.appendChild(unitH5);

            firstTableBody.appendChild(unitID); 
            firstTableBody.appendChild(unitNumber);
            firstTableBody.appendChild(capacity);
            firstTable.appendChild(firstTableBody);
            firstDiv.appendChild(firstTable);
            firstDiv.appendChild(hr);

            //second div
            let guestH5 =  document.createElement('H5');
            guestH5.classList.add('text-center');
            let guestH5Body = document.createTextNode('Guest Details');
            guestH5.appendChild(guestH5Body);

            let secondDiv = document.createElement('DIV');
            secondDiv.classList.add('container');

            let secondTable = document.createElement('TABLE');
            secondTable.classList.add('table');
            secondTable.classList.add('table-sm');
            secondTable.classList.add('borderless');

            let secondTableBody = document.createElement('TBODY');
                     
            let guestName = document.createElement('TR');
            let guestNameLabel = document.createElement('TD');
            let guestNameLabelData = document.createTextNode('Guest Name: ');
            guestNameLabel.appendChild(guestNameLabelData);
            guestNameLabel.style.width='35%';
            let guestNameBody = document.createElement('TD');
            let guestLastNameBodyData = document.createTextNode(data[0].lastName);
            let guestFirstNameBodyData = document.createTextNode(data[0].firstName);
            let space = document.createTextNode(' ');
            guestNameBody.appendChild(guestFirstNameBodyData);
            guestNameBody.appendChild(space);
            guestNameBody.appendChild(guestLastNameBodyData);
            guestName.appendChild(guestNameLabel);
            guestName.appendChild(guestNameBody);
            
            let pax = document.createElement('TR');
            let paxLabel = document.createElement('TD');
            let paxLabelData = document.createTextNode('Number of pax: ');
            paxLabel.appendChild(paxLabelData);
            paxLabel.style.width='35%';
            let paxBody = document.createElement('TD');
            let paxBodyData = document.createTextNode(data[0].numberOfPax);
            paxBody.appendChild(paxBodyData);
            pax.appendChild(paxLabel);
            pax.appendChild(paxBody);

            let checkIn = document.createElement('TR');
            let checkInLabel = document.createElement('TD');
            checkInLabel.colSpan='2';
            let checkInLabelData = 'Checked-in on ';
            /*let checkedInAt = new Datetime(data[0].checkinDatetime);
            checkedInAt.toLocaleString(undefined, {
                month : 'short',
                day : 'numeric',
                year : 'numeric',
                hour : '2-digit',
                minute : '2-digit',
            });*/
            let checkInBody = document.createTextNode(checkInLabelData+data[0].checkinDatetime);
            checkInLabel.style.color='green';
            checkInLabel.style.fontStyle='italic';
            checkInLabel.appendChild(checkInBody);
            checkIn.appendChild(checkInLabel);

            let checkOut = document.createElement('TR');
            let checkOutLabel = document.createElement('TD');
            checkOutLabel.colSpan='2';
            let checkOutLabelData = 'Due ';
            //let checkedOutAt = new Datetime(data[0].checkoutDatetime);
            let checkOutBody = document.createTextNode(checkOutLabelData+data[0].checkoutDatetime);
            checkOutLabel.style.color='green';
            checkOutLabel.style.fontStyle='italic';
            checkOutLabel.appendChild(checkOutBody);
            checkOut.appendChild(checkOutLabel);

            secondDiv.appendChild(guestH5);

            //secondTableBody.appendChild(guestID); 
            secondTableBody.appendChild(guestName);
            secondTableBody.appendChild(pax);
            secondTableBody.appendChild(checkIn);
            secondTableBody.appendChild(checkOut);
            secondTable.appendChild(secondTableBody);
            secondDiv.appendChild(secondTable);
            
            modal.appendChild(firstDiv);
            modal.appendChild(secondDiv);
            //append everything

            jQuery("#editDetails").attr("href", "editdetails/"+data[0].unitID);
            jQuery("#checkout").attr("href", "checkout/"+data[0].unitID);
        })
    });
}); 

//Dynamic adding of forms: Firstname, Lastname, Contact Number depending on the number of Pax
jQuery("#numPax").change(function() {
    var htmlString = "";
    var len = jQuery(this).val();
    for (var i = 1; i < len; i++) {
        if (len > 1) {
            htmlString += "<h5>Accompanying Guests</h5>";
            htmlString += "<div class='row'>";
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<label for='fname'>First Name</label>";
            htmlString += "<input type='text' name='firstName1' required='required' class='form-control' placeholder='Juan'>";
            htmlString += "</div>";
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<label for='lname'>Last Name</label>";
            htmlString += "<input type='text' name='lastName1' required='required' class='form-control' placeholder='Dela Cruz'>";
            htmlString += "</div>";
            
            for (var i = 2; i < len; i++) {
                htmlString += "<div class='form-group col-md-6'>";
                htmlString += "<input type='text' name='firstName" + i + "' required='required' class='form-control' placeholder='Juan'>";
                htmlString += "</div>";
                htmlString += "<div class='form-group col-md-6'>";
                htmlString += "<input type='text' name='lastName" + i + "' required='required' class='form-control' placeholder='Dela Cruz'>";
                htmlString += "</div>";  
            }        
            htmlString +="</div>";
        }
    }
        jQuery("#outputArea").html(htmlString);
});

//Dynamic adding of forms: Firstname Lastname
jQuery("input[type=radio][name=numberOfPax]").change(function() {
    var htmlString = "";
    var len = jQuery(this).val();
    console.log(len);
    if (len > 1) {
        htmlString += "<h5>Accompanying Guests</h5>";
        htmlString += "<div class='row'>";
        htmlString += "<div class='form-group col-md-6'>";
        htmlString += "<label for='fname'>First Name</label>";
        htmlString += "<input type='text' name='firstName1' required='required' class='form-control' placeholder='Juan'>";
        htmlString += "</div>";
        htmlString += "<div class='form-group col-md-6'>";
        htmlString += "<label for='lname'>Last Name</label>";
        htmlString += "<input type='text' name='lastName1' required='required' class='form-control' placeholder='Dela Cruz'>";
        htmlString += "</div>";
        
        for (var i = 2; i < len; i++) {
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<input type='text' name='firstName" + i + "' required='required' class='form-control' placeholder='Juan'>";
            htmlString += "</div>";
            htmlString += "<div class='form-group col-md-6'>";
            htmlString += "<input type='text' name='lastName" + i + "' required='required' class='form-control' placeholder='Dela Cruz'>";
            htmlString += "</div>";  
        }        
        htmlString +="</div>";
    }
    jQuery("#outputDiv").html(htmlString);
});

jQuery(document).on('click','.collapse.in',function(e) {
    if(jQuery(e.target).is('div') ) {
        jQuery(this).collapse('hide');
    }
});

/*jQuery('#checkAvailability').click(function(){
    jQuery.get('/getDates')
});*/

jQuery(document).ready(function(){
    jQuery('.load-unit').click(function(){
        //console.log(jQuery(this).attr('id'));
        var unitID = jQuery(this).attr('id'); 
        jQuery("#checkin").attr("href", "checkin/"+unitID);
        jQuery("#reserve").attr("href", "makeReservation/"+unitID); 
        jQuery("#checkinBackpacker").attr("href", "checkinBackpacker/"+unitID);
        //jQuery("#accommodationType").prop("disabled", true);
    });
}); 


jQuery(document).ready(function(){
    var numberOfUnits = 1;
    var source =['Tent1', 'Tent2', 'Tent3', 'Tent4', 'Tent5', 'Tent6', 'Tent7', 'Tent8', 'Tent9', 'Tent10'];
    jQuery('#tokenfield').tokenfield({
        autocomplete: {
          source: source,
          delay: 100
        },
        showAutocompleteOnFocus: true
    });

    jQuery('#tokenfield').on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        jQuery.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });

        var exists = false;
        jQuery.each(source, function(index, value) {
                if (event.attrs.value === value) {
                    exists = true;
                }
        });
        if(!exists) {
                event.preventDefault(); //prevents creation of token
                alert('Please select the unit from the choices.')
        }

        /*var available_tokens = bloodhound_tokens.index.datums
        var exists = true;
        jQuery.each(available_tokens, function(index, token) {
            if (token.value === event.attrs.value)
                exists = false;
        });
        if(exists === true)
            event.preventDefault();*/
    });

    jQuery('#tokenfield').on('tokenfield:removedtoken', function (e) {
        //alert('Token removed! Token value was: ' + e.attrs.value)
        numberOfUnits--;
        jQuery('#numberOfUnits').val(numberOfUnits);
        removeRow(e.attrs.value);
        removeInvoiceEntry(e.attrs.value);
    });

    jQuery('#tokenfield').on('tokenfield:createdtoken', function (e) {
        //alert('Token added! Token value was: ' + e.attrs.value)
        numberOfUnits++;
        jQuery('#numberOfUnits').val(numberOfUnits);
        makeRow(e.attrs.value);
        makeInvoiceEntry(e.attrs.value);
    });
});

function makeInvoiceEntry(unitNumber) {
    var invoiceRows = jQuery('#invoiceRows');

    htmlString = "";
    htmlString += "<tr id='invoiceUnit"+unitNumber+"'>";
    htmlString += "<td id='invoiceDescription"+unitNumber+"'>Glamping Solo</td>";
    htmlString += "<td id='invoiceQuantity"+unitNumber+"' style='text-align:right;'>1</td>";
    htmlString += "<td id='invoiceUnitPrice"+unitNumber+"' style='text-align:right;'>1350</td>";
    htmlString += "<td id='invoiceTotalPrice"+unitNumber+"' style='text-align:right;' class='invoicePrices'>1350</td>";
    htmlString += "</tr>";

    invoiceRows.append(htmlString);
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
    htmlString += "<input class='form-control paxSelect numberOfPaxGlamping' name='numberOfPaxGlamping"+unitNumber+"' id='numberOfPaxGlamping"+unitNumber+"' type='number' name='additionalServiceNumberOfPax' placeholder='' value='' min='1' max='4'>";
    htmlString += "<input class='' name='totalPrice"+unitNumber+"' id='totalPrice"+unitNumber+"' type='number' style='display:none;position:absolute' value=''>";
    htmlString += "</div>";
    htmlString += "</div>";
    htmlString += "<div class='col-md-5 mb-1' id='divAccommodationPackage"+unitNumber+"'>";
    htmlString += "<select class='form-control' name='accommodationType"+unitNumber+"' id='accommodationType"+unitNumber+"' disabled>";
    htmlString += "<option value='1'>Glamping Solo</option>";
    htmlString += "<option value='2'>Glamping 2 Pax</option>";
    htmlString += "<option value='3'>Glamping 3 pax</option>";
    htmlString += "<option value='4'>Glamping 4 pax</option>";
    htmlString += "</select>";
    htmlString += "</div>";
    htmlString += "</div>";

    jQuery('#divUnits').append(htmlString);
}

function removeInvoiceEntry(unitNumber) {
    var invoiceUnit = '#invoiceUnit'+unitNumber;
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
        var numberOfPaxGlamping;

        var packagePrice;
        var totalPrice;

        var invoiceUnitPrice;
        var invoiceTotalPrice;

        var hiddenTotalPrice;

        for(var index = 0; index < selectedUnits.length; index++) {
            currentUnit = selectedUnits[index].value;
        
            invoiceQuantity = '#invoiceQuantity'+currentUnit;
            numberOfPaxGlamping = '#numberOfPaxGlamping'+currentUnit;
            invoiceUnitPrice = '#invoiceUnitPrice'+currentUnit;
            invoiceTotalPrice = '#invoiceTotalPrice'+currentUnit;

            hiddenTotalPrice = '#totalPrice'+currentUnit;

            jQuery(invoiceQuantity).html(jQuery(numberOfPaxGlamping).val()+'x'+(daysDiff));

            packagePrice = jQuery(invoiceUnitPrice).html();  

            console.log(packagePrice);
            totalPrice = packagePrice * jQuery(numberOfPaxGlamping).val() * (daysDiff);                       
            
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

        jQuery('#accommodationType').val(jQuery('.numberOfPaxGlamping').val());            
        jQuery('#invoiceQuantity').html(jQuery('.numberOfPaxGlamping').val()+'x'+(daysDiff));

        var packagePrice;
        var totalPrice;
        
        jQuery.get('/getService/'+$('.numberOfPaxGlamping').val(), function(data){ 
            packagePrice = data[0].price;                         
            jQuery('#invoiceUnitPrice').html(packagePrice);
            //console.log(daysDiff);
            totalPrice = packagePrice * jQuery('.numberOfPaxGlamping').val() * (daysDiff);
            jQuery('#invoiceTotalPrice').html(totalPrice);      
            
            //jQuery('#stayDuration').val(daysDiff);
            document.getElementById('stayDuration').value = daysDiff;
            //console.log(jQuery('#stayDuration').val());
            updateTotal();
        })
        //console.log(daysDiff);
        //call Glamping method
    });*/



    jQuery(document).on('change','.numberOfPaxGlamping', function(){
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
    });

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

function updateTotal() {
    var totalPrice = 0;
    var prices =  document.getElementsByClassName('invoicePrices');

    //console.log(prices.length);
    //console.log(prices[0].innerHTML);
    for (var index = 0; index < prices.length; index++) {
        console.log(document.getElementsByClassName('invoicePrices')[index].innerHTML);
        totalPrice += parseInt(prices[index].innerHTML);
        console.log(totalPrice);
    }
    document.getElementById('invoiceGrandTotal').innerHTML="";
    document.getElementById('invoiceGrandTotal').innerHTML = totalPrice;
}

jQuery(document).on('click','.collapse.in',function(e) {
    if(jQuery(e.target).is('div') ) {
        jQuery(this).collapse('hide');
    }
});

jQuery(document).ready( function () {
    jQuery('.dataTable').DataTable();
});