<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>
<body>

<div class="container">
  
  <form action="javascript:void(0)" method="post" id="FormReviewSystemForm" enctype="multipart/form-data">
      <h2>Give Your Information For Review System</h2>
     <div class="form-group">
      <label for="Name">Business Name : </label>
      <input type="text" class="form-control" id="UserBusinessName" placeholder="Enter Business Name" name="UserBusinessName" required>
    </div>
      
    <div class="form-group">
      <label for="Name">Email : </label>
      <input type="email" class="form-control" id="UserName" placeholder="Enter Business Email" name="UserEmail" required>
    </div>
    <div class="form-group">
      <label for="Name">Facebook:</label>
      <input type="text" class="form-control  link-group" id="FacebookLink" placeholder="Enter Your Facebook Link" name="FacebookLink">
    </div>
    <div class="form-group">
      <label for="Name">Google:</label>
      <input type="text" class="form-control  link-group" id="GoogleLink" placeholder="Enter Your Google Link" name="GoogleLink">
    </div>
    <div class="form-group">
      <label for="Name">RateMDs:</label>
      <input type="text" class="form-control link-group" id="RateMDsLink" placeholder="Enter Your RateMDs Link" name="RateMDsLink">
    </div>
    <div class="form-group">
      <label for="Name">Yelp:</label>
      <input type="text" class="form-control link-group" id="YelpLink" placeholder="Enter Your Yelp Link" name="YelpLink">
    </div>
    <div class="form-group">
      <label for="Name">RealSelf:</label>
      <input type="text" class="form-control link-group" id="RealSelfLink" placeholder="Enter Your RealSelf Link" name="RealSelfLink" >
    </div>
    
    <div class="form-group form-check">
         <label for="Name">Logo Upload (500KB):</label>
      <label class="form-check-label">
        <input type="file" name="fileToUpload" id="fileToUpload" required>
      </label>
    </div>
     
    <button type="submit" class="btn btn-primary " id="SubmitButtonJquary">Submit</button>
  </form>
  
  
  <br><br><br>

<div id="LinkShow">
    
</div>

</div>
<br><br><br>


<script>
    
    $(document).ready(function(){
        
        jQuery.validator.setDefaults({
          debug: true,
          success: "valid"
        });
        jQuery.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than 500KB');

        jQuery.validator.setDefaults({
          debug: true,
          success: "valid"
        });

        jQuery("#FormReviewSystemForm").validate({
             rules: {
                FacebookLink: {
                 require_from_group: [1, ".link-group"],
                  url: true,
                  
                },
                GoogleLink: {
                  require_from_group: [1, ".link-group"],
                  url: true,
                  
                },
                RateMDsLink: {
                  require_from_group: [1, ".link-group"],
                  url: true,
                  
                },
                YelpLink: {
                  require_from_group: [1, ".link-group"],
                  url: true,
                  
                },
                RealSelfLink: {
                  require_from_group: [1, ".link-group"],
                  url: true,
                  
                },
                fileToUpload: {
                    required: true,
                    extension: "jpg,jpeg,png,svg",
                    filesize: 500000,
                }
              },
              submitHandler:function(){
                  jQuery("#SubmitButtonJquary").attr('disabled',true);
                  
                         var ajax = "<?php echo admin_url("admin-ajax.php")."?action=FormReviewSystemForm&file=ajax" ?>";
                          //$form = $(this);
                
                            var form = $('#FormReviewSystemForm');
                            var formdata = false;
                            
                            if (window.FormData){
                                formdata = new FormData(form[0]);
                            }
                        
                        
                              
                              console.log(ajax);
                              console.log(formdata);
                              
                              $.ajax({
                
                          xhr: function()
                                {
                                  var xhr = new window.XMLHttpRequest();
                                  //Upload progress
                                  xhr.upload.addEventListener("progress", function(evt){
                                    if (evt.lengthComputable) {
                                      var percentComplete = evt.loaded / evt.total;
                                      //Do something with upload progress
                                      console.log(Math.floor(percentComplete * 100)+"%");
                                    }
                                  }, false);
                                 
                                  //Download progress
                                  /*
                                  xhr.addEventListener("progress", function(evt){
                                    if (evt.lengthComputable) {
                                      var percentComplete = evt.loaded / evt.total;
                                      //Do something with download progress
                                      console.log(percentComplete * 100);
                                    }
                                  }, false);
                                  */
                                  return xhr;
                                },
                              
                            url : ajax,
                            data : formdata ? formdata : form.serialize(),
                            type : 'POST',
                        	contentType : false,
                       		processData : false,
                          success : function(data){
                            	console.log(data); 
                            	 var jsonData = jQuery.parseJSON(data);
                            	 console.log(jsonData);
                            	 if(jsonData.status == "success"){
                            	    jQuery("#FormReviewSystemForm").hide();
                            	    jQuery("#LinkShow").html("<h1>"+jsonData.message+"</h1>")
                            	 }else{
                            	     jQuery("#SubmitButtonJquary").attr('disabled',false);
                            	     jQuery("#LinkShow").html("<h4>"+jsonData.message+"</h4>")
                            	 }
                            	 
                            }
                        });
                             
                  
              },
        });
        
        
        
       
    });
    
</script>

</body>
</html>
