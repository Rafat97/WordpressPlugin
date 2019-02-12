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

		if(strpos($name, 'Credit') !== false){





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
						<a class="pmpro_btn yellow_button membership_upgrade_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Purchase More', 'paid-memberships-pro' );?></a>
					<?php
				} else {
					?>
						<a class="pmpro_btn yellow_button membership_upgrade_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Purchase More', 'paid-memberships-pro' );?></a>
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

















