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

  <form action="javascript:void(0)" id = "frmPost_fairOdds">
    <div class="form-group">
      <label for="email">Title :</label>
      <input type="text" class="form-control" id="txtTitle_fairOdds" name="txtTitle_fairOdds" required placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="email">Credit Cost:</label>
      
          <select  class="form-control" name="CreditCost_fairOdds">
                <?php  for($i = 0 ; $i <= 1000; $i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
               <?php } ?>
          </select>
          
    </div>
     <div class="form-group">
      <label for="email">Upload File:</label>
      <input type="button" class="form-control" id="btnImage_fairOdds" name="btnImage_fairOdds" required value="Upload File" >
    </div>
    <div class="form-group">
      
      <input type="hidden" id="FileLink_fairOdds" name="FileLink_fairOdds" >
    </div>

   
    <button type="submit" id="btnClick" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
