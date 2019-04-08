<?php


 $url_redirect_page =  "
    <script> 
         window.location.href = \"".home_url()."\";
    </script>
    ";
if(!isset($_GET['srm']) ){
    //$homePage = get_option('home');
   
    
    echo $url_redirect_page;
    exit(0);
}
if(!is_numeric($_GET['srm'])){
    echo $url_redirect_page;
    exit(0);
}
include_once HOMETROTTING_API_DIR_PATH."lib/Hostaway_api_Listing.php"; 
if (empty(Hostaway_Api_secretKey()) && empty(Hostaway_Api_IdKey())) {
	echo "Please Give The Hostaway Secret Key & ID !";
	exit(0);
}else {
	$listing = new API_Listing( Hostaway_Api_secretKey() , Hostaway_Api_IdKey() );
    
    $val = $listing->get_All_Listing_array();
	$val_2 = $listing->get_All_Listing_json();
	$allRoomId = array();
    foreach($val['result']  as $value) {
        array_push($allRoomId,$value['id']);
    }
    
    if (in_array($_GET['srm'], $allRoomId)){
        
	    $val_2 = $listing->get_Individual_Listing_array($_GET['srm'.""]);
	    $val_amenity = $listing->get_amenity_array();
	    
        $all_val_amenity_my_variable = array();	  
        
        $d=strtotime("+24 Months");
        $startDate = date("Y-m-d");
        $endDate = date("Y-m-d", $d);
        
        $calender_val = $listing->get_Calendar_array($_GET['srm']."" , $startDate , $endDate );
    
        foreach($val_amenity['result'] as $value_loop){
            $all_val_amenity_my_variable[$value_loop['id']] = $value_loop['name'];
        }
        
        $RoomAllInfo = $val_2['result'];
        $RoomAllamenity = $val_2['result']['listingAmenities'];
        $RoomAllImages = $val_2['result']['listingImages'];
        
        $reserved_date = array();
        $not_reserved_date = array();
        $individual_date_price = array();
        $isisAvailableAddExtraOneValue = 0;
        foreach($calender_val['result'] as $value_cal){
            if($value_cal['isAvailable'] == 0){
                
                if($isisAvailableAddExtraOneValue == 0){
                    
                    array_push($reserved_date , $value_cal['date']);
                    
                }else{
                    $isisAvailableAddExtraOneValue = 0;
                    array_push($not_reserved_date , array($value_cal['date'] , $value_cal['price']." ".$RoomAllInfo["currencyCode"] ));
                
                }
                 
            }
            else{
                $isisAvailableAddExtraOneValue ++;
                array_push($not_reserved_date , array($value_cal['date'] , $value_cal['price']." ".$RoomAllInfo["currencyCode"] ));
                
                
            }
        }
    
    //echo $_SESSION['CHECKDATE_IN_DATE']." ".$_SESSION['CHECKDATE_OUT_DATE']." ".$_SESSION['NUMBER_OF_GUEST'] ;
    
        
       
        //echo "<pre>";
        //print_r($calender_val['result']);
        //echo "</pre>";
    
    	//echo "<pre>";
        //print_r($all_val_amenity_my_variable);
        //echo "</pre>";
        
        //echo "<pre>";
        //print_r($RoomAllInfo);
        
        //echo "</pre>";
        
        //echo "<pre>";
        //print_r($val_2['result']);
        //echo "</pre>";
        

        
        //echo "<pre>";
        //print_r($RoomAllInfo['listingAmenities']);
        
        //print_r($RoomAllInfo);
        //echo "</pre>";
        //$_SESSION["RoomInfo"] = $RoomAllInfo;
        
       // echo "<pre>";
       // print_r( $_SESSION["RoomInfo"] );
        
       // echo "</pre>";
    }
    else{
        echo $url_redirect_page;
        exit(0);
    }
    
    
}

function DateConvertForJavaScriptDatePicker($date){
        $d=strtotime($date);
                                        
		//n = month j = day
		$date_conv = date("Y-n-j", $d); 
        return $date_conv;
										
}

?>



    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- <meta http-equiv="Content-Security-Policy" content="default-src https://www.hometrotting.com/; child-src 'none'; object-src 'none'"> -->

  <!-- <meta http-equiv="Content-Security-Policy" content="default-src https://www.hometrotting.com/ 'self'">  -->
	
	<link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	
	<<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


	<!--Font Awesome (added because you use icons in your prepend/append)-->
	<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<!-- Inline CSS based on choices in "Settings" tab -->
	<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

	<style >
	

	.custom html,.custom body{

		width:100%;
		height:100%;

	}

    .custom	html,.custom body,.custom ul,.custom li{

		padding:0;
		margin:0;
		border:0;

		text-decoration:none;

	}

	ul.custom{

		width:100%;
		height:100%; 

		overflow-x:auto;
		overflow-y: hidden;


		white-space: nowrap;
		line-height: 0;
		font-size: 0;

	}


	.custom ul,.custom li{

		display:inline;

		height:100%;

	}

    .custom ul,.custom li,.custom img{

		max-height:100%;
		height:100%; 
		width:auto ;

	}
	
    	html.custom {
		overflow:   scroll;
	}  
	@media only and (max-width:767px)
	{
    	::-webkit-scrollbar {
    		
    		background: transparent; 
    	}
	}
	.w-100{
		max-height: 470px;
	}
	.borderedBox{

		background-color: #abe8dd;
		height: 55px;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		margin: 3%;
		margin-left: 0px; 
		padding: 2%;
		width: 100%;
		font-family: Poppins;

	}
	.webfont{
		font-family: Poppins;
		color: #1a1a1a;
		font-size: 1em;
		width: 100%;
		/*letter-spacing: 0.07em;*/ 
	}
	
	.label
	{
	    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	    display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
	}

	
</style>



</head>


<body >
	<h1 style='margin: 0px;padding:3%; font-family: Poppins;text-align: center;'> <?php echo $RoomAllInfo['name'];?> </h1>
    <div class= ' container-fluid d-flex justify-content-center  '>
	<div class="container " style="margin: 2%; ">
		<div class = 'row'>
			<div class = 'col-md-8 col-sm-12 order-1 order-md-0' style= ' height:50% ;padding-right: 2%;'>
				<div class="container-fluid" style= 'height:50% ;padding: 0px;'>
					<div id="carouselExampleControls" style = '' class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" style="">
						    
						   
							   <?php
					        if(count($RoomAllImages) >= 1){
					            $count = 0;
					            foreach($RoomAllImages as $room_image){
					                
					                if($count == 0){
					                    $count++;
					                    ?>
					                    
					                    
					                    <div class="carousel-item active" data-slide-to="0">
								            <img class="d-block img-fluid w-100" style ='object-fit: cover !important;'src="<?php echo $room_image['url'] ; ?>" alt="First slide">
							            </div>
					                    
					                    
					                    <?php
					                    
					                }
					                else{
					                    $count++;
                                    ?>
					               
					                
					               	<div class="carousel-item " data-slide-to="<?php echo $count - 1;?>">
								        <img class="d-block img-fluid w-100" style ='object-fit: cover !important;'src="<?php echo $room_image['url'] ; ?>" alt="other slide">
							        </div>
					                
					                
					                <?php
					                }
					                
					            }
					        }
					    
					    ?>
						    
						</div>
						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				
				<div class ='row custom' style="margin-left: 0px;margin-right: 0px; height: 125px;">
					<ul class='custom'>
					    
					    
					    
					    
					    <?php
					        if(count($RoomAllImages) >= 1){
					            $count = 0;
					            foreach($RoomAllImages as $room_image){
					                $count++;
					                ?>
					                
					                <li class='custom' id="<?php echo "UnderSliderOnClick_".$count;?>" slide-value ="<?php echo $count-1; ?>">
							            <img src="<?php echo $room_image['url']."-small";?>" style= 'object-fit: cover; padding: 1%;padding-left: 0px;'>
						            </li>
					                
					                
					                <script>
    
                                        jQuery(document).ready(function($) {
                                             $("#<?php echo "UnderSliderOnClick_".$count;?>").click(function(){
                                                    var clickedValue = $(this).attr("slide-value"); 
                                                    $('#carouselExampleControls').carousel(parseInt(clickedValue, 10))
                                             });
                                        });
    
                                </script>
					                
					                
					                <?php
					                
					            }
					        }
					    
					    ?>
					    

					</ul>
				</div>	
				<div class = 'row' style="border-bottom-style: solid; border-width: 1px;color:#1a1a1a;margin-left: 0px;margin-right: 0px;">
					<div class = 'col-6' style="padding: 0px;">
						<p class='webfont'style='text-align: left;margin-bottom: 0px;font-weight: 700;font-size: 17px;letter-spacing: 0.7px;'>
						    
						    <?php echo $RoomAllInfo['name'];?>
						    
						</p>
					</div>
					<div class = 'col-6' style="padding: 0px;text-align: right;">
						<span class='webfont'style='text-align: right;margin-bottom: 0px;margin-right:2%;color: #747474'>Start From </span>
						<span class='webfont'style='text-align: right;margin-bottom: 0px;color: #ff9e12'> <?php echo $RoomAllInfo['currencyCode']." ".$RoomAllInfo['price'];?> </span>
					</div>
				</div>
				
				
				
					<div class= "row" >
				    	<div class='col-xl-12' style = "margin: 3% 0px 3% 0px;">
				    	    
				    	    
				    	    <?php
				    	    if($RoomAllInfo['guestsIncluded'] >= 1){
				    	        echo "<span class = \"label\" style = \"background-color : #ff9e12;\">".$RoomAllInfo['guestsIncluded']." Guests</span>";
				    	    }
				    	     foreach($RoomAllamenity as $amenity){
					                
					               ?>
					               
					               <span class = "label " style = "background-color : #ff9e12;"> <?php echo $all_val_amenity_my_variable[$amenity['amenityId']];?></span>
					               
					               <?php
					               
				    	     }
					               ?>
					                
					       </div>
					 </div>    
				    	    
				    
				<div class= "row">
				    	
				    
				    
					<div class='col-lg-5 col-md-5 col-sm-12 col-xs-12' >
						<div class='borderedBox' >
							<img style= 'margin-right:2%;'src="https://img.icons8.com/material/32/000000/checked-2.png"> 
							<p style="color:#000;margin-bottom:0px;">Bathrooms number : </p>
							<p class="text-muted" style='margin-left: 5%;text-align: center;margin-bottom: 0px; '><?php echo $RoomAllInfo['bathroomsNumber'] + "  " + $RoomAllInfo['bathroomType'];?></p>
						</div>
						<div class='borderedBox' >
							<img style= 'margin-right:2%;' src="https://img.icons8.com/material/32/000000/checked-2.png"> 
							<p style="color:#000;margin-bottom:0px;">Bedrooms number : </p>
							<p class="text-muted" style='margin-left: 5%;text-align: center;margin-bottom: 0px; '><?php echo $RoomAllInfo['bedroomsNumber'] ;?></p>
						</div>
						<div class='borderedBox' >
							<img style= 'margin-right:2%;' src="https://img.icons8.com/material/32/000000/checked-2.png"> 
							<p style="color:#000;margin-bottom:0px;">Beds number : </p>
							<p class="text-muted" style='margin-left: 5%;text-align: center;margin-bottom: 0px; '><?php echo $RoomAllInfo['bedsNumber'] ;?></p>
						</div>
						
					</div>
					<div class='col-2'>
					</div>
					<div class='col-lg-5 col-md-5 col-sm-12 col-xs-12' >
						<div class='borderedBox' >
							<img style= 'margin-right:2%;' src="https://img.icons8.com/material/32/000000/checked-2.png"> 
							<p style="color:#000;margin-bottom:0px;">Monthly discount : </p>
							<p class="text-muted" style='margin-left: 5%;text-align: center;margin-bottom: 0px; '><?php echo ((1-$RoomAllInfo['monthlyDiscount'])*100)."%" ;?></p>
						</div>
						<div class='borderedBox' >
							<img style= 'margin-right:2%;' src="https://img.icons8.com/material/32/000000/checked-2.png"> 
							<p style="color:#000;margin-bottom:0px;">Weekly discount : </p>
							<p class="text-muted" style='margin-left: 5%;text-align: center;margin-bottom: 0px; '><?php echo ((1-$RoomAllInfo['weeklyDiscount'])*100)."%" ;?></p>
						</div>
						<div class='borderedBox' >
							<img style= 'margin-right:2%;' src="https://img.icons8.com/material/32/000000/checked-2.png"> 
							<p style="color:#000;margin-bottom:0px;">Person capacity : </p>
							<p class="text-muted" style='margin-left: 5%;text-align: center;margin-bottom: 0px; '><?php echo $RoomAllInfo['personCapacity'] ;?></p>
						</div>
						
					</div>

				</div>
				<div class ='row webfont'style='margin:0px;margin-bottom: 7%;margin-top: 4%;white-space: pre-line;'>
				    
				    <?php echo $RoomAllInfo['description'];?>
					
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12  order-0 order-md-1" style='padding: 4.2%;padding-top: 0px;padding-right: 2%;' id ="FullFormDiv">
				<div class = 'borderedBox' style ='margin-top: 0px;background-color:#ff9e12'><div style="font-family: Poppins;font-size: 16px;text-align: center !important;width:100%;font-weight: 400;color:#fff;text-transform: uppercase;">Check Availability</div>
				
			</div>
			<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
			<div class="bootstrap-iso">
				<div class="container-fluid" style='background-color: #ff9e12'>

					<div class="row" style='margin-top:5%;'>
						<div class="col-md-12 col-sm-12 col-xs-12" style='padding-right: 20px;padding-left: 20px;padding-bottom: 4%;'>
							<form method="post" action="javascript:void(0)" id ="BookingInfoRoomForm">
								<div class="form-group ">
									<label class="control-label " style='font-family: Poppins;color:#fff;font-weight: 400;' for="date">
										Check In
									</label>
									<div class="input-group">
										
										<!--<input class="form-control" id="date" name="date" placeholder="DD MM YYYY" type="text"/>-->
										<input type="text" id="DatepickerDatefrom" name="from" readonly  placeholder="YYYY-MM-DD" value="<?php echo  $_SESSION['CHECKDATE_IN_DATE'];?>" style="width:100%;" required>
									
										<?php 
										
										//echo DateConvertForJavaScriptDatePicker($reserved_date[1]);
										
										
										?>
									
									
										</label>
                                        
                                        
                                       
										
									
										
						
										
				
										<div class="input-group-addon" id="DatepickerDatefromIcon">
											<i class="fa fa-calendar" id="DatepickerDatefromIcon">
											</i>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<label class="control-label " style='font-family: Poppins;color:#fff;font-weight: 400;' for="date1">
										Check Out
									</label>
									<div class="input-group">
									<!--	<input class="form-control" id="date1" name="date1" placeholder="DD MM YYYY" type="text"/>-->
										 <input type="text" id="DatepickerDateTo" name="to"  readonly placeholder="YYYY-MM-DD" value="<?php echo $_SESSION['CHECKDATE_OUT_DATE'];?>" style="width:100%;"  required>
										<div class="input-group-addon" id="DatepickerDateToIcon">
											<i class="fa fa-calendar" id="DatepickerDateToIcon">
											</i>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<label class="control-label " style='font-family: Poppins;color:#fff;font-weight: 400;' for="name">
										Guest
									</label>
									<input class="form-control" id="NumberOfguest" min= "1" max = "<?php echo $RoomAllInfo['personCapacity'] ?>" value ="<?php if(isset($_SESSION['NUMBER_OF_GUEST'])) {echo $_SESSION['NUMBER_OF_GUEST'];}  else {echo "1";}?>" name="NumberOfguest" type="number" required/>
								</div>
								<input type="hidden" value = "<?php echo $RoomAllInfo['id']; ?>" name = "srm">
								<input type="hidden" id = "RoomPrice" value = "" name = "roomPrice">
								
								
								
								
								
							<!--
								<label for="from">From</label>
                                <input type="text" id="from" name="from"><br><br>
                                <label for="to">to</label>
                                <input type="text" id="to" name="to">
                                -->								
							
								
								
								
								
								
								
								
								<div class="form-group">
									<div>
									    
										<button class="btn btn-primary" disabled id="RoomInfosubmit" style='width:100%;font-family: Poppins;font-size:13px;background-color: #f8eda6;border:0px;color: #1a1a1a!important;border-radius: 0px;' type="submit">
											Book Now
										</button>
									</div>
								</div>
								
									<div id = "TotalValueOfRoom">
									
						            </div>
							</form>
						</div>
						
					
						
						
					</div>
				</div>
			</div>


			
		</div>


		
	</div>
</div>

<!--
<div id="map"></div>
    <script>

      function initMapTestWork() {
        var myLatLng = {lat: <?php echo $RoomAllInfo['lat']?>, lng: <?php echo $RoomAllInfo['lng']?>};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNqVMFtG92NUyWjFjJTRMiGiz5sb9xsJE&callback=initMapTestWork">
    </script>


</div>
-->
    
    
    






	<script>
  
  
  
                    		 	jQuery(document).ready(function() {
                    		 	    
                                       /*
                                       
                                        var dateFormat = "yy-mm-dd",
                                          from = jQuery( "#from" )
                                            .datepicker({
                                            dateFormat: "yy-mm-dd",
                                              defaultDate: "+1D",
                                              changeMonth: true,
                                              numberOfMonths: 1
                                            })
                                            .on( "change", function() {
                                              to.datepicker( "option", "minDate", getDate( this ) );
                                            }),
                                          to = jQuery( "#to" ).datepicker({
                                            dateFormat: "yy-mm-dd",
                                            defaultDate: "+1w",
                                            changeMonth: true,
                                            numberOfMonths: 1
                                          })
                                          .on( "change", function() {
                                                from.datepicker( "option", "maxDate", getDate( this ) );
                                          });
                                     
                                        function getDate( element ) {
                                          var date;
                                          try {
                                            date = $.datepicker.parseDate( dateFormat, element.value );
                                          } catch( error ) {
                                            date = null;
                                          }
                                     
                                          return date;
                                        }
                                    
                                                        		 	    
                    		 	    
                    		 	    */
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    <?php
                    		 	    
                    		 	   
                    		 	        if(isset($_SESSION['CHECKDATE_OUT_DATE']) && isset($_SESSION['CHECKDATE_OUT_DATE']) && isset($_SESSION['NUMBER_OF_GUEST']) ){
                    		 	            ?>
                    		 	             var val2 = jQuery("#DatepickerDateTo").val();
                                            var val1 = jQuery("#DatepickerDatefrom").val();
                    		 	            if(val2){
                                             
                                                         jQuery("#TotalValueOfRoom").html("<h3>Wait...</h3>");
                                                        var data = "grant_type=client_credentials&client_id=<?php echo Hostaway_Api_IdKey();?>&client_secret=<?php echo Hostaway_Api_secretKey();?>&scope=general";
            
                                                        var xhr = new XMLHttpRequest();
                                                        xhr.withCredentials = true;
                                                        
                                                        xhr.addEventListener("readystatechange", function () {
                                                          if (this.readyState === 4) {
                                                            
                                                            var data = JSON.parse(this.responseText);
                                                            if(data.status == "success"){
                                                                console.log(data.result);
                                                                var price = 0;
                                                                for (i = 0; i < data.result.length-1; i++) { 
                                                                    price +=  data.result[i].price;
                                                                }
                                                                var totalprice = <?php echo $RoomAllInfo['cleaningFee']?> + price;
                                                                var clearfee = "Cleaning Fee: <?php echo $RoomAllInfo['cleaningFee']."  ".$RoomAllInfo['currencyCode'];?> ";
                                                                var priceCode = "Reservation Fee: " +price + "<?php echo "  ".$RoomAllInfo['currencyCode'];?>";
                                                                var totalprice = "Total Fee: " + totalprice +"  <?php echo "  ".$RoomAllInfo['currencyCode'];?>";
                                                                
                                                                
                                                                jQuery("#RoomPrice").val(price);
                                                                jQuery("#RoomInfosubmit").removeAttr("disabled");
                                                                
                                                                jQuery("#TotalValueOfRoom").html("<h5>"+clearfee+"</h5><h5>"+priceCode+"</h5><h5>"+totalprice+"</h5>");
                                                            }
                                                            else{
                                                                var relode = "<?php echo get_option('HomeTrotting_Api_page_single_room_details')."?srm=".$_GET['srm'] ;?>";
                                                                window.location.href = relode;
                                                            }
                                                            
                                                           
                                                          }
                                                        });
                                                        
                                                        xhr.open("GET", "https://api.hostaway.com/v1/listings/<?php echo $_GET['srm'];?>/calendar?startDate="+val1+"&endDate="+val2+"&includeResources=1");
                                                        xhr.setRequestHeader("authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE");
                                                        xhr.setRequestHeader("cache-control", "no-cache");
                                                        
                                                        xhr.send(data);
                                             
                                                    }
                                                   
                    		 	            <?php
                    		 	        }
                    		 	    ?>
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	    
                    		 	     //var unavailableDates = ["<?php echo $date_conv; ?>", "<?php echo "2019-2-07" ?>", "<?php echo "2019-3-2" ?>"];
                    		 	     var unavailableDates = new Array();
                    		 	     var priceValue = new Array();
                                    <?php foreach($reserved_date as $value){ ?>
                                        unavailableDates.push('<?php echo DateConvertForJavaScriptDatePicker($value); ?>');
                                    <?php } ?>
                                    <?php foreach($not_reserved_date as $value){ ?>
                                        unavailableDates["<?php echo DateConvertForJavaScriptDatePicker($value[0]); ?>"] = "<?php echo $value[1]; ?>";
                                    <?php } ?>
                                    
                                    
                                    
                    		 	    jQuery("#BookingInfoRoomForm").validate({
                    		 	        
                    		 	         submitHandler:function(){
                    		 	             
                    		 	             
                    		 	             
                                              var dateCheckIn = jQuery("#DatepickerDatefrom").val();
                                              var dateCheckOut = jQuery("#DatepickerDateTo").val();
                                              var date1 = new Date(dateCheckIn);
                                              var date2 = new Date(dateCheckOut);
                                              var timeDiff = date2.getTime() - date1.getTime();
                                              
                                                                    
                                                                         
                                              
                                              
                                                if(timeDiff >= 1){
                                                    var postValue = jQuery("#BookingInfoRoomForm").serialize();
                                                    console.log(postValue);
                                                    var Url = "<?php echo get_option('HomeTrotting_Api_page_Book_In_info_page')."?"; ?>" + postValue ;
                                                    window.location.href = Url;
                                                    
                                        
                                                 }else{
                                                    alert("Please Give The Correct Check In & Check Out Date !!");
                                                    
                                                 }
                                                 dateCheckIn = dateCheckIn.replace(/(^|-)0+/g, "$1");
                                                 dateCheckOut = dateCheckOut.replace(/(^|-)0+/g, "$1");
                                                
                                                
                                                var parts = dateCheckIn.split('-');
                                               
                                                var StartDate = new Date(parts[0], parts[1] - 1, parts[2]); 
                                                
                                                
                                                 console.log(StartDate);       
                                                 
                                                 var dateMy = StartDate.getFullYear() + "-" + (StartDate.getMonth() + 1) + "-" + StartDate.getDate();
                                                
                                                 for(;dateMy !== dateCheckOut;){
                                                     dateMy.replace(/(^|-)0+/g, "$1")
                                                     
                                                     if (jQuery.inArray(dateMy, unavailableDates) !== -1) {
                                                         alert("Please select dates which are not around blocked dates.");
                                                         jQuery("#DatepickerDatefrom").val("");
                                                         jQuery("#DatepickerDateTo").val("");
                                                         jQuery("#FullFormDiv").attr("style", 'visibility: hidden');
                                                         var relode = "<?php echo get_option('HomeTrotting_Api_page_single_room_details')."?srm=".$_GET['srm'] ;?>";
                                                         window.location.href = relode;
                                                         break;
                                                     }
                                                     var parts = dateMy.split('-');
                                                     dateMy = new Date(parts[0], parts[1] - 1, parts[2]);
                                                     dateMy.setDate(dateMy.getDate() + 1);
                                                     dateMy = dateMy.getFullYear() + "-" + (dateMy.getMonth() + 1) + "-" + dateMy.getDate();
                                                     
                                                 }
                                                 
                                                  
                                                 
                                                 
                                                 
                    		 	            }
                                                
                    		 	        });
                    		 	    
                    		 	   
                    
                                    function unavailable(date) {
                                        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                                        
                                        dmy_2 = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
                                         
                                        if (jQuery.inArray(dmy_2, unavailableDates) == -1) {
                                            return [true, "GET_DATE_MONTH_VALUE" , unavailableDates[dmy_2] ];
                                        } else {
                                            return [false, "", "Unavailable"];
                                        }
                                    }
                    		 	    
                    		 	  
                    		 	     jQuery("#DatepickerDatefrom").datepicker({
                                        dateFormat: "yy-mm-dd",
                            			minDate: "+1D",
                            			maxDate: "+24M",
                                        beforeShowDay: unavailable,
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
                                    
                                    
                                    
                                    jQuery("#DatepickerDatefromIcon").on( "click", function() {
                                        
                                        
                                      jQuery( "#DatepickerDatefrom" ).datepicker( "show" );
                                            
                                        
                                        
                                    });
                                    
                                    jQuery("#DatepickerDateToIcon").on( "click", function() {
                                        
                                        
                                     var value = jQuery("#DatepickerDatefrom").val();
                                        if(!value){
                                            alert("Please Select The Check In date ");
                                            
                                        }else{
                                            jQuery("#DatepickerDateTo").datepicker( "show" );
                                        }
                                            
                                        
                                        
                                    });
                                    
                                   
                                   
                                   
                                    jQuery("#DatepickerDateTo").on( "click", function() {
                                        
                                        
                                        var value = jQuery("#DatepickerDatefrom").val();
                                        if(!value){
                                            alert("Please Select The Check In date ");
                                            
                                        }
                                        
                                        
                                        
                                    });
                                    //"+<?php //echo $RoomAllInfo['minNights']+1; ?>D"
                                    jQuery(document).on("change","#DatepickerDatefrom", function() {
                                            var value = jQuery("#DatepickerDatefrom").val();
                                            
                                            if(value){
                                                //alert(value);
                                                
                                                var date1 = new Date();
                                                var date2 = new Date(value);
                                                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                                                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                                                var checkoutDateStart = diffDays + <?php echo $RoomAllInfo['minNights'];?>;
                                                
                                                checkoutDateStart = "+"+checkoutDateStart+"D"
                                                //alert(checkoutDateStart);
                                                
                                                jQuery("#DatepickerDateTo"). removeAttr("disabled")
                                                 jQuery("#DatepickerDateTo").datepicker({
                                                    dateFormat: "yy-mm-dd",
                                        			minDate: checkoutDateStart,
                                        			maxDate: "+24M",
                                                    beforeShowDay: unavailable,
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
                                                
                                                
                                                
                                            }
                                            else{
                                                jQuery( "#DatepickerDatefrom" ).datepicker( "hide" );
                                                jQuery("#DatepickerDateTo").attr("disabled")
                                            }
                                     });
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     jQuery(document).on("change","#DatepickerDateTo", function() {
                                         
                                         
                                       
                                         
                                         
                                         
                                         
                                            var dateCheckIn = jQuery("#DatepickerDatefrom").val();
                                              var dateCheckOut = jQuery("#DatepickerDateTo").val();
                                              var date1 = new Date(dateCheckIn);
                                              var date2 = new Date(dateCheckOut);
                                              var timeDiff = date2.getTime() - date1.getTime();
                                              
                                                                    
                                                console.log(timeDiff);                                
                                              
                                            
                                                if(timeDiff >= 1){
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                dateCheckIn = dateCheckIn.replace(/(^|-)0+/g, "$1");
                                                dateCheckOut = dateCheckOut.replace(/(^|-)0+/g, "$1");
                                                 
                                                console.log(dateCheckIn);
                                                
                                                 //var StartDate = new Date(dateCheckIn);
                                                 
                                                 
                                                 var parts = dateCheckIn.split('-');
                                                // Please pay attention to the month (parts[1]); JavaScript counts months from 0:
                                                // January - 0, February - 1, etc.
                                                var StartDate = new Date(parts[0], parts[1] - 1, parts[2]); 
                            
                                                 console.log(StartDate);
                                                 
                                                 var dateMy = StartDate.getFullYear() + "-" + (StartDate.getMonth() + 1) + "-" + StartDate.getDate();
                                                 console.log(dateMy);
                                               
                                                 for(;dateMy !== dateCheckOut;){
                                                     
                                                     console.log(dateMy);
                                                     
                                                     dateMy.replace(/(^|-)0+/g, "$1")
                                                     
                                                     if (jQuery.inArray(dateMy, unavailableDates) !== -1) {
                                                          console.log(dateMy);
                                                         alert("Please select dates which are not around blocked dates.");
                                                         jQuery("#DatepickerDatefrom").val("");
                                                         jQuery("#DatepickerDateTo").val("");
                                                         jQuery("#FullFormDiv").attr("style", 'visibility: hidden');
                                                         
                                                         var relode = "<?php echo get_option('HomeTrotting_Api_page_single_room_details')."?srm=".$_GET['srm'] ;?>";
                                                         window.location.href = relode;
                                                         break;
                                                     }
                                                     
                                                     var parts = dateMy.split('-');
                                                
                                                     dateMy = new Date(parts[0], parts[1] - 1, parts[2]); 
                                                     //dateMy = new Date(dateMy);
                                                     dateMy.setDate(dateMy.getDate() + 1);
                                                     dateMy = dateMy.getFullYear() + "-" + (dateMy.getMonth() + 1) + "-" + dateMy.getDate();
                                                     console.log(dateMy);
                                                     
                                                 }
                                                 
                                                 
                                                 
                                                   var val2 = jQuery("#DatepickerDateTo").val();
                                                    var val1 = jQuery("#DatepickerDatefrom").val();
                                         
                                         
                                         
                                                if(val2){
                                             
                                                         jQuery("#TotalValueOfRoom").html("<h3>Wait...</h3>");
                                                        var data = "grant_type=client_credentials&client_id=<?php echo Hostaway_Api_IdKey();?>&client_secret=<?php echo Hostaway_Api_secretKey();?>&scope=general";
            
                                                        
                                                        var xhr = new XMLHttpRequest();
                                                        xhr.withCredentials = true;
                                                        
                                                        xhr.addEventListener("readystatechange", function () {
                                                          if (this.readyState === 4) {
                                                            
                                                            var data = JSON.parse(this.responseText);
                                                            if(data.status == "success"){
                                                                console.log(data.result);
                                                                var price = 0;
                                                                for (i = 0; i < data.result.length-1; i++) { 
                                                                    price +=  data.result[i].price;
                                                                }
                                                                var totalprice = <?php echo $RoomAllInfo['cleaningFee']?> + price;
                                                                var clearfee = "Cleaning Fee: <?php echo $RoomAllInfo['cleaningFee']."  ".$RoomAllInfo['currencyCode'];?> ";
                                                                var priceCode = "Reservation Fee: " +price + "<?php echo "  ".$RoomAllInfo['currencyCode'];?>";
                                                                var totalprice = "Total Fee: " + totalprice +"  <?php echo "  ".$RoomAllInfo['currencyCode'];?>";
                                                                
                                                                
                                                                jQuery("#RoomPrice").val(price);
                                                                jQuery("#RoomInfosubmit").removeAttr("disabled");
                                                                
                                                                jQuery("#TotalValueOfRoom").html("<h5>"+clearfee+"</h5><h5>"+priceCode+"</h5><h5>"+totalprice+"</h5>");
                                                            }
                                                            else{
                                                                var relode = "<?php echo get_option('HomeTrotting_Api_page_single_room_details')."?srm=".$_GET['srm'] ;?>";
                                                                window.location.href = relode;
                                                            }
                                                            
                                                           
                                                          }
                                                        });
                                                        
                                                        xhr.open("GET", "https://api.hostaway.com/v1/listings/<?php echo $_GET['srm'];?>/calendar?startDate="+val1+"&endDate="+val2+"&includeResources=1");
                                                        xhr.setRequestHeader("authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE");
                                                        xhr.setRequestHeader("cache-control", "no-cache");
                                                        
                                                        xhr.send(data);
                                             
                                                    }
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                  
                                        
                                                 }else{
                                                    alert("Please Give The Correct Check In & Check Out Date !!");
                                                    
                                                 }
                                                
                                             
                                         
                                        
                                         
                                            
                                     });
                                     

                                     jQuery("#DatepickerDatefrom").on("click", function() {
                    		 	        jQuery( ".GET_DATE_MONTH_VALUE" ).tooltip();
                
                                    });
                                     jQuery("#DatepickerDateTo").on("click", function() {
                    		 	        jQuery( ".GET_DATE_MONTH_VALUE" ).tooltip();
                
                                    });
                                    
                                    jQuery(document).on("click",".ui-datepicker-next" ,function() {
                    		 	      
                    		 	        jQuery( ".GET_DATE_MONTH_VALUE" ).tooltip();
                
                                    });
                                    
                                     
                                     jQuery(document).on( "mouseenter", ".GET_DATE_MONTH_VALUE", function(){
  		                                 
 
                                            jQuery(this).tooltip(); 
  		                               
                                       
  		
                                        });
                             
                                
                                     
                                   
                                     
                    
                    		 	});
                    		 	
                    		 	  
                    		 	    
                    		
                     
                      </script>
                      
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
-->
</body>

