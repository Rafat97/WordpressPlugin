<?php


 	

	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM `".TableName_FairOdds_buy()."` ORDER BY ID DESC");
	

	//print_r($alldata);


?>

<div class="container">
	<div class="row">
		<table id="FairOdds_buy" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>User ID</th>
                <th>Credit Id User Buy</th>
                <th>Credit buy User</th>
                <th>Time</th>
               
                
                
            </tr>
        </thead>
        <tbody>
        	<?php 
        		if (count($results) > 0) {
        			$i = 1;
        			foreach ($results as $key) {
        				?>
        				<tr>
			                <td><?php echo $i++;?></td>
			                <td><?php echo  $key->user_ID_Buy;?></td>
                      		<td><?php echo  $key->Credit_id;?></td>
			                
			                <td><?php echo $key->Total_Credit_buy;?></td>
			                <td><?php echo $key->BuyTime;?></td>
               				
          				 </tr>
        				<?php
        			}
        		}

        	?>
           
        </tbody>
        
    </table>
   
	</div>
	
</div>
