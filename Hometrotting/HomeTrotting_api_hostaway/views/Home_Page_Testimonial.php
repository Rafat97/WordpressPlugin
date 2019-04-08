     
 
 <?php
 
        global $wpdb;
        $array = $wpdb->get_results( "SELECT * FROM `".TableName_Testimonial()."` ORDER BY `".TableName_Testimonial()."`.`id` DESC");
       
       
        ?>
    
    
    <div class="gdlr-testimonial-item-wrapper" id="homepage-testimonial" style="margin-bottom: 0px;">
        <div class="gdlr-item-title-wrapper gdlr-item pos-center gdlr-nav-container ">
            <img src="https://www.hometrotting.com/wp-content/uploads/2019/03/heartvector2-1.svg" style="width:80px;margin-bottom:20px;">
            <div class="gdlr-item-title-head">
                
                <h3 class="gdlr-item-title gdlr-skin-title gdlr-skin-border">What People Are Saying</h3>
                <div class="gdlr-item-title-carousel" style="right:-150px;margin-top:0px;top:22px;"><i class="icon-angle-left gdlr-flex-prev"></i><i class="icon-angle-right gdlr-flex-next"></i></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="gdlr-item gdlr-testimonial-item carousel large plain-style">
            <div class="gdlr-ux gdlr-testimonial-ux" style="opacity: 1; padding-top: 0px; margin-bottom: 0px;">
                <div class="flexslider" data-type="carousel" data-nav-container="gdlr-testimonial-item" data-columns="1">
                    <div class="flex-viewport" style="overflow: hidden; position: relative;">
                        <ul class="slides" style="width: 2800%; margin-left: -9763px;">
                         <?php
	    
	    if(count($array) >= 1){
	        $it = 1;
	        foreach($array as $value){
	            
	                ?>   
                            
                            <li class="testimonial-item" style="width: 751px; float: left; display: block;">
                                <div class="testimonial-content gdlr-skin-content">
                                    <p><?php echo $value->testimonial ?> </p>
                                </div>
                                <div class="testimonial-info"><span class="testimonial-author gdlr-skin-link-color"><?php echo $value->name ?> from <?php echo $value->companyName ?> • <?php echo $value->title ?> </span></div>
                            </li>
                        
            <?php
	            }
           }else{
	        ?>
	        
	        No Testimonial Found
	        
	        <?php
	      
	    }
	    
	    ?>

                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

