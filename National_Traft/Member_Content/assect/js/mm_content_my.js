jQuery(document).ready(function($) {
    
        jQuery("#WithoutReport").DataTable();
        jQuery("#highlights_Row").DataTable();
        jQuery("#FairOdds").DataTable();
        jQuery("#FairOdds_buy").DataTable();
});


jQuery(document).ready(function($) {


    jQuery("#btnImage").on("click", function() {
        var images = wp.media({
            title: "Upload Image",
            multiple: false
        }).open().on("select", function(e) {
            var uploadedImages = images.state().get("selection").first();
            console.log(uploadedImages.toJSON().url);
            var FileLink = uploadedImages.toJSON().url;
            jQuery("#FileLink").val(FileLink);
           
            
        });
    });


    jQuery("#frmPost").validate({
      submitHandler:function(){
            var file = jQuery("#FileLink").val();
            if (!file) {
                alert("Please select the file");
            }
            else{
                var postValue = "action=WithoutReport&parem=WithoutReportAdd_Data&"+jQuery("#frmPost").serialize();
                console.log(postValue);
                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    console.log(response);

                    var data = jQuery.parseJSON(response);
                    if (data.status == 1) {
                        jQuery.notifyBar({
                            cssClass : "success",
                            html : data.message,
                            position: "bottom"
                        });
                    }
                    
                }) ;



            }
         
      }
     
    });

      jQuery(document).on('click', '.WithoutReport_dataDelete', function() {
         var deletId = jQuery(this).attr("data-id");
         var isdeleteConfirm = confirm("Are You want to delete data?");
         //alert(deletId);
         if (isdeleteConfirm) {
                var postValue = "action=WithoutReport&parem=WithoutReportDelete_Data&id="+deletId;
                 console.log(postValue);
                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    console.log(response);

                    var data = jQuery.parseJSON(response);
                    if (data.status == 1) {
                        jQuery.notifyBar({
                            cssClass : "success",
                            html : data.message,
                            position: "bottom"
                        });
                        setTimeout(function(){
                            location.reload();
                        },100)
                    }
                    
                }) ;
            }
                

      });



});




/*
    Tips Part
*/




jQuery(document).ready(function($) {
     jQuery("#TipsDataShow").DataTable();

    jQuery("#TipsFormPost").validate({
      submitHandler:function(){
            //confirm("Hello")
            var Tipstitle = jQuery("#tipsTitle").val().trim();
            var FullTips = jQuery("#FullTipsValue").val().trim();
            if(Tipstitle != "" && FullTips != ""){
                 
                var value =jQuery("#TipsFormPost").serialize();
                var postValue = "action=Tips&parem=TipsAdd_Data&"+value;
                console.log(postValue);

                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    

                    var data = jQuery.parseJSON(response);

                   
                    if (data.status == 1) {
                        jQuery.notifyBar({
                            cssClass : "success",
                            html : data.message,
                            position: "bottom"
                        });
                    }
                }) ;



            }
            else{
                 alert("Please Type All the Filled !!")
            }

           
      }
     
    });



    jQuery(document).on('click', '.Test_dataDelete', function() {
         var deletId = jQuery(this).attr("data-id");
         var isdeleteConfirm = confirm(deletId);

         
         if(isdeleteConfirm){
                console.log(isdeleteConfirm);
                var postValue = "action=Tips&parem=TipsDelete_Data&id="+deletId;
                console.log(postValue);
                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    console.log(response);

                    var data = jQuery.parseJSON(response);
                    if (data.status == 1) {
                        jQuery.notifyBar({
                            cssClass : "success",
                            html : data.message,
                            position: "bottom"
                        });
                        setTimeout(function(){
                            location.reload();
                        },500)
                    }
                    
                    
                }) ;

         }
   

      });





    
});




jQuery(document).ready(function($) {
        
        jQuery("#frmPost_highlights").validate({
          submitHandler:function(){
                var postValue = "action=Highlights&parem=Highlights_Data_RowOnly&"+jQuery("#frmPost_highlights").serialize();
                // alert("Ok");  
                 console.log(postValue)
                 jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    //console.log(response);

                    var data = jQuery.parseJSON(response);
                    if (data.status == 1) {
                        jQuery.notifyBar({
                            cssClass : "success",
                            html : data.message,
                            position: "bottom"
                        });
                    }
                    
                    
                }) ;
             
          }
     
    });


        jQuery(document).on('click', '.HighlightsRow_dataDelete', function() {
         var deletId = jQuery(this).attr("data-id");
         var isdeleteConfirm = confirm("Are You want to delete data?");
         //alert(deletId);
         if (isdeleteConfirm) {
                var postValue = "action=Highlights&parem=Highlights_Data_RowOnly_Delete&id="+deletId;
                 //console.log(postValue);
                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    //console.log(response);

                    var data = jQuery.parseJSON(response);
                    if (data.status == 1) {
                        jQuery.notifyBar({
                            cssClass : "success",
                            html : data.message,
                            position: "bottom"
                        });
                        setTimeout(function(){
                            location.reload();
                        },100)
                    }
                    
                }) ;
                
            }
            
                

      });
   

});







jQuery(document).ready(function($) {

    jQuery("#btnImage_fairOdds").on("click", function() {
        
        var images = wp.media({
            title: "Upload File",
            multiple: false
        }).open().on("select", function(e) {
            var uploadedImages = images.state().get("selection").first();
           // console.log(uploadedImages.toJSON().url);
            var FileLink = uploadedImages.toJSON().url;
            jQuery("#FileLink_fairOdds").val(FileLink);
           
            
        });
    });



    jQuery("#frmPost_fairOdds").validate({
          submitHandler:function(){
                var file = jQuery("#FileLink_fairOdds").val();
                if (!file) {
                    alert("Please select the file");
                }
                else{
                    var postValue = "action=FairOdds&parem=FairOddsAdd_Data&"+jQuery("#frmPost_fairOdds").serialize();
                    console.log(postValue);
                    
                    jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                       // console.log(response);

                        
                        var data = jQuery.parseJSON(response);
                        if (data.status == 1) {
                            jQuery.notifyBar({
                                cssClass : "success",
                                html : data.message,
                                position: "bottom"
                            });
                            setTimeout(function(){
                            location.reload();
                            },500)
                        }
                    
                        
                    }) ;



                }
             
          }
         
        });





    jQuery(document).on('click', '.FairOdds_dataDelete', function() {
         var deletId = jQuery(this).attr("data-id");
         var isdeleteConfirm = confirm("Are You want to delete data?");
         //alert(deletId);
         if (isdeleteConfirm) {
                var postValue = "action=FairOdds&parem=FairOdds_Data_Delete&id="+deletId;
                 //console.log(postValue);
                
                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    //console.log(response);

                    var data = jQuery.parseJSON(response);
                    if (data.status == 1) {
                        jQuery.notifyBar({
                            cssClass : "success",
                            html : data.message,
                            position: "bottom"
                        });
                        setTimeout(function(){
                            location.reload();
                        },100)
                    }
                    
                }) ;
                
                
            }
            
                

      });


});
