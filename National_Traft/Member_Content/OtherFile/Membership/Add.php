<?php

global $wpdb;

$sql3 = "SELECT `checkout_id` FROM `wp_pmpro_membership_orders` ORDER BY `wp_pmpro_membership_orders`.`checkout_id` DESC LIMIT 1";

$sql1 = "SELECT * FROM `wp_pmpro_membership_levels`";
$sql2 = "SELECT * FROM `wp_users`";
$results = $wpdb->get_results($sql1);
$user = $wpdb->get_results($sql2);


?>
<center>
<h4>
<?php 
    $date = date("m-d-Y h:m:s",strtotime('now'));
    
        echo "Current Date And Time(mm-dd-yyyy h:m;s)  : ".$date."<br><br>";
    
?>
</h4>
</center>
<form action="javascript:void(0)" method = 'post' id = "add_membership_admin" enctype="multipart/form-data">
  <div class="form-group">
    <label for="email">Select Email Address:</label>
    <select name = "User_info" >
             <?php 
        foreach ($user as $key) {

        ?>
        
          <option value='<?php 
          
          echo str_replace('"', '"',  json_encode(array("id"=>$key->ID,"user_email"=>$key->user_email,"user_login"=> $key->user_login , "user_nicename" => $key->user_nicename ,"display_name"=>$key->display_name))) ;
          
          ?>'><?php echo $key->user_email ;?></option>
         
        <?php 
        
        }
        ?>
    </select>
  </div>
  <div class="form-group" id= "MembershipLevelOption">
    <label for="pwd">Membership Level:</label>
    <select name = "Membership_level_info">
            <?php 
        foreach ($results as $key) {

        ?>
        
        <option value='<?php 
          
          echo str_replace('"', '"',  json_encode(array("id"=>$key->id,"name"=>$key->name ,"initial_payment"=> $key->initial_payment , "expiration_number_period" => $key->expiration_number." ".$key->expiration_period))) ;
          
          ?>'><?php echo  $key->name ;?></option>
        
        
         
         
        <?php 
        
        }
        ?>
    </select>
  </div>
  
  
  
  <div class="form-group">
    <label for="Address">Address:</label>
   <input type="text" id="Address" name="Address" required>
  </div>
  <div class="form-group">
    <label for="city">City:</label>
   <input type="text" id="City" name="City" required>
  </div>
  <div class="form-group">
    <label for="State">State:</label>
   <input type="text" id="State" name="State" required>
  </div>
  <div class="form-group">
    <label for="zip">zip:</label>
   <input type="text" id="zip" name="zip" required>
  </div>
  <div class="form-group">
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
   
  </div>
  <div class="form-group">
    <label for="phone">Phone:</label>
  <input type="phone" id="phone" name="phone" required>
  </div>
  
  
      <div id="payWay" class="form-group">
        <label for="paymentValue">PaymentWay Way:</label>
        <select name = "paymentValue">
             <option value='Credit Card'>Credit Card</option>
              <option value='Cash'>Cash</option>
        </select>
    </div>
        
        
        
    <div class="form-group" id ="PaymentWay">
        <div id = "PaymentWayHideShow">
             <label for="paymentValue">This credit card information will not work automatically </label><br>
        <div class="form-group">
        <label for="CCNum">CC Num:</label>
              <input type="text" id="cardNumber" name="cardNumber" required>
        </div>
        
        <div class="form-group">
        <label for="CCExp">CC Exp:</label>
              <input type="month" id="cardExpir" name="cardExpir" required>
        </div>
        </div>
    </div>
  
  <div id = "hideDate">
  <div class="form-group" id ="ExpirationDate">
    <label for="phone">Expiration date of Membership option:</label>
  <input type="date" id="date" name="date" required>
  </div>
 </div>
 
  <button type="submit" class="btn btn-default">Submit</button>
</form>


<div id = "ErrorSuccess">
</div>






<script>




$(document).ready(function(){
    $("#MembershipLevelOption select").change(function() {
         var val = $(this).val();
         var data = jQuery.parseJSON(val);
         //console.log(data);
         var str = data.name;
          
         if(str.includes("Credit") || str.includes("Credits") || str.includes("credit") || str.includes("credits")){
             $("#ExpirationDate").remove();
         }
         else{
              $("#hideDate").html("<div class=\"form-group\" id =\"ExpirationDate\"><label for=\"phone\">Expiration date:</label><input type=\"date\" id=\"date\" name=\"date\" required></div>");
         }
    });
    
     $("#payWay select").change(function() {
        var vale = $(this).val();
        if(vale == "Cash"){
            $("#PaymentWayHideShow").remove();
        }
        else{
            $("#PaymentWay").html("<div id = \"PaymentWayHideShow\"><div class=\"form-group\"><label for=\"CCNum\">CC Num:</label><input type=\"text\" id=\"cardNumber\" name=\"cardNumber\" required></div><div class=\"form-group\"><label for=\"CCExp\">CC Exp:</label><input type=\"month\" id=\"cardExpir\" name=\"cardExpir\" required></div></div>");
        }
       
    });
    
    
    
    
    
    $("#add_membership_admin").submit(function() {
                $("#ErrorSuccess").hide();
            
            
                var postValue = "action=MemberLevelAdmin&parem=MemberLevelAdminAdd_Data&"+jQuery("#add_membership_admin").serialize();
                //console.log(postValue);
                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                    //console.log(response);

                    var data = jQuery.parseJSON(response);
                    if (data.status == 1) {
                        $("#ErrorSuccess").show();
                        $("#ErrorSuccess").html("<center><h3>"+data.message+"</h3></center>");
                    }
                    if (data.status == 0) {
                        $("#ErrorSuccess").show();
                        $("#ErrorSuccess").html("<center><h3>"+data.message+"</h3></center>");
                    }
                    
                    
                }) ;



            
         
		
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});
</script>