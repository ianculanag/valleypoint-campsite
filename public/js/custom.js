jQuery(document).ready(function(){
    jQuery('.load-details').click(function(){
        jQuery.get('loadDetails/'+$(this).attr('id'), function(data){
            console.log(data);
            
            let modal = document.getElementById('modal-body');
            modal.innerHTML = ""

            let hr = document.createElement('HR');

            let tentH5 =  document.createElement('H5');
            tentH5.classList.add('text-center');
            let tentH5Body = document.createTextNode('Tent Details');
            tentH5.appendChild(tentH5Body);
            
            //first div
            let firstDiv = document.createElement('DIV');
            firstDiv.classList.add('container');

            let firstTable = document.createElement('TABLE');
            firstTable.classList.add('table');
            firstTable.classList.add('table-sm');
            firstTable.classList.add('borderless');

            let firstTableBody = document.createElement('TBODY');
            
            let tentID = document.createElement('TR');
            let tentIDLabel = document.createElement('TD');
            let tentIDLabelData = document.createTextNode('Tent ID: ');
            tentIDLabel.appendChild(tentIDLabelData);
            tentIDLabel.style.width='35%';
            let tentIDBody = document.createElement('TD');
            let tentIDBodyData = document.createTextNode(data[0].unitID);
            tentIDBody.appendChild(tentIDBodyData);
            tentID.appendChild(tentIDLabel);
            tentID.appendChild(tentIDBody);
            
            let tentNumber = document.createElement('TR');
            let tentNumberLabel = document.createElement('TD');
            let tentNumberLabelData = document.createTextNode('Tent Number: ');
            tentNumberLabel.appendChild(tentNumberLabelData);
            tentNumberLabel.style.width='35%';
            let tentNumberBody = document.createElement('TD');
            let tentNumberBodyData = document.createTextNode(data[0].unitNumber);
            tentNumberBody.appendChild(tentNumberBodyData);
            tentNumber.appendChild(tentNumberLabel);
            tentNumber.appendChild(tentNumberBody);
            
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

            firstDiv.appendChild(tentH5);

            firstTableBody.appendChild(tentID); 
            firstTableBody.appendChild(tentNumber);
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
            
            let guestID = document.createElement('TR');
            let guestIDLabel = document.createElement('TD');
            let guestIDLabelData = document.createTextNode('Guest ID: ');
            guestIDLabel.appendChild(guestIDLabelData);
            guestIDLabel.style.width='35%';
            let guestIDBody = document.createElement('TD');
            let guestIDBodyData = document.createTextNode(data[0].id);
            guestIDBody.appendChild(guestIDBodyData);
            guestID.appendChild(guestIDLabel);
            guestID.appendChild(guestIDBody);
            
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
            let checkInBody = document.createTextNode(checkInLabelData+data[0].checkinDatetime);
            checkInLabel.style.color='green';
            checkInLabel.style.fontStyle='italic';
            checkInLabel.appendChild(checkInBody);
            checkIn.appendChild(checkInLabel);

            secondDiv.appendChild(guestH5);

            secondTableBody.appendChild(guestID); 
            secondTableBody.appendChild(guestName);
            secondTableBody.appendChild(pax);
            secondTableBody.appendChild(checkIn);
            secondTable.appendChild(secondTableBody);
            secondDiv.appendChild(secondTable);
            
            modal.appendChild(firstDiv);
            modal.appendChild(secondDiv);
            //append everything
        })
    });
}); 