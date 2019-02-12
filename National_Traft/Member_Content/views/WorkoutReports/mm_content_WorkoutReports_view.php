<div class = "WorkoutLevelPageShow">
               <?php 
                 echo do_shortcode('[pmpro_levels]');
                 echo do_shortcode('[Show_User_LevelPage]');
                ?>
            </div>
            
            <script>
                
                jQuery(document).ready(function($) {
                    jQuery(".WorkoutLevelPageShow").hide();
      
                });

                
            </script>

<?php

    //include_once("test.php");
    
   // phpinfo();

    global $wpdb;

    $user_info = wp_get_current_user();
    $user_ID = $user_info->ID;
    $results_Is_have_Workout_Paid = $wpdb->get_results("SELECT * FROM `wp_pmpro_memberships_users` WHERE `user_id` = ".$user_ID ." AND `status` = \"Active\"");
    //print_r($results_Is_have_Workout_Paid);

    $results = $wpdb->get_results( "SELECT * FROM `".TableName_WithoutReport()."` ORDER BY ID ASC");
  
    

    $EmailUser = $user_info->user_email;

    
  //print_r($alldata);


?>
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
                      
                  }
              }
            </style>
            
            <style>          
            .report-popup
            {
                position: fixed;
                top: calc(50vh - 116px);
                display: none;
                background: rgba(25, 82, 165, 0.96);
                padding: 40px;
                z-index: 2000;
            }

              @media all and (min-width:768px)
              {

                  
                .report-popup
                {
                    width: 60%;

                }
              }
              @media all and (max-width:768px)
              {

                  
                .report-popup
                {
                    width: calc(100% - 30px);

                }
              }              
              
            </style>
            
<div class="container" style="width:100%;">
      <?php 
      //print_r($results_Is_have_Workout_Paid);
            if (count($results) > 0 && count($results_Is_have_Workout_Paid)) {
                       $i = 1;
                       
                       $now = new DateTime();
                       $future = new DateTime($results_Is_have_Workout_Paid[0]->enddate);
                       $interval = $now->diff($future);
                       $TotalRemaingDays = $interval->format("%R%a Day(s) %R%h Hour(s) %R%i minutes (For test purpose, will be removed)")."<br>";
                       
                       
                       //echo $TotalRemaingDays;
                       //echo $now->format('Y-m-d h:m:s');
                       
                       
                       
                        $date = new DateTime('now');
                        
                        $result = $date->format('Y-m-d');
                        
                        //echo $result;
                            
                        
             $date = new DateTime($results_Is_have_Workout_Paid[0]->enddate);
                        $givenFormet = $date->format('Y-m-d');
                        
                        //echo "<br>".$givenFormet;
                        
                        $date1 = date_create($givenFormet);
                        $date2 = date_create($result);

                        $diff=date_diff($date2,$date1);
                        $val = $diff->format("%R%a"); 




                        //remaning date Have
                        if((int)$val == 0){
                             echo "<h3>Remaining day(s): 1</h3>";
                        }
                        else{
                            if(strpos($val, '+') !== false){
                                 echo "<h3>Remaining day(s): ".(int)$val."</h3>";
                                // echo "<h3>id : ".$results_Is_have_Workout_Paid[0]->id."</h3>";
                            }
                            else if(strpos($val, '-') !== false){
                                
                                //this condition does not work 
                                
                            }
                             
                        }
                      





                      $track = 0;
                      
                      if((int)$val>=1){
                          
                          //echo "Value";
                          
                      }
                      else{
                         // echo "Value Not Value";
                      }
                      
              foreach ($results as $key) {
                        
                        $dateValueReportDB = new DateTime($key->Time);
                        $dateValueReport = $dateValueReportDB->format('Y-m-d');

                       // echo $dateValueReport;


                        $paymentDate = date($dateValueReport);
                        $paymentDate=date('Y-m-d', strtotime($paymentDate));
                        //echo $paymentDate; // echos today! 
                        //$contractDateBegin = date('Y-m-d', strtotime($results_Is_have_Workout_Paid[0]->startdate));
                        //$contractDateEnd = date('Y-m-d', strtotime($results_Is_have_Workout_Paid[0]->enddate));
                        
                        
                        $contractDateBegin = date('Y-m-d', time());
                        $contractDateEnd = date('Y-m-d',time() - 60 * 60 * 24);
                        
                        
                        //echo $contractDateBegin;
                        
                        $isBetween = false;
                        
                        if (($paymentDate <= $contractDateBegin) && ($paymentDate >= $contractDateEnd)){
                            //echo "is between";
                            $isBetween = true;
                            $track++;
                        }else{
                            //echo "NO GO!";  
                           $isBetween = false;
                        }
                       
                    if (($key->GiveEmail == $EmailUser || $key->GiveEmail == "All") && $isBetween) {
                        
                
        ?>
          
      <div class="row workout_reportbg">

            <div class="col-md-9 text-md-left text-center" >
                  
              
                
                    <h2 style="color:#003f9c;font-weight:700;"><?php echo  stripslashes ($key->Title);?></h2>

                    <h5 style="color:#fff;"><?php 

                    //echo date("M d",time($key->Time));
                     $dateDB = new DateTime($key->Time);
                     $dateDB_Formet = $dateDB->format('M d');
                    echo $dateDB_Formet;
                    ?></h5>

                        
            </div>
            
            <div class="col-md-3 button-div text-md-left text-center" >
                <div id= <?php echo "given-id-".$key->ID ;?> >
                      <a class="btn btn-primary workout_report_button" id = "<?php echo "download-id-".$key->ID ;?>" href="<?php echo $key->FileLink ;?>" target = "_blank">
                          Download
                      </a>   
                </div>
            </div>

        </div><br>
        
        <div class=" row report-popup" id=<?php echo "popup-id-".$key->ID ;?> >
            <div class="cursor-change" style="text-align:right;">
                <img src="http://nationalturf.teamalfy.com/wp-content/uploads/2018/10/cross.png" >
            </div>
            
            <div class="col-12">
                <h3 style="color:#fff;">The download of this file should start automatically, if not <a href="<?php echo $key->FileLink ;?>" target = "_blank">Click here</a></h3>                
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-1 col-4">
                        <img src="http://nationalturf.teamalfy.com/wp-content/uploads/2018/10/pdf.png">
                    </div>
                    <div class="col-md-5 col-8">
                        <h2 class="yellow" style="font-weight:700;"><?php echo  stripslashes ($key->Title);?></h2>
        
                        <h5 style="color:#fff;">

                          <?php 
                             $dateDB = new DateTime($key->Time);
                              $dateDB_Formet = $dateDB->format('M d');
                              echo $dateDB_Formet;

                          //echo date("M d",time($key->Time));
                          ?>
                            
                          </h5>  
                        
                        
                    </div>  
                </div>             
            </div>



        </div>
        
       
        
        <script>
            jQuery(document).ready(function( $ ){
         
         /*
                $("#<?php echo "download-id-".$key->ID ;?>").click(function(e) {
                    //alert("<?php echo $key->FileLink ;?>");
                    e.preventDefault();  //stop the browser from following
                    window.location.href = '<?php echo $key->FileLink ;?>';
                });
         
         */
         
              
                $( "#<?php echo "given-id-".$key->ID ;?>" ).on( "click", function() {
     
                    $(".report-popup").fadeOut( "slow", function() {
               
              		});
                  	$("#<?php echo "popup-id-".$key->ID ;?>").fadeIn( "slow", function() {
               
              		});
                  

                });
                $( ".cursor-change" ).on( "click", function() {
     
                    $(".report-popup").fadeOut( "slow", function() {
               
              		});


                });
            });
        </script>
       <?php
                  }
                 
                 
                  
              }
               if ($track == 0) {
                      echo "<br><br><br><h1>No Workout Report Published Yet.<h1>";
                      $track = 0;
                  }

            }
            else{
              
            
            
                        $date = new DateTime('now');
                        $result = $date->format('Y-m-d');


                        $date = new DateTime($results_Is_have_Workout_Paid[0]->enddate);
                        $givenFormet = $date->format('Y-m-d');
                        
                        $date1 = date_create($givenFormet);
                        $date2 = date_create($result);

                        $diff=date_diff($date2,$date1);
                         $dateDifferent = $diff->format("%R%a days"); 
                        //echo $dateDifferent;
           
              

              echo "<br><br><br><h1>Please Purchase One of Our Membership Plans.<h1>";
            }

         ?>
</div>