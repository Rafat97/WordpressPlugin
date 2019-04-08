<div class="container">
	<form action="options.php" method="post" >
		
		<?php 

			settings_fields( 'homeTrotting_api_Page_info' );
			do_settings_sections( 'homeTrotting_api_Page_info' );
			submit_button("Save Changes");

		 ?>
	</form>
</div>
<br>
<br>
<br>
<br>


<?php
/*
include_once HOMETROTTING_API_DIR_PATH."lib/Hostaway_api_Listing.php"; 

if (empty(Hostaway_Api_secretKey()) && empty(Hostaway_Api_IdKey())) {
	echo "Please Give The Hostaway Secret Key & ID !";
	exit(0);
}
else {
	$listing = new API_Listing( Hostaway_Api_secretKey() , Hostaway_Api_IdKey() );
	//$vale = 
	$val = $listing->get_Individual_Listing_json(48419);
	$val_2 = $listing->get_Individual_Listing_array(48419);
	
	//$val = $listing->get_Calendar_json();
	//$val_2 = $listing->get_Calendar_array();



	//print_r($val) ;
	echo "<pre>";
	//print_r($val_2['result']);
	print_r($val_2);
    echo "</pre>";

	//echo "<br><br>".$vale."<br><br>";
}

*/

?>
