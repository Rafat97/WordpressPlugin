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
	//print_r($val['result']);
    echo "</pre>";

	//echo "<br><br>".$vale."<br><br>";
}



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
   <!-- <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'></title> -->
	
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
	<!--
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    -->
    
	<style>
	.btn {
		background-color: #abe9dd; 
		border: none; /* Remove borders */
		color: #1a1a1a; /* White text */
		border-radius: 0px;
		width:100%;
		padding: 12px 16px; /* Some padding */
		font-size: 16px; /* Set a font size */
		cursor: pointer; /* Mouse pointer on hover */
	}
	.card {
		/* Add shadows to create the "card" effect */
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		transition: 0.3s;
	}
	.webfont{
		font-family: Poppins;
		color: #1a1a1a;
		font-size: 1em;
		/*letter-spacing: 0.07em;*/ 
	}
</style>
</head>
<body>
	<h1 style="padding: 3%;font-family: Poppins;text-align: center;">ALL ROOMS</h1>
	<div class = 'container' >
	    
	    
	    
		<div class="card-deck" style ='margin-bottom: 5%;'  >
		    
		    
	      <?php
                    $SingelPageLink = get_option('HomeTrotting_Api_page_single_room_details');
                    //echo "<h1>".count( $val['result'] )."</h1>";
                    if(count( $val['result'] ) >= 1){
                           $count = 0;
                            foreach($val['result']  as $value) {
                                       
                                $url = $SingelPageLink."?srm=".$value["id"];
                                    //."?room=".$value["id"];
                                    
                                    
            ?>
	    
			<div class="card" style="height:515px;"  >
				<img class=" card-img-top" src="<?php  echo $value["thumbnailUrl"]; ?>" alt="<?php  echo $value["name"]; ?>" style="padding: 5%;object-fit: cover;">
				<div class="card-body " style="max-height:38vh;">
					<h5 class="card-title webfont" style='font-weight: 700; text-transform: uppercase;height:33px;' ><?php  echo $value["name"]; ?></h5>

					<p class = "card-text webfont" ><i class="fas fa-map-marker-alt"> </i> <?php  echo $value["city"]; ?></p>
					<p class="card-text" style="color: #ffab4c;font-family: Poppins"> <?php  echo $value["currencyCode"]." ".$value["price"]; ?></p>
					<a href ="<?php  echo $url ?>">
					    <button class="btn webfont" style="font-weight: 650; ">VIEW DETAILS</button>
					</a>
				</div>

			</div>
			
			
			<?php
			                    $count++;
                                if($count%3 == 0){
                                    
                                    echo "</div>";
                                    
                                    echo "<div class=\"card-deck\" style ='margin-bottom: 5%;'>";
                                    //break;
                                }
			
                            }
                             if($count%3 != 0){
                                	echo "<div class=\"card\" style=\"height:515px;visibility: hidden;\"  ></div>";
                                	 echo "</div>";
                                    echo "<div class=\"card-deck\" style ='margin-bottom: 5%;'>";
                            }
                             echo "</div>";
                             
                    }
			?>
			
	<!--		
			
			
			<div class="card" style="height:515px;"  >
				<img class=" card-img-top" src="https://www.hometrotting.com/wp-content/uploads/2019/01/room1.png" alt="Card image cap" style="padding: 5%;object-fit: cover;">
				<div class="card-body " style="max-height:38vh;">
					<h5 class="card-title webfont" style='font-weight: 700; text-transform: uppercase;height:33px;' >BELL CENTER APARTMENTS -TDC</h5>

					<p class = "card-text webfont" ><i class="fas fa-map-marker-alt"> </i> Montreal</p>
					<p class="card-text" style="color: #ffab4c;font-family: Poppins"> $ 150</p>
					<button class="btn webfont" style="font-weight: 650; ">VIEW DETAILS</button>
				</div>

			</div>
			<div class="card" style="height:515px;"  >
				<img class=" card-img-top" src="https://www.hometrotting.com/wp-content/uploads/2019/01/room1.png" alt="Card image cap" style="padding: 5%;object-fit: cover;">
				<div class="card-body " style="max-height:38vh;">
					<h5 class="card-title webfont" style='font-weight: 700; text-transform: uppercase;height:33px;' >PRIME LOCATION - DLM</h5>

					<p class = "card-text webfont" ><i class="fas fa-map-marker-alt"> </i> Montreal</p>
					<p class="card-text" style="color: #ffab4c;font-family: Poppins"> $ 150</p>
					<button class="btn webfont" style="font-weight: 650; ">VIEW DETAILS</button>
				</div>

			</div>
			
			-->
		
		<!--
	
		</div>
		
		
		
		<div class="card-deck" style ='margin-bottom: 5%;'  >
			<div class="card" style="height:515px;"  >
				<img class=" card-img-top" src="https://www.hometrotting.com/wp-content/uploads/2019/01/room1.png" alt="Card image cap" style="padding: 5%;object-fit: cover;">
				<div class="card-body " style="max-height:38vh;">
					<h5 class="card-title webfont" style='font-weight: 700; text-transform: uppercase;height:33px;' >St. Francois Xavier - 1 Bdr</h5>

					<p class = "card-text webfont" ><i class="fas fa-map-marker-alt"> </i> Montreal</p>
					<p class="card-text" style="color: #ffab4c;font-family: Poppins"> $ 150</p>
					<button class="btn webfont" style="font-weight: 650; ">VIEW DETAILS</button>
				</div>

			</div>
			<div class="card" style="height:515px;"  >
				<img class=" card-img-top" src="https://www.hometrotting.com/wp-content/uploads/2019/01/room1.png" alt="Card image cap" style="padding: 5%;object-fit: cover;">
				<div class="card-body " style="max-height:38vh;">
					<h5 class="card-title webfont" style='font-weight: 700; text-transform: uppercase;height:33px;' >Bright 1BR Apartment</h5>

					<p class = "card-text webfont" ><i class="fas fa-map-marker-alt"> </i> Montreal</p>
					<p class="card-text" style="color: #ffab4c;font-family: Poppins"> $ 150</p>
					<button class="btn webfont" style="font-weight: 650; ">VIEW DETAILS</button>
				</div>

			</div>
			<div class="card" style="height:515px;"  >
				<img class=" card-img-top" src="https://www.hometrotting.com/wp-content/uploads/2019/01/room1.png" alt="Card image cap" style="padding: 5%;object-fit: cover;">
				<div class="card-body " style="max-height:38vh;">
					<h5 class="card-title webfont" style='font-weight: 700; text-transform: uppercase;height:33px;' >Condo & Office Steps</h5>

					<p class = "card-text webfont" ><i class="fas fa-map-marker-alt"> </i> Montreal</p>
					<p class="card-text" style="color: #ffab4c;font-family: Poppins"> $ 150</p>
					<button class="btn webfont" style="font-weight: 650; ">VIEW DETAILS</button>
				</div>

			</div>
		</div>
		
		-->
	</div>
	

</body>
</html>