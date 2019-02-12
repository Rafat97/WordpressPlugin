<?php
/*
Plugin Name:  Member Content
Plugin URI:   
Description:  Own Make Member Content
Version:      1.0.0
Author:       Rafat Haque
Author URI:   
*/

	
	
	if (!defined('ABSPATH')) {
		die;
	}
	if(!defined('WPINC')){
		die;
	}
	if(!defined("MEMBER_CONTENT_DIR_PATH")){
		define('MEMBER_CONTENT_DIR_PATH',plugin_dir_path( __FILE__ ));
	}
	if(!defined("MEMBER_CONTENT_DIR_URL")){
		define('MEMBER_CONTENT_DIR_URL',plugin_dir_url( __FILE__ ));
	}
	if(!defined("MEMBER_CONTENT_DIR_VERSION")){
		define('MEMBER_CONTENT_DIR_VERSION',"1.0.0");
	}
	if(!defined("MEMBER_CONTENT_DIR_OUR_EXT")){
		define('MEMBER_CONTENT_DIR_OUR_EXT',"mm_cont");
	}
	function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
	}
	
	
	function WorkoutExpireWork() {
	    global $wpdb;
	    $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
        $current_post_id = url_to_postid( $url );
        //echo "<h1>". $current_post_id."</h1>";
        $blockPageValue = array(0,17);
	     if(in_array($current_post_id, $blockPageValue)){
         
         
	     
	    $UserActive_PMPRO_UserDB = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `status` = \"Active\"");
	    
	    $UserSuccess_PMPRO_OrdersDb  =  $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_orders` WHERE `status` = 'success'");
	    
	    
	    //print_r($results_Is_have_Workout_Paid);
	    //print_r($UserSuccess);
		//echo "<center><h1>asdfsdf</h1></center>";
		
		foreach($UserActive_PMPRO_UserDB as $key){
		    /*
		    
		    echo $key->id."<br>";
		    echo $key->startdate."<br>";
		    echo $key->enddate."<br>";
		    $date = new DateTime();
		    echo date_default_timezone_get()."<br>";
		    echo $date->format('Y-m-d h:m:s')."<br>"."<br>";
		    
		    */
		    
		    //future is always future value get (+ sign); otherwise if future have less value get (- sign)
		    /*
		    1st way 
		    
		    
		    $now = new DateTime();
            $future = new DateTime($key->enddate);
          
            //$now = new DateTime();
            //$future = new DateTime(date('Y-m-d h:m:s',strtotime("-1 second")));
           
           
           // $now = new DateTime();
           // $future = new DateTime();
            
            
            $interval = $now->diff($future);
            $day = $interval->format("%R%a");
            $hour = $interval->format("%R%h");
            $minut = $interval->format("%R%m");
            $second = $interval->format("%R%s");
            
            echo $day;
            echo $hour;
            echo $minut;
            echo $second;
            echo "<br><br>";
            echo $now->format('Y-m-d h:m:s');
            echo "<br>";
            echo $future->format('Y-m-d h:m:s');
            echo "<br><br>";
            
            
            */
            
            //tomorrow;
            //yesterday 
            $date = new DateTime('now');
            $result = $date->format('Y-m-d');
                        
            $date = new DateTime($key->enddate);
            $givenFormet = $date->format('Y-m-d');
            
            $date1 = date_create($givenFormet);
            $date2 = date_create($result);

            $diff=date_diff($date2,$date1);
            $val = $diff->format("%R%a"); 
            
            if((int)$val == 0){
                
                
                
                 // echo "<h3>Remaining day0(s): 1</h3>";
                
                
                
                
                
            }
            else{
                
                         if(strpos($val, '+') !== false){
                                //echo "<h3>Remaining day(s): ".(int)$val."</h3>";
                               
                            }
                         else if(strpos($val, '-') !== false){
                               
                                
                                $sql1 = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `id` = ".$key->id);
                                $sql2 = $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_orders` WHERE `id` = ".$key->id);
                                
                                $datefinal = new DateTime('now');
                                $enddateExp = $datefinal->format('Y-m-d h:m:s');
                                
                                $sqlMake_user_allPages = "UPDATE `wp_pmpro_memberships_users` SET 
                    	    	`user_id`='".$sql1[0]->user_id."',
                    	    	`membership_id`='".$sql1[0]->membership_id."',
                    	    	`code_id`='".$sql1[0]->code_id."',
                    	    	`initial_payment`='".$sql1[0]->initial_payment."',
                    	    	`billing_amount`='".$sql1[0]->billing_amount."',
                    	    	`cycle_number`='".$sql1[0]->cycle_number."',
                    	    	`cycle_period`='".$sql1[0]->cycle_period."',
                    	    	`billing_limit`='".$sql1[0]->billing_limit."',
                    	    	`trial_amount`='".$sql1[0]->trial_amount."',
                    	    	`trial_limit`='".$sql1[0]->trial_limit."',
                    	    	`status`='expired',
                    	    	`startdate`='".$sql1[0]->startdate."',
                    	    	`enddate`='".$enddateExp."',
                    	    	`modified`='".$sql1[0]->modified."' WHERE `id` = ".$sql1[0]->id;                
                    	    	
                    	    	
                    	    	
                    	    $sqlMake_Oder_allPages = "UPDATE `wp_pmpro_membership_orders` SET 
                    	    	`code`='".$sql2[0]->code."',
                    	    	`session_id`='".$sql2[0]->session_id."',
                    	    	`user_id`='".$sql2[0]->user_id."',
                    	    	`membership_id`='".$sql2[0]->membership_id."',
                    	    	`paypal_token`='".$sql2[0]->paypal_token."',
                    	    	`billing_name`='".$sql2[0]->billing_name."',
                    	    	`billing_street`='".$sql2[0]->billing_street."',
                    	    	`billing_city`='".$sql2[0]->billing_city."',
                    	    	`billing_state`='".$sql2[0]->billing_state."',
                    	    	`billing_zip`='".$sql2[0]->billing_zip."',
                    	    	`billing_country`='".$sql2[0]->billing_country."',
                    	    	`billing_phone`='".$sql2[0]->billing_phone."',
                    	    	`subtotal`='".$sql2[0]->subtotal."',
                    	    	`tax`='".$sql2[0]->tax."',
                    	    	`couponamount`='".$sql2[0]->couponamount."',
                    	    	`checkout_id`='".$sql2[0]->checkout_id."',
                    	    	`certificate_id`='".$sql2[0]->certificate_id."',
                    	    	`certificateamount`='".$sql2[0]->certificateamount."',
                    	    	`total`='".$sql2[0]->total."',
                    	    	`payment_type`='".$sql2[0]->payment_type."',
                    	    	`cardtype`='".$sql2[0]->cardtype."',
                    	    	`accountnumber`='".$sql2[0]->accountnumber."',
                    	    	`expirationmonth`='".$sql2[0]->expirationmonth."',
                    	    	`expirationyear`='".$sql2[0]->expirationyear."',
                    	    	`status`='cancelled',
                    	    	`gateway`='".$sql2[0]->gateway."',
                    	    	`gateway_environment`='".$sql2[0]->gateway_environment."',
                    	    	`payment_transaction_id`='".$sql2[0]->payment_transaction_id."',
                    	    	`subscription_transaction_id`='".$sql2[0]->subscription_transaction_id."',
                    	    	`timestamp`='".$sql2[0]->timestamp."',
                    	    	`affiliate_id`='".$sql2[0]->affiliate_id."',
                    	    	`affiliate_subid`='".$sql2[0]->affiliate_subid."',
                    	    	`notes`='".$sql2[0]->notes."' WHERE `id` = ".$sql2[0]->id;
                    
                    	  		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                    	  	
                    	  		dbDelta($sqlMake_Oder_allPages);
                    	  		dbDelta($sqlMake_user_allPages);
                                //print_r($sql1);
                                 //echo "<h3>Remaining day(s): ".(int)$val."</h3>";
                                
                            }
               
                
                
                
            }
           




                        
            
		   
		    
		}
	    
	    
	    $sqlMake_user = "UPDATE `wp_pmpro_memberships_users` SET 
	    	`user_id`='".$result2[0]->user_id."',
	    	`membership_id`='".$result2[0]->membership_id."',
	    	`code_id`='".$result2[0]->code_id."',
	    	`initial_payment`='".$result2[0]->initial_payment."',
	    	`billing_amount`='".$result2[0]->billing_amount."',
	    	`cycle_number`='".$result2[0]->cycle_number."',
	    	`cycle_period`='".$result2[0]->cycle_period."',
	    	`billing_limit`='".$result2[0]->billing_limit."',
	    	`trial_amount`='".$result2[0]->trial_amount."',
	    	`trial_limit`='".$result2[0]->trial_limit."',
	    	`status`='".$result2[0]->status."',
	    	`startdate`='".$result2[0]->startdate."',
	    	`enddate`='".$result2[0]->enddate."',
	    	`modified`='".$result2[0]->modified."' WHERE `id` = ".$result2[0]->id;                
	    	
	    	
	    	
	    $sqlMake_Oder = "UPDATE `wp_pmpro_membership_orders` SET 
	    	`code`='".$result1[0]->code."',
	    	`session_id`='".$result1[0]->session_id."',
	    	`user_id`='".$result1[0]->user_id."',
	    	`membership_id`='".$result1[0]->membership_id."',
	    	`paypal_token`='".$result1[0]->paypal_token."',
	    	`billing_name`='".$result1[0]->billing_name."',
	    	`billing_street`='".$result1[0]->billing_street."',
	    	`billing_city`='".$result1[0]->billing_city."',
	    	`billing_state`='".$result1[0]->billing_state."',
	    	`billing_zip`='".$result1[0]->billing_zip."',
	    	`billing_country`='".$result1[0]->billing_country."',
	    	`billing_phone`='".$result1[0]->billing_phone."',
	    	`subtotal`='".$result1[0]->subtotal."',
	    	`tax`='".$result1[0]->tax."',
	    	`couponamount`='".$result1[0]->couponamount."',
	    	`checkout_id`='".$result1[0]->checkout_id."',
	    	`certificate_id`='".$result1[0]->certificate_id."',
	    	`certificateamount`='".$result1[0]->certificateamount."',
	    	`total`='".$result1[0]->total."',
	    	`payment_type`='".$result1[0]->payment_type."',
	    	`cardtype`='".$result1[0]->cardtype."',
	    	`accountnumber`='".$result1[0]->accountnumber."',
	    	`expirationmonth`='".$result1[0]->expirationmonth."',
	    	`expirationyear`='".$result1[0]->expirationyear."',
	    	`status`='".$result1[0]->status."',
	    	`gateway`='".$result1[0]->gateway."',
	    	`gateway_environment`='".$result1[0]->gateway_environment."',
	    	`payment_transaction_id`='".$result1[0]->payment_transaction_id."',
	    	`subscription_transaction_id`='".$result1[0]->subscription_transaction_id."',
	    	`timestamp`='".$result1[0]->timestamp."',
	    	`affiliate_id`='".$result1[0]->affiliate_id."',
	    	`affiliate_subid`='".$result1[0]->affiliate_subid."',
	    	`notes`='".$result1[0]->notes."' WHERE `id` = ".$result1[0]->id;

	  		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	  	
	  		//dbDelta($sqlMake_Oder);
	  		//dbDelta($sqlMake_user);
	    
	     }
	     else{
	        
	        //echo "not work";
	        
	        //after block some page to do this action 
	        
	        
	     }
	    
	    
	    
	}
	add_action('init', 'WorkoutExpireWork');


	/* 
	@Start  Without Report Page
	*/

	function mm_content_fun_WithoutReport_See()
	{
		 include_once MEMBER_CONTENT_DIR_PATH."OtherFile/WithoutReport/mm_content_see.php"; 
	}
	function mm_content_fun_WithoutReport_Add()
	{
		include_once MEMBER_CONTENT_DIR_PATH."OtherFile/WithoutReport/mm_content_add.php"; 
	}
	

	function mm_content_fun_OptionMenu_WithoutReport()
	{
	    add_menu_page(
	        'Workout Reports',
	        'Workout Reports',
	        'manage_options',
	        'member_content_Without_Report_See',
	        'mm_content_fun_WithoutReport_See',
	        '',
	        1
	    );

	     add_submenu_page(
        'member_content_Without_Report_See',
        'See Information',
        'See Information',
        'manage_options',
        'member_content_Without_Report_See',
        'mm_content_fun_WithoutReport_See'
    	);

	      add_submenu_page(
        'member_content_Without_Report_See',
        'Add Information',
        'Add Information',
        'manage_options',
        'member_content_Without_Report_Add',
        'mm_content_fun_WithoutReport_Add'
    	);
	}


	add_action('admin_menu', 'mm_content_fun_OptionMenu_WithoutReport');



	function mm_content_fun_AdminScriptFile()
	{
	    $obj_id = $_GET['page'];
	    
	    $pages = array('member_content_Without_Report_See','member_content_Without_Report_Add','member_content_Tips_See','member_content_Tips_Add',"member_content_Highlights_2_Part","member_content_Highlights","member_content_FairOdds_See","member_content_FairOdds_Add","member_content_FairOdds_user","member_content_Membership_admin_add","member_content_Membership_admin_see");
	    
	    if(in_array($obj_id,$pages)){
	        	wp_enqueue_style('mm_content_css_use_2' ,  MEMBER_CONTENT_DIR_URL.'assect/css/bootstrap.min.css');
        		wp_enqueue_style('mm_content_css_use_3' ,  MEMBER_CONTENT_DIR_URL.'assect/css/jquery.dataTables.min.css');
        		wp_enqueue_style('mm_content_css_use_4' ,  MEMBER_CONTENT_DIR_URL.'assect/css/jquery.notifyBar.css');
        		wp_enqueue_style('mm_content_css_use_1' ,  MEMBER_CONTENT_DIR_URL.'assect/css/mm_content_style.css');
        
        
        		wp_enqueue_script( 'jquery');
        
        		
        		wp_enqueue_script( 'mm_content_js_use_2', MEMBER_CONTENT_DIR_URL.'assect/js/bootstrap.min.js',
        			"",true );
        		
        		wp_enqueue_script( 'mm_content_js_use_4', 'http://code.jquery.com/jquery-1.11.2.min.js',
        			"",true );
        		
        		
        
        		wp_enqueue_script( 'mm_content_js_use_3', MEMBER_CONTENT_DIR_URL.'assect/js/jquery.dataTables.min.js',
        			"",true );
        
        		
        		wp_enqueue_script( 'mm_content_js_use_5', MEMBER_CONTENT_DIR_URL.'assect/js/jquery.notifyBar.js',
        			"",true );
        		wp_enqueue_script( 'mm_content_js_use_6', MEMBER_CONTENT_DIR_URL.'assect/js/jquery.validate.min.js',
        			"",true );
        		wp_enqueue_script( 'mm_content_js_use_1', MEMBER_CONTENT_DIR_URL.'assect/js/mm_content_my.js',
        			"",true );
        		wp_localize_script( 'mm_content_js_use_1', 'mm_content_getAjaxUrl', admin_url("admin-ajax.php") );
	    }
		
	
		
	}
	add_action( 'admin_enqueue_scripts', 'mm_content_fun_AdminScriptFile');
	
	function mm_content_fun_userScriptFile()
	{
	    
		
		wp_enqueue_style('mm_content_css_use_2' ,  MEMBER_CONTENT_DIR_URL.'assect/css/bootstrap.min.css');

		wp_enqueue_style('mm_content_css_use_1' ,  MEMBER_CONTENT_DIR_URL.'assect/css/mm_content_style.css');


		wp_enqueue_script( 'jquery');

		
		wp_enqueue_script( 'mm_content_js_use_2', MEMBER_CONTENT_DIR_URL.'assect/js/bootstrap.min.js',
			"",true );
		
	/*	wp_enqueue_script( 'mm_content_js_use_4', 'http://code.jquery.com/jquery-1.11.2.min.js',
			"",true );
			*/
		
	
		
	}
	add_action( 'wp_enqueue_scripts', 'mm_content_fun_userScriptFile');
    

	register_activation_hook( __FILE__, 'mm_content_fun_MakeDBForWithoutReport');
	 function TableName_WithoutReport()
	{
		global $wpdb;
		$value = $wpdb->prefix . 'mm_content_db_WithoutReport' ;
		return $value;
	}
	 function mm_content_fun_MakeDBForWithoutReport()
	{
		$tablename = TableName_WithoutReport();

		$sql = "CREATE TABLE IF NOT EXISTS`".$tablename."` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `Title` text NOT NULL,
 `GiveEmail` text NOT NULL,
 `FileLink` text NOT NULL,
 `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1";

	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	  dbDelta($sql);
	}


	

	add_action( 'wp_ajax_WithoutReport', 'mm_content_fun_WithoutReportAddData_handler' );

	function mm_content_fun_WithoutReportAddData_handler()
	{
		global $wpdb;

		if ($_REQUEST['parem'] == 'WithoutReportAdd_Data') {
			
			//print_r($_REQUEST);
			$wpdb->insert(TableName_WithoutReport(),array(
				"Title"=>test_input($_REQUEST['txtTitle']),
				"GiveEmail"=>$_REQUEST['UserEmail'],
				"FileLink"=>$_REQUEST['FileLink']

			));

			echo json_encode(array("status"=>1,"message"=>"Data added successfully in Workout Report Database."));
			

			//print_r($_REQUEST);
		}
		else if ($_REQUEST['parem'] == 'WithoutReportDelete_Data') {
			
			//print_r($_REQUEST);
			
			$wpdb->delete(TableName_WithoutReport(), array(
				"id"=>$_REQUEST['id']
			));

			echo json_encode(array("status"=>1,"user_login"=>"Data deleted successfully in Workout Report Database."));
		}
		
		wp_die();
	}
	add_shortcode( "Show_WorkoutReports_FontEnd",  'mm_content_fun_WithoutReport_viewShortCode');
	function mm_content_fun_WithoutReport_viewShortCode(){
		include_once MEMBER_CONTENT_DIR_PATH."views/WorkoutReports/mm_content_WorkoutReports_view.php"; 
	}


/* 
@end  Without Report Page
*/








	/* 
	@Start  Tips Page
	*/

	/*
		

	*/

	function mm_content_fun_Tips_See()
	{
		include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Tips/mm_content_see.php"; 
	}
	function mm_content_fun_Tips_Add()
	{
		include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Tips/mm_content_add.php"; 
	}

	function mm_content_fun_OptionMenu_Tips()
	{
	    add_menu_page(
	        'Tips',
	        'Tips',
	        'manage_options',
	        'member_content_Tips_See',
	        'mm_content_fun_Tips_See',
	        '',
	        1
	    );

	     add_submenu_page(
        'member_content_Tips_See',
        'See Tips',
        'See Tips',
        'manage_options',
        'member_content_Tips_See',
        'mm_content_fun_Tips_See'
    	);

	      add_submenu_page(
        'member_content_Tips_See',
        'Add Tips',
        'Add Tips',
        'manage_options',
        'member_content_Tips_Add',
        'mm_content_fun_Tips_Add'
    	);
	}



	add_action('admin_menu', 'mm_content_fun_OptionMenu_Tips');


	
	register_activation_hook( __FILE__, 'mm_content_fun_MakeDBForTips');
	 function TableName_Tips()
	{
		global $wpdb;
		$value = $wpdb->prefix . 'mm_content_db_tips' ;
		return $value;
	}
	 function mm_content_fun_MakeDBForTips()
	{
		$tablename = TableName_Tips();

		$sql = "CREATE TABLE IF NOT EXISTS `".$tablename."` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `TipsTitle` text NOT NULL,
 `FullTips` text NOT NULL,
 `UplodeTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	  dbDelta($sql);
	}




	add_action( 'wp_ajax_Tips', 'mm_content_fun_TipsAddData_handler' );
	function mm_content_fun_TipsAddData_handler()
	{
		
		global $wpdb;
		if ($_REQUEST['parem'] == 'TipsAdd_Data') {
			
			//print_r($_REQUEST);
			$wpdb->insert(TableName_Tips(),array(
				"TipsTitle"=>test_input($_REQUEST['tipsTitle']),
				"FullTips"=>test_input($_REQUEST['FullTipsValue'])
			));

			echo json_encode(array("status"=>1,"message"=>"Data added successfully in Tips Database."));
			
		}


		else if ($_REQUEST['parem'] == 'TipsDelete_Data') {
			
			//print_r($_REQUEST);
			
			$wpdb->delete(TableName_Tips(), array(
				"ID"=>$_REQUEST['id']
			));

			echo json_encode(array("status"=>1,"message"=>"Data deleted Successfully in Tips Database."));
			
		}

		wp_die();
	}




	add_shortcode( "Show_Tips_FontEnd",  'mm_content_fun_Tips_viewShortCode');
	function mm_content_fun_Tips_viewShortCode(){
		include_once MEMBER_CONTENT_DIR_PATH."views/Tips/mm_content_Tips_view.php"; 
	}
	add_shortcode( "Show_User_Name",  'mm_content_fun_ShowUserName');
	function mm_content_fun_ShowUserName(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_UserName.php"; 
	}
	add_shortcode( "Show_User_Checkout_Info",  'mm_content_fun_CheckoutInfo');
	function mm_content_fun_CheckoutInfo(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_checkout_info.php"; 
	}
	add_shortcode( "Show_User_LevelPage",  'mm_content_fun_LevelPage');
	function mm_content_fun_LevelPage(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_LevelPage.php"; 
	}
	
	add_shortcode( "Show_User_CheckOut_UserInfo_Get",  'mm_content_fun_CheckOut_UserInfo_Get');
	function mm_content_fun_CheckOut_UserInfo_Get(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_CheckoutPage_UserInfo.php"; 
	}
	add_shortcode( "Show_User_CheckOut_Confirm",  'mm_content_fun_CheckOut_Confirm');
	function mm_content_fun_CheckOut_Confirm(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_user_conf.php"; 
	}
	add_shortcode( "Show_User_CreditsPage",  'mm_content_fun_CreditsPage');
	function mm_content_fun_CreditsPage(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_CreditsPage.php"; 
	}
	add_shortcode( "Show_User_X_Button",  'mm_content_fun_X_Button');
	function mm_content_fun_X_Button(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_X_Button_page.php"; 
	}
	
	add_shortcode( "Show_User_CreditValue",  'mm_content_fun_Get_CreditValue');
	function mm_content_fun_Get_CreditValue(){
		include_once MEMBER_CONTENT_DIR_PATH."views/FairOdds/mm_content_Fair_Odds_Pages.php"; 
	}
	
	

	/* 
		@end  Tips Page
	*/




		/*
			@start Highlights 
		*/




			register_activation_hook( __FILE__, 'mm_content_fun_MakeDBForHighlite');
			 function TableName_highlite()
			{
				global $wpdb;
				$value = $wpdb->prefix . 'mm_content_db_HighLightes_RowOnly' ;
				return $value;
			}
			 function mm_content_fun_MakeDBForHighlite()
			{
				$tablename = TableName_highlite();

				$sql = "CREATE TABLE `".$tablename."` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `name` text NOT NULL,
 `time` text NOT NULL,
 `dmr` text NOT NULL,
 `number` text NOT NULL,
 `hour` text NOT NULL,
 `month` text NOT NULL,
 `ft` text NOT NULL,
 `b` text NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1";

			  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			  dbDelta($sql);
			}

		function mm_content_fun_Highlights_adminPage()
		{
			include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Highlights/Highlights_admin_page.php"; 
		}
		function mm_content_fun_Highlights_adminPage_2()
		{
			include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Highlights/Highlights_admin_page_add_Row.php"; 
			//include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Highlights/Highlights_admin_page_2.php"; 
		}
		function mm_content_fun_Highlights_adminPage_3()
		{
			//include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Highlights/Highlights_admin_page_3.php";
		}
		function mm_content_fun_Highlights_adminPage_4()
		{
			//include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Highlights/Highlights_admin_page_4.php";
		}
		function mm_content_fun_Highlights_adminPage_5()
		{
			//include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Highlights/Highlights_admin_page_5.php";
		}

		function mm_content_fun_Highlights_menu()
		{
	    add_menu_page(
	        'Highlights',
	        'Highlights',
	        'manage_options',
	        'member_content_Highlights',
	        'mm_content_fun_Highlights_adminPage',
	        '',
	        1
	    );
	     add_submenu_page(
        'member_content_Highlights',
        'Add Other Title',
        'Add Other Title',
        'manage_options',
        'member_content_Highlights',
        'mm_content_fun_Highlights_adminPage'
    	);

	      add_submenu_page(
        'member_content_Highlights',
        'Add Row',
        'Add Row',
        'manage_options',
        'member_content_Highlights_2_Part',
        'mm_content_fun_Highlights_adminPage_2'
    	);

	   /* 
	    add_submenu_page(
        'member_content_Highlights',
        '3rd',
        '3rd',
        'manage_options',
        'member_content_Highlights_3_Part',
        'mm_content_fun_Highlights_adminPage_3'
    	);
	     add_submenu_page(
        'member_content_Highlights',
        '4th',
        '4th',
        'manage_options',
        'member_content_Highlights_4_Part',
        'mm_content_fun_Highlights_adminPage_4'
    	);
	      add_submenu_page(
        'member_content_Highlights',
        '5th',
        '5th',
        'manage_options',
        'member_content_Highlights_5_Part',
        'mm_content_fun_Highlights_adminPage_5'
    	);
*/

	   
	}



	add_action('admin_menu', 'mm_content_fun_Highlights_menu');

	function mm_content_fun_Highlights_setting()
	{
		register_setting( "member_content_Highlights", "Highlights_Page_first" );
		register_setting( "member_content_Highlights", "Highlights_Page_2" );
		register_setting( "member_content_Highlights", "Highlights_Page_3" );
		register_setting( "member_content_Highlights", "Highlights_Page_4" );
		register_setting( "member_content_Highlights", "Highlights_Page_5" );
		register_setting( "member_content_Highlights", "Highlights_Page_6" );
		register_setting( "member_content_Highlights", "Highlights_Page_7" );
		register_setting( "member_content_Highlights", "Highlights_Page_8" );
		register_setting( "member_content_Highlights", "Highlights_Page_9" );
		register_setting( "member_content_Highlights", "Highlights_Page_10" );
		register_setting( "member_content_Highlights", "Highlights_Page_11" );
		register_setting( "member_content_Highlights", "Highlights_Page_12" );


		/*register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_first" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_2" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_3" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_4" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_5" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_6" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_7" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_8" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_9" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_10" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_11" );
		register_setting( "member_content_Highlights_2_Part", "Highlights_Page_2_12" );



		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_first" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_2" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_3" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_4" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_5" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_6" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_7" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_8" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_9" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_10" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_11" );
		register_setting( "member_content_Highlights_3_Part", "Highlights_Page_3_12" );




		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_first" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_2" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_3" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_4" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_5" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_6" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_7" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_8" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_9" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_10" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_11" );
		register_setting( "member_content_Highlights_4_Part", "Highlights_Page_4_12" );



		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_first" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_2" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_3" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_4" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_5" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_6" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_7" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_8" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_9" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_10" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_11" );
		register_setting( "member_content_Highlights_5_Part", "Highlights_Page_5_12" );
*/




		add_settings_section( "mm_content_Highlights_section_ID", "", "mm_content_fun_Highlights_Setting_Section_part", "member_content_Highlights" );

/*
		add_settings_section( "mm_content_Highlights_section_ID_2", "", "mm_content_fun_Highlights_Setting_Section_part_2_row", "member_content_Highlights_2_Part" );


		add_settings_section( "mm_content_Highlights_section_ID_3", "", "mm_content_fun_Highlights_Setting_Section_part_3_row", "member_content_Highlights_3_Part" );


		add_settings_section( "mm_content_Highlights_section_ID_4", "", "mm_content_fun_Highlights_Setting_Section_part_4_row", "member_content_Highlights_4_Part" );


		add_settings_section( "mm_content_Highlights_section_ID_5", "", "mm_content_fun_Highlights_Setting_Section_part_5_row", "member_content_Highlights_5_Part" );

*/




		add_settings_field( "mm_content_Highlights_field_ID_1", "Header 1", "mm_content_fun_Highlights_Setting_field_part_first", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_2", "Header 2", "mm_content_fun_Highlights_Setting_field_part_2", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_3", "Table data 1", "mm_content_fun_Highlights_Setting_field_part_3", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_4", "Table data 2", "mm_content_fun_Highlights_Setting_field_part_4", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_5", "Table data 3", "mm_content_fun_Highlights_Setting_field_part_5", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_6", "Table data 4", "mm_content_fun_Highlights_Setting_field_part_6", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_7", "Table data 5", "mm_content_fun_Highlights_Setting_field_part_7", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_8", "Table data 6", "mm_content_fun_Highlights_Setting_field_part_8", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_9", "Table data 7", "mm_content_fun_Highlights_Setting_field_part_9", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_10", "Table data 8", "mm_content_fun_Highlights_Setting_field_part_10", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_11", "Footer 1", "mm_content_fun_Highlights_Setting_field_part_11", "member_content_Highlights", "mm_content_Highlights_section_ID");
		add_settings_field( "mm_content_Highlights_field_ID_12", "Footer 2", "mm_content_fun_Highlights_Setting_field_part_12", "member_content_Highlights", "mm_content_Highlights_section_ID");


/*

		add_settings_field( "mm_content_Highlights_2_row_field_ID_1", "1st Part", "mm_content_fun_Highlights_Setting_field_2_row_part_first", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");


		add_settings_field( "mm_content_Highlights_2_row_field_ID_2", "2nd Part", "mm_content_fun_Highlights_Setting_field_2_row_part_2", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_3", "3rd Part", "mm_content_fun_Highlights_Setting_field_2_row_part_3", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_4", "4th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_4", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_5", "5th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_5", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_6", "6th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_6", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_7", "7th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_7", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_8", "8th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_8", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_9", "9th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_9", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_10", "10th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_10", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_11", "11th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_11", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");

		add_settings_field( "mm_content_Highlights_2_row_field_ID_12", "12th Part", "mm_content_fun_Highlights_Setting_field_2_row_part_12", "member_content_Highlights_2_Part", "mm_content_Highlights_section_ID_2");










		add_settings_field( "mm_content_Highlights_3_row_field_ID_1", "1st Part", "mm_content_fun_Highlights_Setting_field_3_row_part_first", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_2", "2nd Part", "mm_content_fun_Highlights_Setting_field_3_row_part_2", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_3", "3rd Part", "mm_content_fun_Highlights_Setting_field_3_row_part_3", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_4", "4th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_4", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_5", "5th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_5", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_6", "6th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_6", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_7", "7th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_7", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_8", "8th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_8", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_9", "9th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_9", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_10", "10th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_10", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_11", "11th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_11", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");

		add_settings_field( "mm_content_Highlights_3_row_field_ID_12", "12th Part", "mm_content_fun_Highlights_Setting_field_3_row_part_12", "member_content_Highlights_3_Part", "mm_content_Highlights_section_ID_3");










		add_settings_field( "mm_content_Highlights_4_row_field_ID_1", "1st Part", "mm_content_fun_Highlights_Setting_field_4_row_part_first", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");
	
	
		add_settings_field( "mm_content_Highlights_4_row_field_ID_2", "2nd Part", "mm_content_fun_Highlights_Setting_field_4_row_part_2", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_3", "3rd Part", "mm_content_fun_Highlights_Setting_field_4_row_part_3", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_4", "4th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_4", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_5", "5th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_5", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_6", "6th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_6", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_7", "7th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_7", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_8", "8th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_8", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_9", "9th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_9", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_10", "10th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_10", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_11", "11th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_11", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");

		add_settings_field( "mm_content_Highlights_4_row_field_ID_12", "12th Part", "mm_content_fun_Highlights_Setting_field_4_row_part_12", "member_content_Highlights_4_Part", "mm_content_Highlights_section_ID_4");








		add_settings_field( "mm_content_Highlights_5_row_field_ID_1", "1st Part", "mm_content_fun_Highlights_Setting_field_5_row_part_first", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_2", "2nd Part", "mm_content_fun_Highlights_Setting_field_5_row_part_2", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_3", "3rd Part", "mm_content_fun_Highlights_Setting_field_5_row_part_3", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_4", "4th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_4", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_5", "5th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_5", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_6", "6th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_6", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_7", "7th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_7", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_8", "8th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_8", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_9", "9th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_9", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_10", "10th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_10", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_11", "11th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_11", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");

		add_settings_field( "mm_content_Highlights_5_row_field_ID_12", "12th Part", "mm_content_fun_Highlights_Setting_field_5_row_part_12", "member_content_Highlights_5_Part", "mm_content_Highlights_section_ID_5");
*/




	}
	add_action( "admin_init", "mm_content_fun_Highlights_setting" );


	//this is the header of the page
	function mm_content_fun_Highlights_Setting_Section_part()
	{
		echo "<h1>Highlights Change</h1>";
	}
	function mm_content_fun_Highlights_Setting_Section_part_2_row()
	{
		echo "<h1>Highlights Change 2 Row</h1>";
	}
	function mm_content_fun_Highlights_Setting_Section_part_3_row()
	{
		echo "<h1>Highlights Change 3 Row</h1>";
	}
	function mm_content_fun_Highlights_Setting_Section_part_4_row()
	{
		echo "<h1>Highlights Change 4 Row</h1>";
	}

	function mm_content_fun_Highlights_Setting_Section_part_5_row()
	{
		echo "<h1>Highlights Change 5 Row</h1>";
	}






	function mm_content_fun_Highlights_Setting_field_part_first()
	{
		$setting = get_option('Highlights_Page_first');
    	?>
    	<textarea name="Highlights_Page_first" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}

	function mm_content_fun_Highlights_Setting_field_part_2()
	{
		$setting = get_option('Highlights_Page_2');
    	?>
    	<textarea name="Highlights_Page_2" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_3()
	{
		$setting = get_option('Highlights_Page_3');
    	?>
    	<input type="text" name="Highlights_Page_3" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_4()
	{
		$setting = get_option('Highlights_Page_4');
    	?>
    	<input type="text" name="Highlights_Page_4" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_5()
	{
		$setting = get_option('Highlights_Page_5');
    	?>
    	<input type="text" name="Highlights_Page_5" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_6()
	{
		$setting = get_option('Highlights_Page_6');
    	?>
    	<input type="text" name="Highlights_Page_6" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_7()
	{
		$setting = get_option('Highlights_Page_7');
    	?>
    	<input type="text" name="Highlights_Page_7" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}

	function mm_content_fun_Highlights_Setting_field_part_8()
	{
		$setting = get_option('Highlights_Page_8');
    	?>
    	<input type="text" name="Highlights_Page_8" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_9()
	{
		$setting = get_option('Highlights_Page_9');
    	?>
    	<input type="text" name="Highlights_Page_9" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_10()
	{
		$setting = get_option('Highlights_Page_10');
    	?>
    	<input type="text" name="Highlights_Page_10" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_11()
	{
		$setting = get_option('Highlights_Page_11');
    	?>
    	<textarea name="Highlights_Page_11" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_part_12()
	{
		$setting = get_option('Highlights_Page_12');
    	?>
    	<textarea name="Highlights_Page_12" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}

















	function mm_content_fun_Highlights_Setting_field_2_row_part_first()
	{
		$setting = get_option('Highlights_Page_2_first');
    	?>
    	<textarea name="Highlights_Page_2_first" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php
	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_2()
	{
		$setting = get_option('Highlights_Page_2_2');
    	?>
    	<textarea name="Highlights_Page_2_2" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_3()
	{
		$setting = get_option('Highlights_Page_2_3');
    	?>
    	<input type="text" name="Highlights_Page_2_3" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_4()
	{
		$setting = get_option('Highlights_Page_2_4');
    	?>
    	<input type="text" name="Highlights_Page_2_4" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_5()
	{
		$setting = get_option('Highlights_Page_2_5');
    	?>
    	<input type="text" name="Highlights_Page_2_5" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_6()
	{
		$setting = get_option('Highlights_Page_2_6');
    	?>
    	<input type="text" name="Highlights_Page_2_6" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_7()
	{
		$setting = get_option('Highlights_Page_2_7');
    	?>
    	<input type="text" name="Highlights_Page_2_7" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}

	function mm_content_fun_Highlights_Setting_field_2_row_part_8()
	{
		$setting = get_option('Highlights_Page_2_8');
    	?>
    	<input type="text" name="Highlights_Page_2_8" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_9()
	{
		$setting = get_option('Highlights_Page_2_9');
    	?>
    	<input type="text" name="Highlights_Page_2_9" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_10()
	{
		$setting = get_option('Highlights_Page_2_10');
    	?>
    	<input type="text" name="Highlights_Page_2_10" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_11()
	{
		$setting = get_option('Highlights_Page_2_11');
    	?>
    	<textarea name="Highlights_Page_2_11" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_2_row_part_12()
	{
		$setting = get_option('Highlights_Page_2_12');
    	?>
    	<textarea name="Highlights_Page_2_12" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}















	function mm_content_fun_Highlights_Setting_field_3_row_part_first()
	{
		$setting = get_option('Highlights_Page_3_first');
    	?>
    	<textarea name="Highlights_Page_3_first" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php
	}

	function mm_content_fun_Highlights_Setting_field_3_row_part_2()
	{
		$setting = get_option('Highlights_Page_3_2');
    	?>
    	<textarea name="Highlights_Page_3_2" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_3()
	{
		$setting = get_option('Highlights_Page_3_3');
    	?>
    	<input type="text" name="Highlights_Page_3_3" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_4()
	{
		$setting = get_option('Highlights_Page_3_4');
    	?>
    	<input type="text" name="Highlights_Page_3_4" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_5()
	{
		$setting = get_option('Highlights_Page_3_5');
    	?>
    	<input type="text" name="Highlights_Page_3_5" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_6()
	{
		$setting = get_option('Highlights_Page_3_6');
    	?>
    	<input type="text" name="Highlights_Page_3_6" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_7()
	{
		$setting = get_option('Highlights_Page_3_7');
    	?>
    	<input type="text" name="Highlights_Page_3_7" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}

	function mm_content_fun_Highlights_Setting_field_3_row_part_8()
	{
		$setting = get_option('Highlights_Page_3_8');
    	?>
    	<input type="text" name="Highlights_Page_3_8" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_9()
	{
		$setting = get_option('Highlights_Page_3_9');
    	?>
    	<input type="text" name="Highlights_Page_3_9" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_10()
	{
		$setting = get_option('Highlights_Page_3_10');
    	?>
    	<input type="text" name="Highlights_Page_3_10" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_11()
	{
		$setting = get_option('Highlights_Page_3_11');
    	?>
    	<textarea name="Highlights_Page_3_11" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_3_row_part_12()
	{
		$setting = get_option('Highlights_Page_3_12');
    	?>
    	<textarea name="Highlights_Page_3_12" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}










	function mm_content_fun_Highlights_Setting_field_4_row_part_first()
	{
		$setting = get_option('Highlights_Page_4_first');
    	?>
    	<textarea name="Highlights_Page_4_first" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php
	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_2()
	{
		$setting = get_option('Highlights_Page_4_2');
    	?>
    	<textarea name="Highlights_Page_4_2" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_3()
	{
		$setting = get_option('Highlights_Page_4_3');
    	?>
    	<input type="text" name="Highlights_Page_4_3" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_4()
	{
		$setting = get_option('Highlights_Page_4_4');
    	?>
    	<input type="text" name="Highlights_Page_4_4" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_5()
	{
		$setting = get_option('Highlights_Page_4_5');
    	?>
    	<input type="text" name="Highlights_Page_4_5" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_6()
	{
		$setting = get_option('Highlights_Page_4_6');
    	?>
    	<input type="text" name="Highlights_Page_4_6" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_7()
	{
		$setting = get_option('Highlights_Page_4_7');
    	?>
    	<input type="text" name="Highlights_Page_4_7" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}

	function mm_content_fun_Highlights_Setting_field_4_row_part_8()
	{
		$setting = get_option('Highlights_Page_4_8');
    	?>
    	<input type="text" name="Highlights_Page_4_8" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_9()
	{
		$setting = get_option('Highlights_Page_4_9');
    	?>
    	<input type="text" name="Highlights_Page_4_9" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_10()
	{
		$setting = get_option('Highlights_Page_4_10');
    	?>
    	<input type="text" name="Highlights_Page_4_10" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_11()
	{
		$setting = get_option('Highlights_Page_4_11');
    	?>
    	<textarea name="Highlights_Page_4_11" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_4_row_part_12()
	{
		$setting = get_option('Highlights_Page_4_12');
    	?>
    	<textarea name="Highlights_Page_4_12" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}










	function mm_content_fun_Highlights_Setting_field_5_row_part_first()
	{
		$setting = get_option('Highlights_Page_5_first');
    	?>
    	<textarea name="Highlights_Page_5_first" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php
	}

	function mm_content_fun_Highlights_Setting_field_5_row_part_2()
	{
		$setting = get_option('Highlights_Page_5_2');
    	?>
    	<textarea name="Highlights_Page_5_2" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_3()
	{
		$setting = get_option('Highlights_Page_5_3');
    	?>
    	<input type="text" name="Highlights_Page_5_3" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_4()
	{
		$setting = get_option('Highlights_Page_5_4');
    	?>
    	<input type="text" name="Highlights_Page_5_4" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_5()
	{
		$setting = get_option('Highlights_Page_5_5');
    	?>
    	<input type="text" name="Highlights_Page_5_5" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_6()
	{
		$setting = get_option('Highlights_Page_5_6');
    	?>
    	<input type="text" name="Highlights_Page_5_6" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_7()
	{
		$setting = get_option('Highlights_Page_5_7');
    	?>
    	<input type="text" name="Highlights_Page_5_7" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}

	function mm_content_fun_Highlights_Setting_field_5_row_part_8()
	{
		$setting = get_option('Highlights_Page_5_8');
    	?>
    	<input type="text" name="Highlights_Page_5_8" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_9()
	{
		$setting = get_option('Highlights_Page_5_9');
    	?>
    	<input type="text" name="Highlights_Page_5_9" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_10()
	{
		$setting = get_option('Highlights_Page_5_10');
    	?>
    	<input type="text" name="Highlights_Page_5_10" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" >
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_11()
	{
		$setting = get_option('Highlights_Page_5_11');
    	?>
    	<textarea name="Highlights_Page_5_11" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}
	function mm_content_fun_Highlights_Setting_field_5_row_part_12()
	{
		$setting = get_option('Highlights_Page_5_12');
    	?>
    	<textarea name="Highlights_Page_5_12" rows="4" cols="100"><?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?></textarea>
    	<?php

	}





















	add_action( 'wp_ajax_Highlights', 'mm_content_fun_Highlights_Data_RowOnly_handler' );

	function mm_content_fun_Highlights_Data_RowOnly_handler()
	{
		global $wpdb;

		if ($_REQUEST['parem'] == 'Highlights_Data_RowOnly') {
			
			//print_r($_REQUEST);
			$wpdb->insert(TableName_highlite(),array(
				"name"=>test_input($_REQUEST['txt_1']),
				"time"=>$_REQUEST['txt_2'],
				"dmr"=>$_REQUEST['txt_3'],
				"number"=>test_input($_REQUEST['txt_4']),
				"hour"=>$_REQUEST['txt_5'],
				"month"=>$_REQUEST['txt_6'],
				"ft"=>test_input($_REQUEST['txt_7']),
				"b"=>$_REQUEST['txt_8']
				

			));

			echo json_encode(array("status"=>1,"message"=>"Data added successfully in Highlights Database."));
			
			

			//print_r($_REQUEST);
		}
		else if ($_REQUEST['parem'] == 'Highlights_Data_RowOnly_Delete') {
			
			//print_r($_REQUEST);
			
			$wpdb->delete(TableName_highlite(), array(
				"id"=>$_REQUEST['id']
			));

			echo json_encode(array("status"=>1,"message"=>"Data deleted successfully from Highlights Database."));
			
		}
		
		wp_die();
	}









	add_shortcode( "Show_User_Highlights_Option",  'mm_content_fun_Highlights_Option_fontend');
	function mm_content_fun_Highlights_Option_fontend(){
		include_once MEMBER_CONTENT_DIR_PATH."views/Highlights/mm_content_user_Highlights_Option_fontend.php"; 
	}

















		/*
			@end Highlights 
		*/











			/*
			@Start Fair Odds 
		*/

			register_activation_hook( __FILE__, 'mm_content_fun_MakeDBForFairOdds');
			 function TableName_FairOdds()
			{
				global $wpdb;
				$value = $wpdb->prefix . 'mm_content_db_fairOdds_admin_add' ;
				return $value;
			}
			 function TableName_FairOdds_buy()
			{
				global $wpdb;
				$value = $wpdb->prefix . 'mm_content_db_fairodd_buy' ;
				return $value;
			}
			 function mm_content_fun_MakeDBForFairOdds()
			{
				$tablename = TableName_FairOdds();

				$sql = "CREATE TABLE `".$tablename."` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `Title` text NOT NULL,
 `CreditCost` text NOT NULL,
 `DocLink` text NOT NULL,
 `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	

		$table2 = TableName_FairOdds_buy();
		
		$sql2 = "CREATE TABLE `".$table2."` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `user_ID_Buy` text NOT NULL,
 `Credit_id` text NOT NULL,
 `Total_Credit_buy` text NOT NULL,
 `BuyTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

			  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			  dbDelta($sql);
			  dbDelta($sql2);
			}


			function mm_content_fun_FairOdds_See()
			{
				include_once MEMBER_CONTENT_DIR_PATH."OtherFile/FairOdds/See.php"; 
			}
			function mm_content_fun_FairOdds_Add()
			{
				include_once MEMBER_CONTENT_DIR_PATH."OtherFile/FairOdds/Add.php"; 
			}
			function mm_content_fun_FairOdds_user()
			{
				include_once MEMBER_CONTENT_DIR_PATH."OtherFile/FairOdds/user.php"; 
			}

			function mm_content_fun_OptionMenu_FairOdds()
			{
				    add_menu_page(
				        'Fair Odds',
				        'Fair Odds ',
				        'manage_options',
				        'member_content_FairOdds_See',
				        'mm_content_fun_FairOdds_See',
				        '',
				        1
				    );

				     add_submenu_page(
			        'member_content_FairOdds_See',
			        'See Information',
			        'See Information',
			        'manage_options',
			        'member_content_FairOdds_See',
			        'mm_content_fun_FairOdds_See'
			    	);

				      add_submenu_page(
			        'member_content_FairOdds_See',
			        'Add Information',
			        'Add Information',
			        'manage_options',
			        'member_content_FairOdds_Add',
			        'mm_content_fun_FairOdds_Add'
			    	);
				       add_submenu_page(
			        'member_content_FairOdds_See',
			        'User Information',
			        'User Information',
			        'manage_options',
			        'member_content_FairOdds_user',
			        'mm_content_fun_FairOdds_user'
			    	);
		}


	add_action('admin_menu', 'mm_content_fun_OptionMenu_FairOdds');




	add_action( 'wp_ajax_FairOdds', 'mm_content_fun_FairOddsAddData_handler' );
	function mm_content_fun_FairOddsAddData_handler()
	{
		
		global $wpdb;
		if ($_REQUEST['parem'] == 'FairOddsAdd_Data') {
			
			//print_r($_REQUEST);
			$wpdb->insert(TableName_FairOdds(),array(
				"Title"=>test_input($_REQUEST['txtTitle_fairOdds']),
				"CreditCost"=>$_REQUEST['CreditCost_fairOdds'],
				"DocLink"=>$_REQUEST['FileLink_fairOdds']
				
			));

			echo json_encode(array("status"=>1,"message"=>"Data added successfully in Fair Odds Database."));
			
			
		}


		else if ($_REQUEST['parem'] == 'FairOdds_Data_Delete') {
			
			//print_r($_REQUEST);
			
			$wpdb->delete(TableName_FairOdds(), array(
				"ID"=>$_REQUEST['id']
			));

			echo json_encode(array("status"=>1,"message"=>"Data deleted successfully in Fair Odds Database."));
			
		}

		wp_die();
	}




	add_action( 'wp_ajax_FairOdd_Buy_user', 'mm_content_fun_FairOdds_UserBuy_AddData_handler' );
	function mm_content_fun_FairOdds_UserBuy_AddData_handler()
	{
		
		global $wpdb;
		if ($_REQUEST['parem'] == 'FairOdd_Buy_user_Add_Data') {
			
			//print_r($_REQUEST);
			$wpdb->insert(TableName_FairOdds_buy(),array(
				"user_ID_Buy"=>$_REQUEST['userId'],
				"Credit_id"=>$_REQUEST['CreditBuyId'],
				"Total_Credit_buy"=>$_REQUEST['CreditBuyCurrent']
				
			));
			 $sql = "SELECT * FROM `wp_mm_content_db_fairodds_admin_add` WHERE `ID` = ".$_REQUEST['CreditBuyId'];
 			$results = $wpdb->get_results($sql);




 			
 			echo json_encode(array("status"=>1,"Link"=>$results[0]->DocLink , "Cost" => $results[0]->CreditCost));

			
			
			
		}


		

		wp_die();
	}


			/*
			@end Fair Odds 
		*/




	add_shortcode( "Show_User_Simple_Workout_Report",  'mm_content_fun_Simple_Workout_Report');
	function mm_content_fun_Simple_Workout_Report(){
		include_once MEMBER_CONTENT_DIR_PATH."views/user/mm_content_Sample_Workout_Reports_page.php"; 
	}
	








	function mm_content_fun_Membership_user_admin()
	{
	    add_menu_page(
	        'Membership',
	        'Membership',
	        'manage_options',
	        'member_content_Membership_admin_add',
	        'mm_content_fun_Membership_admin_add',
	        '',
	        1
	    );
	    
	     add_submenu_page(
			 'member_content_Membership_admin_add',
			  'Add User',
			   'Add User',
			   'manage_options',
			    'member_content_Membership_admin_add',
			   'mm_content_fun_Membership_admin_add'
			    	);

		add_submenu_page(
			        'member_content_Membership_admin_add',
			        'See User',
			        'See User',
			        'manage_options',
			        'member_content_Membership_admin_see',
			        'mm_content_fun_Membership_admin_see'
			 );

	    
	}
	
	add_action('admin_menu', 'mm_content_fun_Membership_user_admin');
	function mm_content_fun_Membership_admin_add(){
		include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Membership/Add.php"; 
	}
	function mm_content_fun_Membership_admin_see(){
		include_once MEMBER_CONTENT_DIR_PATH."OtherFile/Membership/See.php"; 
	}
	

    function luhn_check($number) {

      // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
      $number=preg_replace('/\D/', '', $number);
    
      // Set the string length and parity
      $number_length=strlen($number);
      $parity=$number_length % 2;
    
      // Loop through each digit and do the maths
      $total=0;
      for ($i=0; $i<$number_length; $i++) {
        $digit=$number[$i];
        // Multiply alternate digits by two
        if ($i % 2 == $parity) {
          $digit*=2;
          // If the sum is two digits, add them together (in effect)
          if ($digit > 9) {
            $digit-=9;
          }
        }
        // Total up the digits
        $total+=$digit;
      }
    
      // If the total mod 10 equals 0, the number is valid
      return ($total % 10 == 0) ? TRUE : FALSE;

    }
    
    function validatecard($number)
     {
        global $type;
    
        $cardtype = array(
            "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
            "mastercard" => "/^5[1-5][0-9]{14}$/",
            "amex"       => "/^3[47][0-9]{13}$/",
            "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
           
        );
    
        if (preg_match($cardtype['visa'],$number))
        {
    	$type= "Visa";
        return 'Visa';
    	
        }
        else if (preg_match($cardtype['mastercard'],$number))
        {
    	$type= "Mastercard";
            return 'Mastercard';
        }
        else if (preg_match($cardtype['amex'],$number))
        {
    	$type= "American Express";
            return 'American Express';
    	
        }
        else if (preg_match($cardtype['discover'],$number))
        {
    	$type= "Discover";
        return 'Discover';
        }
        else
        {
            return "Unknown Card Type";
        } 
     }


    

    add_action( 'wp_ajax_MemberLevelAdmin', 'mm_content_fun_MemberLevelAdminAdd_handler' );
	function mm_content_fun_MemberLevelAdminAdd_handler()
	{
		
		   global $wpdb;
		if ($_REQUEST['parem'] == 'MemberLevelAdminAdd_Data') {
		    $user_info =  json_decode(str_replace('\"', '"',  $_REQUEST['User_info']),true);
    		$Membership_level_info =  json_decode(str_replace('\"', '"',  $_REQUEST['Membership_level_info']),true);
    		$isAlreadtHave = 0;
    		if(strpos($Membership_level_info['name'], 'Credit') === false){
    		    $st = "success";
		        $us_id = $user_info['id'];
		        $sql_Main_1 = $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_orders` WHERE `user_id` = ".$us_id." AND `status` = '".$st."'");
		        $st = "active";
		        $sql_Main_2= $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `user_id` = ".$us_id." AND `status` = '".$st."' AND `startdate` < `enddate`");
		        $isAlreadtHave = count($sql_Main_2) + count($sql_Main_1);
    		}
    	
    		
		    
		    
		    
		    if($isAlreadtHave == 0){
		    
		    
		    
		    
		    $gateway = "";
		    $sql3 = $wpdb->get_results("SELECT `checkout_id` FROM `wp_pmpro_membership_orders` ORDER BY `wp_pmpro_membership_orders`.`checkout_id` DESC LIMIT 1");
			$checout_id = $sql3[0]->checkout_id;
			$checout_id = (int)$checout_id + 1;
			$datenow = strtotime('now');
			$valueexp = 0;
			if(strpos($Membership_level_info['name'], 'Credit') === false){
    			$date = strtotime($_REQUEST['date']);
    			$valueexp = $date - $datenow;
    			//echo $valueexp."\n";
			}else{
			    $date = strtotime('now')+15;
    			$valueexp = $date - $datenow;
    			//echo $valueexp."\n";
			}
			
			if($valueexp >= 15){
			    
			
			
    		    if($_REQUEST['paymentValue'] == "Cash"){
    		        $gateway = "cash";
    		    }
    		    else{
    		          $val = luhn_check($_REQUEST['cardNumber']);
    		          if(val){
    		               $gateway = validatecard($_REQUEST['cardNumber']);
    		          }
    		          else{
    		               $gateway = "Unknown Card Type";
    		          }
    		    }
    		      
    		            
    			       
    			        $code = "Admin_".strtoupper(uniqid());
    			        $user_id = $user_info['id'];
    			        $membership_id = $Membership_level_info['id'];
    			        $billing_name = $user_info['display_name'];
    			        $billing_street = $_REQUEST['Address'];
    			        $billing_city =   $_REQUEST['City'];
    			        $billing_state =  $_REQUEST['State'];
    			        $billing_zip =    $_REQUEST['zip'];
    			        $billing_country =$_REQUEST['bcountry'];
    			        $billing_phone =  $_REQUEST['phone'];
    			        $subtotal = $Membership_level_info['initial_payment'];
    			        $tax = '0';
    			        $checout_id = $checout_id;
    			        $certificate_id = 0;
    			        $total = $subtotal;
    			        if($gateway == "cash"){
    			            $cardtype = "";
    			            $accountnumber = "";
    			            $expirationmonth = "";
    			            $expirationyear = "";
    			        }
    			        else{
    			            $cardtype = $gateway;
    			            $accountnumber = $_REQUEST['cardNumber'];
    			            $expdate = $_REQUEST['cardExpir'];
    			            $month = date("m",strtotime($expdate));
    			            $yer = date("Y",strtotime($expdate));
    			            $expirationmonth = $month;
    			            $expirationyear = $yer;
    			            $gateway = "";
    			        }
    			        $status = "success";
    			        $gateway_environment = "sandbox";

    		    if(isset($_REQUEST['date'])){
    			         $status = "success";
    		    }
    		    else{
                    $status = "cancelled";
    		    }
    		
    		$pmpro_membership_orders = array(
    		            'code' => $code,
    			        'user_id' => $user_id,
    			        'membership_id' =>  $membership_id,
    			        'billing_name' =>   $billing_name,
    			        'billing_street' => $billing_street,
    			        'billing_city' =>   $billing_city,
    			        'billing_state' =>  $billing_state,
    			        'billing_zip' =>    $billing_zip ,
    			        'billing_country' =>$billing_country,
    			        'billing_phone' =>  $billing_phone,
    			        'subtotal' =>  $subtotal,
    			        'tax' => $tax,
    			        'checkout_id' => $checout_id,
    			        'certificate_id' => $certificate_id,
    			        'total' => $subtotal,
    			        'cardtype' => $cardtype,
    			        'accountnumber' => $accountnumber,
    			        'expirationmonth' => $expirationmonth,
    			        'expirationyear' => $expirationyear,
    			        'status' => $status,
    			        'gateway' => $gateway,
    			        'gateway_environment' => $gateway_environment,
    			        'payment_transaction_id'=> "TRANS_".$code,
    			        'timestamp' => date('Y-m-d h:m:s'),

    		    );
    		    
                $wpdb->insert( "wp_pmpro_membership_orders", $pmpro_membership_orders) or die("Database error");
                
                $expire_date_1 = date('Y-m-d' , strtotime($_REQUEST['date']));
                $expire_date_final = date($expire_date_1." 00:00:00");
                if($status == 'success'){
                    $status = "active";
                    $expire_date_final = date($expire_date_1." 00:00:00");
                }
                else{
                    $status ="changed";
                    $expire_date_final = date('Y-m-d h:m:s');
                }
               
                
                /*
                $now = strtotime('now');
                $fu = strtotime($expire_date_1." 00:00:00");
                
                echo $fu - $now."\n";
                */
                
                $wp_pmpro_memberships_users = array(
    		            'user_id' => $user_id , 
    		            'membership_id' => $membership_id, 
    		            'code_id' => '0', 
    		            'initial_payment' => $subtotal, 
    		            'billing_amount' =>0.00, 
    		            'cycle_number' =>0,
    		            'cycle_period' => "",
    		            'billing_limit' =>0, 
    		            'trial_amount' =>0.00, 
    		            'trial_limit' =>0,
    		            'status' => $status, 
    		            'startdate' => date('Y-m-d h:m:s'),
    		            'enddate' => $expire_date_final, 
    		            'modified' =>date('Y-m-d h:m:s'),

    		    );
    		    
    		    
                 $wpdb->insert( "wp_pmpro_memberships_users", $wp_pmpro_memberships_users) or die("Database error");
                
                
                
                echo json_encode(array("status"=>1,"message"=>"Add Data Successfully"));
                  
                 
    			
    		}
    		else{
    		    	echo json_encode(array("status"=>0,"message"=>"You must Give the Expiration date greater than 600 seconds or 10 minutes"));
    		}
		    }
		    else if($isAlreadtHave == 1){
		           echo json_encode(array("status"=>0,"message"=>"Something is problem , Please contact the developers "));
		    }
		     else if($isAlreadtHave == 2){
		           echo json_encode(array("status"=>0,"message"=>"Already Have A Membership This User."));
		    }
		}
		
		
		
		if ($_REQUEST['parem'] == 'MemberLevelAdminSee_Data') {
		    
		    if($_REQUEST['User_See_delete'] == "seeInfo"){
		        
		        $sql1 = $wpdb->get_results("SELECT * FROM `wp_users` WHERE `ID` = ".$_REQUEST['User_Id']);
		        $sql2 = $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_orders` WHERE `user_id` = ".$_REQUEST['User_Id']);
		        $sql3 = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `user_id` = ".$_REQUEST['User_Id']);
		        $sql4 = $wpdb->get_results("SELECT * FROM `wp_mm_content_db_fairodd_buy` WHERE `user_ID_Buy` = ".$_REQUEST['User_Id']);
		        $credit = UserCredit($_REQUEST['User_Id']);
		        $sql5 = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` INNER JOIN `wp_pmpro_membership_levels` ON `wp_pmpro_membership_levels`.`ID` = `wp_pmpro_memberships_users`.`membership_id` WHERE `wp_pmpro_memberships_users`.`status` = 'active' AND `wp_pmpro_memberships_users`.`user_id` = ".$_REQUEST['User_Id']);
		       
		         echo json_encode(array(
		             "status"=>'seeInfo',
		             "users"=>$sql1,
		             "membership_orders"=>$sql2,
		             "memberships_users"=>$sql3,
		             "fairodd_buy"=>$sql4 ,
		             "TotalCredit"=>$credit,
		             "CurrentRuningMembership" => $sql5
		             ));
		        
		    }
		    else if($_REQUEST['User_See_delete'] == "deleteInfo"){
		         
		          $sql1 = $wpdb->get_results("DELETE FROM `wp_users` WHERE `wp_users`.`ID` = ".$_REQUEST['User_Id']);
		          $sql2 = $wpdb->get_results("DELETE FROM `wp_pmpro_membership_orders` WHERE `wp_pmpro_membership_orders`.`user_id` = ".$_REQUEST['User_Id']);
		          $sql3 = $wpdb->get_results("DELETE FROM `wp_pmpro_memberships_users` WHERE `wp_pmpro_memberships_users`.`user_id` = ".$_REQUEST['User_Id']);
		          $sql4 = $wpdb->get_results("DELETE FROM `wp_mm_content_db_fairodd_buy` WHERE `wp_mm_content_db_fairodd_buy`.`user_ID_Buy`= ".$_REQUEST['User_Id']);
		        
		        
		         echo json_encode(array(
		             "status"=>'deleteInfo'
		             
		             ));
		    }
		    
		    
		}
		
		
		
		
		
		
		
		
		
		
    

		
		wp_die();
	}







    function UserCredit($userId){
        global $wpdb;
        $sql = "SELECT * FROM `wp_pmpro_membership_levels` WHERE `name` LIKE '%Credit%'";
 
         
         $sql2 = "SELECT * FROM `wp_pmpro_memberships_users` WHERE `user_id` = ".$userId;
         
         $results = $wpdb->get_results($sql);
         $arrayProduct = array();
         
         $results2 = $wpdb->get_results($sql2);
         $arrayUserProduct = array();
         
         
         foreach($results as $key) {
             array_push($arrayProduct, $key->id);
         }
         
         
         $UserProductBuy = array();
         foreach($results2 as $key) {
             array_push($arrayUserProduct, $key->membership_id);
             if(in_array($key->membership_id, $arrayProduct)){
             	 
                 $sql = "SELECT * FROM `wp_pmpro_membership_levels` WHERE `id` = ".$key->membership_id;
                 $results = $wpdb->get_results($sql);
                 $name = (int) $results[0]->name;
                 array_push($UserProductBuy, $name);
             }
         }
         $userCredit = array_sum($UserProductBuy);
	
       
        $user_ID = $userId;
        $sqlBuyCredit = "SELECT * FROM `".TableName_FairOdds_buy()."` WHERE `user_ID_Buy` = ".$user_ID;
        $resultsBuyCredit = $wpdb->get_results($sqlBuyCredit);   
    	   $previousBuy = 0;
         $CurrentUserFairOddBuy_Id =  array();
        if (count($resultsBuyCredit) >= 1) {
        	$previousBuy = 0;
        	foreach ($resultsBuyCredit as $key) {
        		$previousBuy += (int)$key->Total_Credit_buy; 
            array_push($CurrentUserFairOddBuy_Id, $key->Credit_id);
        	}
    
    
    	     $userCredit -= $previousBuy ;
    
           //print_r($CurrentUserFairOddBuy_Id);
        	
        	 
        }
        else{
        	$userCredit = array_sum($UserProductBuy) - $previousBuy ;
        }
         
         
         return $userCredit;
         
         
    }














function bartag_func( $atts ) {
	$_SESSION["price"] = $atts['price'];
	//print_r($atts);
	

	include_once MEMBER_CONTENT_DIR_PATH."/payment/user.php"; 
	
}
add_shortcode( 'test', 'bartag_func' );








?>