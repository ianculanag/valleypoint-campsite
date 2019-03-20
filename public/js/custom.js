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
            
            /*let guestID = document.createElement('TR');
            let guestIDLabel = document.createElement('TD');
            let guestIDLabelData = document.createTextNode('Guest ID: ');
            guestIDLabel.appendChild(guestIDLabelData);
            guestIDLabel.style.width='35%';
            let guestIDBody = document.createElement('TD');
            let guestIDBodyData = document.createTextNode(data[0].id);
            guestIDBody.appendChild(guestIDBodyData);
            guestID.appendChild(guestIDLabel);
            guestID.appendChild(guestIDBody);*/
            
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

/*jQuery(document).ready(function(){
    var servicePrice = 0;
    jQuery('.serviceSelect').change(function(){
        jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
            //console.log(data[0].price);
            servicePrice = data[0].price;
            console.log(servicePrice);

            var numberOfPax = document.getElementById('additionalServiceNumberOfPax').value;

            if(numberOfPax) {
                console.log('yeah');
                document.getElementById('additionalServicePrice').value = servicePrice * numberOfPax;
            }
        })
    });

    jQuery('.paxSelect').change(function(){
        var numberOfPax = document.getElementById('additionalServiceNumberOfPax').value
        console.log();
        if(document.getElementById('serviceSelect').value) {
            document.getElementById('additionalServicePrice').value = servicePrice * numberOfPax;
        }
    });
}); */

jQuery(document).on('click','.collapse.in',function(e) {
    if(jQuery(e.target).is('div') ) {
        jQuery(this).collapse('hide');
    }
});

jQuery(document).ready(function(){
    jQuery('.load-unit').click(function(){
        //console.log(jQuery(this).attr('id'));
        var unitID = jQuery(this).attr('id'); 
        jQuery("#checkin").attr("href", "checkin/"+unitID);
        jQuery("#reserve").attr("href", "makeReservation/"+unitID); 
        //jQuery("#accommodationType").prop("disabled", true);
    });
}); 

jQuery(document).ready(function(){
    var daysDiff = 2;

    jQuery('#checkoutDate').change(function(){
        var checkin = Date.parse(jQuery('#checkinDate').val());
        var checkout = Date.parse(jQuery('#checkoutDate').val());

        var timeDiff = checkout-checkin;
        daysDiff = Math.floor(timeDiff/(1000 * 60 * 60 * 24));

        jQuery('#accommodationType').val(jQuery('.numberOfPaxGlamping').val());            
        jQuery('#invoiceQuantity').html(jQuery('.numberOfPaxGlamping').val()+'x'+(daysDiff-1));

        var packagePrice;
        var totalPrice;
        
        jQuery.get('/getService/'+$('.numberOfPaxGlamping').val(), function(data){ 
            packagePrice = data[0].price;                         
            jQuery('#invoiceUnit').html(packagePrice);
            //console.log(daysDiff);
            totalPrice = packagePrice * jQuery('.numberOfPaxGlamping').val() * (daysDiff-1);
            jQuery('#invoiceTotal').html(totalPrice);                

            updateTotal();
        })
        //console.log(daysDiff);
        //call Glamping method
    });
    
    jQuery('.numberOfPaxGlamping').change(function(){
        if(jQuery(this).val() > 0 && jQuery(this).val() < 5) {
            //console.log('Hello');
            jQuery('#accommodationType').val(jQuery(this).val());            
            jQuery('#invoiceQuantity').html(jQuery(this).val()+'x'+(daysDiff-1));

            var packagePrice;
            var totalPrice;
            
            jQuery.get('/getService/'+$(this).val(), function(data){ 
                packagePrice = data[0].price;                         
                jQuery('#invoiceUnit').html(packagePrice);
                //console.log(daysDiff);
                totalPrice = packagePrice * jQuery('.numberOfPaxGlamping').val() * (daysDiff-1);
                jQuery('#invoiceTotal').html(totalPrice);                

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

    jQuery('.additionalServiceFormAdd').click(function(){
        jQuery.get('/serviceSelect/'+document.getElementById('serviceSelect').value, function(data){
            console.log('Hello');
            let tbody = jQuery('#invoiceRows');
            let tr =  document.createElement('TR');
            
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

            /*let divServiceName = document.getElementById('divServiceName');
            let divServiceNameNew = document.createElement('DIV');
            divServiceNameNew.className = 'mt-2';

            let inputService = document.createElement('INPUT');
            inputService.className = 'form-control';
            inputService.disabled =  true;
            inputService.value = data[0].serviceName;

            divServiceNameNew.appendChild(inputService);
            divServiceName.appendChild(divServiceNameNew);

            let divQuantity = document.getElementById('divQuantity');
            let divQuantityNew = document.createElement('DIV');
            divQuantityNew.className = 'mt-2';

            let inputQuantity = document.createElement('INPUT');
            inputQuantity.className = 'form-control';
            inputQuantity.disabled =  true;
            inputQuantity.value = jQuery('#additionalServiceNumberOfPax').val();

            divQuantityNew.appendChild(inputQuantity);
            divQuantity.appendChild(divQuantityNew);

            let divUnitPrice = document.getElementById('divUnitPrice');
            let divUnitPriceNew = document.createElement('DIV');
            divUnitPriceNew.className = 'mt-2';

            let inputUnitPrice = document.createElement('INPUT');
            inputUnitPrice.className = 'form-control';
            inputUnitPrice.disabled =  true;
            inputUnitPrice.value = document.getElementsByClassName('additionalServiceUnitPrice')[0].value;

            divUnitPriceNew.appendChild(inputUnitPrice);
            divUnitPrice.appendChild(divUnitPriceNew);

            let divTotalPrice = document.getElementById('divTotalPrice');
            let divTotalPriceNew = document.createElement('DIV');
            divTotalPriceNew.className = 'mt-2';

            let inputTotalPrice = document.createElement('INPUT');
            inputTotalPrice.className = 'form-control';
            inputTotalPrice.disabled =  true;
            inputTotalPrice.value = document.getElementsByClassName('additionalServiceTotalPrice')[0].value;

            divTotalPriceNew.appendChild(inputTotalPrice);
            divTotalPrice.appendChild(divTotalPriceNew);

            let divButton = document.getElementById('divButton');
            let divButtonNew = document.createElement('DIV');
            divButtonNew.className = 'input-group';

            let button = document.createElement('BUTTON');
            button.className = 'btn btn-danger additionalServiceFormAdd mt-2';
            button.type = 'button';

            let buttonSpan = document.createElement('SPAN');
            buttonSpan.className = 'fa fa-minus';
            buttonSpan.setAttribute('aria-hidden', 'true');

            button.appendChild(buttonSpan);
            divButtonNew.appendChild(button);
            divButton.appendChild(divButtonNew);
            */
            let htmlString = "";
            htmlString += "<div class='col-md-3 mb-1' id='divServiceName'>";
            htmlString += "<input class='form-control paxSelect' type='number' name='additionalServiceName' placeholder='"+data[0].serviceName+"' value='"+data[0].serviceName+"' disabled>";
            htmlString += "</div>";
            htmlString += "<div class='col-md-2 mb-1' id='divQuantity'>";
            htmlString += "<input class='form-control paxSelect' type='number' id='additionalServiceNumberOfPax' name='additionalServiceNumberOfPax' placeholder='' value='"+jQuery('#additionalServiceNumberOfPax').val()+"' min='1' max='10' {{--form='serviceForm'--}} disabled>";
            htmlString += "</div>";
            htmlString += "<div class='col-md-3 mb-1' id='divUnitPrice'>";
            htmlString += "<div class='input-group'>";
            htmlString += "<div class='input-group-prepend'>";
            htmlString += "<span class='input-group-text'>₱</span>";
            htmlString += "</div>";
            htmlString += "<input class='form-control additionalServiceUnitPrice' type='text' id='additionalServiceUnitPrice' name='additionalServiceUnitPrice' placeholder='' value='"+document.getElementsByClassName('additionalServiceUnitPrice')[0].value+"' disabled>";
            htmlString += "</div>";
            htmlString += "</div>";
            htmlString += "<div class='col-md-3 mb-1' id='divTotalPrice'>";
            htmlString += "<div class='input-group'>";
            htmlString += "<div class='input-group-prepend'>";
            htmlString += "<span class='input-group-text'>₱</span>";
            htmlString += "</div>";
            htmlString += "<input class='form-control additionalServiceTotalPrice' type='text' id='additionalServiceTotalPrice' name='additionalServiceTotalPrice' placeholder='' value='"+document.getElementsByClassName('additionalServiceTotalPrice')[0].value+"' disabled>";
            htmlString += "</div>";
            htmlString += "</div>";
            htmlString += "<div id='divButton'>";
            htmlString += "<div class='input-group'>";
            htmlString += "<button type='button' id='additionalServiceFormAdd' class='btn btn-danger additionalServiceFormRemove'>";
            htmlString += "<span class='fa fa-minus' aria-hidden='true'></span>";
            htmlString += "</button>";
            htmlString += "</div>";
            htmlString += "</div>";

            jQuery('#divAdditionalServices').append(htmlString);

            

            jQuery('#serviceSelect').val('choose');
            jQuery('#additionalServiceNumberOfPax').val('');            
            jQuery('#additionalServiceUnitPrice').val('');           
            jQuery('#additionalServiceTotalPrice').val('');
        })
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

/*jQuery('#tokenfield').tokenfield({
    autocomplete: {
      source: ['Tent 1','Tent 2','Tent 3','Tent 4','Tent 6','Tent 7','Tent 8'],
      delay: 100
    },
    showAutocompleteOnFocus: true
});*/
