jQuery(document).ready(function(){
    jQuery(document).on('click', '.restaurant-tables', function(){
        var name = jQuery(this).attr('id');
        console.log(name);

        var nameSliced =jQuery(this).attr('id').slice(5);

        var htmlString ="";
        //<!-- Modal -->
         htmlString+="<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
         htmlString+="<div class='modal-dialog' role='document'>";
         htmlString+="<div class='modal-content'>";
         htmlString+="<div class='modal-header'>";
         htmlString+="<h5 class='modal-title' id='exampleModalLabel'> Table "+nameSliced+"</h5>";
         htmlString+="<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
         htmlString+="<span aria-hidden='true'>&times;</span>";
         htmlString+="</button>";
         htmlString+="</div>";
         htmlString+="<div class='modal-body'>";
         htmlString+="<strong>Table status:</strong> Available<br>";
         htmlString+="<strong>Capacity:</strong> 4pax";    
         htmlString+="</div>";
         htmlString+="<div class='modal-footer'>";
         htmlString+="<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>";
         //htmlString+="<a href=''>";
         htmlString+="<button type='button' name='button"+nameSliced+"' class='btn btn-primary occupyButton' data-dismiss='modal'>Occupy</button>";
         //htmlString+="</a>";
         htmlString+="</div>";
         htmlString+="</div>";
         htmlString+="</div>";
         htmlString+="</div>"; 

        jQuery('.dynamicModal').html(htmlString);
        
    });

    jQuery(document).on('click', '.occupyButton', function(){
        //console.log("gumagana yung occupyButton");

        var buttonId = jQuery(this).attr('name').slice(6);
        var badge = jQuery('.badgeStatus').attr('id').slice(5);
        //console.log(badge);
        //console.log(button);

        var htmlString = "";

        htmlString+="<span class='badge badge-danger float-right badgeStatus' style='font-size:.55em;' id='"+badge+"'>Occupied</span>";

        jQuery('#badge'+buttonId).html(htmlString);
        //jQuery('#')

    });
});
