<?php


um_fetch_user( get_current_user_id() );
//user_nicename
//display_name

?>

<div style="background-image: url('http://nationalturf.teamalfy.com/wp-content/uploads/2018/10/sidebar_image.jpg'); background-size: cover; height: 25vh; max-height: 400px; text-align: center; display: flex; align-items: center; ">
    <div style="margin: 0px auto;">
    <h1 style="color: #fff; font-weight: bold; display: inline-block;">Hi <?php echo um_user('user_nicename'); ?> ! </h1>
    
    <p class="sidebar-text" style="font-size: 20px; margin-bottom: 20px;">Welcome to your dashboard</p>
    <!-- <a href="#"><button class="kc_button yellow_button" style="padding: 0px 20px;">Upgrade Membership</button></a> -->
    
    </div>

</div>