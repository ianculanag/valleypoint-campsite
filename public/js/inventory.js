/* View Inventory */
jQuery(document).ready(function () {
    jQuery('.ingredientCategories').click(function () {

        var category = jQuery(this).attr('id');
        var inventoryReportTab = jQuery('.inventory-reports-tabs.active').attr('id');
        
        if (inventoryReportTab == 'dailyInventory') {
            
            var onDate = moment(jQuery('#lodgingReportDate').val()).format('YYYY-MM-D');
            
            jQuery.get('/view-inventory/daily/' + category + '/' + onDate, function (data) {
                loadInventoryTable(data);
            });

        } else if (inventoryReportTab == 'monthlyInventory') {

            var onMonth = jQuery('#selectMonth').val();
            var onYear = jQuery('#selectYear').val();
            
            jQuery.get('/view-inventory/monthly/' + category + '/' + onMonth + '/' + onYear , function (data) {
                loadInventoryTable(data);
            });

        } else if (inventoryReportTab == 'customInventory') {

            var fromDate = moment(jQuery('#fromDate').val()).format('YYYY-MM-D');
            var toDate = moment(jQuery('#toDate').val()).format('YYYY-MM-D');
            
            jQuery.get('/view-inventory/custom/' + category + '/' + fromDate + '/' + toDate , function (data) {
                loadInventoryTable(data);
            });

        }

        if (category == 'allCategories') {
            jQuery('.categories').removeClass('active');
            jQuery('#all-categories').addClass('active');
        } else {
            jQuery('.categories').removeClass('active');
            jQuery('#this-' + category).addClass('active');
        }
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

        if (jQuery(this).attr('id') == 'loadDailyInventory') {

            var onDate = moment(jQuery('#lodgingReportDate').val()).format('YYYY-MM-D');

            jQuery.get('/view-inventory/daily/' + category + '/' + onDate, function (data) {
                loadInventoryTable(data);
            });

        } else if (jQuery(this).attr('id') == 'loadMonthlyInventory') {

            var onMonth = jQuery('#selectMonth').val();
            var onYear = jQuery('#selectYear').val();

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
    jQuery('#productsTable').DataTable();
    jQuery('#ingredientTable').DataTable();
})

function loadInventoryTable(data) {
    var htmlString = "";

    if (data.length > 0) {
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

/* View Menu */
jQuery(document).ready(function () {
    jQuery('.product-categories').click(function () {

        var category = jQuery(this).attr('id');
        
        jQuery.get('/view-menu-recipe/' + category, function (data) {
            loadProductsTable(data);
        });

        if (category == 'allProducts') {
            jQuery('.product-categories').removeClass('active');
            jQuery('#allProducts').addClass('active');
        } else {
            jQuery('.product-categories').removeClass('active');
            jQuery('#' + category).addClass('active');
        }
    })
    jQuery(document).on('click', '.menuItemList', function () {

        var menuItem = jQuery(this).attr('id');

        jQuery.get('/load-recipe/' + menuItem, function (data) {

            jQuery("#productName").html(data[0].productName + " Recipe");
            htmlString = "";

            if (data.length > 0) {
                for (var index = 0; index < data.length; index++) {
                    htmlString += "<tr><td class='py-2'>" + data[index].ingredientName + "</td>";
                    htmlString += "<td class='text-right py-2'>" + data[index].quantity + "</td></tr>";
                }
            } else {
                htmlString += "<tr><td colspan='2' class='text-center py-2'>Add ingredients to " + data[0].productName + "</td></tr>";
            }

            jQuery("#recipe").html(htmlString);
            jQuery("#editRecipe").prop('disabled', false);
        });
    })
});

function loadProductsTable(data) {
    var htmlString = "";

    if (data.length > 0) {
        var productCount = 0;

        htmlString += "<table class='table table-sm dataTable compact' cellspacing='0' id='productsTable'>";
        htmlString += "<thead><tr> <th style='width:10%'>No.</th> <th>Product Name</th> <th style='width:15%'>Price</th> <th style='width:21%'>Price (guest)</th>";
        htmlString += "</tr></thead><tbody id='displayProductCategory'>";

        for (var index = 0; index < data.length; index++) {
            productCount++;

            htmlString += "<tr id=" + data[index].id + " class='menuItemList' style='cursor:pointer'>";
            htmlString += "<td class='text-right pr-5'>" + productCount + "</td>";
            htmlString += "<td class='pl-3'>" + data[index].productName + "</td>";
            htmlString += "<td class='pl-3'>" + data[index].price + "</td>";
            htmlString += "<td class='text-right pr-5'>" + data[index].guestPrice + "</td></tr>";
        } 

        htmlString += "</tbody></table>";
        jQuery('#productsLibrary').html(htmlString);
    } else {
        htmlString += "<table class='table table-sm dataTable compact' cellspacing='0' id='productsTable'>";
        htmlString += "<thead><tr> <th>No.</th> <th>Product Name</th> <th>Price</th> <th>Price (guest)</th>";
        htmlString += "</tr></thead><tbody id='displayProductCategory'></tbody></table>";

        jQuery('#productsLibrary').html(htmlString);
    } 
}

/* View Ingredients */
jQuery(document).ready(function () {
    jQuery('.ingredient-categories').click(function () {

        var category = jQuery(this).attr('id');
        
        jQuery.get('/view-ingredients/' + category, function (data) {
            loadIngredientTable(data);
        });

        if (category == 'allCategories') {
            jQuery('.categories').removeClass('active');
            jQuery('#all-categories').addClass('active');
        } else {
            jQuery('.categories').removeClass('active');
            jQuery('#this-' + category).addClass('active');
        }
    })
});

function loadIngredientTable(data) {
    var htmlString = "";

    if (data.length > 0) {
        var ingredientCount = 0;

        htmlString += "<table class='table table-sm dataTable compact stripe' cellspacing='0' id='ingredientTable'>";
        htmlString += "<thead><tr> <th style='width:10%'>No.</th> <th class='pl-3' style='width:50%'>Description</th>";
        htmlString += "<th style='width:25%' class='pl-3'>Category</th><th>Action</th></tr></thead><tbody id='displayIngredientCategory'>";

        for (var index = 0; index < data.length; index++) {
            ingredientCount++;

            htmlString += "<tr><td class='text-center pr-5'>" + ingredientCount + "</td>";
            htmlString += "<td class='pl-3'>" + data[index].ingredientName + "</td>";
            htmlString += "<td class='pl-3'>" + data[index].ingredientCategory + "</td>";
            htmlString += "<td><a href='edit-ingredient/" + data[index].id + "'>";
            htmlString += "<button class='btn btn-sm btn-info'>Edit</button></a>";
            htmlString += "<a id='" + data[index].id + "' class='delete-ingredient-modal' data-toggle='modal' data-target='#deleteIngredientModal'>";
            htmlString += "<button class='btn btn-sm btn-danger mx-1'>Delete</button></a></td></tr>";
        } 

        htmlString += "</tbody></table>";
        jQuery('#ingredientLibrary').html(htmlString);

    } else {
        htmlString += "<table class='table table-sm dataTable compact stripe' cellspacing='0' id='ingredientTable'>";
        htmlString += "<thead><tr> <th style='width:10%'>No.</th> <th class='pl-3' style='width:50%'>Description</th>";
        htmlString += "<th style='width:25%' class='pl-3'>Category</th><th>Action</th></tr></thead><tbody id='displayIngredientCategory'></tbody></table>";

        jQuery('#ingredientLibrary').html(htmlString);
    } 
}