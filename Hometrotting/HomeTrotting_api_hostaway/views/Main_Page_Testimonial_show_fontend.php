 
 
 <?php
 
        global $wpdb;
        $array = $wpdb->get_results( "SELECT * FROM `".TableName_Testimonial()."` ORDER BY `".TableName_Testimonial()."`.`id` DESC");
       
       
        ?>
<body>
	
	<div class ='container' style="padding-top:40px;">
	    
	    <?php
	    
	    if(count($array) >= 1){
	        $it = 1;
	        foreach($array as $value){
	            if($it%2 != 0){
	                ?>
	                
                    	<div class="row">
                			<div class='col-md-6 order-1 order-md-0 text-md-right text-left'>
                				<p style="">" <?php echo $value->testimonial ?> "</p>
        				        <p style="font-size:0.88em;">-<?php echo $value->name ?>, <?php echo $value->companyName ?>, <?php echo $value->title ?></p>
                			</div>
                			<div class='col-md-6 text-md-left text-center' style="justify-content: left; padding-bottom: 30px;">
                				<img style="height:120px;object-fit: cover;max-width: 100%;"  src="https://www.hometrotting.com/wp-content/uploads/2019/03/q_r.png">
                			</div>
                    			
                    	</div>
	                
	                <?php
	            }
	            else {
	                
	                ?>
	                
	                
	                	<div class="row" style="margin-top: 40px;">
                			<div class='col-md-6 text-md-right text-center' style="justify-content: right; padding-bottom: 30px;">
                				<img style="height:120px;object-fit: cover;max-width: 100%;"  src="https://www.hometrotting.com/wp-content/uploads/2019/03/q_l.png">
                			</div>
                			<div class='col-md-6'>
                				<p>"<?php echo $value->testimonial ?> "</p>
                				<p style="font-size:0.88em;">-<?php echo $value->name ?>, <?php echo $value->companyName ?>, <?php echo $value->title ?></p>
                			</div>
                		</div>
	                
	                
	                <?php
	                
	            }
	            $it++;
	        }
	        
	    }else{
	        ?>
	        
	        No Testimonial Found
	        
	        <?php
	      
	    }
	    
	    ?>
	    
	
	

	</div>
</body>