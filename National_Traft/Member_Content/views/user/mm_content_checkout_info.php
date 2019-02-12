<?php 

if(isset($_GET['level'])){
    global $wpdb;
    $linkChange = true;
    $value1 = $_GET['level'];
    $sql2 = "SELECT * FROM `wp_pmpro_membership_levels` WHERE `id` = ".$value1;
    
    $results1 = $wpdb->get_results($sql2);
  
    $name1 = $results1[0]->name ;
    if(strpos($name1, 'Credit') !== false){
        //credits page link
        $linkChange = true;
    }
    else{
        //levels page link
         $linkChange = false;
    }
}   

?>


<?php


  

  global $wpdb;
  $results = $wpdb->get_results( "SELECT * FROM `wp_pmpro_membership_levels`");



?>

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

<div class="container" style="width:100%;">
      <?php 
      if($linkChange){
          ?>
          <h1 style="color: #003f9c;">Purchase Fair Odds</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut</p>
          <?php
            if (count($results) > 0) {
              foreach ($results as $key) {
                  $name = $key->name;
                if(strpos($name, 'Credit') !== false){
        ?>
          

      <div class="row">

            <div class="col-md-2 col-4 membership_price_div" >
                <div>
                    <?php
                        $cent= $key->initial_payment - floor($key->initial_payment);
                        $cent = ltrim($cent, '0');
                    ?>
                    <h2 style="font-weight:800;display:inline-block;">  <?php echo floor($key->initial_payment); ?> <sup ><?php echo $cent ;?> </sup>  </h2> 
                    <h3 style="font-weight:800;">  USD </h3>                    
                </div>

            </div>
            
            <div class="col-md-10 col-8 membership_info" >
                <div class="row">
                    <div class="col-xl-7" style="padding:15px;">
                        <div class="row">
                            <h2 style="color:#ffc127"> <?php echo $key->name;?> </h2>
                        </div>
                        <div class="row">
                            <p style="color:#fff;"> <?php echo $key->description;?> </p>
                        </div>                        
                    </div>
                    <div class="col-xl-5 membership_button_div no-padding text-center text-md-right">

                        <input class="yellow_button membership_upgrade_button" type="submit" style="padding:0px 60px;font-weight:600!important;" value = "Purchase">
                    
                    </div>
                </div>

                
            </div>


        </div>
        <br>

       <?php
                  
              }
            }
       }

         ?>
        <script>
            jQuery(document).ready(function( $ ){
              {
                  $('.sidebar-credits').css({'background-color': '#ffc127'});
              }
            });
        </script>
          
          <?php
      }
      else{
          ?>
          <h1 style="color: #003f9c;">Purchase Workout Report</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut</p>          
          
          
          <?php
            if (count($results) > 0) {
              foreach ($results as $key) {
                  $name = $key->name;
                if(strpos($name, 'Credit') === false){
        ?>

      <div class="row">

            <div class="col-md-2 col-4 membership_price_div" >
                <div>
                    <?php
                        $cent= $key->initial_payment - floor($key->initial_payment);
                        $cent = ltrim($cent, '0');
                    ?>
                    <h2 style="font-weight:800;display:inline-block;">  <?php echo floor($key->initial_payment); ?> <sup ><?php echo $cent ;?> </sup>  </h2> 
                    <h3 style="font-weight:800;">  USD </h3>                    
                </div>

            </div>
            
            <div class="col-md-10 col-8 membership_info" >
                <div class="row">
                    <div class="col-xl-7" style="padding:15px;">
                        <div class="row">
                            <h2 style="color:#ffc127"> <?php echo $key->name;?> </h2>
                        </div>
                        <div class="row">
                            <p style="color:#fff;"> <?php echo $key->description;?> </p>
                        </div>                        
                    </div>
                    <div class="col-xl-5 membership_button_div no-padding text-center text-md-right">

                        <input class="yellow_button membership_upgrade_button" type="submit" style="padding:0px 60px;font-weight:600!important;" value = "Upgrade">
                    
                    </div>
                </div>

                
            </div>


        </div>
        <br>

       <?php
                  
              }
            }
       }

         ?>
        <script>
            jQuery(document).ready(function( $ ){
              {
                  $('.sidebar-membership').css({'background-color': '#ffc127'});
              }
            });
        </script>
           
          
    <?php      
      }
      ?>
      
       
</div>


