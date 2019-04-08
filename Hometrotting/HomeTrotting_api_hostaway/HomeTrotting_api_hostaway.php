<?php
/*
Plugin Name:  Hometotting Api
Plugin URI:   
Description:  Make For use the Api in Hostaway website
Version:      1.0.0
Author:       Rafat Haque
Author URI:   https://sites.google.com/view/emdadul-haque/home
*/


	if (!defined('ABSPATH')) {
		die;
	}
	if(!defined('WPINC')){
		die;
	}
	if(!defined("HOMETROTTING_API_DIR_PATH")){
		define('HOMETROTTING_API_DIR_PATH',plugin_dir_path( __FILE__ ));
	}
	if(!defined("HOMETROTTING_API_URL")){
		define('HOMETROTTING_API_URL',plugin_dir_url( __FILE__ ));
	}
	
		
	

require_once(HOMETROTTING_API_DIR_PATH.'/views/stripe-php/init.php');

    function HomeTrotting_register_my_session(){
        if( ! session_id() ) {
            session_start();
        }
    }

    add_action('init', 'HomeTrotting_register_my_session');

    function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
	}


	function Hostaway_Api_secretKey()
	{
		 $ApiSecretKey = get_option('HomeTrotting_Api_Hostaway_secretKey');
		 return $ApiSecretKey;
	}
	function Hostaway_Api_IdKey()
	{
		 $ApiIdKey = get_option('HomeTrotting_Api_Hostaway_IdKey');
		 return $ApiIdKey;
	}


	function HT_API_fun_userScriptFile()
	{
		//wp_enqueue_style('HT_API_css_use_1' ,  HOMETROTTING_API_URL.'extra/downlode/css/bootstrap.min.css');
		wp_enqueue_style('HT_API_css_use_1' ,  'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
		wp_enqueue_style('HT_API_css_use_2' ,  HOMETROTTING_API_URL.'extra/downlode/css/Hometortting_custom.css');



		wp_enqueue_script( 'jquery');

		//wp_enqueue_script( 'HT_API_js_use_4', HOMETROTTING_API_URL.'extra/downlode/js/jquery.min.js',"",true );
		
		
		//wp_enqueue_script( 'HT_API_js_use_5', HOMETROTTING_API_URL.'extra/downlode/js/jquery-3.3.1.slim.min.js',"",true );
	
	    //wp_enqueue_script( 'HT_API_js_use_6', HOMETROTTING_API_URL.'extra/downlode/js/popper.min.js',"",true );
		//wp_enqueue_script( 'HT_API_js_use_3', HOMETROTTING_API_URL.'extra/downlode/js/bootstrap.min.js',"",true);
	    wp_enqueue_script( 'HT_API_js_use_6', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js',"",true );
		wp_enqueue_script( 'HT_API_js_use_3', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' ,"",true);
		wp_enqueue_script( 'HT_API_js_use_7', HOMETROTTING_API_URL.'extra/downlode/js/Hometortting_custom.js',"",true );
	}
	add_action( 'wp_enqueue_scripts', 'HT_API_fun_userScriptFile');
	
	


	function HomeTrotting_fun_api_setting()
	{
		 include_once HOMETROTTING_API_DIR_PATH."admin/api_info.php"; 
	}
	function HomeTrotting_api_fun_Page_info()
	{
		include_once HOMETROTTING_API_DIR_PATH."admin/page_info.php"; 
	}
	
	function HomeTrotting_api_fun_Reservation_info()
	{
		include_once HOMETROTTING_API_DIR_PATH."admin/Reservation_info.php"; 
	}
	function HomeTrotting_Stripe_fun_info()
	{
		include_once HOMETROTTING_API_DIR_PATH."admin/Stripe_info.php"; 
	}
	function HomeTrotting_Testimonial_fun_info()
	{
		include_once HOMETROTTING_API_DIR_PATH."admin/testimonial_admin.php"; 
	}
	function HT_fun_AdminMenu()
	{
	    add_menu_page(
	        'API Control',
	        'API Control',
	        'manage_options',
	        'homeTrotting_api_setting',
	        'HomeTrotting_fun_api_setting',
	        '',
	        1
	    );

	     add_submenu_page(
	        'homeTrotting_api_setting',
	        'Hostaway Api Info',
	        'Hostaway Api Info',
	        'manage_options',
	        'homeTrotting_api_setting',
	        'HomeTrotting_fun_api_setting'
    	);

	     add_submenu_page(
	        'homeTrotting_api_setting',
	        'Page Information',
	        'Page Information',
	        'manage_options',
	        'homeTrotting_api_Page_info',
	        'HomeTrotting_api_fun_Page_info'
    	);
    	add_submenu_page(
	        'homeTrotting_api_setting',
	        'Stripe Information',
	        'Stripe Information',
	        'manage_options',
	        'homeTrotting_Stripe_info',
	        'HomeTrotting_Stripe_fun_info'
    	);
    	add_submenu_page(
	        'homeTrotting_api_setting',
	        'Testimonial Information',
	        'Testimonial Information',
	        'manage_options',
	        'homeTrotting_Testimonial_info',
	        'HomeTrotting_Testimonial_fun_info'
    	);
    	
 /*   	 add_submenu_page(
	        'homeTrotting_api_setting',
	        'Reservation Info',
	        'Reservation Info',
	        'manage_options',
	        'homeTrotting_api_Reservation_info',
	        'HomeTrotting_api_fun_Reservation_info'
    	);
    	
    	*/
	}
	add_action('admin_menu', 'HT_fun_AdminMenu');



	function homeTrotting_api_settings_init()
	{

		    register_setting('homeTrotting_api_setting', 'HomeTrotting_Api_Hostaway_secretKey');
		    register_setting('homeTrotting_api_setting', 'HomeTrotting_Api_Hostaway_IdKey');
		 
		    
		    add_settings_section(
		        'HomeTrotting_Api_settings_section',
		        'HomeTrotting Api Section',
		        'HomeTrotting_Api_settings_fun_section_cb',
		        'homeTrotting_api_setting'
		    );
		 
		   
		    add_settings_field(
		        'HomeTrotting_Api_settings_field_secretKey',
		        'Hostaway Api Secret key',
		        'HomeTrotting_Api_settings_fun_field_cb_secretKey',
		        'homeTrotting_api_setting',
		        'HomeTrotting_Api_settings_section'
		    );

		    add_settings_field(
		        'HomeTrotting_Api_settings_field_IdKey',
		        'Hostaway Api ID :',
		        'HomeTrotting_Api_settings_fun_field_cb_Id',
		        'homeTrotting_api_setting',
		        'HomeTrotting_Api_settings_section'
		    );
	}
 
/**
 * register wporg_settings_init to the admin_init action hook
 */
	add_action('admin_init', 'homeTrotting_api_settings_init');
 
/**
 * callback functions
 */
 
// section content cb
	function HomeTrotting_Api_settings_fun_section_cb()
	{
	    //echo '<p>HomeTrotting Api Section Introduction.</p>';
	}
	 
// field content cb
	function HomeTrotting_Api_settings_fun_field_cb_secretKey()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_Hostaway_secretKey');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_Hostaway_secretKey" style = "width: 70%;" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}

	function HomeTrotting_Api_settings_fun_field_cb_Id()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_Hostaway_IdKey');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_Hostaway_IdKey" style = "width: 70%;"  value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}





	function homeTrotting_Stripe_settings_init()
	{

		    register_setting('homeTrotting_Stripe_setting', 'HomeTrotting_Api_Stripe_secretKey');
		    register_setting('homeTrotting_Stripe_setting', 'HomeTrotting_Api_Stripe_PublishableKey');
		 
		    
		    add_settings_section(
		        'HomeTrotting_Api_Stripe_settings_section',
		        'HomeTrotting Stripe Setting Section',
		        'HomeTrotting_Stripe_settings_fun_section_cb',
		        'homeTrotting_Stripe_setting'
		    );
		 
		   
		    add_settings_field(
		        'HomeTrotting_Api_Stripe_settings_field_secretKey',
		        'Stripe Secret key : ',
		        'HomeTrotting_Api_Stripe_settings_fun_field_cb_secretKey',
		        'homeTrotting_Stripe_setting',
		        'HomeTrotting_Api_Stripe_settings_section'
		    );

		    add_settings_field(
		        'HomeTrotting_Api_Stripe_settings_field_PublishableKey',
		        'Stripe Publishable Key :',
		        'HomeTrotting_Api_Stripe_settings_fun_field_cb_PublishableKey',
		        'homeTrotting_Stripe_setting',
		        'HomeTrotting_Api_Stripe_settings_section'
		    );
	}
 
/**
 * register wporg_settings_init to the admin_init action hook
 */
	add_action('admin_init', 'homeTrotting_Stripe_settings_init');


	function HomeTrotting_Stripe_settings_fun_section_cb()
	{
	    //echo '<p>HomeTrotting Api Section Introduction.</p>';
	}
	function HomeTrotting_Api_Stripe_settings_fun_field_cb_secretKey()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_Stripe_secretKey');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_Stripe_secretKey" style = "width: 70%;" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}

	function HomeTrotting_Api_Stripe_settings_fun_field_cb_PublishableKey()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_Stripe_PublishableKey');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_Stripe_PublishableKey" style = "width: 70%;"  value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}









	function homeTrotting_api_Page_setting_init()
	{
    // register a new setting for "reading" page
		    register_setting('homeTrotting_api_Page_info', 'HomeTrotting_Api_page_all_room_details');
		    register_setting('homeTrotting_api_Page_info', 'HomeTrotting_Api_page_single_room_details');
		    register_setting('homeTrotting_api_Page_info', 'HomeTrotting_Api_page_Search_All_room_details');
		    register_setting('homeTrotting_api_Page_info', 'HomeTrotting_Api_page_Book_In_info_page');
		 
		    // register a new section in the "reading" page
		    add_settings_section(
		        'HomeTrotting_Api_page_settings_section',
		        'HomeTrotting Page Section',
		        'HomeTrotting_Api_page_fun_section_cb',
		        'homeTrotting_api_Page_info'
		    );
		 
		    // register a new field in the "wporg_settings_section" section, inside the "reading" page
		    add_settings_field(
		        'HomeTrotting_Api_page_field_all_room_details',
		        'All Room Details Page Link',
		        'HomeTrotting_Api_settings_fun_field_cb_all_room_detail',
		        'homeTrotting_api_Page_info',
		        'HomeTrotting_Api_page_settings_section'
		    );


		    add_settings_field(
		        'HomeTrotting_Api_page_field_single_room_details',
		        'Individual Room Details Page Link :',
		        'HomeTrotting_Api_settings_fun_field_cb_single_room_detail',
		        'homeTrotting_api_Page_info',
		        'HomeTrotting_Api_page_settings_section'
		    );
		    
		     add_settings_field(
		        'HomeTrotting_Api_page_field_Search_All_room_details',
		        'Check Availability All Room Details Page Link :',
		        'HomeTrotting_Api_settings_fun_field_cb_Search_All_room_detail',
		        'homeTrotting_api_Page_info',
		        'HomeTrotting_Api_page_settings_section'
		    );
		    
		     add_settings_field(
		        'HomeTrotting_Api_page_field_Book_info_Get',
		        'Get Book In info Page Link:',
		        'HomeTrotting_Api_settings_fun_field_cb_Search_Book_info_Get_Page',
		        'homeTrotting_api_Page_info',
		        'HomeTrotting_Api_page_settings_section'
		    );
		    
		    
	}
	
	
	add_action('wp_ajax_nopriv_CreateReservation', 'HomeTrotting_Api_fun_CreateReservation_handler');
    add_action( 'wp_ajax_CreateReservation', 'HomeTrotting_Api_fun_CreateReservation_handler' );
    
    
    add_filter('wp_mail_from','yoursite_wp_mail_from');
    function yoursite_wp_mail_from($content_type) {
      return 'test@example.com';
    }
    add_filter('wp_mail_from_name','yoursite_wp_mail_from_name');
    function yoursite_wp_mail_from_name($name) {
      return 'Test Mail';
    }
    
	function HomeTrotting_Api_fun_CreateReservation_handler(){
	    
	    
	     $stripe_secretKey = get_option('HomeTrotting_Api_Stripe_secretKey');
	     $stripe_PublishableKey = get_option('HomeTrotting_Api_Stripe_PublishableKey');
	    
	    if ($_REQUEST['parem'] === 'CreateReservation_User') {
 
        
             $stripe = [
                 "secret_key"      => $stripe_secretKey,
                 "publishable_key" => $stripe_PublishableKey,
            ];
     
     
           \Stripe\Stripe::setApiKey($stripe['secret_key']);
          
          try{
           $value_Stripe_token = \Stripe\Token::create([
              "card" => [
                 "name"=> $_POST['CCName'],
                "address_city"=> $_POST['UCity'],
                "address_country"=> $_POST['UCountry'],
                "address_line1" => $_POST['UAddress'],
                "address_zip"=>$_POST['ZipCodeNumber'],
                "number" => $_POST['CreditCardNumber'],
                "exp_month" => $_POST['ExpirationDate_Month'],
                "exp_year" => $_POST['ExpirationDate_Year'],
                "cvc" => $_POST['CVCNumber'],
                
              ]
            ]);
            
            $value_token_get =$value_Stripe_token->id;
            
            
            //echo $value_Stripe_token;
            
            $value_Stripe_customer = \Stripe\Customer::create([
              'email' => $_POST['UEmail'],
              "description" => "Customer Email :".$_POST['UEmail']." Room Id is :".$_POST['srm']." Arrival Date is :".$_POST['arrivalDate']." Departure Date is :".$_POST['DepartureDate']." Total Price is :".$_POST['Price']." Room Price is :".($_POST['Price'] - $_POST['cleaningFee'])." Room cleaning Fee Price is :".$_POST['cleaningFee']." Token Is :".$value_token_get,
              'source'  => $value_token_get,
              "metadata"=> [
                    "RoomId"=>$_POST['srm'] , 
                    "NumberOfguest"=>$_POST['NumberOfguest'] ,
                    "ArrivalDate"=>$_POST['arrivalDate'] ,
                    "TotalPrice"=>$_POST['Price'],
                    "RoomcleaningFee"=>$_POST['cleaningFee'] , 
                    "RoomPrice"=>($_POST['Price'] - $_POST['cleaningFee'])."" ,
                    "DepartureDate"=>$_POST['departureDate'] ,
                    "FirstName"=>$_POST['FName'],
                    "LastName"=>$_POST['LName'],
                    "Email"=>$_POST['UEmail'],
                    "PhoneNumber"=>$_POST['PhoneNumber'],
                    ]
            ]);
            //echo $value_Stripe_customer;
            
            $value_customer_get=$value_Stripe_customer->id;
             
            $value_Stripe_charge = \Stripe\Charge::create([
                'customer' => $value_customer_get,
                'amount'   => ($_POST['Price']*100),
                'currency' => 'cad',
                'receipt_email'=>$_POST['UEmail'],
                "metadata"=> [
                    "RoomId"=>$_POST['srm'] , 
                    "NumberOfguest"=>$_POST['NumberOfguest'] ,
                    "TotalPrice"=>$_POST['Price'],
                    "RoomcleaningFee"=>$_POST['cleaningFee'] , 
                    "RoomPrice"=>($_POST['Price'] - $_POST['cleaningFee'])."" ,
                    "ArrivalDate"=>$_POST['arrivalDate'] ,
                    "DepartureDate"=>$_POST['departureDate'] ,
                    "FirstName"=>$_POST['FName'],
                    "LastName"=>$_POST['LName'],
                    "Email"=>$_POST['UEmail'],
                    "PhoneNumber"=>$_POST['PhoneNumber'],
                    "RoomUrl"=>"https://dashboard.hostaway.com/listing/".$_POST['srm'],
                    "CalenderUrl"=>"https://dashboard.hostaway.com/calendar?type=single&listingMap=".$_POST['srm']."&view=monthly&date=".$_POST['arrivalDate'],
                    ]
            ]);
           // echo $value_Stripe_charge;
           
        
              $name = $_POST['FName']." ".$_POST['LName'];
              $email = "rafathaque1997@gmail.com";
              $message = "Hello,People ";
            
            //php mailer variables
              //$to = get_option('admin_email');
              $to = $_POST['UEmail'];
              $subject = "Thank You for booking room ...";
              $headers = 'Test Mail';
            

            //Here put your Validation and send mail
            $sent = wp_mail($to, $subject, $message, $headers);
            if($sent){
                
                
                  $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://api.hostaway.com/v1/reservations",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS => "{\n    \"channelId\": 2000,\n    \"listingMapId\": ".$_POST['srm'].",\n    \"isManuallyChecked\": 0,\n    \"isInitial\": 0,\n    
                      \"guestName\": \"".$_POST['FName']." ".$_POST['LName']."\",\n    \"guestFirstName\": \"".$_POST['FName']."\",\n    \"guestLastName\": \"".$_POST['LName']."\",\n    \"guestZipCode\": \"".$_POST['ZipCodeNumber']."\",\n    \"guestAddress\": \"".$_POST['UAddress']."\",\n    \"guestCity\": \"".$_POST['UCity']."\",\n    \"guestCountry\": \"".$_POST['UCountry']."\",\n    \"guestEmail\": \"".$_POST['UEmail']."\",\n    \"guestPicture\": null,\n    \"guestRecommendations\": 0,\n    \"guestTrips\": 0,\n    \"guestWork\": null,\n    
                      \"isGuestIdentityVerified\": 0,\n    \"isGuestVerifiedByEmail\": 0,\n    \"isGuestVerifiedByWorkEmail\": 0,\n    \"isGuestVerifiedByFacebook\": 0,\n    \"isGuestVerifiedByGovernmentId\": 0,\n    \"isGuestVerifiedByPhone\": 0,\n    \"isGuestVerifiedByReviews\": 0,\n    
                      \"numberOfGuests\": ".$_POST['NumberOfguest'].",\n    \"adults\": null,\n    \"children\": null,\n    \"infants\": null,\n    \"pets\": null,\n    \"arrivalDate\": \"".$_POST['arrivalDate']."\",\n    \"departureDate\": \"".$_POST['departureDate']."\",\n    \"checkInTime\": null,\n    \"checkOutTime\": null,\n    \"phone\": \"".$_POST['PhoneNumber']."\",\n    \"totalPrice\": ".$_POST['Price'].",\n    \"taxAmount\": null,\n    \"channelCommissionAmount\": null,\n    \"cleaningFee\": ".$_POST['cleaningFee'].",\n    \"securityDepositFee\": null,\n   
                      \"isPaid\": true,\n    \"currency\": \"".$_POST['currencyCode']."\",\n    
                      \"hostNote\": null,\n    \"guestNote\": null,\n    \"doorCode\": null,\n    \"doorCodeVendor\": null,\n    \"doorCodeInstruction\": null,\n    \"comment\": null,\n    
                      \"airbnbExpectedPayoutAmount\": 0,\n    \"airbnbListingBasePrice\": 0,\n    \"airbnbListingCancellationHostFee\": 0,\n    \"airbnbListingCancellationPayout\": 0,\n    \"airbnbListingCleaningFee\": 0,\n    \"airbnbListingHostFee\": 0,\n    \"airbnbListingSecurityPrice\": 0,\n    \"airbnbOccupancyTaxAmountPaidToHost\": 0,\n    \"airbnbTotalPaidAmount\": 0,\n    \"airbnbTransientOccupancyTaxPaidAmount\": 0,\n    \"airbnbCancellationPolicy\": null\n}",
                      
                      
                      CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		                "cache-control: no-cache",
                        "content-type: application/json")
                    ));
                    
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    
                    curl_close($curl);
                    
                    if ($err) {
                      echo  $err;
                    } else {
                     
                       echo $response;
                      
                    }
                
                
                /*
                $success =json_encode(array(
                          "status" => "success",
                          "message"=> "Thank you for booking with us. We will contact you soon."
                          ));
                      echo $success;
                     */ 
            }
            else{
                $success =json_encode(array(
                          "status" => "error",
                          "message"=> "Mail Not send."
                          ));
                      echo $success;
            }
                  
                   
              
              
            
          }catch(Exception $e){
              $error =json_encode(array(
                  "status" => "error",
                  "Exception"=>$e,
                  "message"=> $e->getMessage()
                  ));
              echo $error;
          }
 
 /*
 
 
                  
                    
            */
           // print_r($_POST);
            
	    }
	    
	    wp_die();
	}
	


	add_action('admin_init', 'homeTrotting_api_Page_setting_init');


	function HomeTrotting_Api_page_fun_section_cb()
	{
	    //echo '<p>HomeTrotting Api Section Introduction.</p>';
	}
	 
// field content cb
	function HomeTrotting_Api_settings_fun_field_cb_all_room_detail()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_page_all_room_details');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_page_all_room_details" style = "width: 70%;" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}


	function HomeTrotting_Api_settings_fun_field_cb_single_room_detail()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_page_single_room_details');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_page_single_room_details" style = "width: 70%;" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}
	
	function HomeTrotting_Api_settings_fun_field_cb_Search_All_room_detail()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_page_Search_All_room_details');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_page_Search_All_room_details" style = "width: 70%;" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}
	
	function HomeTrotting_Api_settings_fun_field_cb_Search_Book_info_Get_Page()
	{
	    // get the value of the setting we've registered with register_setting()
	    $setting = get_option('HomeTrotting_Api_page_Book_In_info_page');
	    // output the field
	    ?>
	    <input type="text" name="HomeTrotting_Api_page_Book_In_info_page" style = "width: 70%;" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
	    <?php
	}


     function TableName_Testimonial()
	 {
		global $wpdb;
		$value = $wpdb->prefix . 'hometrotting_db_testimonial' ;
		return $value;
		
	  }
	  function Hometrotting_MakeDBForTestimonial()
        {
        		$tablename = TableName_Testimonial();
        		$sql = "CREATE TABLE `".$tablename."` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` text COLLATE utf8_unicode_ci,
 `companyName` text COLLATE utf8_unicode_ci,
 `title` text COLLATE utf8_unicode_ci,
 `testimonial` longtext COLLATE utf8_unicode_ci,
 `uplodeTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
";
        	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        	  dbDelta($sql);
        }
	
    	register_activation_hook( __FILE__, 'Hometrotting_MakeDBForTestimonial');




	add_shortcode( "Show_Home_Page_Data_Hometrotting", 'HomeTrotting_Api_fun_Home_page_Show');
	function HomeTrotting_Api_fun_Home_page_Show(){
			include_once HOMETROTTING_API_DIR_PATH."views/Home_Page_Room_Show.php"; 
	}
	
	add_shortcode( "Show_Main_Page_All_Room_Hometrotting", 'HomeTrotting_Api_fun_Main_Page_All_Room_Show');
	function HomeTrotting_Api_fun_Main_Page_All_Room_Show(){
			include_once HOMETROTTING_API_DIR_PATH."views/Main_Page_All_Room_Show.php"; 
	}
	
	
	
	add_shortcode( "Show_Home_Page_Check_Availability_Data_Hometrotting", 'HomeTrotting_Api_fun_Home_page__Check_Availability_Search');
	function HomeTrotting_Api_fun_Home_page__Check_Availability_Search(){
			include_once HOMETROTTING_API_DIR_PATH."views/Home_Page_Check_Availability_scode.php"; 
	}
	
	add_shortcode( "Show_Check_Availability_Search_room_Hometrotting", 'HomeTrotting_Api_fun_main_page__Check_Availability_Search_room');
	function HomeTrotting_Api_fun_main_page__Check_Availability_Search_room(){
			include_once HOMETROTTING_API_DIR_PATH."views/Main_Page_Check_Availability_after_search_scode.php"; 
	}
	
	add_shortcode( "Show_Single_Page_room_Details_Hometrotting", 'HomeTrotting_Api_fun_main_page_Single_Page_room_Details_room');
	function HomeTrotting_Api_fun_main_page_Single_Page_room_Details_room(){
			include_once HOMETROTTING_API_DIR_PATH."views/Main_Page_Single_room_details_info.php"; 
	}
	
	add_shortcode( "Show_Book_in_info_user_Details_Hometrotting", 'HomeTrotting_Api_fun_main_page_Book_id_Info_Details_user');
	function HomeTrotting_Api_fun_main_page_Book_id_Info_Details_user(){
		include_once HOMETROTTING_API_DIR_PATH."views/Main_Book_In_infoPage.php"; 
	}
	
	add_shortcode( "Show_Testimonial_Page", 'HomeTrotting_Api_fun_main_page_Show_Testimonial_Page');
	function HomeTrotting_Api_fun_main_page_Show_Testimonial_Page(){
		include_once HOMETROTTING_API_DIR_PATH."views/Main_Page_Testimonial_show_fontend.php"; 
	}
	
	add_shortcode( "Show_Testimonial_Home_Page", 'HomeTrotting_Api_fun_Home_Page_Show_Testimonial_Page');
	function HomeTrotting_Api_fun_Home_Page_Show_Testimonial_Page(){
		include_once HOMETROTTING_API_DIR_PATH."views/Home_Page_Testimonial.php"; 
	}



    function HomeTrotting_Api_fun_TestimonialUpdateAdmin_handler(){
            global $wpdb;
            
            if($_REQUEST['parem'] == 'TestimonialUpdateAdminAdd_Data'){
                $name = $_REQUEST['UserName'];
                $title = $_REQUEST['TitleName'];
                $companyname = $_REQUEST['companyName'];
                $testimonial = $_REQUEST['TestimonialTextarea'];
                
                $Db_insert = array(
        		           'name'=>test_input($name),
        		           'companyName'=>test_input($companyname),
        		           'title'=>test_input($title),
        		           'testimonial'=>test_input($testimonial),
        		           
        		    );
                
                $wpdb->insert( TableName_Testimonial(), $Db_insert) or die(json_encode(array("status"=>"error","message"=>"Database Error")));
                echo json_encode(array("status"=>"success","message"=>"Successfully Add Data"));
            }
            else if($_REQUEST['parem'] == 'TestimonialUpdateAdminedit_Data'){
                $id = $_REQUEST['selectedId'];
                
                
                $value = json_encode($wpdb->get_results( "SELECT * FROM ".TableName_Testimonial() ." where `id`=".$id));
               
                echo json_encode(array("status"=>"success","message"=> $value));
            }
            else if($_REQUEST['parem'] == 'TestimonialUpdateAdminEditAdd_Data_form'){
               
               $id =  $_REQUEST['IdSelect'];
                $name = $_REQUEST['UserName'];
                $title = $_REQUEST['TitleName'];
                $companyname = $_REQUEST['companyName'];
                $testimonial = $_REQUEST['TestimonialTextarea'];
                
                $Db_update = array(
        		           'name'=>test_input($name),
        		           'companyName'=>test_input($companyname),
        		           'title'=>test_input($title),
        		           'testimonial'=>test_input($testimonial),
        		           
        		    );
                try{
                    $wpdb->update(TableName_Testimonial(), $Db_update , array('id'=>$id)) /* or die(json_encode(array("status"=>"error","message"=>"Database Error"))) */ ;
                }catch(Exception $e){
                    echo json_encode(array("status"=>"error","message"=>$e->getMessage()));
                }
                 
                 echo json_encode(array("status"=>"success","message"=>"Successfully Add Data"));
            }
            else if($_REQUEST['parem'] == 'TestimonialUpdateAdminDelete_Data'){
                $wpdb->delete( TableName_Testimonial(), array( 'id'  => $_REQUEST['DeletedId'] ));
                echo json_encode(array("status"=>"success","message"=>"Successfully Delete Data"));
            }
    	    
    	     wp_die();
    }
	//add_action('wp_ajax_nopriv_CreateReservation', 'HomeTrotting_Api_fun_TestimonialUpdateAdmin_handler');
    add_action( 'wp_ajax_TestimonialUpdateAdmin', 'HomeTrotting_Api_fun_TestimonialUpdateAdmin_handler' );





	?>