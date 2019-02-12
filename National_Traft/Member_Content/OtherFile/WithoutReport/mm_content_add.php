<?php


  

  global $wpdb;
  $results = $wpdb->get_results( "SELECT * FROM `wp_users`");
  

  //print_r($results);


?>


<!DOCTYPE html>
<html lang="en">
<head>

 
<?php 
wp_enqueue_media();
?>
</head>


<body>

<div class="container">
  <h2></h2>
  <br>
  <br>
  <br>
  <br>
  <br>

  <form action="javascript:void(0)" id = "frmPost">
    <div class="form-group">
      <label for="email">Title:</label>
      <input type="text" class="form-control" id="txtTitle" name="txtTitle" required placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <?php if (count($results) > 0) {
        # code...
      ?>
          <select  class="form-control" name="UserEmail">
                <option value="<?php echo "All"; ?>">All</option>
                <?php  foreach ($results as $key) { ?>
                    <option value="<?php echo $key->user_email; ?>"><?php echo $key->user_email; ?></option>
               <?php } ?>
          </select>
          <?php
          }else{
         ?>
          <label class="form-group" for="email">Sorry ! No User Found </label>
        <?php

          }
           ?>
    </div>
     <div class="form-group">
      <label for="email">Upload File:</label>
      <input type="button" class="form-control" id="btnImage" name="btnImage" required value="Upload File" >
    </div>
    <div class="form-group">
      
      <input type="hidden" id="FileLink" name="FileLink" >
    </div>

   
    <button type="submit" id="btnClick" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
