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
  <h2></h2>
  <br>
  <br>
  <br>
  <br>
  <br>

  <form action="javascript:void(0)" id = "frmPost_highlights">
    <div class="form-group">
      <label for="email"><?php echo $Value_3; ?>:</label>
      <input type="text" class="form-control" id="txt_1" name="txt_1" required >
    </div>
    <div class="form-group">
      <label for="email"><?php echo $Value_4; ?>:</label>
      <input type="text" class="form-control" id="txt_2" name="txt_2" required >
    </div>
    <div class="form-group">
      <label for="email"><?php echo $Value_5; ?>:</label>
      <input type="text" class="form-control" id="txt_3" name="txt_3" required >
    </div>
    <div class="form-group">
      <label for="email"><?php echo $Value_6; ?>:</label>
      <input type="text" class="form-control" id="txt_4" name="txt_4" required >
    </div>
    <div class="form-group">
      <label for="email"><?php echo $Value_7; ?>:</label>
      <input type="text" class="form-control" id="txt_5" name="txt_5" required >
    </div>
    <div class="form-group">
      <label for="email"><?php echo $Value_8; ?>:</label>
      <input type="text" class="form-control" id="txt_6" name="txt_6" required >
    </div>
    <div class="form-group">
      <label for="email"><?php echo $Value_9; ?>:</label>
      <input type="text" class="form-control" id="txt_7" name="txt_7" required >
    </div>
    <div class="form-group">
      <label for="email"><?php echo $Value_10; ?>:</label>
      <input type="text" class="form-control" id="txt_8" name="txt_8" required >
    </div>

    <button type="submit" id="btnClick_highlights" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
