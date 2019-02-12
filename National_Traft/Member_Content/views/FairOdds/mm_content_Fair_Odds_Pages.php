<?php
 global $wpdb;

 $sql = "SELECT * FROM `wp_pmpro_membership_levels` WHERE `name` LIKE '%Credit%'";
 
 $userId = get_current_user_id();
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

?>

<h1><?php //echo $userId ?></h1>
<h1><?php //print_r($arrayProduct); ?></h1>
<h1><?php //print_r($arrayUserProduct); ?></h1>
<h1><?php //print_r($UserProductBuy); ?></h1>










<?php

    
	$userCredit = array_sum($UserProductBuy);
	global $wpdb;
    $user_info = wp_get_current_user();
    $user_ID = $user_info->ID;
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




    $sql = "SELECT * FROM `".TableName_FairOdds()."` ORDER BY `".TableName_FairOdds()."`.`ID` DESC LIMIT 10";
    $results = $wpdb->get_results($sql);   
    
  //print_r($results);


?>	
<br>

		
          <style>


           .workout_reportbg
              {
                  
                    background-size: cover;
                    background-position: 50%;
                    padding: 40px;
                    font-weight:700px;
              }

              .workout_report_button
              {
                  font-size: 18px ;
                  text-decoration: none;
                  border-radius:0px;
                  background-color:#003f9b;
                  color:#fff!important;
                  border:0px!important;
                  padding: 10px 20px;
              }
              .workout_report_button:hover
              {
                  text-decoration:none!important;
              }
              
              @media all and (min-width:768px)
              {

                  
                  .button-div
                  {
                      display:flex;
                      align-items:center;
                      justify-content: flex-end;
                  }
              }
          	
          </style>


<script src="http://localhost:8088/nationalturf.teamalfy.com/wp-content/plugins/Member_Content/assect/js/mm_content_fontEnd.js" ></script>

<script>


</script>

<div class="container ">
    
	<h2> Remaining Credit(s): <?php echo $userCredit; ?></h2>

</div>
<div class="container ">
           <div id = "get_URL_Ajax" url_id= "<?php echo admin_url("admin-ajax.php") ?>"></div>
      <?php  if (count($results) >= 1) {

      		foreach ($results as $key) {

      			?>

      			<div class="row workout_reportbg"  style="width:100%;">

			            <div class="col-md-7 text-md-left text-center " >


			            	 		 <h2 style="color:#003f9c;font-weight:700;"> <?php echo $key->Title; ?> </h2>

									<h5 style="color:#fff;">  
										<?php
										  $dateDB = new DateTime($key->Time);
                    					  $dateDB_Formet = $dateDB->format('M d');
                   						  echo $dateDB_Formet;

										  ?> 

									</h5>

			                

			                        
			            </div>
			            
			            <div class="col-md-5 button-div text-md-left text-center" >

			            	<?php 
                    if (in_array($key->ID, $CurrentUserFairOddBuy_Id)) {
                       ?>
                       <button class="btn btn-primary workout_report_button" style="color: white;">
                           <a href="<?php echo $key->DocLink;?>" target="_blank" style="text-decoration: none;color:#fff;"> Download </a>
                      </button>
                       <?php
                    }
                    else{
                    
    			            		$isUserBuy = false;
    			            		if($userCredit >= $key->CreditCost){
    			            			$isUserBuy = true;
    			            		}
    			            	if($isUserBuy){
			            		?>

			            		<form action="javascript:void(0)" id="<?php echo "FormFairOddsBuy_".$key->ID ;?>" method="post" >
			            			
				            		<input type="hidden" name="userId" value="<?php echo $user_ID ?>">
				            		<input type="hidden" name="CreditBuyId" value="<?php echo $key->ID;  ?>">
				            		<input type="hidden" name="CreditBuyCurrent" value="<?php echo $key->CreditCost;  ?>">
					            	<button  class="btn btn-primary workout_report_button"  id="<?php echo "ButtonFairOddBuy".$key->ID ;?>">- <?php echo $key->CreditCost;  ?> Credit(s) </button>
			            	   </form>
			            		<?php

			            	}
			            	else{
			            		?>
			            		<button class="btn btn-primary workout_report_button disabled" >
					            		  - <?php echo $key->CreditCost;  ?> Credit(s) 
					            </button>
			            		<?php

			            	}
                  }

			            	 ?>

			            	
			               
			            </div>

        	</div>
        <br>
            <script>
              


jQuery(document).ready(function($) {
    
       $("#<?php echo "FormFairOddsBuy_".$key->ID ;?>").submit(function(){
          var Value = jQuery("#<?php echo "FormFairOddsBuy_".$key->ID ;?>").val();
          var Value2 = jQuery("#get_URL_Ajax").attr("url_id");
           $("#<?php echo "ButtonFairOddBuy".$key->ID ;?>").attr("disabled", "disabled");
            //
            $("#<?php echo "ButtonFairOddBuy".$key->ID ;?>").html("<i class=\"fa fa-refresh fa-spin\"></i>");

          
        //alert(Value2);
        var postValue = "action=FairOdd_Buy_user&parem=FairOdd_Buy_user_Add_Data&"+jQuery("#<?php echo "FormFairOddsBuy_".$key->ID ;?>").serialize();
            //console.log(postValue);
            jQuery.post(Value2,postValue,function(response){
                    //console.log(response);

                    var data = jQuery.parseJSON(response);
                    var crdt = " Download ";
                    $("#<?php echo "ButtonFairOddBuy".$key->ID ;?>").removeAttr("disabled");  
                    $("#<?php echo "ButtonFairOddBuy".$key->ID ;?>").html(crdt);  
                    if (data.status == 1) {
                        setTimeout(function(){
                            location.reload();
                        },50)
                                              
                    } 
                    
                }) ;

    });
});






            </script>

      			<?php
      			
      		}
      }
      else{
      		echo "No Data Found";

      } ?>    
          
      
        
      

</div>
       
