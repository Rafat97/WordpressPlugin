<?php 
ob_start();
session_start();
include_once HOMETROTTING_API_DIR_PATH."lib/Hostaway_api_Listing.php"; 
$listing = new API_Listing( Hostaway_Api_secretKey() , Hostaway_Api_IdKey() );
$val_2 = $listing->get_Individual_Listing_array($_GET['srm'.""]);
$RoomAllInfo = $val_2['result'];

/*
echo isset($_SESSION["RoomInfo"]);
echo "<pre>";
print_r( $_SESSION["RoomInfo"] );
print_r($_GET);
echo "</pre>";
echo "<pre>";
print_r($val_2);
echo "</pre>";
*/

?>
<style>
    
.StripeElement {
  background-color: #212121;
  height: 40px;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
  width :100%;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #fff;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}

#bookingDetails p,h1{
			color:#fff;
			font-family:Poppins;
		}
 
    
</style>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="https://js.stripe.com/v3/"></script>




<br><br><br><br>
          
          <form action="javascript:void(0)" method="post" id = "UserInfoForm">
         <h1 style="text-align:center;color:#fff;">Payment Information</h1>
         <div class="form-group">
            <label for="text">First Name :</label>
            <input type="text" class="form-control" id="NameInput" placeholder="First Name" name="FName" required>
          </div>
          <div class="form-group">
            <label for="text">Last Name :</label>
            <input type="text" class="form-control" id="NameInput" placeholder="Last Name"name="LName" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="UEmail"  required>
          </div>
          <div class="form-group">
            <label for="address">Address :</label>
            <input type="text" class="form-control" id="AdressInput" placeholder="Address Name" name="UAddress" required>
          </div>
          <div class="form-group">
            <label for="address">City :</label>
            <input type="text" class="form-control" id="AdressInput"  placeholder="City Name"  name="UCity" required>
          </div>
          <div class="form-group" >
            <label for="address">Country :</label>
            <select class="form-control" id="CountrySelect" name="UCountry" required>
                <option value="CA">Canada</option>
                <option value="US">United States</option>
            	<option value="AF">Afghanistan</option>
            	<option value="AX">Åland Islands</option>
            	<option value="AL">Albania</option>
            	<option value="DZ">Algeria</option>
            	<option value="AS">American Samoa</option>
            	<option value="AD">Andorra</option>
            	<option value="AO">Angola</option>
            	<option value="AI">Anguilla</option>
            	<option value="AQ">Antarctica</option>
            	<option value="AG">Antigua and Barbuda</option>
            	<option value="AR">Argentina</option>
            	<option value="AM">Armenia</option>
            	<option value="AW">Aruba</option>
            	<option value="AU">Australia</option>
            	<option value="AT">Austria</option>
            	<option value="AZ">Azerbaijan</option>
            	<option value="BS">Bahamas</option>
            	<option value="BH">Bahrain</option>
            	<option value="BD">Bangladesh</option>
            	<option value="BB">Barbados</option>
            	<option value="BY">Belarus</option>
            	<option value="BE">Belgium</option>
            	<option value="BZ">Belize</option>
            	<option value="BJ">Benin</option>
            	<option value="BM">Bermuda</option>
            	<option value="BT">Bhutan</option>
            	<option value="BO">Bolivia, Plurinational State of</option>
            	<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
            	<option value="BA">Bosnia and Herzegovina</option>
            	<option value="BW">Botswana</option>
            	<option value="BV">Bouvet Island</option>
            	<option value="BR">Brazil</option>
            	<option value="IO">British Indian Ocean Territory</option>
            	<option value="BN">Brunei Darussalam</option>
            	<option value="BG">Bulgaria</option>
            	<option value="BF">Burkina Faso</option>
            	<option value="BI">Burundi</option>
            	<option value="KH">Cambodia</option>
            	<option value="CM">Cameroon</option>
            	
            	<option value="CV">Cape Verde</option>
            	<option value="KY">Cayman Islands</option>
            	<option value="CF">Central African Republic</option>
            	<option value="TD">Chad</option>
            	<option value="CL">Chile</option>
            	<option value="CN">China</option>
            	<option value="CX">Christmas Island</option>
            	<option value="CC">Cocos (Keeling) Islands</option>
            	<option value="CO">Colombia</option>
            	<option value="KM">Comoros</option>
            	<option value="CG">Congo</option>
            	<option value="CD">Congo, the Democratic Republic of the</option>
            	<option value="CK">Cook Islands</option>
            	<option value="CR">Costa Rica</option>
            	<option value="CI">Côte d'Ivoire</option>
            	<option value="HR">Croatia</option>
            	<option value="CU">Cuba</option>
            	<option value="CW">Curaçao</option>
            	<option value="CY">Cyprus</option>
            	<option value="CZ">Czech Republic</option>
            	<option value="DK">Denmark</option>
            	<option value="DJ">Djibouti</option>
            	<option value="DM">Dominica</option>
            	<option value="DO">Dominican Republic</option>
            	<option value="EC">Ecuador</option>
            	<option value="EG">Egypt</option>
            	<option value="SV">El Salvador</option>
            	<option value="GQ">Equatorial Guinea</option>
            	<option value="ER">Eritrea</option>
            	<option value="EE">Estonia</option>
            	<option value="ET">Ethiopia</option>
            	<option value="FK">Falkland Islands (Malvinas)</option>
            	<option value="FO">Faroe Islands</option>
            	<option value="FJ">Fiji</option>
            	<option value="FI">Finland</option>
            	<option value="FR">France</option>
            	<option value="GF">French Guiana</option>
            	<option value="PF">French Polynesia</option>
            	<option value="TF">French Southern Territories</option>
            	<option value="GA">Gabon</option>
            	<option value="GM">Gambia</option>
            	<option value="GE">Georgia</option>
            	<option value="DE">Germany</option>
            	<option value="GH">Ghana</option>
            	<option value="GI">Gibraltar</option>
            	<option value="GR">Greece</option>
            	<option value="GL">Greenland</option>
            	<option value="GD">Grenada</option>
            	<option value="GP">Guadeloupe</option>
            	<option value="GU">Guam</option>
            	<option value="GT">Guatemala</option>
            	<option value="GG">Guernsey</option>
            	<option value="GN">Guinea</option>
            	<option value="GW">Guinea-Bissau</option>
            	<option value="GY">Guyana</option>
            	<option value="HT">Haiti</option>
            	<option value="HM">Heard Island and McDonald Islands</option>
            	<option value="VA">Holy See (Vatican City State)</option>
            	<option value="HN">Honduras</option>
            	<option value="HK">Hong Kong</option>
            	<option value="HU">Hungary</option>
            	<option value="IS">Iceland</option>
            	<option value="IN">India</option>
            	<option value="ID">Indonesia</option>
            	<option value="IR">Iran, Islamic Republic of</option>
            	<option value="IQ">Iraq</option>
            	<option value="IE">Ireland</option>
            	<option value="IM">Isle of Man</option>
            	<option value="IL">Israel</option>
            	<option value="IT">Italy</option>
            	<option value="JM">Jamaica</option>
            	<option value="JP">Japan</option>
            	<option value="JE">Jersey</option>
            	<option value="JO">Jordan</option>
            	<option value="KZ">Kazakhstan</option>
            	<option value="KE">Kenya</option>
            	<option value="KI">Kiribati</option>
            	<option value="KP">Korea, Democratic People's Republic of</option>
            	<option value="KR">Korea, Republic of</option>
            	<option value="KW">Kuwait</option>
            	<option value="KG">Kyrgyzstan</option>
            	<option value="LA">Lao People's Democratic Republic</option>
            	<option value="LV">Latvia</option>
            	<option value="LB">Lebanon</option>
            	<option value="LS">Lesotho</option>
            	<option value="LR">Liberia</option>
            	<option value="LY">Libya</option>
            	<option value="LI">Liechtenstein</option>
            	<option value="LT">Lithuania</option>
            	<option value="LU">Luxembourg</option>
            	<option value="MO">Macao</option>
            	<option value="MK">Macedonia, the former Yugoslav Republic of</option>
            	<option value="MG">Madagascar</option>
            	<option value="MW">Malawi</option>
            	<option value="MY">Malaysia</option>
            	<option value="MV">Maldives</option>
            	<option value="ML">Mali</option>
            	<option value="MT">Malta</option>
            	<option value="MH">Marshall Islands</option>
            	<option value="MQ">Martinique</option>
            	<option value="MR">Mauritania</option>
            	<option value="MU">Mauritius</option>
            	<option value="YT">Mayotte</option>
            	<option value="MX">Mexico</option>
            	<option value="FM">Micronesia, Federated States of</option>
            	<option value="MD">Moldova, Republic of</option>
            	<option value="MC">Monaco</option>
            	<option value="MN">Mongolia</option>
            	<option value="ME">Montenegro</option>
            	<option value="MS">Montserrat</option>
            	<option value="MA">Morocco</option>
            	<option value="MZ">Mozambique</option>
            	<option value="MM">Myanmar</option>
            	<option value="NA">Namibia</option>
            	<option value="NR">Nauru</option>
            	<option value="NP">Nepal</option>
            	<option value="NL">Netherlands</option>
            	<option value="NC">New Caledonia</option>
            	<option value="NZ">New Zealand</option>
            	<option value="NI">Nicaragua</option>
            	<option value="NE">Niger</option>
            	<option value="NG">Nigeria</option>
            	<option value="NU">Niue</option>
            	<option value="NF">Norfolk Island</option>
            	<option value="MP">Northern Mariana Islands</option>
            	<option value="NO">Norway</option>
            	<option value="OM">Oman</option>
            	<option value="PK">Pakistan</option>
            	<option value="PW">Palau</option>
            	<option value="PS">Palestinian Territory, Occupied</option>
            	<option value="PA">Panama</option>
            	<option value="PG">Papua New Guinea</option>
            	<option value="PY">Paraguay</option>
            	<option value="PE">Peru</option>
            	<option value="PH">Philippines</option>
            	<option value="PN">Pitcairn</option>
            	<option value="PL">Poland</option>
            	<option value="PT">Portugal</option>
            	<option value="PR">Puerto Rico</option>
            	<option value="QA">Qatar</option>
            	<option value="RE">Réunion</option>
            	<option value="RO">Romania</option>
            	<option value="RU">Russian Federation</option>
            	<option value="RW">Rwanda</option>
            	<option value="BL">Saint Barthélemy</option>
            	<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
            	<option value="KN">Saint Kitts and Nevis</option>
            	<option value="LC">Saint Lucia</option>
            	<option value="MF">Saint Martin (French part)</option>
            	<option value="PM">Saint Pierre and Miquelon</option>
            	<option value="VC">Saint Vincent and the Grenadines</option>
            	<option value="WS">Samoa</option>
            	<option value="SM">San Marino</option>
            	<option value="ST">Sao Tome and Principe</option>
            	<option value="SA">Saudi Arabia</option>
            	<option value="SN">Senegal</option>
            	<option value="RS">Serbia</option>
            	<option value="SC">Seychelles</option>
            	<option value="SL">Sierra Leone</option>
            	<option value="SG">Singapore</option>
            	<option value="SX">Sint Maarten (Dutch part)</option>
            	<option value="SK">Slovakia</option>
            	<option value="SI">Slovenia</option>
            	<option value="SB">Solomon Islands</option>
            	<option value="SO">Somalia</option>
            	<option value="ZA">South Africa</option>
            	<option value="GS">South Georgia and the South Sandwich Islands</option>
            	<option value="SS">South Sudan</option>
            	<option value="ES">Spain</option>
            	<option value="LK">Sri Lanka</option>
            	<option value="SD">Sudan</option>
            	<option value="SR">Suriname</option>
            	<option value="SJ">Svalbard and Jan Mayen</option>
            	<option value="SZ">Swaziland</option>
            	<option value="SE">Sweden</option>
            	<option value="CH">Switzerland</option>
            	<option value="SY">Syrian Arab Republic</option>
            	<option value="TW">Taiwan, Province of China</option>
            	<option value="TJ">Tajikistan</option>
            	<option value="TZ">Tanzania, United Republic of</option>
            	<option value="TH">Thailand</option>
            	<option value="TL">Timor-Leste</option>
            	<option value="TG">Togo</option>
            	<option value="TK">Tokelau</option>
            	<option value="TO">Tonga</option>
            	<option value="TT">Trinidad and Tobago</option>
            	<option value="TN">Tunisia</option>
            	<option value="TR">Turkey</option>
            	<option value="TM">Turkmenistan</option>
            	<option value="TC">Turks and Caicos Islands</option>
            	<option value="TV">Tuvalu</option>
            	<option value="UG">Uganda</option>
            	<option value="UA">Ukraine</option>
            	<option value="AE">United Arab Emirates</option>
            	<option value="GB">United Kingdom</option>
            	
            	<option value="UM">United States Minor Outlying Islands</option>
            	<option value="UY">Uruguay</option>
            	<option value="UZ">Uzbekistan</option>
            	<option value="VU">Vanuatu</option>
            	<option value="VE">Venezuela, Bolivarian Republic of</option>
            	<option value="VN">Viet Nam</option>
            	<option value="VG">Virgin Islands, British</option>
            	<option value="VI">Virgin Islands, U.S.</option>
            	<option value="WF">Wallis and Futuna</option>
            	<option value="EH">Western Sahara</option>
            	<option value="YE">Yemen</option>
            	<option value="ZM">Zambia</option>
            	<option value="ZW">Zimbabwe</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="address">Phone Number :</label>
            <input type="tel" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Enter Your 10 Digit Phone Number" required>
          </div>
          
          
          <div class="form-group">
            <label for="address">Postal/Zip Code :</label>
            <input type="text" class="form-control" id="ZipCodeNumber" name="ZipCodeNumber" placeholder="Postal/Zip Code" required>
          </div>
          
          <div class="form-group">
            <label for="address">Credit Card Name :</label>
            <input type="text" class="form-control" id="CCName" name="CCName" placeholder="CC Name" required>
          </div>
          
           <div class="form-group">
            <label for="address">Credit Card Number :</label>
            <input type="number" class="form-control" id="CreditCardNumber"  placeholder="CC Number"  name="CreditCardNumber" required>
          </div>
          
          <div class="form-group">
            <label for="address">Expiration Date :<?php $year = date("Y");?></label>
            <select class="form-control" name="ExpirationDate_Month" id="ExpirationDate_Month" required>
                <?php 
                for($i = 1 ; $i<=12 ;$i++){
                    $num_padded = sprintf("%02d", $i);
                ?>
                
                <option value="<?php echo $num_padded?>"><?php echo $num_padded?></option>
              <?php  
                }
                ?>
            </select>
            
            
            
            <select class="form-control"  name="ExpirationDate_Year" id="ExpirationDate_Year" required>
                <?php 
                for($i = $year ; $i<=2099 ;$i++){
                ?>
                
                <option value="<?php echo $i?>"><?php echo $i?></option>
              <?php  
                }
                ?>
            </select>
          </div>
          <div class="form-group">
            <label for="address">CVC : </label>
            <input type="text" class="form-control" id="CVCNumber" placeholder="CVC" name="CVCNumber" required>
          </div>
          
          
          
          
        <!--  
          <div class="form-group">
            <label for="address">Credit Card Name :</label>
            <input type="text" class="form-control" id="CCName" name="CCName" placeholder="CC Name" required>
          </div>
          
         <div class="form-group">
            <label for="address">Credit Card Number :</label>
            <input type="number" class="form-control" id="CreditCardNumber"  placeholder="CC Number"  name="CreditCardNumber" required>
          </div>
          <div class="form-group">
            <label for="address">Expiration Date :<?php $year = date("y");?></label>
            <select class="form-control" name="ExpirationDate_Month" id="ExpirationDate_Month" required>
                <?php 
                //for($i = 1 ; $i<=12 ;$i++){
                   // $num_padded = sprintf("%02d", $i);
                ?>
                
                <option value="<?php //echo $num_padded?>"><?php// echo $num_padded?></option>
              <?php  
                //}
                ?>
            </select>
            
            
            
            <select class="form-control"  name="ExpirationDate_Year" id="ExpirationDate_Year" required>
                <?php 
                //for($i = $year ; $i<=99 ;$i++){
                ?>
                
                <option value="<?php //echo $i?>"><?php //echo $i?></option>
              <?php  
                //}
                ?>
            </select>
          </div>
          <div class="form-group">
            <label for="address">CVC : </label>
            <input type="text" class="form-control" id="CVCNumber" placeholder="CVC" name="CVCNumber" required>
          </div>
                -->
                 
                
                <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"style ="color:white;"></div>
              
         
          
         <input type="hidden" class="form-control"  name="arrivalDate" value = "<?php echo $_GET['from'] ;?>" >
         <input type="hidden" class="form-control"  name="departureDate" value = "<?php echo $_GET['to'] ;?>">
         <input type="hidden" class="form-control"  name="NumberOfguest" value = "<?php echo $_GET['NumberOfguest'] ;?>">
         <input type="hidden" class="form-control"  name="cleaningFee" value = "<?php echo $RoomAllInfo['cleaningFee'] ;?>">
         <input type="hidden" class="form-control"  name="currencyCode" value = "<?php echo $RoomAllInfo['currencyCode'] ;?>">
         
         
          <br>
          <button type="submit" class="btn " style="background-color:#ffa856;" id="UserBookingSubmitButton">Submit</button>
        </form>
          
<br>
<br><br><br><br>

<div id ="afterReservationComp">
    
   
</div>
<br>
<br>

<div id="bookingDetails">
					<h1 style="text-align: center;">Booking Summary</h1>
					<div style="max-width: 500px;margin: 0 auto; ">
					<p><span style="font-weight: 700">Room Name: </span><span><?php echo $RoomAllInfo['name'];?></span></p>
					<p><span style="font-weight: 700">Price: </span><span><?php echo ($RoomAllInfo['cleaningFee']+$_GET['roomPrice']);?> <?php echo $RoomAllInfo['currencyCode']?></span></p>
					<p><span style="font-weight: 700">Check In: </span><span><?php echo $_GET['from'];?></span></p>
					<p><span style="font-weight: 700"> Check Out: </span><span><?php echo $_GET['to'];?></span></p>
					<p><span style="font-weight: 700">Total Guests: </span><span><?php echo $_GET['NumberOfguest']  ;?></span></p>
					<p><span style="font-weight: 700">Address: </span><span><?php echo $RoomAllInfo['address'];?></span></p>
					</div>
</div>

      
      
<script>
    jQuery('#bookingDetails').hide();

   
        jQuery("#UserInfoForm").validate({
                    		 	        
                submitHandler:function(){
                    jQuery('#UserBookingSubmitButton').attr('disabled',true);
                     jQuery("#card-errors").html("Securely processing payment... <img src='https://www.hometrotting.com/wp-content/uploads/2019/03/Rolling-1s-200px.svg' style='width:20px;margin-bottom:-4px;'>");
                    //jQuery("#card-errors").html("Wait for Sometimes ... ");
                    
                     var AjaxUrl = "<?php echo admin_url("admin-ajax.php"); ?>";
                     var TotalPrice = "<?php echo $_GET['roomPrice'] + $RoomAllInfo['cleaningFee']?>";
                    
                    var postValue = "action=CreateReservation&parem=CreateReservation_User&"+jQuery("#UserInfoForm").serialize()+"&Price="+TotalPrice+"&srm=<?php echo $_GET['srm'] ;?>";                                                                  
                    //console.log(postValue);
                    jQuery.post(AjaxUrl,postValue,function(response){
                        //console.log(response);
                        //var pre = "<pre>";var pre2 = "</pre>";
                        //jQuery("#card-errors").html(pre+response+pre2);
    
    
                        var data = jQuery.parseJSON(response);
                        //console.log(data);
                       var linkValue = "<h2 style='color:#fff;'><center>Thank you for booking with us. We will contact you soon. </center></h2>";
                       
                        if (data.status == "success") {
                            jQuery("#UserInfoForm").hide();
                            
                             //link += "<a href ='"+data.result.guestPortalUrl+"' target='_blank'> Click here </a></center></h2>" ;
                              jQuery('#bookingDetails').show();
                            jQuery("#afterReservationComp").html(linkValue);
                            window.scrollTo(0.0,0.0);
                        }
                        
                        else if (data.status == "error") {
                            
                           jQuery("#card-errors").html(data.message);
                           jQuery('#UserBookingSubmitButton').attr('disabled',false);
                            
                        }
                    
                        
                        
                }) ;
                
                
                       /*
                     
                       
                       {id: "tok_1DxdfU2eZvKYlo2C87SP0e1W", object: "token", card: {…}, client_ip: "119.15.154.164", created: 1548695588, …}
card:
address_city: null
address_country: null
address_line1: null
address_line1_check: null
address_line2: null
address_state: null
address_zip: "1232"
address_zip_check: "unchecked"
brand: "Visa"
country: "US"
cvc_check: "unchecked"
dynamic_last4: null
exp_month: 3
exp_year: 2023
funding: "credit"
id: "card_1DxdfU2eZvKYlo2CkoAngYZd"
last4: "4242"
metadata: {}
name: null
object: "card"
tokenization_method: null
__proto__: Object
client_ip: "119.15.154.164"
created: 1548695588
id: "tok_1DxdfU2eZvKYlo2C87SP0e1W"
livemode: false
object: "token"
type: "card"
used: false
                       
                       */
                       
                       
                       
                       
                       /*
                       code: "incorrect_number"
doc_url: "https://stripe.com/docs/error-codes/incorrect-number"
message: "Your card number is incorrect."
param: "number"
type: "card_error"
                       
                       */
                    
                       //4151 6659 6415 2185
                       //4242 4242 4242 4242
                    	
                        
            /*          
                        Stripe.setPublishableKey('pk_test_TYooMQauvdEDq54NiTphI7jx');
                       
                        Stripe.card.createToken({
                          number: jQuery("#CreditCardNumber").val()+"" ,
                          cvc: jQuery("#CVCNumber").val()+"" ,
                          exp_month: jQuery("#ExpirationDate_Month").val()+"" ,
                          exp_year: jQuery("#ExpirationDate_Year").val()+"" ,
                          address_zip: jQuery("#ZipCodeNumber").val()+""  
                        }, stripeResponseHandler);
                     
        
                function stripeResponseHandler(status, response) {

                  // Grab the form:
                
                 console.log(response);
                 console.log(status);
                  if (response.error) { // Problem!
                
                    // Show the errors on the form
                    jQuery("#card-errors").html(response.error.message);
                    console.log("Error");
                
                  } else { // Token was created!
                
                    var token = response.id;
                    console.log(token);
                    
                   
                
                  }
                }
                 */
                
                 
                }
        });
            
    
    
   
    
    
</script>
