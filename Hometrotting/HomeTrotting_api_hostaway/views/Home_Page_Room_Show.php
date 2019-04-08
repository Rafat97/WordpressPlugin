<?php 

include_once HOMETROTTING_API_DIR_PATH."lib/Hostaway_api_Listing.php"; 

if (empty(Hostaway_Api_secretKey()) && empty(Hostaway_Api_IdKey())) {
	echo "Please Give The Hostaway Secret Key & ID !";
	exit(0);
}
else {
	$listing = new API_Listing( Hostaway_Api_secretKey() , Hostaway_Api_IdKey() );
	//$vale = 
	$val = $listing->get_All_Listing_array();
	$val_2 = $listing->get_All_Listing_json();

	//print_r($val) ;
	echo "<pre>";
//	print_r($val['result']);
    echo "</pre>";

    unset($_SESSION['CHECKDATE_IN_DATE']);
    unset($_SESSION['CHECKDATE_OUT_DATE']);
    unset($_SESSION['NUMBER_OF_GUEST']);

	//echo "<br><br>".$vale."<br><br>";
}





?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<style>
    .rooms{
        background-color:#fff;
    }
    .featured-rooms-button
    {
		border-radius: 0px;
		background-color: #abe9dd;
		color:#1a1a1a!important;
		padding:13px;
		width:100%;
		font-family: Poppins;
		border-color: transparent;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 13px;
	}
	.webfont{
		font-family: Poppins;
		color: #1a1a1a;
		font-size: 1em;
		/*letter-spacing: 0.07em;*/ 
	}
	.featured-rooms-title, .featured-rooms-title:hover
	{
	    color:#1a1a1a!important;
	}
	.gdlr-full-size-wrapper .gdlr-show-all{
	padding-bottom:0px;
}
    @media only screen and (max-width: 767px) 
    {
      .hider {
        display:none;
      }

    }
    
    .featured-rooms-cards
    {
        padding-right: 12px!important;
        padding-left: 12px!important;        
    }
    
    .cards-holder
    {
        margin: 0 auto;
        max-width: 400px;

        display: block;

        box-shadow: 0px 6px 12px 4px rgba(0,0,0,0.1);
        padding: 16px;
    }
    #carouselExampleIndicators .icon-angle-left:before {
        color: #000;
        font-size: 35px;
    } 
     #carouselExampleIndicators .icon-angle-right:before {
        color: #000;
        font-size: 35px;
    } 
   
     @media only screen and (min-width: 767px)
    {
        .bigV_hider{
            display:none;
        }
    }
    @media only screen and (max-width: 767px)
    {
        .gdlr-item-title-head .gdlr-flex-prev, .gdlr-item-title-head .gdlr-flex-next 
        {
            display: inline-block;
        }
        .gdlr-item-title-wrapper .gdlr-item-title-carousel 
        {
            position: relative;
            right: 0px!important;
            top: 25px;
        }
    }
</style>
<div class="gdlr-parallax-wrapper gdlr-background-image gdlr-show-all gdlr-skin-light-grey rooms" id="gdlr-parallax-wrapper-1" data-bgspeed="0.1" style=" padding-top: 80px; padding-bottom: 0px; ">
    <div class="container" style="max-width:100%;">
        <div class="gdlr-item-title-wrapper gdlr-item pos-center gdlr-nav-container ">
            <div class="gdlr-item-title-head">
                <h3 class="gdlr-item-title gdlr-skin-title gdlr-skin-border">Featured Rooms</h3>
                <div class="gdlr-item-title-carousel"><i class="icon-angle-left gdlr-flex-prev"></i><i class="icon-angle-right gdlr-flex-next"></i></div>
                <div class="clear"></div>
            </div><a class="gdlr-item-title-link" href="<?php echo get_option('HomeTrotting_Api_page_all_room_details');; ?>">View All Rooms<i class="fa fa-long-arrow-right icon-long-arrow-right"></i></a></div>
        <div class="room-item-wrapper type-modern">
            <div class="room-item-holder ">
                <div class="gdlr-room-carousel-item gdlr-item">
                    <div class="flexslider" data-type="carousel" data-nav-container="room-item-wrapper" data-columns="4">
                        <div class="clear"></div>
                        <div class="flex-viewport" style="overflow: hidden; position: relative;">
                            <ul class="slides" style="width: 1600%; margin-left: -1140px;">
                                
                                
                                <?php
                                $SingelPageLink = get_option('HomeTrotting_Api_page_single_room_details');
                                //echo "<h1>".count( $val['result'] )."</h1>";
                                if(count( $val['result'] ) >= 1){
                                    
                                    foreach ($val['result']  as $value) {
                                       
                                   
                                    $url = $SingelPageLink."?srm=".$value["id"];
                                    //."?room=".$value["id"];
                                ?>
                                
                                
                                <li class="gdlr-item gdlr-modern-room featured-rooms-cards" >
                                    <div class="cards-holder">
                                        <div class="gdlr-room-thumbnail">
                                            <a href="<?php echo $url; ?>"><img src="<?php  echo $value["thumbnailUrl"]; ?>" alt="" width="700" height="400" draggable="false"></a>
                                        </div>
                                        <h3 class="gdlr-room-title" style='height:50px;margin-left:0px;'><a href="<?php echo $url; ?>" class="featured-rooms-title"><?php  echo $value["name"]; ?></a></h3>
                                        <p class = "card-text webfont" style="color:#1a1a1a;"><i class="fas fa-map-marker-alt" style="color:#1a1a1a;"> </i> <?php  echo $value["city"]; ?></p>
    					                <p class="card-text" style="color: #ffab4c;font-family: Poppins"> <?php  echo $value["currencyCode"]." ".$value["price"]; ?></p>   
                                        <a href="<?php echo $url; ?>" class="btn featured-rooms-button">View Details</a>
                                    </div>
                                </li>
                                    
                                    
                                    
                                    
                                <?php
                               
                                
                                  }
                                }
                                
                                ?>    
                                    
                                    

                            
                            
                            
                            
                            
                            
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="text-align:center;"><a href="https://www.hometrotting.com/all-rooms/" class="btn featured-rooms-button" style="max-width: 200px; border-radius: 30px;background-color:#ffa856;" >View All Rooms</a></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="clear"></div>
    </div>


    <!--Feel at home div -->
    <div class = 'container-fluid' style='background-color: #ffffff;width:100% !important ;padding:1px;'>
    	<div class = 'row'>
    		<div class='col-md-2 col-lg-2' >
    		</div>
    		<div class='col-md-8 col-lg-8' >
        		<div class = 'container' style='width:75%;margin-top: 5%;'>
        			<h4 style='text-align:center;font-weight:600;'> ALL YOUR BASES ARE COVERED</h4>
        			<h4 style='text-align:center;font-weight:600;'> WHILE #HOMETROTTING</h4>
        
        			<p class='webfont2' style='text-align:center;margin-top: 3%;font-weight: 200!important;'>You don’t have to worry about anything when you stay in one of our rooms. Everything’s taken care of like it would be back home.</p>
        		</div>
        		<style>
        		    .bases-covered-icon
                    {
                        height:260px; 
                        width:350px;
                        display: inline-block; 
                        align-items: center; 
                        justify-content: center;
                    }
                    @media only screen and (max-width:767px)
                    {
                        .bases-covered-icon
                        {
                            
                            width: 250px;
                            margin: 0 auto;
                        }
                    }
        		</style>
        		<div class = 'container' style='margin-top: 5%;'>
        			<div class= 'row hider'>
        			    <!--
        				<div class='col-md-1'>
        				</div>
        				-->
        				<div class ='col-md-4 col-sm-12 bases-covered-icon'>
        					<div style='display: flex;align-items: center; justify-content: center;padding:10px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-02.png"  class="img-fluid" style='height:110px;' alt="Responsive image">
        					</div>
        					<div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Cleaning Service</div>
        				</div>
        				<!--
        				<div class ='col-md-2 col-sm-12 bases-covered-icon'>
        					<div style='display: flex;align-items: center; justify-content: center;padding:10px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-03.png"  class="img-fluid" style='' alt="Responsive image">
        					</div>
        					<div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Free Parking</div>
        				</div>
        				-->
        				<div class ='col-md-4 col-sm-12 bases-covered-icon'>
        					<div style='display: flex;align-items: center; justify-content: center;padding:10px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-01.png"  class="img-fluid" style='height:110px;' alt="Responsive image">
        					</div>
        					<div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Fully Furnished</div>
        				</div>
        				<div class ='col-md-4 col-sm-12 bases-covered-icon'>
        					<div style='display: flex;align-items: center; justify-content: center;padding:10px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-04.png"  class="img-fluid" style='height:110px;' alt="Responsive image">
        					</div>
        					<div class='webfont2' style='display: flex;align-items: center; justify-content: center;'>Free Wifi</div>
        				</div>
        				<!--
        				<div class ='col-md-2 col-sm-12 bases-covered-icon'>
        					<div style='display: flex;align-items: center; justify-content: center;padding:10px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-05.png"  class="img-fluid" style='' alt="Responsive image">
        					</div>
        					<div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Airport Transfers</div>
        
        				</div>
        				
        				<div class='col-md-1'>
        				</div>
        				-->
        			</div>
                     <div id="carouselExampleIndicators" class="carousel slide bigV_hider" style="padding-bottom:25px;" data-ride="carousel">
                         
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <div style='display: flex;align-items: center; justify-content: center;padding:25px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-02.png"  class="img-fluid" style='' alt="Responsive image">
        					   </div>
        					   <div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Cleaning Service</div>
                            </div>
                            <!--
                            <div class="carousel-item">
                              <div style='display: flex;align-items: center; justify-content: center;padding:25px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-03.png"  class="img-fluid" style='' alt="Responsive image">
        					   </div>
        					   <div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Free Parking</div>
                            </div>
                            -->
                            <div class="carousel-item">
                              <div style='display: flex;align-items: center; justify-content: center;padding:25px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-01.png"  class="img-fluid" style='' alt="Responsive image">
        					   </div>
        					   <div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Fully Furnished</div>
                            </div>
                            <div class="carousel-item">
                              <div style='display: flex;align-items: center; justify-content: center;padding:25px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-04.png"  class="img-fluid" style='' alt="Responsive image">
        					   </div>
        					   <div class='webfont2' style='display: flex;align-items: center; justify-content: center;'>Free Wifi</div>
                            </div>
                            <!--
                            <div class="carousel-item">
                              <div style='display: flex;align-items: center; justify-content: center;padding:25px;'>
        						<img src="https://www.hometrotting.com/wp-content/uploads/2019/01/Icons-05.png"  class="img-fluid" style='' alt="Responsive image">
        					   </div>
        					   <div class='webfont2' style='display: flex;align-items: center; justify-content: center;text-align:center;'>Airport Transfers</div>
                            </div>
                            -->
                          </div>
                          <a class="carousel-control-prev " href="#carouselExampleIndicators" style="margin-left:-25px;" role="button" data-slide="prev">
                            <span class="icon-angle-left gdlr-flex-prev " aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next " href="#carouselExampleIndicators" style="margin-right:-25px;" role="button" data-slide="next">
                            <span class="icon-angle-right gdlr-flex-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
        		</div>
	        </div>
    		<div class='col-md-2 col-lg-2' style='padding:0px;text-align:right;' >
    			<img class='img-fluid hider' src='https://www.hometrotting.com/wp-content/uploads/2019/01/Vector-Smart-Object_11.png' style='object-fit: cover;max-height: 550px;'>
        	</div>
	    </div>
    </div>







    <!--
    <div class ='container-fluid ' style="background-color:#fff;margin-top: 0px;padding-bottom:0px;">
        <div class='row'>
            <div class='col-md-4 col-sm-12 hider' style='padding: 0px;'><img src ='https://www.hometrotting.com/wp-content/uploads/2019/01/Vector-Smart-Object_overlay.png ' class='img-fluid'> </div> 
            <div class='col-md-4 col-sm-12 'style='margin-top: auto;margin-bottom: auto;'><h3 style='text-align: center;font-family: Poppins'>CORPORATE & EXTENDED </h3>
            	<h2 style='text-align: center;font-family: Poppins'>STAY CLIENTS
            	</h2>
            </div> 
            <div class='col-md-4 col-sm-12'> </div> 
        </div>
    
    </div>    
    -->
</div>


