<?php 

if(isset($_GET['level'])){
    global $wpdb;
    $Link =  "";
    $value = $_GET['level'];
    $sql = "SELECT * FROM `wp_pmpro_membership_levels` WHERE `id` = ".$value;
    
    $results = $wpdb->get_results($sql);
  
    $name = $results[0]->name ;
    if(strpos($name, 'Credit') !== false){
        //credits page link
        $Link = "http://nationalturf.teamalfy.com/index.php/membership-credits/";
    }
    else{
        ////levels page link
         $Link = "https://nationalturf.teamalfy.com/index.php/membership-levels/";
    }
}   

?>


<a href="<?php echo  $Link?>">
    <img class="alignnone size-medium" src="http://nationalturf.teamalfy.com/wp-content/uploads/2018/10/cross.png" alt="" width="21" height="21" />
</a>


<div class="text-left">
    <h2 style="color: #ffc127;text-align:left;">Enter Payment Information <?php echo $nameCrd; ?></h2>
    <p style="color: #fff;text-align:left;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea</p>    
</div>

