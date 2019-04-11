<?php 
     global $wpdb;
?>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


<h1>See Information Of Review System</h1>
<?php
        $array = $wpdb->get_results( "SELECT * FROM ".TableName_ReviewSystem());
        //print_r($array);
       
        ?>
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Business Name </th>
                <th>Business Email </th>
                <th>Facebook </th>
                <th>Google </th>
                <th>RateMDs </th>
                <th>RealSelf </th>
                <th>YelpLink </th>
                <th>Image </th>
                <th>Review Link </th>
                <th>Edit</th>
                <th>Delete </th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                if(count($array >= 1 )) :
                    foreach($array as $value) : ?>
            <tr>
                <td><?php echo $value->businessName; ?></td>
                <td><?php echo $value->businessEmail; ?></td>
                <td><?php echo $value->fbLink; ?></td>
                <td><?php echo $value->googleLink; ?></td>
                <td><?php echo $value->RateMDsLink; ?></td>
                <td><?php echo $value->RealSelfLink; ?></td>
                <td><?php echo $value->YelpLink; ?></td>
                <td> <img src="<?php echo $value->ImageLink; ?>" class="img-thumbnail" alt="Cinque Terre" width="100" height="100">  </td>
                <td><?php echo $value->GeneratedLink; ?></td>
                <td>
                    <button class="btn btn-primary" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit</button>
                    <div class="modal fade" id="myModal">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                    
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Information</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                    
                          <!-- Modal body -->
                          <div class="modal-body">
                            
                            <form action="javascript:void(0)" method="post" id="FormReviewSystemFormEdit_<?php echo $value->id;?>" enctype="multipart/form-data">
                                 <div class="form-group">
                                  <label for="Name">Business Name : </label>
                                  <input type="text" class="form-control" id="UserBusinessName" placeholder="Enter Business Name" value="<?php echo $value->businessName; ?>" name="UserBusinessName" required>
                                </div>
                                  
                                <div class="form-group">
                                  <label for="Name">Email : </label>
                                  <input type="email" class="form-control" id="UserName" placeholder="Enter Business Email" value="<?php echo $value->businessEmail; ?>" name="UserEmail" required>
                                </div>
                                <div class="form-group">
                                  <label for="Name">Facebook:</label>
                                  <input type="text" class="form-control  link-group" id="FacebookLink" placeholder="Enter Your Facebook Link" value="<?php echo $value->fbLink; ?>" name="FacebookLink">
                                </div>
                                <div class="form-group">
                                  <label for="Name">Google:</label>
                                  <input type="text" class="form-control  link-group" id="GoogleLink" placeholder="Enter Your Google Link" value="<?php echo $value->googleLink; ?>" name="GoogleLink">
                                </div>
                                <div class="form-group">
                                  <label for="Name">RateMDs:</label>
                                  <input type="text" class="form-control link-group" id="RateMDsLink" placeholder="Enter Your RateMDs Link" value="<?php echo $value->RateMDsLink; ?>" name="RateMDsLink">
                                </div>
                                <div class="form-group">
                                  <label for="Name">Yelp:</label>
                                  <input type="text" class="form-control link-group" id="YelpLink" placeholder="Enter Your Yelp Link" value="<?php echo $value->YelpLink; ?>" name="YelpLink">
                                </div>
                                <div class="form-group">
                                  <label for="Name">RealSelf:</label>
                                  <input type="text" class="form-control link-group" id="RealSelfLink" placeholder="Enter Your RealSelf Link" value="<?php echo $value->RealSelfLink; ?>" name="RealSelfLink" >
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="Name">Image Link:</label>
                                     <input type="text" class="form-control link-group" id="RealSelfLink" placeholder="Enter Your RealSelf Link" value="<?php echo $value->ImageLink; ?>" name="ImageLink" >
                                </div>
                              
                                  <input type="hidden" value="<?php echo $value->id; ?>"  name ="EditDataid">
                                <button type="submit" class="btn btn-primary " id="SubmitButtonJquary_<?php echo $value->id;?>">Submit</button>
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            
                            </form>
                            
                            
                           
                          </div>
                             <script>
                                jQuery("#FormReviewSystemFormEdit_<?php echo $value->id;?>").submit(function(){
                                  
                                    var postvalue =  "action=FormReviewSystemEditDeleteAdmin&type=EditReviewSystem&"+jQuery("#FormReviewSystemFormEdit_<?php echo $value->id;?>").serialize();
                                    console.log(postvalue);
                                    var ajax = "<?php echo admin_url("admin-ajax.php")."?action=FormReviewSystemEditDeleteAdmin&type=EditReviewSystem" ?>";
                            
                        
                                    var form = $('#FormReviewSystemFormEdit_<?php echo $value->id;?>');
                                    var formdata = false;
                                    
                                    if (window.FormData){
                                        formdata = new FormData(form[0]);
                                    }
                                    console.log(formdata);
                                    
                                    jQuery.post("<?php echo admin_url("admin-ajax.php"); ?>",postvalue,function(response){
                                          console.log(response);
                                           var jsonData = jQuery.parseJSON(response);
                                             console.log(jsonData);
                                            if(jsonData.status == "success"){
                                                location.reload();
                                            }else{
                                               alert("Some problem occurred");
                                               location.reload();
                                            }
                                      });
                                
                                });
                                
                                    
                                
                                
                            </script>
                          <!-- Modal footer -->
                          <!--<div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                    -->
                        </div>
                      </div>
                    </div>
                </td>
                <td><button class="btn btn-danger" id="ReviewDeleteButton_<?php echo $value->id;?>" value="<?php echo $value->id; ?>">Delete</button></td>
                <script>
                jQuery("#ReviewDeleteButton_<?php echo $value->id;?>").click(function(){
                    var ajax = "<?php echo admin_url("admin-ajax.php")."?action=FormReviewSystemEditDeleteAdmin&type=DeleteReviewSystem" ?>";
                    var conf = confirm("Are You sure ?");
                    if(conf){
                        var postValue = "action=FormReviewSystemEditDeleteAdmin&type=DeleteReviewSystem&deleteId="+jQuery(this).val();
                        
                          jQuery.post("<?php echo admin_url("admin-ajax.php"); ?>",postValue,function(response){
                              console.log(response);
                              var jsonData = jQuery.parseJSON(response);
                             console.log(jsonData);
                            if(jsonData.status == "success"){
                                location.reload();
                            }else{
                               alert("Some problem occurred");
                               location.reload();
                            }
                          });
                    
                    }
                    
                });
                </script>
            </tr>
           <?php endforeach; ?>
           <?php endif; ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>










<script>
    $(document).ready(function() {
        $('#example').DataTable();
} );
    
    
</script>
