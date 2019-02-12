<style>
    p, strong, h3, li
    {
        color:#fff;
    }
    
    h2
    {
        color:#ffc127;
    }
    .nav-next a,    .nav-next a:hover 
    {
        color:#fff;
        text-decoration:none;
    }
</style>

<?php 
	session_start();
	global $wpdb, $current_user, $pmpro_invoice, $pmpro_msg, $pmpro_msgt;


    function DB_Update($id)
	{

		$ch = "cancelled";
		
	    $sqlfunc_1 = "UPDATE `wp_pmpro_membership_orders` SET `status`= '".$ch."' WHERE `id` = ".$id;

	  	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	  	dbDelta($sqlfunc_1);
	}
	function DB_Update_2($id, $date)
	{
		

		$ch = "changed";
		
	    $sqlfunc_1 = "UPDATE `wp_pmpro_memberships_users` SET `status`= '".$ch."' WHERE `id` = ".$id;
	    $sqlfunc_2 = "UPDATE `wp_pmpro_memberships_users` SET `enddate` = '".$date."' WHERE `id` = ".$id;
	   
	    	

	  	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	  	dbDelta($sqlfunc_1);
	  	dbDelta($sqlfunc_2);
	}

	$sql = "SELECT * FROM `wp_pmpro_membership_levels` WHERE `name` LIKE '%Credit%'";
	$results = $wpdb->get_results($sql);
    $arrayProduct = array();
    foreach($results as $key) {
     	array_push($arrayProduct, $key->id);
	}
	$val = $_GET['level'];
	$inCradit = in_array($val, $arrayProduct);
	if ($inCradit ) {
		$user_info = wp_get_current_user();
	    $user_ID = $user_info->ID;

	    $results_Is_have_Workout_order = $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_orders` WHERE `user_id` = ".$user_ID ." AND `status` = \"success\"");
	    $results_Is_have_Workout_user = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `user_id` = ".$user_ID ." AND `status` = \"active\"");

	  
	  
	       $result = $results_Is_have_Workout_order;
	       DB_Update($result[0]->id);

    	  $result = $results_Is_have_Workout_user;
    	  DB_Update_2($result[0]->id , $result[0]->startdate);
	  
	

	 // echo $result[0]->startdate;

	  //print_r($results_Is_have_Workout_order) ;
	  //print_r($results_Is_have_Workout_user);



		if (isset($_SESSION["WorkoutReport_Order"]) && isset($_SESSION["WorkoutReport_User"])) {
			
			

	    	$result1 = $_SESSION["WorkoutReport_Order"];
	    	$result2 = $_SESSION["WorkoutReport_User"];
	    	
	    	//echo $result1[0]->id."<br>";
	    	//echo $result1[0]->status."<br>";

	    	//echo $result2[0]->id."<br>";
	    	//echo $result2[0]->status."<br>";
	    	//echo $result2[0]->enddate."<br>";

	    	 $sql = "UPDATE `wp_pmpro_membership_orders` SET `status`= '".$result1[0]->status."' WHERE `id` = ".$result1[0]->id;

	        $sql2 = "UPDATE `wp_pmpro_memberships_users` SET `status`= '".$result2[0]->status."' WHERE `id` = ".$result2[0]->id;
	    	$sq3 = "UPDATE `wp_pmpro_memberships_users` SET `enddate` = '".$result2[0]->enddate."' WHERE `wp_pmpro_memberships_users`.`id` = ".$result2[0]->id;
	    	
	    	
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
	  		//dbDelta($sql);
	  		//dbDelta($sql2);
	  		//dbDelta($sq3);
	  		dbDelta($sqlMake_Oder);
	  		dbDelta($sqlMake_user);
		
	    	

	   		unset($_SESSION["WorkoutReport_Order"]);
	   		unset($_SESSION["WorkoutReport_User"]);
   		}
   		else {
   			//echo "<h1>First</h1>";
   			unset($_SESSION["WorkoutReport_Order"]);
	   		unset($_SESSION["WorkoutReport_User"]);
   		}
	}
	else {
		
		// echo "<h1>OK Not Cradit</h1><br><br>";
	}
   


	
	if($pmpro_msg)
	{
	?>
		<div class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
	<?php
	}
	
	if(empty($current_user->membership_level))
		$confirmation_message = "<h2>" . __('Your payment has been submitted. Your membership will be activated shortly.', 'paid-memberships-pro' ) . "</h2>";
	else
		$confirmation_message = "<h2>" . sprintf(__('Thank you for your membership to %s. Your %s membership is now active.', 'paid-memberships-pro' ), get_bloginfo("name"), $current_user->membership_level->name) . "</h2>";		
	
	//confirmation message for this level
	$level_message = $wpdb->get_var("SELECT l.confirmation FROM $wpdb->pmpro_membership_levels l LEFT JOIN $wpdb->pmpro_memberships_users mu ON l.id = mu.membership_id WHERE mu.status = 'active' AND mu.user_id = '" . $current_user->ID . "' LIMIT 1");
	if(!empty($level_message))
		$confirmation_message .= "\n" . stripslashes($level_message) . "\n";
?>	

<?php if(!empty($pmpro_invoice) && !empty($pmpro_invoice->id)) { ?>		
	
	<?php
		$pmpro_invoice->getUser();
		$pmpro_invoice->getMembershipLevel();			
				
		$confirmation_message .= "<p>" . sprintf(__('Below are details about your membership account and a receipt for your initial membership invoice. A welcome email with a copy of your initial membership invoice has been sent to %s.', 'paid-memberships-pro' ), $pmpro_invoice->user->user_email) . "</p>";
		
		//check instructions
		if($pmpro_invoice->gateway == "check" && !pmpro_isLevelFree($pmpro_invoice->membership_level))
			$confirmation_message .= wpautop(wp_unslash( pmpro_getOption("instructions") ) );
		
		/**
		 * All devs to filter the confirmation message.
		 * We also have a function in includes/filters.php that applies the the_content filters to this message.
		 * @param string $confirmation_message The confirmation message.
		 * @param object $pmpro_invoice The PMPro Invoice/Order object.
		 */
		$confirmation_message = apply_filters("pmpro_confirmation_message", $confirmation_message, $pmpro_invoice);				
		
		echo $confirmation_message;
	?>
	
	
	<h3>
		<?php printf(__('Invoice #%s on %s', 'paid-memberships-pro' ), $pmpro_invoice->code, date_i18n(get_option('date_format'), $pmpro_invoice->timestamp));?>		
	</h3>
	<a class="pmpro_a-print" href="javascript:window.print()"><?php _e('Print', 'paid-memberships-pro' );?></a>
	<ul>
		<?php do_action("pmpro_invoice_bullets_top", $pmpro_invoice); ?>
		<li><strong><?php _e('Account', 'paid-memberships-pro' );?>:</strong> <?php echo $current_user->display_name?> (<?php echo $current_user->user_email?>)</li>
		<li><strong><?php _e('Membership Level', 'paid-memberships-pro' );?>:</strong> <?php echo $current_user->membership_level->name?></li>
		<?php if($current_user->membership_level->enddate) { ?>
			<li><strong><?php _e('Membership Expires', 'paid-memberships-pro' );?>:</strong> <?php echo date_i18n(get_option('date_format'), $current_user->membership_level->enddate)?></li>
		<?php } ?>
		<?php if($pmpro_invoice->getDiscountCode()) { ?>
			<li><strong><?php _e('Discount Code', 'paid-memberships-pro' );?>:</strong> <?php echo $pmpro_invoice->discount_code->code?></li>
		<?php } ?>
		<?php do_action("pmpro_invoice_bullets_bottom", $pmpro_invoice); ?>
	</ul>
	<hr />	
	<div class="pmpro_invoice_details">
		<?php if(!empty($pmpro_invoice->billing->name)) { ?>
			<div class="pmpro_invoice-billing-address">
				<strong><?php _e('Billing Address', 'paid-memberships-pro' );?></strong>
				<p><?php echo $pmpro_invoice->billing->name?><br />
				<?php echo $pmpro_invoice->billing->street?><br />						
				<?php if($pmpro_invoice->billing->city && $pmpro_invoice->billing->state) { ?>
					<?php echo $pmpro_invoice->billing->city?>, <?php echo $pmpro_invoice->billing->state?> <?php echo $pmpro_invoice->billing->zip?> <?php echo $pmpro_invoice->billing->country?><br />												
				<?php } ?>
				<?php echo formatPhone($pmpro_invoice->billing->phone)?>
				</p>
			</div> <!-- end pmpro_invoice-billing-address -->
		<?php } ?>
		
		<?php if($pmpro_invoice->accountnumber) { ?>
			<div class="pmpro_invoice-payment-method">
				<strong><?php _e('Payment Method', 'paid-memberships-pro' );?></strong>
				<p><?php echo $pmpro_invoice->cardtype?> <?php _e('ending in', 'paid-memberships-pro' );?> <?php echo last4($pmpro_invoice->accountnumber)?></p>
				<p><?php _e('Expiration', 'paid-memberships-pro' );?>: <?php echo $pmpro_invoice->expirationmonth?>/<?php echo $pmpro_invoice->expirationyear?></p>
			</div> <!-- end pmpro_invoice-payment-method -->
		<?php } elseif($pmpro_invoice->payment_type) { ?>
			<?php echo $pmpro_invoice->payment_type?>
		<?php } ?>
		
		<div class="pmpro_invoice-total">
			<strong><?php _e('Total Billed', 'paid-memberships-pro' );?></strong>
			<p><?php if($pmpro_invoice->total != '0.00') { ?>
				<?php if(!empty($pmpro_invoice->tax)) { ?>
					<?php _e('Subtotal', 'paid-memberships-pro' );?>: <?php echo pmpro_formatPrice($pmpro_invoice->subtotal);?><br />
					<?php _e('Tax', 'paid-memberships-pro' );?>: <?php echo pmpro_formatPrice($pmpro_invoice->tax);?><br />
					<?php if(!empty($pmpro_invoice->couponamount)) { ?>
						<?php _e('Coupon', 'paid-memberships-pro' );?>: (<?php echo pmpro_formatPrice($pmpro_invoice->couponamount);?>)<br />
					<?php } ?>
					<strong><?php _e('Total', 'paid-memberships-pro' );?>: <?php echo pmpro_formatPrice($pmpro_invoice->total);?></strong>
				<?php } else { ?>
					<?php echo pmpro_formatPrice($pmpro_invoice->total);?>
				<?php } ?>						
			<?php } else { ?>
				<small class="pmpro_grey"><?php echo pmpro_formatPrice(0);?></small>
			<?php } ?></p>
		</div> <!-- end pmpro_invoice-total -->

	</div> <!-- end pmpro_invoice -->
	<hr />
<?php 
	} 
	else 
	{
		$confirmation_message .= "<p>" . sprintf(__('Below are details about your membership account. A welcome email has been sent to %s.', 'paid-memberships-pro' ), $current_user->user_email) . "</p>";
		
		/**
		 * All devs to filter the confirmation message.
		 * Documented above.
		 * We also have a function in includes/filters.php that applies the the_content filters to this message.		 
		 */
		$confirmation_message = apply_filters("pmpro_confirmation_message", $confirmation_message, false);
		
		echo $confirmation_message;
	?>	
	<ul>
		<li><strong><?php _e('Account', 'paid-memberships-pro' );?>:</strong> <?php echo $current_user->display_name?> (<?php echo $current_user->user_email?>)</li>
		<li><strong><?php _e('Membership Level', 'paid-memberships-pro' );?>:</strong> <?php if(!empty($current_user->membership_level)) echo $current_user->membership_level->name; else _e("Pending", 'paid-memberships-pro' );?></li>
	</ul>	
<?php 
	} 
?>  
<nav class="navigation" role="navigation" style="text-align:left;">
	<button class="nav-next yellow_button btn">
		<?php if(!empty($current_user->membership_level)) { ?>
		   <!-- https://nationalturf.teamalfy.com/index.php/membership-levels -->
			<a href="<?php echo pmpro_url("account");?>" >
			    <?php _e('View Your Membership Account', 'paid-memberships-pro' );?> 
			</a>
		<?php } else { ?>
			<?php _e('If your account is not activated within a few minutes, please contact the site owner.', 'paid-memberships-pro' );?>
		<?php } ?>
	</button>
</nav>
