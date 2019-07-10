jQuery(document).ready(function () {
    jQuery(document).on('click', '.restaurant-tables', function () {
        var name = jQuery(this).attr('id');
        //console.log(name);

        var nameSliced = jQuery(this).attr('id').slice(5);

        var htmlString = "";
        //<!-- Modal -->
        htmlString += "<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
        htmlString += "<div class='modal-dialog' role='document'>";
        htmlString += "<div class='modal-content'>";
        htmlString += "<div class='modal-header'>";
        htmlString += "<h5 class='modal-title' id='exampleModalLabel'> Table " + nameSliced + "</h5>";
        htmlString += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        htmlString += "<span aria-hidden='true'>&times;</span>";
        htmlString += "</button>";
        htmlString += "</div>";
        htmlString += "<div class='modal-body'>";
        htmlString += "<strong>Table status:</strong> Available<br>";
        htmlString += "<strong>Capacity:</strong> 4pax";
        htmlString += "</div>";
        htmlString += "<div class='modal-footer'>";
        htmlString += "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>";
        //htmlString+="<a href=''>";
        htmlString += "<button type='button' name='button" + nameSliced + "' class='btn btn-primary occupyButton' data-dismiss='modal'>Occupy</button>";
        htmlString += "<a href='/create-order'>";
        htmlString += "<button type='button' name='button" + nameSliced + "' class='btn btn-primary occupyButton' data-='modal'>Occupy & Make Order</button>";
        htmlString += "</a>";
        htmlString += "</div>";
        htmlString += "</div>";
        htmlString += "</div>";
        htmlString += "</div>";

        jQuery('.dynamicModal').html(htmlString);

    });

    jQuery(document).on('click', '.occupyButton', function () {
        //console.log("gumagana yung occupyButton");

        var buttonId = jQuery(this).attr('name').slice(6);
        var badge = jQuery('.badgeStatus').attr('id').slice(5);
        //console.log(badge);
        //console.log(button);

        var htmlString = "";

        htmlString += "<span class='badge badge-danger float-right badgeStatus' style='font-size:.55em;' id='" + badge + "'>Occupied</span>";

        jQuery('#badge' + buttonId).html(htmlString);
        //jQuery('#')

    });
});

jQuery(document).ready(function () {

    /*var htmlString = "";

    if(productCategory == 'bread'){
        //alert("bread ito");
        jQuery.get('/view-breads', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#bread').addClass('active');
    }
    else if(productCategory == 'breakfast'){
        //alert("bfast");

        jQuery.get('/view-breakfast', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#breakfast').addClass('active');
    } else if(productCategory == 'appetizer'){
        jQuery.get('/view-appetizers', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#appetizer').addClass('active');
    } else if(productCategory == 'groupMeals'){
        jQuery.get('/view-group-meals', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#groupMeals').addClass('active');
    }else if(productCategory == 'noodles'){
        jQuery.get('/view-noodles', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#noodles').addClass('active');
    }else if(productCategory == 'riceBowl'){
        jQuery.get('/view-rice-bowl', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#riceBOwl').addClass('active');  
    }else if(productCategory == 'soup'){
        jQuery.get('/view-soup', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#soup').addClass('active');   
    }else if (productCategory == 'beverages'){
        jQuery.get('/view-beverages', function(data){
            if(data.length > 0) {
                for(var index = 0; index<data.length; index++){
                    htmlString +="<a data-toggle='modal' data-target='#view-details' style='cursor:pointer' class='menu-item px-1 mx-1' id='" + data[0].id + "'>";
                    htmlString +="<div class='card  px-0 mx-1' style='width:9.3rem; height:5em;'>";
                    htmlString+="<div class='card-body px-2 py-2 mx-0'>";
                    htmlString+="<h6 class='card-title text-center'>"+data[index].productName;
                    htmlString +="</h6> </div> </div> </a>";
                    jQuery('#Menu').html(htmlString);
                }
            } else {
                htmlString += "<div class='container'> <p style='font-style:italic;'> No product available </p></div>";
                jQuery('#Menu').html(htmlString);
            }
        })
        jQuery('.makeorder').removeClass('active');
        jQuery('#beverages').addClass('active');
    }*/
});

function updateRestaurantTotal() {
    var totalPrice = 0;
    var prices = document.getElementsByClassName('restaurantPricesDaily');

    for (var index = 0; index < prices.length; index++) {
        //console.log(document.getElementsByClassName('invoicePrices')[index].innerHTML);
        totalPrice += parseInt(prices[index].innerHTML);
        //console.log(totalPrice);
    }
    document.getElementById('restaurantIncomeDaily').innerHTML = "";
    //document.getElementById('invoiceGrandTotal').innerHTML = totalPrice;

    jQuery('#restaurantIncomeDaily').html(parseFloat(totalPrice).toFixed(2));
}

jQuery(document).ready(function () {
    jQuery(document).on('', '#restaurantIncomeDaily', function () {
        updateRestaurantTotal();
    })
})


jQuery(document).ready(function(){
    jQuery('.change-register-details').click(function(){
        jQuery.get('change-register-details/'+$(this).attr('id'), function(data){

            console.log(data);
            
            var htmlString = "";
            htmlString += "<h5 class='text-center'>Shift Details</h5>";
            htmlString += "<div class='container'>";
            htmlString += "<table class='table table-sm borderless'>";
            htmlString += "<tr><td style='width:35%'>Shift Duration: </td>";
 
            
            jQuery('#modal-body1').html(htmlString);
            

            jQuery("#changeRegister").attr("href", "create-order/"+data[0].orderID);
            
        })
    });

}); 
jQuery(document).ready(function(){
    jQuery(document).on('click', '#Print', function(){
        jQuery(this).hide();
        window.print();
    })
})

jQuery(document).ready(function(){
    jQuery(document).on('click', '#printReport', function(){
        jQuery(this).hide();
        jQuery('#dateFilter').hide();
        window.print();

            })
})