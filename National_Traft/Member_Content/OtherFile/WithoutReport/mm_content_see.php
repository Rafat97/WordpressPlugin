<?php


 	

	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM `".TableName_WithoutReport()."` ORDER BY ID DESC");
	

	//print_r($alldata);


?>

<div class="container">
	<div class="row">
		<table id="WithoutReport" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>All Title</th>
                <th>User Email</th>
                <th>File Link</th>
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
			                <td><?php echo  stripslashes ($key->Title);?></td>
                      <td><?php echo  $key->GiveEmail;?></td>
			                <td>
                        <a href="<?php echo $key->FileLink;?>" class="btn btn-info">
                              Download File
                        </a>

                        </td>
			                <td><?php echo $key->Time;?></td>
               				<td>
               					<a class="btn btn-danger WithoutReport_dataDelete"  href="javascript:void(0)" data-id="<?php echo $key->ID;?>" >
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

[Show_WorkoutReports_FontEnd]

</div>
</center>