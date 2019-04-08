<?php


include_once HOMETROTTING_API_DIR_PATH."lib/Hostaway_api_Listing.php"; 

if (empty(Hostaway_Api_secretKey()) && empty(Hostaway_Api_IdKey())) {
	echo "Please Give The Hostaway Secret Key & ID !";
	exit(0);
}
else {
	$listing = new API_Listing( Hostaway_Api_secretKey() , Hostaway_Api_IdKey() );
	//$vale = 
	//$val = $listing->get_All_reservation_array();
	//$val_2 = $listing->get_All_reservation_json();
	
	$reservationId = "725009" ;

	
	$val = $listing->get_Delete_reservation_array("757733");


	//print_r($val) ;
	echo "<pre>";
	print_r($val);
    echo "</pre>";

	//echo "<br><br>".$vale."<br><br>";
}


?>