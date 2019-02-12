<?php


 	

	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM `".TableName_Tips()."` ORDER BY ID DESC");
	

	//print_r($alldata);


?>

<div class="container">
	<div class="row">
		<table id="TipsDataShow" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tips Title</th>
                <th>Full Tips</th>
                <th>Upload Time</th>
                <th>Delete Button</th>
                
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
			                <td><?php echo  stripslashes ($key->TipsTitle);?></td>
			                <td><?php echo stripslashes ($key->FullTips);?></td>
			                <td><?php echo $key->UplodeTime;?></td>
               				<td>
               					<a class="btn btn-danger Test_dataDelete" href="javascript:void(0)" data-id="<?php echo $key->ID;?>" >
               						Delete
               					</a>
               				</td>
          				 </tr>
        				<?php
        			}
        		}

        	?>
           
        </tbody>
        
    </table>
   
	</div>
	
</div>

<br>
<br>
<br>
<center>
<div class="container">
Short Code Is <br>

[Show_Tips_FontEnd]

</div>
</center>