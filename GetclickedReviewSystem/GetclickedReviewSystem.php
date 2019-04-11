<?php
/*
Plugin Name:  GetClick Review System
Plugin URI:   
Description:  Make For use the  GetClick Review System 
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
	if(!defined("GETCLICK_BTX_DIR_PATH")){
		define('GETCLICK_BTX_DIR_PATH',plugin_dir_path( __FILE__ ));
	}
	if(!defined("GETCLICK_BTX_URL")){
		define('GETCLICK_BTX_URL',plugin_dir_url( __FILE__ ));
	}
	
	function TableName_ReviewSystem()
	{
		global $wpdb;
		$value = $wpdb->prefix . 'GetClickReviewSystemDB' ;
		return $value;
		
	 }
	  function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
	}
	function GetClickReviewFilesUploadImage_URL()
    {
        	$upload = wp_upload_dir();
            $upload_url = $upload['baseurl']."/GetClickReviewFiles/";
            return $upload_url;
            
    }
    function GetClickReviewFilesUploadImage_DIR()
    {
        	$upload = wp_upload_dir();
            $upload_dir = $upload['basedir'];
            $upload_dir = $upload_dir . '/GetClickReviewFiles/';
            return $upload_dir;
    }
	 
	function GETCLICK_BTX_ReviewSystemDB_SQL()
    {
        	$tablename = "CREATE TABLE `".TableName_ReviewSystem()."` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `businessName` text COLLATE utf8_unicode_ci NOT NULL,
                         `businessEmail` text COLLATE utf8_unicode_ci NOT NULL,
                         `googleLink` longtext COLLATE utf8_unicode_ci,
                         `fbLink` longtext COLLATE utf8_unicode_ci,
                         `RateMDsLink` longtext COLLATE utf8_unicode_ci,
                         `YelpLink` longtext COLLATE utf8_unicode_ci,
                         `RealSelfLink` longtext COLLATE utf8_unicode_ci,
                         `ImageLink` longtext COLLATE utf8_unicode_ci NOT NULL,
                         `ImagePath` longtext COLLATE utf8_unicode_ci NOT NULL,
                         `GeneratedLink` longtext COLLATE utf8_unicode_ci NOT NULL,
                         `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
        	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        	dbDelta($tablename);
    }
    register_activation_hook( __FILE__, 'GETCLICK_BTX_ReviewSystemDB_SQL');
    
    function GETCLICK_BTX_DirecteryCreat()
    {
        	$upload = wp_upload_dir();
            $upload_dir = $upload['basedir'];
            $upload_dir = $upload_dir . '/GetClickReviewFiles';
            if (! is_dir($upload_dir)) {
               mkdir( $upload_dir, 0700 );
            }
    }
	register_activation_hook( __FILE__, 'GETCLICK_BTX_DirecteryCreat' );
	
	function getclick_btx_slug_CustomReview()
	{
		include_once GETCLICK_BTX_DIR_PATH."admin/reviewsystem/review_info_admin.php"; 
	}
	function GETCLICK_BTX_fun_AdminMenu()
	{
	    add_menu_page(
	        'Custom Review System ',
	        'Custom Review System ',
	        'manage_options',
	        'getclick_btx_slug_CustomReview',
	        'getclick_btx_fun_CustomReview',
	        '',
	        1
	    );

	     add_submenu_page(
	        'getclick_btx_slug_CustomReview',
	        'Custom Review System',
	        'Custom Review System',
	        'manage_options',
	        'getclick_btx_slug_CustomReview',
	        'getclick_btx_slug_CustomReview'
    	);
	     
	}
	add_action('admin_menu', 'GETCLICK_BTX_fun_AdminMenu');


    add_shortcode( "show_user_review_page", 'GETCLICK_BTX_fun_ReviewSystemShow_ShortCode');
	function GETCLICK_BTX_fun_ReviewSystemShow_ShortCode(){
		include_once GETCLICK_BTX_DIR_PATH."views/reviewsystem/User_See_Page.php"; 
	}
	add_shortcode( "show_user_review_page_make", 'GETCLICK_BTX_fun_ReviewSystemMake_ShortCode');
	function GETCLICK_BTX_fun_ReviewSystemMake_ShortCode(){
		include_once GETCLICK_BTX_DIR_PATH."views/reviewsystem/User_ReviewMake_Page.php"; 
	}
	
	
	
    add_action("wp_ajax_FormReviewSystemForm", "my_user_vote");
    add_action('wp_ajax_nopriv_FormReviewSystemForm', 'my_user_vote');
    function my_user_vote() {
        global $wpdb;
        
      
        
        $BSName = test_input($_POST['UserBusinessName']);
        $BSEmail = test_input($_POST['UserEmail']);
        $FBurl = test_input($_POST['FacebookLink']);
        $GOOGLEurl = test_input($_POST['GoogleLink']);
        $RateMDsurl = test_input($_POST['RateMDsLink']);
        $Yelpurl = test_input($_POST['YelpLink']);
        $RealSelfurl = test_input($_POST['RealSelfLink']);
        $FileName = test_input($_FILES['fileToUpload']['name']);
        $GanetetedUrlIs = "https://getclicked.co/reviews/?review=".str_replace(" ","-",$BSName);
    
       //$sql = "SELECT * FROM `".TableName_ReviewSystem()."` WHERE `GeneratedLink` = '".$GanetetedUrlIs."' AND `businessName` = '".$BSName."'";
       $sql = "SELECT * FROM `6bc_GetClickReviewSystemDB`";
        $results = $wpdb->get_results("SELECT * FROM `6bc_GetClickReviewSystemDB` WHERE `GeneratedLink` = \"".$GanetetedUrlIs."\"");
        //echo "SELECT * FROM `6bc_GetClickReviewSystemDB` WHERE `GeneratedLink` = \"".$GanetetedUrlIs."\" AND `businessName` = \"".$BSName."\" ";
       //print_r($results);
       
       if(count($results) >= 1){
           $success = json_encode(array('status'=>'error' ,'message'=>'Alrady Have An Account '));
           echo $success;
           
       }
       
       else{
       
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            
            $uploadedfile = $_FILES['fileToUpload'];
    
            $upload_overrides = array( 'test_form' => false );
            
            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
            
            if ( $movefile && ! isset( $movefile['error'] ) ) {
                $FileLink = $movefile['url'];
                $FilePath= $movefile['file'];
                //print_r($movefile);
                
                 $Db_insert = array(
            		           'businessName'=>$BSName,
            		           'businessEmail'=>$BSEmail,
            		           'googleLink'=>$GOOGLEurl,
            		           'fbLink'=>$FBurl,
            		           'RateMDsLink'=>$RateMDsurl,
            		           'YelpLink'=>$Yelpurl,
            		           'RealSelfLink'=>$RealSelfurl,
            		           'ImageLink'=>$FileLink,
            		           'ImagePath'=>$FilePath,
            		           'GeneratedLink'=>$GanetetedUrlIs,
            		    );
                $wpdb->insert( TableName_ReviewSystem(), $Db_insert) or die(json_encode(array("status"=>"error","message"=>"Database Error")));
                $to = $BSEmail;
                $subject = "Your Review System Link";
                $headers = 'Review System Mail';
                $message = "Your Review System Link is ".$GanetetedUrlIs;
                $sent = wp_mail($to, $subject, $message, $headers);
                if($sent){
                     $success = json_encode(array('status'=>'success' ,'message'=>$GanetetedUrlIs ));
                    echo $success;
                }else{
                    $success = json_encode(array('status'=>'error' ,'message'=>"Mail Not Sent" ));
                    echo $success;
                }
               
            } else {
                $error = json_encode(array('status'=>'error' ,'message'=>$movefile['error'] ));
                echo $error;
            }
       }
        
        wp_die();
    }
	
	
	
	add_action("wp_ajax_FormReviewSystemEditDeleteAdmin", "AdminReviewEditDelete");
    //add_action('wp_ajax_nopriv_FormReviewSystemForm', 'AdminReviewEditDelete');
    function AdminReviewEditDelete() {
        global $wpdb;
        
        if($_REQUEST['type'] == 'DeleteReviewSystem'){
            $wpdb->delete( TableName_ReviewSystem(), array( 'id'  => $_REQUEST['deleteId'] ));
            echo json_encode(array("status"=>"success","message"=>"Successfully Delete Data"));
        }
        else if($_REQUEST['type'] == 'EditReviewSystem'){
            //print_r($_REQUEST);
            
            
                $id =  $_REQUEST['EditDataid'];
                $bsname = $_REQUEST['UserBusinessName'];
                $bsmail = $_REQUEST['UserEmail'];
                $FacebookLink = $_REQUEST['FacebookLink'];
                $GoogleLink = $_REQUEST['GoogleLink'];
                $RateMDsLink = $_REQUEST['RateMDsLink'];
                $YelpLink = $_REQUEST['YelpLink'];
                $RealSelfLink = $_REQUEST['RealSelfLink'];
                $ImageLink = $_REQUEST['ImageLink'];
                
                $Db_update = array(
        		           'businessName'=>test_input($bsname),
        		           'businessEmail'=>test_input($bsmail),
        		           'googleLink'=>test_input($GoogleLink),
        		           'fbLink'=>test_input($FacebookLink),
        		           'RateMDsLink'=>test_input($RateMDsLink),
        		           'YelpLink'=>test_input($YelpLink),
        		           'RealSelfLink'=>test_input($RealSelfLink),
        		           'ImageLink'=>test_input($ImageLink),
        		    );
        		 try{
                    $wpdb->update(TableName_ReviewSystem(), $Db_update , array('id'=>$id))  ;
                    echo json_encode(array("status"=>"success","message"=>"Successfully Update Data"));
                }catch(Exception $e){
                    echo json_encode(array("status"=>"error","message"=>$e->getMessage()));
                }
        		    
        }
        
        wp_die();
    }
	add_action("wp_ajax_FormReviewSystemBadReviewGive", "UserBagReviewGiven");
    add_action('wp_ajax_nopriv_FormReviewSystemBadReviewGive', 'UserBagReviewGiven');
    function UserBagReviewGiven() {
        
        
        $to = test_input($_REQUEST['bsUserMail']);
        $subject = "Complaint Email ";
        $headers = 'Review System Mail';
        $message = test_input("User Name : ".test_input($_REQUEST['UserName'])."\n\n"."Message : \n".test_input($_REQUEST['UserMessage']));
        $sent = wp_mail($to, $subject, $message, $headers);
        if($sent){
             $success = json_encode(array('status'=>'success' ,'message'=>"Mail Sent" ));
            echo $success;
        }else{
            $success = json_encode(array('status'=>'error' ,'message'=>"Mail Not Sent" ));
            echo $success;
        }
         wp_die();
    }
    
