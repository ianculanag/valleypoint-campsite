jQuery(document).ready(function(){
    jQuery('#additionalbed').click(function(){
        console.log("Gumana");
        var htmlString ="";
        htmlString += "<div class='col-md-3 mb-1'";
        htmlString +="<label for='unitID' No. of bunk/s </label>";
        htmlString +="<div class='input-group'>";
        htmlString +="<div class='input-group-prepend>'";
        htmlString +="<span class='input-group-text>'";
        htmlString +="<i class='fa fa-bed' aria-hidden='true'</i>";
        htmlString +="</span>";
        htmlString +="</div>";
        htmlString +="<input class='form-control' type='number' id='numberOfBunks' name='numberOfBunks required' placeholder='' value='1' min='1' max='20>";
        htmlString +="</div>";
        htmlString +="</div>";

        console.log(htmlString);

        jQuery('#unitDetails').append(htmlString);

    });
});

