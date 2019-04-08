<?php


function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

$url_redirect_page =  "
    <script> 
         window.location.href = \"".home_url()."\";
    </script>
    ";
if(!isset($_GET) && !isset($_GET['dateCheckIn']) && !isset($_GET['dateCheckOut']) && !isset($_GET['guests_number'])){
    //$homePage = get_option('home');
   
    
    echo $url_redirect_page;
    exit(0);
}
if(!validateDate($_GET['dateCheckOut']) && !validateDate($_GET['dateCheckIn']) ){
    echo $url_redirect_page;
    exit(0);
}

if(!is_numeric($_GET['guests_number'])){
    echo $url_redirect_page;
    exit(0);
}



include_once HOMETROTTING_API_DIR_PATH."lib/Hostaway_api_Listing.php"; 

if (empty(Hostaway_Api_secretKey()) && empty(Hostaway_Api_IdKey())) {
	echo "Please Give The Hostaway Secret Key & ID !";
	exit(0);
}
else {
    

	$listing = new API_Listing( Hostaway_Api_secretKey() , Hostaway_Api_IdKey() );
	//$vale = 
	
	$d =  date("Y-m-d" ,strtotime($_GET['dateCheckIn']. ' +1 day'));
	
	
	$val_2 = $listing->get_All_Listing_Is_Availability_json($d ,$_GET['dateCheckOut'] , $_GET['guests_number']);
	$val = $listing->get_All_Listing_Is_Availability_Array($_GET['dateCheckIn'] ,$_GET['dateCheckOut'] , $_GET['guests_number']);


     $_SESSION['CHECKDATE_IN_DATE'] = $_GET['dateCheckIn'];  
      $_SESSION['CHECKDATE_OUT_DATE'] = $_GET['dateCheckOut'];  
       $_SESSION['NUMBER_OF_GUEST'] = $_GET['guests_number'];  
	//print_r($val) ;
//	echo "<pre>";
//	print_r($val);
//    echo "</pre>";

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
    	<script>
			var RoomLoc = [];
			var TotalRoomFindNumber = <?php echo $val['count']?>;
		</script>
	<h1 class='webfont' style="text-align: center;padding: 3%;font-weight: 700;">ROOMS</h1>
	<div class = 'container' >
	    
	   
	    
		<div class="card-deck" style ='margin-bottom: 5%; margin-top: 5%;'  >
		    
		    
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
			<script>
			var IndvRoom = ["<?php echo $value["name"];  ?>" , <?php echo $value["lat"];  ?> , <?php echo $value["lng"];  ?> ,TotalRoomFindNumber--];
			RoomLoc.push(IndvRoom)
			</script>
			
			<?php
			                    $count++;
                                if($count%3 == 0){
                                    echo "</div>";
                                    echo "<div class=\"card-deck\" style ='margin-bottom: 5%;'>";
                                    //break;
                                }
			
                            }
                            if($count%3 != 0){
                                
                                $i =  (ceil($count / 3) * 3) - $count;
                              
                                while($i != 0){
                                    echo "<div class=\"card\" style=\"height:515px;visibility: hidden;\"  ></div>";
                                    $i--;
                                }
                                echo "</div>";
                                echo "<div class=\"card-deck\" style ='margin-bottom: 5%;'>"; 	
                            }
                            
                             echo "</div>";
                             
                    }
			?>
			

	</div>
	
	 <div id="map" style="width: 100%; height: 400px;"></div>
	
	

  <script type="text/javascript">
  console.log(RoomLoc);
  
  function initMap(){
    /*var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];
    */
    var locations = RoomLoc;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: new google.maps.LatLng(45.504075,-73.5693897),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    
  }
  </script>
   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNqVMFtG92NUyWjFjJTRMiGiz5sb9xsJE&callback=initMap">
    </script>

</body>
</html>






