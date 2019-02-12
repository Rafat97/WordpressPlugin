<div class="container">
	<form action="options.php" method="post" >
		
		<?php 

			settings_fields( "member_content_Highlights" );
			do_settings_sections( "member_content_Highlights" );
			submit_button("Save Changes");

		 ?>
	</form>
</div>
<br>
<br>
<br>
<br>
<br>
<?php


 	

	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM `".TableName_highlite()."` ORDER BY ID DESC");
	

	//print_r($alldata);


?>
<?php 

 $Value_1 = get_option( "Highlights_Page_first", "No Data Found" );
 $Value_2 = get_option( "Highlights_Page_2", "No Data Found" );
 $Value_3 = get_option( "Highlights_Page_3", "No Data Found" );
 $Value_4 = get_option( "Highlights_Page_4", "No Data Found" );
 $Value_5 = get_option( "Highlights_Page_5", "No Data Found" );
 $Value_6 = get_option( "Highlights_Page_6", "No Data Found" );
 $Value_7 = get_option( "Highlights_Page_7", "No Data Found" );
 $Value_8 = get_option( "Highlights_Page_8", "No Data Found" );
 $Value_9 = get_option( "Highlights_Page_9", "No Data Found" );
 $Value_10 = get_option( "Highlights_Page_10", "No Data Found" );
 $Value_11 = get_option( "Highlights_Page_11", "No Data Found" );
 $Value_12 = get_option( "Highlights_Page_12", "No Data Found" );



?>


<div class="container">
	<div class="row">
		<table id="highlights_Row" class="display" style="width:100%">
        <thead>
            <tr>
               
                <th><?php echo $Value_3; ?></th>
                <th><?php echo $Value_4; ?></th>
                <th><?php echo $Value_5; ?></th>
                <th><?php echo $Value_6; ?></th>
                <th><?php echo $Value_7; ?></th>
                <th><?php echo $Value_8; ?></th>
                <th><?php echo $Value_9; ?></th>
                <th><?php echo $Value_10 ?></th>
                 <th><?php echo "Delete" ?></th>

                
                
            </tr>
        </thead>
        <tbody>
        	<?php 
        		if (count($results) > 0) {
        			$i = 1;
        			foreach ($results as $key) {
        				?>
        				<tr>
			                <td><?php echo  $key->name;?></td>
			                <td><?php echo  $key->time;?></td>
                      		<td><?php echo  $key->dmr;?></td>
			                <td><?php echo  $key->number;?></td>
			                <td><?php echo  $key->hour;?></td>
               				<td><?php echo  $key->month;?></td>
               			    <td><?php echo  $key->ft;?></td>
               				<td><?php echo  $key->b;?></td>
               				<td>
               					<a class="btn btn-danger HighlightsRow_dataDelete"  href="javascript:void(0)" data-id="<?php echo $key->ID;?>" >
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
