jQuery(document).ready(function () {
    jQuery('.ingredientCategories').click(function () {
        var ingredientCategory = jQuery(this).attr('id');
        
        console.log("Working");
        var htmlString = "";
        
        jQuery.get('/view-ingredient-category/' + ingredientCategory, function (data) {
            console.log("Working ulit");
            
            if(data.length > 0) {
                console.log("Still working");
                var ingredientCount = 0;

                for (var index = 0; index < data.length; index++) {
                    ingredientCount++;

                    htmlString += "<table class='table table-sm dataTable stripe' cellspacing='0' id='inventoryTable'>";
                    htmlString += "<thead><tr> <th>No.</th> <th>Description</th> <th>Category</th> <th>Quantity Consumed</th>";
                    htmlString += "<th>Last Consumed</th> </tr></thead><tbody id='displayIngredientCategory'>";
                    htmlString += "<tr><td class='text-right pr-5'>" + ingredientCount + "</td>";
                    htmlString += "<td class='pl-3'>" + data[index].ingredientName + "</td>";
                    //htmlString += "<td class='pl-3'>" + displayNameSplit(data[index].ingredientCategory) + "</td>";
                    htmlString += "<td class='pl-3'>" + data[index].ingredientCategory + "</td>";
                    htmlString += "<td class='text-right pr-5'>" + data[index].quantity + "</td>";                
                    htmlString += "<td class='pl-3'>" + data[index].updated_at + "</td></tr></tbody></table>";

                    jQuery('#inventoryLibrary').html(htmlString);
                } 
            } else {
                htmlString += "<table class='table table-sm dataTable stripe' cellspacing='0' id='inventoryTable'>";
                htmlString += "<thead><tr> <th>No.</th> <th>Description</th> <th>Category</th> <th>Quantity Consumed</th>";
                htmlString += "<th>Last Consumed</th> </tr></thead><tbody id='displayIngredientCategory'></tbody></table>";

                jQuery('#inventoryLibrary').html(htmlString);
            } 
        });  
		jQuery('.categories').removeClass('active');
        jQuery('#this' + ingredientCategory).addClass('active');
    })
});

jQuery(document).ajaxComplete(function() {
    jQuery('#inventoryTable').DataTable();
})
/* function displayNameSplit(stringToConvert) {
    var text = stringToConvert;
    var result = text.replace( /([A-Z])/g, " $1" );
    var finalResult = result.charAt(0).toUpperCase() + result.slice(1); 

    return finalResult;
} */