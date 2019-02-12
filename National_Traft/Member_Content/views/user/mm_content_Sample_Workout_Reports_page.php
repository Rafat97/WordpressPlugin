<section class="kc-elm kc-css-2514856 kc_row#">
<div class="kc-row-container kc-container">
<div class="kc-wrap-columns">
<div class="kc-elm kc-css-3795674 kc_col-sm-12 kc_column# kc_col-sm-12">
<div class="kc-col-container">
<h1 style="color: #003f9c;">SAMPLE WORKOUT REPORT</h1>
<div class="kc-elm kc-css-2768165 kc_text_block">

This is a sample of the Workout Reports you will receive (please use https if document fails to load) :









<?php 
//[wonderplugin_pdf src="https://nationalturf.teamalfy.com/wp-content/uploads/2018/10/WORKOUT.pdf" width="100%" height="600px" style="border:0;"]
global $wpdb;

$sql_sample_report = $wpdb->get_results("SELECT * FROM `wp_mm_content_db_WithoutReport` ORDER BY `wp_mm_content_db_WithoutReport`.`ID` DESC LIMIT 1,1");
if(count($sql_sample_report) >= 1 ){
    $fileLink_sample_report = $sql_sample_report[0]->FileLink;
    $value = "[wonderplugin_pdf src=\"".$fileLink_sample_report."\" width=\"100%\" height=\"600px\" style=\"border:0;\"]";
    echo do_shortcode($value);
    
}
else {
    
     echo "<h1>Sorry !! Sample Workout Reports Not Yet Published . </h1>";
    
}
//print_r ($sql_sample_report);


?>
<!--
<embed src="<?php echo $fileLink_sample_report; ?>" width="100%" height="600px">
-->










</div>
<div class="kc-elm kc-css-4082876" style="height: 30px; clear: both; width: 100%;"></div>
<div class="kc-elm kc-css-2389770 kc_text_block"></div>
</div>
</div>
</div>
</div>
</section>