<?php
session_start();
	global $gateway, $pmpro_review, $skip_account_fields, $pmpro_paypal_token, $wpdb, $current_user, $pmpro_msg, $pmpro_msgt, $pmpro_requirebilling, $pmpro_level, $pmpro_levels, $tospage, $pmpro_show_discount_code, $pmpro_error_fields;
	global $discount_code, $username, $password, $password2, $bfirstname, $blastname, $baddress1, $baddress2, $bcity, $bstate, $bzipcode, $bcountry, $bphone, $bemail, $bconfirmemail, $CardType, $AccountNumber, $ExpirationMonth,$ExpirationYear;

	$pmpro_email_field_type = apply_filters('pmpro_email_field_type', true);

	$sql = "SELECT * FROM `wp_pmpro_membership_levels` WHERE `name` LIKE '%Credit%'";
	$results = $wpdb->get_results($sql);
    $arrayProduct = array();
    foreach($results as $key) {
     	array_push($arrayProduct, $key->id);
	}
	$val = $_GET['level'];
	$inCradit = in_array($val, $arrayProduct);
	if ($inCradit) {
		$user_info = wp_get_current_user();
    	$user_ID = $user_info->ID;
		$sql1 = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `user_id` = ".$user_ID ." AND `status` = \"active\"");
		$sql2 = $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_orders` WHERE `user_id` = ".$user_ID ." AND `status` = \"success\"");
		
		
		if (count($sql1) >= 1 && count($sql2) >= 1) {
				//echo count($sql1);
				//echo count($sql2);
				$_SESSION["WorkoutReport_User"] = $sql1;
				$_SESSION["WorkoutReport_Order"] = $sql2;
				//print_r($_SESSION["WorkoutReport_User"][0]->enddate);
		}

	

	}
	
	
	

?>
<div id="pmpro_level-<?php echo $pmpro_level->id; ?>">
<form id="pmpro_form" class="pmpro_form" action="<?php if(!empty($_REQUEST['review'])) echo pmpro_url("checkout", "?level=" . $pmpro_level->id); ?>" method="post">
    
	<input type="hidden" id="level" name="level" value="<?php echo esc_attr($pmpro_level->id) ?>" />
	<input type="hidden" id="checkjavascript" name="checkjavascript" value="1" />
	<?php if ($discount_code && $pmpro_review) { ?>
		<input class="input <?php echo pmpro_getClassForField("discount_code");?>" id="discount_code" name="discount_code" type="hidden" size="20" value="<?php echo esc_attr($discount_code) ?>" />
	<?php } ?>

	<?php if($pmpro_msg) { ?>
		<div id="pmpro_message" class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
	<?php } else { ?>
		<div id="pmpro_message" class="pmpro_message" style="display: none;"></div>
	<?php } ?>

	<?php if($pmpro_review) { ?>
		<p><?php _e('Almost done. Review the membership information and pricing below then <strong>click the "Complete Payment" button</strong> to finish your order.', 'paid-memberships-pro' );?></p>
	<?php } ?>
	
	
	
	
	
	
	
	




	<?php if($pmpro_show_discount_code) { ?>
	<script>
		<!--
		//update discount code link to show field at top of form
		jQuery('#other_discount_code_a').attr('href', 'javascript:void(0);');
		jQuery('#other_discount_code_a').click(function() {
			jQuery('#other_discount_code_tr').show();
			jQuery('#other_discount_code_p').hide();
			jQuery('#other_discount_code').focus();
		});

		//update real discount code field as the other discount code field is updated
		jQuery('#other_discount_code').keyup(function() {
			jQuery('#discount_code').val(jQuery('#other_discount_code').val());
		});
		jQuery('#other_discount_code').blur(function() {
			jQuery('#discount_code').val(jQuery('#other_discount_code').val());
		});

		//update other discount code field as the real discount code field is updated
		jQuery('#discount_code').keyup(function() {
			jQuery('#other_discount_code').val(jQuery('#discount_code').val());
		});
		jQuery('#discount_code').blur(function() {
			jQuery('#other_discount_code').val(jQuery('#discount_code').val());
		});

		//applying a discount code
		jQuery('#other_discount_code_button').click(function() {
			var code = jQuery('#other_discount_code').val();
			var level_id = jQuery('#level').val();

			if(code)
			{
				//hide any previous message
				jQuery('.pmpro_discount_code_msg').hide();

				//disable the apply button
				jQuery('#other_discount_code_button').attr('disabled', 'disabled');

				jQuery.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',type:'GET',timeout:<?php echo apply_filters("pmpro_ajax_timeout", 5000, "applydiscountcode");?>,
					dataType: 'html',
					data: "action=applydiscountcode&code=" + code + "&level=" + level_id + "&msgfield=pmpro_message",
					error: function(xml){
						alert('Error applying discount code [1]');

						//enable apply button
						jQuery('#other_discount_code_button').removeAttr('disabled');
					},
					success: function(responseHTML){
						if (responseHTML == 'error')
						{
							alert('Error applying discount code [2]');
						}
						else
						{
							jQuery('#pmpro_message').html(responseHTML);
						}

						//enable invite button
						jQuery('#other_discount_code_button').removeAttr('disabled');
					}
				});
			}
		});
		-->
	</script>
	<?php } ?>

	<?php
		do_action('pmpro_checkout_after_pricing_fields');
	?>

	<?php if(!$skip_account_fields && !$pmpro_review) { ?>
	<hr />
	<div id="pmpro_user_fields" class="pmpro_checkout">
  
		<h3>
			<span class="pmpro_checkout-h3-name"><?php _e('Account Information', 'paid-memberships-pro' );?></span>
			<span class="pmpro_checkout-h3-msg"><?php _e('Already have an account?', 'paid-memberships-pro' );?> <a href="<?php echo wp_login_url(pmpro_url("checkout", "?level=" . $pmpro_level->id)); ?>"><?php _e('Log in here', 'paid-memberships-pro' );?></a></span>
		</h3>
		<div class="pmpro_checkout-fields">
			<div class="pmpro_checkout-field pmpro_checkout-field-username">
				<label for="username"><?php _e('Username', 'paid-memberships-pro' );?></label>
				<input id="username" name="username" type="text" class="input <?php echo pmpro_getClassForField("username");?>" size="30" value="<?php echo esc_attr($username); ?>" />
			</div> <!-- end pmpro_checkout-field-username -->

			<?php
				do_action('pmpro_checkout_after_username');
			?>

			<div class="pmpro_checkout-field pmpro_checkout-field-password">
				<label for="password"><?php _e('Password', 'paid-memberships-pro' );?></label>
				<input id="password" name="password" type="password" class="input <?php echo pmpro_getClassForField("password");?>" size="30" value="<?php echo esc_attr($password); ?>" />
			</div> <!-- end pmpro_checkout-field-password -->

			<?php
				$pmpro_checkout_confirm_password = apply_filters("pmpro_checkout_confirm_password", true);
				if($pmpro_checkout_confirm_password) { ?>
					<div class="pmpro_checkout-field pmpro_checkout-field-password2">
						<label for="password2"><?php _e('Confirm Password', 'paid-memberships-pro' );?></label>
						<input id="password2" name="password2" type="password" class="input <?php echo pmpro_getClassForField("password2");?>" size="30" value="<?php echo esc_attr($password2); ?>" />
					</div> <!-- end pmpro_checkout-field-password2 -->
				<?php } else { ?>
					<input type="hidden" name="password2_copy" value="1" />
				<?php } 
			?>

			<?php
				do_action('pmpro_checkout_after_password');
			?>

			<div class="pmpro_checkout-field pmpro_checkout-field-bemail">
				<label for="bemail"><?php _e('E-mail Address', 'paid-memberships-pro' );?></label>
				<input id="bemail" name="bemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="input <?php echo pmpro_getClassForField("bemail");?>" size="30" value="<?php echo esc_attr($bemail); ?>" />
			</div> <!-- end pmpro_checkout-field-bemail -->

			<?php
				$pmpro_checkout_confirm_email = apply_filters("pmpro_checkout_confirm_email", true);
				if($pmpro_checkout_confirm_email) { ?>
					<div class="pmpro_checkout-field pmpro_checkout-field-bconfirmemail">
						<label for="bconfirmemail"><?php _e('Confirm E-mail Address', 'paid-memberships-pro' );?></label>
						<input id="bconfirmemail" name="bconfirmemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="input <?php echo pmpro_getClassForField("bconfirmemail");?>" size="30" value="<?php echo esc_attr($bconfirmemail); ?>" />
					</div> <!-- end pmpro_checkout-field-bconfirmemail -->
				<?php } else { ?>
					<input type="hidden" name="bconfirmemail_copy" value="1" />
				<?php }
			?>

			<?php
				do_action('pmpro_checkout_after_email');
			?>

			<div class="pmpro_hidden">
				<label for="fullname"><?php _e('Full Name', 'paid-memberships-pro' );?></label>
				<input id="fullname" name="fullname" type="text" class="input <?php echo pmpro_getClassForField("fullname");?>" size="30" value="" /> <strong><?php _e('LEAVE THIS BLANK', 'paid-memberships-pro' );?></strong>
			</div> <!-- end pmpro_hidden -->

			<div class="pmpro_checkout-field pmpro_captcha">
			<?php
				global $recaptcha, $recaptcha_publickey;
				if($recaptcha == 2 || ($recaptcha == 1 && pmpro_isLevelFree($pmpro_level))) {
					echo pmpro_recaptcha_get_html($recaptcha_publickey, NULL, true);
				}
			?>
			</div> <!-- end pmpro_captcha -->

			<?php
				do_action('pmpro_checkout_after_captcha');
			?>
		</div>  <!-- end pmpro_checkout-fields -->
	</div> <!-- end pmpro_user_fields -->
	<?php } elseif($current_user->ID && !$pmpro_review) { ?>
	
	
	
	    <!-- Login Information Starting Code -->
	
	
	
	 <!-- Login Information Ending Code -->
		
		
		
		
	<?php } ?>

	<?php
		do_action('pmpro_checkout_after_user_fields');
	?>

	<?php
		do_action('pmpro_checkout_boxes');
	?>







<!-- Information To Select The payment gateway Starting Code  This Is not Testing Part Only when paypal website payment pro  is selected -->



	<?php if(pmpro_getGateway() == "paypal" && empty($pmpro_review) && true == apply_filters('pmpro_include_payment_option_for_paypal', true ) ) { ?>
	<div id="pmpro_payment_method" class="pmpro_checkout" <?php if(!$pmpro_requirebilling) { ?>style="display: none;"<?php } ?>>
		<hr />
		<h3>
			<span class="pmpro_checkout-h3-name"><?php _e('Choose your Payment Method', 'paid-memberships-pro' ); ?></span>
		</h3>
		<div class="pmpro_checkout-fields">
			<span class="gateway_paypal">
				<input type="radio" name="gateway" value="paypal" <?php if(!$gateway || $gateway == "paypal") { ?>checked="checked"<?php } ?> />
				<a href="javascript:void(0);" class="pmpro_radio"><?php _e('Check Out with a Credit Card Here', 'paid-memberships-pro' );?></a>
			</span>
			<span class="gateway_paypalexpress">
				<input type="radio" name="gateway" value="paypalexpress" <?php if($gateway == "paypalexpress") { ?>checked="checked"<?php } ?> />
				<a href="javascript:void(0);" class="pmpro_radio"><?php _e('Check Out with PayPal', 'paid-memberships-pro' );?></a>
			</span>
		</div> <!-- end pmpro_checkout-fields -->
	</div> <!-- end pmpro_payment_method -->
	<?php } ?>
	
	

<!-- Information To Select The payment gateway Ending Code -->





<style>
    /*form.pmpro_form label*/
    /*{*/
    /*  display:none!important;*/
    /*}*/
    
    form.pmpro_form .input, form.pmpro_form textarea, form.pmpro_form select
    {
        max-width:100%;
    }
    
    .half-width
    {
        width:49%;
        display:inline-block;
    }
    
    .full-width
    {
        width:98.3%;
        display:inline-block;        
    }
    
    .larger-width
    {
        width:59%;
        display:inline-block;   
    }
    
    .smaller-width
    {
        width:39%;
        display:inline-block;          
    }
    
    .one-third-width
    {
        width:32.5%;
        display:inline-block;  
    }
    
    .ccv-div
    {
        width: calc(100% - 197px);
        display:inline-block;         
    }
    
    form.pmpro_form .pmpro_payment-cvv .input, form.pmpro_form .pmpro_payment-discount-code .input, form.pmpro_form #other_discount_code.input
    {
        max-width:100%;
    }
    
    form.pmpro_form label
    {
        display:none;
    }
    
    .pmpro_checkout h3
    {
        color:#fff;
    }
    
    .other-inputs
    {
        height:46px;!important;
        background-color:#fff;
    }
</style>





<!-- Information of user Starting Code  -->
	<?php
		$pmpro_include_billing_address_fields = apply_filters('pmpro_include_billing_address_fields', true);
		if($pmpro_include_billing_address_fields) { ?>
	<div id="pmpro_billing_address_fields" class="pmpro_checkout" <?php if(!$pmpro_requirebilling || apply_filters("pmpro_hide_billing_address_fields", false) ){ ?>style="display: none;"<?php } ?>>
		
		<h3>
			<span class="pmpro_checkout-h3-name"><?php _e('GENERAL INFORMATION', 'paid-memberships-pro' );?></span>
		</h3>
		<div class="pmpro_checkout-fields">
			<div class="pmpro_checkout-field pmpro_checkout-field-bfirstname half-width">
				<label for="bfirstname"><?php _e('First Name', 'paid-memberships-pro' );?></label>
				<input id="bfirstname" name="bfirstname" placeholder="<?php _e('First Name', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("bfirstname");?>" size="30" value="<?php echo esc_attr($bfirstname); ?>" />
			</div> <!-- end pmpro_checkout-field-bfirstname -->
			<div class="pmpro_checkout-field pmpro_checkout-field-blastname half-width">
				<label for="blastname"><?php _e('Last Name', 'paid-memberships-pro' );?></label>
				<input id="blastname" name="blastname" placeholder="<?php _e('Last Name', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("blastname");?>" size="30" value="<?php echo esc_attr($blastname); ?>" />
			</div> <!-- end pmpro_checkout-field-blastname -->
			<div class="pmpro_checkout-field pmpro_checkout-field-baddress1 full-width">
				<label for="baddress1"><?php _e('Address 1', 'paid-memberships-pro' );?></label>
				<input id="baddress1" name="baddress1" placeholder="<?php _e('Address 1', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("baddress1");?>" size="30" value="<?php echo esc_attr($baddress1); ?>" />
			</div> <!-- end pmpro_checkout-field-baddress1 -->
			<div class="pmpro_checkout-field pmpro_checkout-field-baddress2 full-width">
				<label for="baddress2"><?php _e('Address 2', 'paid-memberships-pro' );?></label>
				<input id="baddress2" name="baddress2" placeholder="<?php _e('Address 2', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("baddress2");?>" size="30" value="<?php echo esc_attr($baddress2); ?>" />
			</div> <!-- end pmpro_checkout-field-baddress2 -->
			<?php
				$longform_address = apply_filters("pmpro_longform_address", true);
				if($longform_address) { ?>
					<div class="pmpro_checkout-field pmpro_checkout-field-bcity larger-width">
						<label for="bcity"><?php _e('City', 'paid-memberships-pro' );?></label>
						<input id="bcity" name="bcity" placeholder="<?php _e('City', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("bcity");?>" size="30" value="<?php echo esc_attr($bcity); ?>" />
					</div> <!-- end pmpro_checkout-field-bcity -->
					<div class="pmpro_checkout-field pmpro_checkout-field-bstate smaller-width">
						<label for="bstate"><?php _e('State', 'paid-memberships-pro' );?></label>
						<input id="bstate" name="bstate" placeholder="<?php _e('State', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("bstate");?>" size="30" value="<?php echo esc_attr($bstate); ?>" />
					</div> <!-- end pmpro_checkout-field-bstate -->
					<div class="pmpro_checkout-field pmpro_checkout-field-bzipcode one-third-width">
						<label for="bzipcode"><?php _e('Postal Code', 'paid-memberships-pro' );?></label>
						<input id="bzipcode" name="bzipcode" placeholder="<?php _e('Postal Code', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("bzipcode");?>" size="30" value="<?php echo esc_attr($bzipcode); ?>" />
					</div> <!-- end pmpro_checkout-field-bzipcode -->
				<?php } else { ?>
					<div class="pmpro_checkout-field pmpro_checkout-field-bcity_state_zip">
						<label for="bcity_state_zip"><?php _e('City, State Zip', 'paid-memberships-pro' );?></label>
						<input id="bcity" name="bcity" placeholder="<?php _e('City, State Zip', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("bcity");?>" size="14" value="<?php echo esc_attr($bcity); ?>" />,
						<?php
							$state_dropdowns = apply_filters("pmpro_state_dropdowns", false);
							if($state_dropdowns === true || $state_dropdowns == "names") {
								global $pmpro_states;
								?>
								<select name="bstate" class="<?php echo pmpro_getClassForField("bstate");?>">
									<option value="">--</option>
									<?php
										foreach($pmpro_states as $ab => $st) { ?>
											<option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo $st;?></option>
									<?php } ?>
								</select>
							<?php } elseif($state_dropdowns == "abbreviations") {
								global $pmpro_states_abbreviations;
								?>
								<select name="bstate" class="<?php echo pmpro_getClassForField("bstate");?>">
									<option value="">--</option>
									<?php
										foreach($pmpro_states_abbreviations as $ab)
										{
									?>
										<option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo $ab;?></option>
									<?php } ?>
								</select>
							<?php } else { ?>
								<input id="bstate" name="bstate" type="text" class="input <?php echo pmpro_getClassForField("bstate");?>" size="2" value="<?php echo esc_attr($bstate); ?>" />
						<?php } ?>
						<input id="bzipcode" name="bzipcode" type="text" class="input <?php echo pmpro_getClassForField("bzipcode");?>" size="5" value="<?php echo esc_attr($bzipcode); ?>" />
					</div> <!-- end pmpro_checkout-field-bcity_state_zip -->
			<?php } ?>

			<?php
				$show_country = apply_filters("pmpro_international_addresses", true);
				if($show_country) { ?>
					<div class="pmpro_checkout-field pmpro_checkout-field-bcountry one-third-width" >
						<label for="bcountry"><?php _e('Country', 'paid-memberships-pro' );?></label>
						<select name="bcountry" id="bcountry" class="<?php echo pmpro_getClassForField("bcountry");?> other-inputs">
						<?php
							global $pmpro_countries, $pmpro_default_country;
							if(!$bcountry) {
								$bcountry = $pmpro_default_country;
							}
							foreach($pmpro_countries as $abbr => $country) { ?>
								<option value="<?php echo $abbr?>" <?php if($abbr == $bcountry) { ?>selected="selected"<?php } ?>><?php echo $country?></option>
							<?php } ?>
						</select>
					</div> <!-- end pmpro_checkout-field-bcountry -->
				<?php } else { ?>
					<input type="hidden" name="bcountry" value="US" />
				<?php } ?>
			<div class="pmpro_checkout-field pmpro_checkout-field-bphone one-third-width">
				<label for="bphone"><?php _e('Phone', 'paid-memberships-pro' );?></label>
				<input id="bphone" name="bphone" placeholder="<?php _e('Phone', 'paid-memberships-pro' );?>" type="text" class="input <?php echo pmpro_getClassForField("bphone");?>" size="30" value="<?php echo esc_attr(formatPhone($bphone)); ?>" />
			</div> <!-- end pmpro_checkout-field-bphone -->
			<?php if($skip_account_fields) { ?>
			<?php
				if($current_user->ID) {
					if(!$bemail && $current_user->user_email) {
						$bemail = $current_user->user_email;
					}
					if(!$bconfirmemail && $current_user->user_email) {
						$bconfirmemail = $current_user->user_email;
					}
				}
			?>
			<div class="pmpro_checkout-field pmpro_checkout-field-bemail full-width">
				<label for="bemail"><?php _e('E-mail Address', 'paid-memberships-pro' );?></label>
				<input id="bemail" name="bemail" placeholder="<?php _e('E-mail Address', 'paid-memberships-pro' );?>" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="input <?php echo pmpro_getClassForField("bemail");?>" size="30" value="<?php echo esc_attr($bemail); ?>" />
			</div> <!-- end pmpro_checkout-field-bemail -->
			<?php
				$pmpro_checkout_confirm_email = apply_filters("pmpro_checkout_confirm_email", true);
				if($pmpro_checkout_confirm_email) { ?>
					<div class="pmpro_checkout-field pmpro_checkout-field-bconfirmemail full-width">
						<label for="bconfirmemail"><?php _e('Confirm E-mail', 'paid-memberships-pro' );?></label>
						<input id="bconfirmemail" name="bconfirmemail" placeholder="<?php _e('Confirm E-mail', 'paid-memberships-pro' );?>" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="input <?php echo pmpro_getClassForField("bconfirmemail");?>" size="30" value="<?php echo esc_attr($bconfirmemail); ?>" />
					</div> <!-- end pmpro_checkout-field-bconfirmemail -->
				<?php } else { ?>
					<input type="hidden" name="bconfirmemail_copy" value="1" />
				<?php } ?>
			<?php } ?>
		</div> <!-- end pmpro_checkout-fields -->
	</div> <!--end pmpro_billing_address_fields -->
	
	
	<?php } ?>
	
	
	<!-- Information of user Ending Code  -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	<?php do_action("pmpro_checkout_after_billing_fields"); ?>

	<?php
		$pmpro_accepted_credit_cards = pmpro_getOption("accepted_credit_cards");
		$pmpro_accepted_credit_cards = explode(",", $pmpro_accepted_credit_cards);
		$pmpro_accepted_credit_cards_string = pmpro_implodeToEnglish($pmpro_accepted_credit_cards);
	?>

	<?php
		$pmpro_include_payment_information_fields = apply_filters("pmpro_include_payment_information_fields", true);
		if($pmpro_include_payment_information_fields) { ?>
		
		
		
		
		<!-- User Payment Information Starting Code  -->
		
		<div id="pmpro_payment_information_fields" class="pmpro_checkout" <?php if(!$pmpro_requirebilling || apply_filters("pmpro_hide_payment_information_fields", false) ) { ?>style="display: none;"<?php } ?>>
			
			<h3>
				<span class="pmpro_checkout-h3-name"><?php _e('CARD INFORMATION', 'paid-memberships-pro' );?></span>
				<!-- <span class="pmpro_checkout-h3-msg"><?// php printf(__('We Accept %s', 'paid-memberships-pro' ), $pmpro_accepted_credit_cards_string);?></span> -->
			</h3>
			<?php $sslseal = pmpro_getOption("sslseal"); ?>
			<?php if(!empty($sslseal)) { ?>
				<div class="pmpro_checkout-fields-display-seal">
			<?php } ?>
			<div class="pmpro_checkout-fields">
				<?php
					$pmpro_include_cardtype_field = apply_filters('pmpro_include_cardtype_field', false);
					if($pmpro_include_cardtype_field) { ?>
						<div class="pmpro_checkout-field pmpro_payment-card-type">
							<label for="CardType"><?php _e('Card Type', 'paid-memberships-pro' );?></label>
							<select id="CardType" name="CardType" class=" <?php echo pmpro_getClassForField("CardType");?>">
								<?php foreach($pmpro_accepted_credit_cards as $cc) { ?>
									<option value="<?php echo $cc; ?>" <?php if($CardType == $cc) { ?>selected="selected"<?php } ?>><?php echo $cc; ?></option>
								<?php } ?>
							</select>
						</div>
					<?php } else { ?>
						<input type="hidden" id="CardType" name="CardType" value="<?php echo esc_attr($CardType);?>" />
						<script>
							<!--
							jQuery(document).ready(function() {
									jQuery('#AccountNumber').validateCreditCard(function(result) {
										var cardtypenames = {
											"amex"                      : "American Express",
											"diners_club_carte_blanche" : "Diners Club Carte Blanche",
											"diners_club_international" : "Diners Club International",
											"discover"                  : "Discover",
											"jcb"                       : "JCB",
											"laser"                     : "Laser",
											"maestro"                   : "Maestro",
											"mastercard"                : "Mastercard",
											"visa"                      : "Visa",
											"visa_electron"             : "Visa Electron"
										};

										if(result.card_type)
											jQuery('#CardType').val(cardtypenames[result.card_type.name]);
										else
											jQuery('#CardType').val('Unknown Card Type');
									});
							});
							-->
						</script>
					<?php } ?>
				<div class="pmpro_checkout-field pmpro_payment-account-number full-width">
					<label for="AccountNumber"><?php _e('Card Number', 'paid-memberships-pro' );?></label>
					<input id="AccountNumber" name="AccountNumber" placeholder="<?php _e('Card Number', 'paid-memberships-pro' );?>" class="input <?php echo pmpro_getClassForField("AccountNumber");?>" type="text" size="30" value="<?php echo esc_attr($AccountNumber); ?>" data-encrypted-name="number" autocomplete="off" />
				</div>
				<div class="pmpro_checkout-field pmpro_payment-expiration" style="display:inline-block;">
					<label for="ExpirationMonth"><?php _e('Expiration Date', 'paid-memberships-pro' );?></label>
					<select id="ExpirationMonth" name="ExpirationMonth" class=" <?php echo pmpro_getClassForField("ExpirationMonth");?> other-inputs">
						<option value="01" <?php if($ExpirationMonth == "01") { ?>selected="selected"<?php } ?>>01</option>
						<option value="02" <?php if($ExpirationMonth == "02") { ?>selected="selected"<?php } ?>>02</option>
						<option value="03" <?php if($ExpirationMonth == "03") { ?>selected="selected"<?php } ?>>03</option>
						<option value="04" <?php if($ExpirationMonth == "04") { ?>selected="selected"<?php } ?>>04</option>
						<option value="05" <?php if($ExpirationMonth == "05") { ?>selected="selected"<?php } ?>>05</option>
						<option value="06" <?php if($ExpirationMonth == "06") { ?>selected="selected"<?php } ?>>06</option>
						<option value="07" <?php if($ExpirationMonth == "07") { ?>selected="selected"<?php } ?>>07</option>
						<option value="08" <?php if($ExpirationMonth == "08") { ?>selected="selected"<?php } ?>>08</option>
						<option value="09" <?php if($ExpirationMonth == "09") { ?>selected="selected"<?php } ?>>09</option>
						<option value="10" <?php if($ExpirationMonth == "10") { ?>selected="selected"<?php } ?>>10</option>
						<option value="11" <?php if($ExpirationMonth == "11") { ?>selected="selected"<?php } ?>>11</option>
						<option value="12" <?php if($ExpirationMonth == "12") { ?>selected="selected"<?php } ?>>12</option>
					</select>/<select id="ExpirationYear" name="ExpirationYear" class=" <?php echo pmpro_getClassForField("ExpirationYear");?> other-inputs">
						<?php
							for($i = date_i18n("Y"); $i < intval( date_i18n("Y") ) + 10; $i++)
							{
						?>
							<option value="<?php echo $i?>" <?php if($ExpirationYear == $i) { ?>selected="selected"<?php } ?>><?php echo $i?></option>
						<?php
							}
						?>
					</select>
				</div>
				<?php
					$pmpro_show_cvv = apply_filters("pmpro_show_cvv", true);
					if($pmpro_show_cvv) { ?>
					<div class="pmpro_checkout-field pmpro_payment-cvv ccv-div">
						<label for="CVV"><?php _e('Security Code (CVC)', 'paid-memberships-pro' );?></label>
						<input id="CVV" name="CVV" placeholder="<?php _e('Security Code (CVC)', 'paid-memberships-pro' );?>" type="text" size="4" value="<?php if(!empty($_REQUEST['CVV'])) { echo esc_attr($_REQUEST['CVV']); }?>" class="input <?php echo pmpro_getClassForField("CVV");?>" />  
						
						<!--Need to comment out both html and php
						<small>(<a href="javascript:void(0);" onclick="javascript:window.open('<?// php echo pmpro_https_filter(PMPRO_URL); ?>/pages/popup-cvv.html','cvv','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=475');"><?// php _e("what's this?", 'paid-memberships-pro' );?></a>)</small>
						-->
					    
					</div>
				<?php } ?>
				<?php if($pmpro_show_discount_code) { ?>
					<div class="pmpro_checkout-field pmpro_payment-discount-code">
						<label for="discount_code"><?php _e('Discount Code', 'paid-memberships-pro' );?></label>
						<input class="input <?php echo pmpro_getClassForField("discount_code");?>" id="discount_code" name="discount_code" type="text" size="10" value="<?php echo esc_attr($discount_code); ?>" />
						<input type="button" id="discount_code_button" name="discount_code_button" value="<?php _e('Apply', 'paid-memberships-pro' );?>" />
						<p id="discount_code_message" class="pmpro_message" style="display: none;"></p>
					</div>
				<?php } ?>
			</div> <!-- end pmpro_checkout-fields -->
			<?php if(!empty($sslseal)) { ?>
				<div class="pmpro_checkout-fields-rightcol pmpro_sslseal"><?php echo stripslashes($sslseal); ?></div>
			</div> <!-- end pmpro_checkout-fields-display-seal -->
			<?php } ?>
		</div> <!-- end pmpro_payment_information_fields -->
		
		
		
		
		
		
		
		
		
		<!-- User Payment Information Ending Code  -->
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	<?php } ?>
	<script>
		<!--
		//checking a discount code
		jQuery('#discount_code_button').click(function() {
			var code = jQuery('#discount_code').val();
			var level_id = jQuery('#level').val();

			if(code)
			{
				//hide any previous message
				jQuery('.pmpro_discount_code_msg').hide();

				//disable the apply button
				jQuery('#discount_code_button').attr('disabled', 'disabled');

				jQuery.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',type:'GET',timeout:<?php echo apply_filters("pmpro_ajax_timeout", 5000, "applydiscountcode");?>,
					dataType: 'html',
					data: "action=applydiscountcode&code=" + code + "&level=" + level_id + "&msgfield=discount_code_message",
					error: function(xml){
						alert('Error applying discount code [1]');

						//enable apply button
						jQuery('#discount_code_button').removeAttr('disabled');
					},
					success: function(responseHTML){
						if (responseHTML == 'error')
						{
							alert('Error applying discount code [2]');
						}
						else
						{
							jQuery('#discount_code_message').html(responseHTML);
						}

						//enable invite button
						jQuery('#discount_code_button').removeAttr('disabled');
					}
				});
			}
		});
		-->
	</script>

	<?php do_action('pmpro_checkout_after_payment_information_fields'); ?>

	<?php if($tospage && !$pmpro_review) { ?>
		<div id="pmpro_tos_fields" class="pmpro_checkout">
			
			<h3>
				<span class="pmpro_checkout-h3-name"><?php echo $tospage->post_title?></span>
			</h3>
			<div class="pmpro_checkout-fields">
				<div id="pmpro_license" class="pmpro_checkout-field">
<?php echo wpautop(do_shortcode($tospage->post_content));?>
				</div> <!-- end pmpro_license -->
				<input type="checkbox" name="tos" value="1" id="tos" /> <label class="pmpro_label-inline pmpro_clickable" for="tos"><?php printf(__('I agree to the %s', 'paid-memberships-pro' ), $tospage->post_title);?></label>
			</div> <!-- end pmpro_checkout-fields -->
		</div> <!-- end pmpro_tos_fields -->
		<?php
		}
	?>

	<?php do_action("pmpro_checkout_after_tos_fields"); ?>

	<?php do_action("pmpro_checkout_before_submit_button"); ?>








<!-- Submit Button Starding -->
	<div class="pmpro_submit" style="text-align:left;">
		
		<?php if($pmpro_review) { ?>

			<span id="pmpro_submit_span" >
				<input type="hidden" name="confirm" value="1" />
				<input type="hidden" name="token" value="<?php echo esc_attr($pmpro_paypal_token); ?>" />
				<input type="hidden" name="gateway" value="<?php echo esc_attr($gateway); ?>" />
				<input type="submit" class="pmpro_btn pmpro_btn-submit-checkout yellow_button" value="<?php _e('Upgrade Membership', 'paid-memberships-pro' );?>" />
			</span>

		<?php } else { ?>

			<?php
				$pmpro_checkout_default_submit_button = apply_filters('pmpro_checkout_default_submit_button', true);
				if($pmpro_checkout_default_submit_button)
				{
				?>
				<span id="pmpro_submit_span">
					<input type="hidden" name="submit-checkout" value="1" />
					<input type="submit" class="pmpro_btn pmpro_btn-submit-checkout yellow_button" value="<?php if($pmpro_requirebilling) { _e('Upgrade Membership', 'paid-memberships-pro' ); } else { _e('Upgrade Membership', 'paid-memberships-pro' );}?>" />
				</span>
				<?php
				}
			?>

		<?php } ?>

		<span id="pmpro_processing_message" style="visibility: hidden;">
			<?php
				$processing_message = apply_filters("pmpro_processing_message", __("Processing...", 'paid-memberships-pro' ));
				echo $processing_message;
			?>
		</span>
	</div>
	
    <!-- Submit Button Starding -->
	
	
	
	
	
	
	
	
</form>

<?php do_action('pmpro_checkout_after_form'); ?>

</div> <!-- end pmpro_level-ID -->

<script>
<!--
	// Find ALL <form> tags on your page
	jQuery('form').submit(function(){
		// On submit disable its submit button
		jQuery('input[type=submit]', this).attr('disabled', 'disabled');
		jQuery('input[type=image]', this).attr('disabled', 'disabled');
		jQuery('#pmpro_processing_message').css('visibility', 'visible');
	});

	//iOS Safari fix (see: http://stackoverflow.com/questions/20210093/stop-safari-on-ios7-prompting-to-save-card-data)
	var userAgent = window.navigator.userAgent;
	if(userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
		jQuery('input[type=submit]').click(function() {
			try{
				jQuery("input[type=password]").attr("type", "hidden");
			} catch(ex){
				try {
					jQuery("input[type=password]").prop("type", "hidden");
				} catch(ex) {}
			}
		});
	}

	//add required to required fields
	jQuery('.pmpro_required').after('<span class="pmpro_asterisk"> <abbr title="Required Field">*</abbr></span>');

	//unhighlight error fields when the user edits them
	jQuery('.pmpro_error').bind("change keyup input", function() {
		jQuery(this).removeClass('pmpro_error');
	});

	//click apply button on enter in discount code box
	jQuery('#discount_code').keydown(function (e){
	    if(e.keyCode == 13){
		   e.preventDefault();
		   jQuery('#discount_code_button').click();
	    }
	});

	//hide apply button if a discount code was passed in
	<?php if(!empty($_REQUEST['discount_code'])) {?>
		jQuery('#discount_code_button').hide();
		jQuery('#discount_code').bind('change keyup', function() {
			jQuery('#discount_code_button').show();
		});
	<?php } ?>

	//click apply button on enter in *other* discount code box
	jQuery('#other_discount_code').keydown(function (e){
	    if(e.keyCode == 13){
		   e.preventDefault();
		   jQuery('#other_discount_code_button').click();
	    }
	});
-->
</script>
<script>
<!--
//add javascriptok hidden field to checkout
jQuery("input[name=submit-checkout]").after('<input type="hidden" name="javascriptok" value="1" />');
-->
</script>




















