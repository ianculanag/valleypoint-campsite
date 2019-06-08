/* Delete service */
jQuery(document).ready(function(){
    jQuery('.delete-service-modal').click(function(){
        jQuery.get('/delete-service-modal/'+$(this).attr('id'), function(data){
            
            console.log(data);

            var htmlString = "";

            htmlString += "<p class='mx-3'><strong>Warning!</strong> Are you sure you want to delete " + data[0].serviceName + "?</p>";
            htmlString += "<div class='card'><div class='card-body'><table class='table table-sm borderless mb-0'>";
            htmlString += "<tr><td style='width:38%'>Service type: </td>";
            htmlString += "<td>" + data[0].serviceType + "</td></tr>";
            htmlString += "<tr><td style='width:38%'>Service name: </td>";
            htmlString += "<td>" + data[0].serviceName + "</td></tr>";
            htmlString += "<tr><td style='width:38%'>Price: </td>";
            htmlString += "<td>₱&nbsp;" + data[0].price + "</td></tr>";
            htmlString += "<tr><td style='width:38%'>Price (lean): </td>";
            htmlString += "<td>₱&nbsp;" + data[0].leanPrice + "</td></tr>";
            htmlString += "<tr><td style='width:38%'>Price (peak): </td>";
            htmlString += "<td>₱&nbsp;" + data[0].peakPrice + "</td></tr></table></div></div>";

            jQuery('#deleteServiceModalBody').html(htmlString);
            jQuery("#confirmServiceDeletion").attr("href", "/confirm-service-deletion/"+data[0].serviceID);
            jQuery("#deleteServiceForm").attr("action", "/confirm-service-deletion/"+data[0].serviceID);
        })
    });
}); 

/* Delete unit */
jQuery(document).ready(function(){
    jQuery('.delete-unit-modal').click(function(){
        jQuery.get('/delete-unit-modal/'+$(this).attr('id'), function(data){
            
            console.log(data);

            var htmlString = "";

            htmlString += "<p class='mx-3'><strong>Warning!</strong> Are you sure you want to delete " + data[0].unitNumber + "?</p>";
            htmlString += "<div class='card'><div class='card-body'><table class='table table-sm borderless mb-0'>";
            htmlString += "<tr><td style='width:28%'>Unit type: </td>";
            htmlString += "<td>" + data[0].unitType + "</td></tr>";
            htmlString += "<tr><td style='width:28%'>Unit number: </td>";
            htmlString += "<td>" + data[0].unitNumber + "</td></tr>";
            htmlString += "<tr><td style='width:28%'>Capacity: </td>";
            htmlString += "<td>" + data[0].capacity + "</td></tr></table></div></div>";

            htmlString += "<input type='hidden' name='thisUnit' value='"+ data[0].unitID +"'>";

            jQuery('#deleteUnitModalBody').html(htmlString);
            jQuery("#confirmUnitDeletion").attr("href", "/confirm-unit-deletion/"+data[0].unitID);
            jQuery('#deleteUnitForm').attr("action", "/confirm-unit-deletion/"+data[0].unitID);
        })
    });
});

/* Delete ingredient */
jQuery(document).ready(function(){
    jQuery('.delete-ingredient-modal').click(function(){
        jQuery.get('/delete-ingredient-modal/'+$(this).attr('id'), function(data){
            
            console.log(data);

            var htmlString = "";

            htmlString += "<p class='mx-3'><strong>Warning!</strong> Are you sure you want to delete " + data[0].ingredientName + "?</p>";
            htmlString += "<div class='card'><div class='card-body'><table class='table table-sm borderless mb-0'>";
            htmlString += "<tr><td style='width:40%'>Ingredient name: </td>";
            htmlString += "<td>" + data[0].ingredientName + "</td></tr>";
            htmlString += "<tr><td style='width:40%'>Category: </td>";
            htmlString += "<td>" + data[0].ingredientCategory + "</td></tr></table></div></div>";

            htmlString += "<input type='hidden' name='thisIngredient' value='"+ data[0].id +"'>";

            jQuery('#deleteIngredientModalBody').html(htmlString);
            jQuery("#confirmIngredientDeletion").attr("href", "/confirm-ingredient-deletion/"+data[0].id);
            jQuery('#deleteIngredientForm').attr("action", "/confirm-ingredient-deletion/"+data[0].id);
        })
    });
});