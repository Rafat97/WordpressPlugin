<!DOCTYPE html>
<html>
<head>

	<link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'></title >
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

	<!--Font Awesome (added because you use icons in your prepend/append)-->
	<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<!-- Inline CSS based on choices in "Settings" tab -->
	<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>


	<title></title>
</head>
<style >
.webfont{
	font-family: Poppins;
	color: #ffffff;
	font-weight:300 !important;
}
.nrow{
	width:100%;
	display: flex;
	flex-wrap: wrap;
}
.ncol-1{
	width:18%;
	margin: 1%;
}

.webfont2{
	font-family: Poppins;
	color: #1a1a1a;
	letter-spacing: 0.07em; 
}
@media only screen and (max-width: 640px) {
  .hider {
    display:none;
  }
}
</style>
<body>
    <div class="container-fluid" style="background-image: url(https://www.hometrotting.com/wp-content/uploads/2019/02/montreal-optimized-overlay-1.jpg);margin-top:180px;background-size:cover;background-repeat:no-repeat;background-position:center;">
		<div class ='row' style="padding-top:30px;">
			<div class='col-3'> </div>
			<div class='col-md-6 col-lg-6 col-sm-12'style='justify-content:center;'>
				<h1 style="text-align: center;font-family: Poppins;color: #abe9dd">FEEL AT HOME<br> AWAY FROM HOME</h1>
				<p style="text-align: center;font-family: Poppins;color:#fff;max-width: 700px;margin: auto;line-height: 30px;margin-top: 3%;">You deserve to see, live and experience Montreal at its best. With HomeTrotting, you can book fully-furnished apartments in the heart of Montreal for both short-term and extended stays. No matter what part of the world you’re coming from, you’ll feel at home even when you’re away from it.
				</p>
			</div>
			<div class='col-3'> </div>

	
		</div>
    	<div class="bootstrap-iso" style='padding:30px 0px 70px;background:transparent;'>
    		<div class="container" style=''>
    		    <h3 style='text-align:center;font-weight:300;color:#abe9dd;'> CHECK AVAILABILITIES</h3>
    			<div class="row " style="display: flex;justify-content: center;">
    
    			    <form action='javascript:void(0)' method="get" id = "formRoomSearch">
    				
    				<div class="col-md-3 col-sm-12 col-xs-12">
    					
    						<div class="form-group center-in-mobile">
    							<label class="control-label webfont" for="date1" style='color:#fff;'>
    								Check In
    							</label>
    							<div class="input-group">
    								<input  style='background-color:#ffffff;width:100%;' id="dateCheckIn" name="dateCheckIn" required readonly placeholder="YYYY MM DD" type="text"/>
    								<div class="input-group-addon" id="dateCheckInIcon">
    									<i class="fa fa-calendar">
    									</i>
    								</div>
    							</div>
    						</div>
    						<div class="form-group">
    						</div>
    					
    				</div>
    				<div class="col-md-3 col-sm-12 col-xs-12">
    					
    						<div class="form-group center-in-mobile">
    							<label class="control-label webfont" for="date1" style='color:#fff;'>
    								Check Out
    							</label>
    							<div class="input-group">
    								<input style='background-color:#ffffff;width:100%;' id="dateCheckOut" name="dateCheckOut" required readonly placeholder="YYYY MM DD" type="text"/>
    								<div class="input-group-addon" id="dateCheckOutIcon">
    									<i class="fa fa-calendar">
    									</i>
    								</div>
    							</div>
    						</div>
    						<div class="form-group">
    						</div>
    					
    				</div>
    				<div class="col-md-3 col-sm-12 col-xs-12" style='display:inline-block;'>
    					
    						<div class="form-group center-in-mobile" style=" display: inline-block;">
    							<label class="control-label webfont" for="select" style='color:#fff;'>
    								Guests
    							</label>
    						    <div class="input-group">
    							    <input class="form-control" style='background-color:#ffffff;padding-right:40%;' id="guests_number" min='1' value="1" name="guests_number" placeholder="Guest" type="number"/>
    					        </div>
    						</div>
    						
    					
    				</div>
    		
    				    <div class="col-md-3 col-sm-12 col-xs-12 center-in-mobile" >
    
    
    						<div class="form-group " style=" display: inline-block;">
    							<label class="control-label webfont" for="select" >
    								
    							</label>
    						    <div class="input-group">
    							    <button class="btn btn-primary webfont " style='background-color:#abe9dd;color:#1a1a1a !important;width:120px;border-radius:0px;margin-top: 4px; ' type="submit">Search</button>
    					        </div>
    						</div>
    
    					
    				    </div>
    		        </form>
    			</div>
    		</div>
    	</div>
	</div>
	<div class ='container-fluid d-flex justify-content-center' style='background-color: #1a1a1a;'>
	    

    </div>
    
    
    
    <script>
        jQuery(document).ready(function(){   
        
                                    jQuery("#dateCheckIn").datepicker({
                                        dateFormat: "yy-mm-dd",
                            			minDate: "+1D",
                            			maxDate: "+24M",
                                        numberOfMonths: 1,
                                        showButtonPanel: true,
                                         beforeShow: function (textbox, instance) {
                                                                   var txtBoxOffset = jQuery(this).offset();
                                                                   var top = txtBoxOffset.top;
                                                                   var left = txtBoxOffset.left;
                                                                   var textBoxWidth = jQuery(this).outerWidth();
                                                                   console.log('top: ' + top + 'left: ' + left);
                                                                           setTimeout(function () {
                                                                               instance.dpDiv.css({
                                                                                   top: top, //you can adjust this value accordingly
                                                                                   left: left //show at the end of textBox
                                                                           });
                                                                       }, 0);
                                                            
                                                                    },
                                        
                                    });
                                    
                                   
                                    
                                     jQuery("#dateCheckInIcon").on( "click", function() {
                                        
                                        
                                      jQuery( "#dateCheckIn" ).datepicker( "show" );
                                            
                                        
                                        
                                    });
                                    
                                    jQuery("#dateCheckOutIcon").on( "click", function() {
                                        
                                        
                                     var value = jQuery("#dateCheckIn").val();
                                        if(!value){
                                            alert("Please Select The Check In date ");
                                            
                                        }else{
                                            jQuery("#dateCheckOut").datepicker( "show" );
                                        }
                                            
                                        
                                        
                                    });
                                    
                                    jQuery("#dateCheckOut").on( "click", function() {
                                        
                                        
                                     var value = jQuery("#dateCheckIn").val();
                                        if(!value){
                                            alert("Please Select The Check In date ");
                                            
                                        }else{
                                            jQuery("#dateCheckOut").datepicker( "show" );
                                        }
                                            
                                        
                                        
                                    });
                                    
                                      jQuery(document).on("change","#dateCheckIn", function() {
                                           var value = jQuery("#dateCheckIn").val();
                                            if(value){
                                                var date1 = new Date();
                                                var date2 = new Date(value);
                                                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                                                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                                                var checkoutDateStart = diffDays + 1;
                                                
                                                checkoutDateStart = "+"+checkoutDateStart+"D"
                                                
                                                console.log(value+"  "+checkoutDateStart);
                                                
                                                
                                                 jQuery("#dateCheckOut").datepicker({
                                                        dateFormat: "yy-mm-dd",
                                            			minDate: checkoutDateStart,
                                            			maxDate: "+24M",
                                                        numberOfMonths: 1,
                                                        showButtonPanel: true,
                                                        beforeShow: function (textbox, instance) {
                                                                                   var txtBoxOffset = jQuery(this).offset();
                                                                                   var top = txtBoxOffset.top;
                                                                                   var left = txtBoxOffset.left;
                                                                                   var textBoxWidth = jQuery(this).outerWidth();
                                                                                   console.log('top: ' + top + 'left: ' + left);
                                                                                           setTimeout(function () {
                                                                                               instance.dpDiv.css({
                                                                                                   top: top, //you can adjust this value accordingly
                                                                                                   left: left //show at the end of textBox
                                                                                           });
                                                                                       }, 0);
                                                                            
                                                                                    },
                                                        
                                                    });
                                            
                                           
                                            }else{
                                                alert("Please Select The Check In date ");
                                            }
                                          
                                      });
                                    

                  });                 
        
    </script>
    
    
    
    
    
    
    
    
    
    
    <script>
    
 
    jQuery("#formRoomSearch").validate({
          submitHandler:function(){
              var dateCheckIn = jQuery("#dateCheckIn").val();
              var dateCheckOut = jQuery("#dateCheckOut").val();
              var date1 = new Date(dateCheckIn);
              var date2 = new Date(dateCheckOut);
              var timeDiff = date2.getTime() - date1.getTime();
              
                                        
                                                
              
              
                if(timeDiff >= 1){
                    var postValue = jQuery("#formRoomSearch").serialize();
                    var Url = "<?php echo get_option('HomeTrotting_Api_page_Search_All_room_details')."?"; ?>" + postValue ;
                    window.location.href = Url;
        
                 }else{
                    alert("Please Give The Correct Check In & Check Out Date !!");
                    
                }
                    
                   
    
    
    
                
             
          }
     
    });


</script>
    
    
  
    
    
    
    
    
    
    
    
    
    






