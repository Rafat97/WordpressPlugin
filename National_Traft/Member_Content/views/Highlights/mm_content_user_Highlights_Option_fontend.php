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
<?php


 	

	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM `".TableName_highlite()."` ORDER BY ID DESC");
	

	//print_r($alldata);


?>
<style>


    .highlight-content
    {
        height:40vh;
        overflow-y:scroll;
    }
        
    .highlights-text, .highlights-bold
    {
        font-size:12px;
        color:#fff;
    }

    .highlights-table
    {
        background-color:#FFF6D4;
        color:#1a1a1a;

    }
    @media all and (max-width:768px)
    {
        .highlights-table
        {
            padding-left:10px!important;
            padding-right:10px!important;
            
        }
    }
    
    .scrollbar-change::-webkit-scrollbar-track
    {
    	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    	background-color: #F5F5F5;
    }
    
    .scrollbar-change::-webkit-scrollbar
    {
    	width: 6px;
    	background-color: #F5F5F5;
    }
    
    .scrollbar-change::-webkit-scrollbar-thumb
    {
    	background-color: #ffc127;
    	
    }

</style>

<div class="container" style="background-color:#003f9b; border: 2px;padding: 5px 0px;" >
    <p style="color:#fff;text-align:center;margin-bottom:0px;text-transform:uppercase;font-weight:800;">National Turf Highlights</p>
</div>
<div class="container highlight-content scrollbar-change" style="background-color:#1a1a1a;padding: 40px;">
    
	<p class="highlights-bold"><?php echo $Value_1; ?></p>
	<p class="highlights-bold"><?php echo $Value_2; ?></p>
	

	<div class="row" >
		<div class="col-2 highlights-text highlights-table">
			<?php echo $Value_3; ?>
		</div>
		<div class="col-2 highlights-text highlights-table">
			<?php echo $Value_4; ?>
		</div>
		<div class="col-2 highlights-text highlights-table">
			<?php echo $Value_4; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo $Value_6; ?>
		</div>
		<div class="col-2 highlights-text highlights-table">
			<?php echo $Value_7; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo $Value_8; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo $Value_9; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo $Value_10; ?>
		</div>
	</div>
<?php 
        		if (count($results) > 0) {
        			$i = 1;
        			foreach ($results as $key) {
        				?>
        				


        				

	<div class="row scrollbar-change">
		<div class="col-2 highlights-text highlights-table">
			<?php echo  $key->name; ?>
		</div>
		<div class="col-2 highlights-text highlights-table">
			<?php echo  $key->time; ?>
		</div>
		<div class="col-2 highlights-text highlights-table">
			<?php echo  $key->dmr; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo  $key->number; ?>
		</div>
		<div class="col-2 highlights-text highlights-table">
			<?php echo  $key->hour; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo  $key->month; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo  $key->ft; ?>
		</div>
		<div class="col-1 highlights-text highlights-table">
			<?php echo  $key->b; ?>
		</div>
	</div>

<?php
        			}
        		}

        	?>

	
	<p class="highlights-text"><br><?php echo $Value_11; ?></p>
	<p class="highlights-bold"><br><?php echo $Value_12; ?></p>
	

	
</div>
