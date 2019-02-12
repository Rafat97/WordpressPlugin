<?php
        global $wpdb;
        $user_info = wp_get_current_user();
    	$user_ID = $user_info->ID;
		$sql1 = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `user_id` = ".$user_ID ." AND `status` = \"active\"");
		$sql2 = $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_orders` WHERE `user_id` = ".$user_ID ." AND `status` = \"success\"");
		if (count($sql1) >= 1 && count($sql2) >= 1) {
		       
		        $date = new DateTime('now');
                        $result = $date->format('Y-m-d');


                        $date = new DateTime($sql1[0]->enddate);
                        $givenFormet = $date->format('Y-m-d');
                        
                        $date1 = date_create($givenFormet);
                        $date2 = date_create($result);

                        $diff=date_diff($date2,$date1);
                        $val = $diff->format("%R%a"); 


                        $MemberShipRepoet = $sql1[0]->membership_id;
                        $sql3 = $wpdb->get_results("SELECT * FROM `wp_pmpro_membership_levels` WHERE `id` = ".$MemberShipRepoet);
                        //remaning date Have
                       
                        
                        //remaning date Have
                       
		    ?>
		    
		    
		    <div class = "RemainingDay">
		        <h3>
		             Remaining Day(s) : <?php echo (int)$val; ?>
		         </h3>
		    </div>
		   
		   
		    <div class = "NameOfActiveMembership">
		        <h3>
		            Your current plan is <?php echo $sql3[0]->name; ?>.
		            
		         </h3>
		         <h4>You can choose a new plan once your current membership plan expires.</h4>
		    </div>
		   
		   
		   
		    <div class = "NameOfActiveMembership_price">
		        <h3>
		            <?php // echo $sql3[0]->initial_payment."$"; ?>
		        </h3>
		    </div>
		    
		    
		  


<script>

jQuery(document).ready(function($) {
    
        jQuery(".membership_upgrade_button").attr("disabled", "disabled");
        
       
});

</script>




  <?php
			
		}


?>








<?php 
global $wpdb, $pmpro_msg, $pmpro_msgt, $current_user;

$pmpro_levels = pmpro_getAllLevels(false, true);
$pmpro_level_order = pmpro_getOption('level_order');

if(!empty($pmpro_level_order))
{
	$order = explode(',',$pmpro_level_order);

	//reorder array
	$reordered_levels = array();
	foreach($order as $level_id) {
		foreach($pmpro_levels as $key=>$level) {
			if($level_id == $level->id)
				$reordered_levels[] = $pmpro_levels[$key];
		}
	}

	$pmpro_levels = $reordered_levels;
}

$pmpro_levels = apply_filters("pmpro_levels_array", $pmpro_levels);

if($pmpro_msg)
{
?>
<div class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
<?php
}
?>
<table id="pmpro_levels_table" class="pmpro_checkout">
<style>
    .no-padding
    {
        padding-left:0px;
        padding-right:0px;
    }
    .membership_price_div
    {
      display: flex;
      align-items: center;
      justify-content: center;   
      background-image:url("http://nationalturf.teamalfy.com/wp-content/uploads/2018/10/membership_price_bg.jpg");
      color:#003f9b;
    }


    @media all and (max-width:768px)
    {
        
        .membership_price_div
        {
            padding-top: 60px;
            text-align: center;
            display: block;
    
        }
    }

    .membership_info
    {
        background-image:url("http://nationalturf.teamalfy.com/wp-content/uploads/2018/10/membership_bg.jpg");
        background-position: center center;
        padding: 40px;
    }

    @media all and (min-width:768px)
    {
        .membership_button_div
        {
          display: flex;
          align-items: center;
          justify-content: flex-end;
    
        }
    }
    
    .membership_upgrade_button
    {
        padding: 0px 60px!important;
        border-radius:0px!important;
        line-height:46px;
        border:0px!important;
        font-size: 14px!important;
        font-weight:600!important;
    }

    @media all and (max-width:768px)
    {
        
        .membership_upgrade_button
        {
            width:100%;
        }
    }
    
    .membership_upgrade_button:hover
    {
        text-decoration:none!important;
    }
</style>


<tbody>
	<?php	
	$count = 0;
	foreach($pmpro_levels as $level)
	{
		$name = $level->name;

		if(strpos($name, 'Credit') === false){





	  if(isset($current_user->membership_level->ID))
		  $current_level = ($current_user->membership_level->ID == $level->id);
	  else
		  $current_level = false;
	?>
	<tr class="<?php if($count++ % 2 == 0) { ?>odd<?php } ?><?php if($current_level == $level) { ?> active<?php } ?>">
		
		
	<div class="row" style="margin-bottom:30px;margin-left:0px;margin-right:0px;">
		
		
		<!-- This Part is see the price Starting Code -->

        <div class="col-md-2 col-4 membership_price_div" >
            <div>
                <?php
                    $cent= $level->initial_payment - floor($level->initial_payment);
                    $cent = ltrim($cent, '0');
                ?>
                <h2 style="font-weight:800;display:inline-block;">  <?php echo floor($level->initial_payment); ?> <sup ><?php echo $cent ;?> </sup>  </h2> 
                <h3 style="font-weight:800;">  USD </h3>                    
            </div>

        </div>
            

		<!-- This Part is see the price Starting Code -->
		
		
		
		
		
		
		
		<!-- This Part is see the name and  description Starting Code -->
		
        <div class="col-md-10 col-8 membership_info" >
            <div class="row">
                <div class="col-xl-7" style="padding:15px;">
                    <div class="row">
                        <h2 style="color:#ffc127"> <?php echo $level->name;?> </h2>
                    </div>
                    <div class="row">
                        <p style="color:#fff;"> <?php echo $level->description;?> </p>
                    </div>                        
                </div>



                

            

		<!-- This Part is see the name and  description Ending Code -->
		
		
		
	
	
	
	
	
	
	
		<!-- This Part is see the button Starting Code -->
                <div class="col-xl-5 membership_button_div no-padding  text-center text-md-right">
		<?php if(empty($current_user->membership_level->ID)) { ?>
			<a class="pmpro_btn pmpro_btn-select yellow_button membership_upgrade_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Purchase', 'paid-memberships-pro' );?></a>
		<?php } elseif ( !$current_level ) { ?>                	
			<a class="pmpro_btn pmpro_btn-select yellow_button membership_upgrade_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Purchase', 'paid-memberships-pro' );?></a>
		<?php } elseif($current_level) { ?>      
			
			<?php
				//if it's a one-time-payment level, offer a link to renew				
				if( pmpro_isLevelExpiringSoon( $current_user->membership_level) && $current_user->membership_level->allow_signups ) {
					?>
						<a class="pmpro_btn disabled yellow_button membership_upgrade_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Current', 'paid-memberships-pro' );?></a>
					<?php
				} else {
					?>
						<a class="pmpro_btn disabled yellow_button membership_upgrade_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Current', 'paid-memberships-pro' );?></a>
					<?php
				}
			?>
			
		<?php } ?>
		
                </div>
            </div>

            
        </div>
		<!-- This Part is see the button Ending Code -->
		
		
		
    </div>			
		
		
		
		
	</tr>

	<?php
	}

	}
	?>
	
</tbody>
</table>

