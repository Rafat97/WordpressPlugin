<?php


    

    global $wpdb;
    $results = $wpdb->get_results( "SELECT * FROM `".TableName_Tips()."` ORDER BY ID ASC");
    


?>

<div class="container" style="width:100%;">
            <?php 
                if (count($results) > 0) {
                    $i = 1;
                    foreach ($results as $key) {
            ?>
            
                <style>

                </style>
                <div class="row" >

                    <h3 style="color:#003f9c;"><?php echo  stripslashes ($key->TipsTitle);?></h2>
                    <br>
                    <p><?php echo stripslashes ($key->FullTips);?></p>
                    <br>
                        
                </div>

           <?php
                    }
                }

            ?>
</div>