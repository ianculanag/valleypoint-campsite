jQuery(document).ready(function () {
    jQuery('.ingredientCategories').click(function () {
		var ingredientCategory = jQuery(this).attr('id');

		displayIngredientCategory(ingredientCategory);

		jQuery('.ingredientCategories').removeClass('active');
		jQuery(this).addClass('active');
    })
});

function displayIngredientCategory(ingredientCategory) {	
    console.log("Working");
    var htmlString = "";
    
	jQuery.get('/view-ingredient-category/' + ingredientCategory, function (data) {
        console.log("Working ulit");
        
		if(data.length > 0) {
            console.log("Still working");
            var ingredientCount = 0;

			for (var index = 0; index < data.length; index++) {
                ingredientCount++;

                htmlString += "<tr><td class='text-right pr-5'>" + ingredientCount + "</td>";
                htmlString += "<td class='pl-3'>" + data[index].ingredientName + "</td>";
                //htmlString += "<td class='pl-3'>" + displayNameSplit(data[index].ingredientCategory) + "</td>";
                htmlString += "<td class='pl-3'>" + data[index].ingredientCategory + "</td>";
                htmlString += "<td class='text-right pr-5'>" + data[index].quantity + "</td>";                
                htmlString += "<td class='pl-3'>" + data[index].updated_at + "</td></tr>";

				jQuery('#displayIngredientCategory').html(htmlString);
			}
		} 
	})
}

/* function displayNameSplit(stringToConvert) {
    var text = stringToConvert;
    var result = text.replace( /([A-Z])/g, " $1" );
    var finalResult = result.charAt(0).toUpperCase() + result.slice(1); 

    return finalResult;
} */