jQuery(document).ready(function () {
    jQuery('.ingredientCategories').click(function () {
		var ingredientCategory = jQuery(this).attr('id');

		displayCategoryItems(ingredientCategory);

		jQuery('.ingredientCategories').removeClass('active');
		jQuery(this).addClass('active');
    })
});

function displayIngredientCategory(ingredientCategory) {	
	var htmlString = "";
	jQuery.get('/view-ingredient-category/' + ingredientCategory, function (data) {
		if (data.length > 0) {
			for (var index = 0; index < data.length; index++) {
				
				jQuery('#displayIngredientCategory').html(htmlString);
			}
		} 
	})
}