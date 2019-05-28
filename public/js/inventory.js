jQuery(document).ready(function () {
    jQuery('.ingredientCategories').click(function () {

        var ingredientCategory = jQuery(this).attr('id');
        
        jQuery.get('/view-ingredient-category/' + ingredientCategory, function (data) {
            loadInventoryTable(data);
        });  

		jQuery('.categories').removeClass('active');
        jQuery('#this-' + ingredientCategory).addClass('active');
    })

    jQuery('#all-categories').click(function () {

        jQuery.get('/view-all-ingredient-category/', function (data) {
            loadInventoryTable(data);
        });

        jQuery('.categories').removeClass('active');
        jQuery('#all-categories').addClass('active');
    })

    jQuery('.inventory-reports-tabs').click(function () {
        
        var ingredientConsumption = jQuery(this).attr('id');

        jQuery('.inventory-reports-tabs').removeClass('active');
        jQuery('#' + ingredientConsumption).addClass('active');

        jQuery('.inventory-inputs').hide();
        jQuery('#' + ingredientConsumption + 'Input').show();
    })

    jQuery('.load-inventory').click(function() {

        var id = jQuery('.categories.active').attr('id').split('-');
        var category = id[1];

        console.log(category);

        if (jQuery(this).attr('id') == 'loadDailyInventory') {

            var onDate = moment(jQuery('#lodgingReportDate').val()).format('YYYY-MM-D');

            jQuery.get('/view-inventory/daily/' + category + '/' + onDate, function (data) {
                loadInventoryTable(data);
            });

        } else if (jQuery(this).attr('id') == 'loadMonthlyInventory') {

            var onMonth = jQuery('#selectMonth').val();
            var onYear = jQuery('#selectYear').val();

            //console.log(onMonth, onYear);
            jQuery.get('/view-inventory/monthly/' + category + '/' + onMonth + '/' + onYear , function (data) {
                loadInventoryTable(data);
            });

        } else if (jQuery(this).attr('id') == 'loadCustomInventory') {

            var fromDate = moment(jQuery('#fromDate').val()).format('YYYY-MM-D');
            var toDate = moment(jQuery('#toDate').val()).format('YYYY-MM-D');

            jQuery.get('/view-inventory/custom/' + category + '/' + fromDate + '/' + toDate , function (data) {
                loadInventoryTable(data);
            });
        }
    })
});

jQuery(document).ajaxComplete(function() {
    jQuery('#inventoryTable').DataTable();
})

function loadInventoryTable(data) {
    var htmlString = "";

    if(data.length > 0) {
        var ingredientCount = 0;

        htmlString += "<table class='table table-sm dataTable stripe' cellspacing='0' id='inventoryTable'>";
        htmlString += "<thead><tr> <th>No.</th> <th>Description</th> <th>Category</th> <th>Quantity Consumed</th>";
        htmlString += "<th>Last Consumed</th> </tr></thead><tbody id='displayIngredientCategory'>";

        for (var index = 0; index < data.length; index++) {
            ingredientCount++;

            htmlString += "<tr><td class='text-right pr-5'>" + ingredientCount + "</td>";
            htmlString += "<td class='pl-3'>" + data[index].ingredientName + "</td>";
            //htmlString += "<td class='pl-3'>" + displayNameSplit(data[index].ingredientCategory) + "</td>";
            htmlString += "<td class='pl-3'>" + data[index].ingredientCategory + "</td>";
            htmlString += "<td class='text-right pr-5'>" + data[index].quantity + "</td>";                
            htmlString += "<td class='pl-3'>" + moment(data[index].updated_at).format('llll') + "</td></tr>";
        } 

        htmlString += "</tbody></table>";
        jQuery('#inventoryLibrary').html(htmlString);

    } else {
        htmlString += "<table class='table table-sm dataTable stripe' cellspacing='0' id='inventoryTable'>";
        htmlString += "<thead><tr> <th>No.</th> <th>Description</th> <th>Category</th> <th>Quantity Consumed</th>";
        htmlString += "<th>Last Consumed</th> </tr></thead><tbody id='displayIngredientCategory'></tbody></table>";

        jQuery('#inventoryLibrary').html(htmlString);
    } 
}

/* function displayNameSplit(stringToConvert) {
    var text = stringToConvert;
    var result = text.replace( /([A-Z])/g, " $1" );
    var finalResult = result.charAt(0).toUpperCase() + result.slice(1); 

    return finalResult;
} */