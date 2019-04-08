<?php 
     global $wpdb;
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


<h1>
    <center>
    Testimonial Page
    </center>
    
</h1>

<h3>
    
    Testimonial Add Data
    
    
</h3><br>

    <form action = "javascript:void(0)" id="TestimonialUpdateAdmin">
      <div class="form-group">
        <label for="exampleInputEmail1">User Name : </label>
        <input type="text" class="form-control" id="UserName" name = "UserName" placeholder="Enter Name" required>
        
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Date :</label>
        <input type="text" class="form-control" id="TitleName" name = "TitleName"  placeholder="Date" required>
      </div>
       <div class="form-group">
        <label for="exampleInputPassword1">Location : </label>
        <input type="text" class="form-control" id="companyName" name = "companyName" placeholder="Location" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Testimonial : </label>
        <textarea class="form-control" id="TestimonialTextarea" name = "TestimonialTextarea" rows="3" required></textarea>
    </div>
      
      <button type="submit" class="btn btn-primary" id="addDataSubmitButton">Submit</button>
    </form>
    
    
    
    
    
    
    <br><br><br>
    
 <h3>
    
    Testimonial See Data
    
    
</h3>   <br>
     <pre>
        <?php
        $array = $wpdb->get_results( "SELECT * FROM ".TableName_Testimonial());
        //print_r($array);
       
        ?>
            </pre>
    <table id="table_id" class="display">
    <thead>
       
        
        <tr>
            <th>Id</th>
            <th>User Name  </th>
            <th>Date </th>
            <th>Location  </th>
            <th>Testimonial</th>
            <th>Edit</th>
            <th>Delete</th>
            
        </tr>
        
        
    </thead>
    <tbody>
        
        <?php 
            if(count($array >= 0)){ 
                foreach($array as $val){ 
        ?>
        <tr>
           
             
        
            
            <td><?php echo $val->id; ?></td>
            <td><?php echo $val->name; ?></td>
            <td><?php echo $val->title; ?></td>
            <td><?php echo $val->companyName; ?></td>
            <td><?php echo $val->testimonial; ?></td>
            <td><a href="#EditFormTestmonial"> <button type="button" class="btn btn-primary" id="EditButton_<?php echo $val->id; ?>" value ="<?php echo $val->id; ?>">Edit</button> </a></td>
            <td> <button type="button" class="btn btn-danger" id="DeleteButton_<?php echo $val->id; ?>" value ="<?php echo $val->id; ?>">Delete</button> </td>
            <script>
             $('#EditButton_<?php echo $val->id; ?>').click(function(){
                 $("#IdSelect").val($(this).val()).change();
             });
            
                
                $('#DeleteButton_<?php echo $val->id; ?>').click(function(){
                    var conf = confirm("Are you sure to delete the testimonial ?");
                    if(conf){
                        $(this).attr("disabled", true);
                        var postValue = "action=TestimonialUpdateAdmin&parem=TestimonialUpdateAdminDelete_Data&DeletedId=<?php echo $val->id; ?>";
                        //console.log(postValue);
                        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                        //console.log(ajaxurl);
                            
                        jQuery.post(ajaxurl,postValue,function(response){
                                console.log(response);
            
                                var data = jQuery.parseJSON(response);
                                if (data.status == "success") {
                                    location.reload();
                                }
                                
                            }) ;
                    }
                  
                });
                
            </script>
        </tr>
       <?php
                }
            }
        ?>
    </tbody>
</table>
    
    
    
 
 
 <div id = "EditFormTestmonial">
 
 <br>
 <h3>
    
    Testimonial Edit Data
    
    
</h3><br>

    <form action = "javascript:void(0)" id="TestimonialUpdateEditDataAdmin">
      
      
      <div class="form-group">
        <label for="exampleInputEmail1">Select Id : </label>
        <select class="form-control" name="IdSelect" id="IdSelect">
            <option value="0">Default select</option>
            <?php 
                if(count($array >= 0)){ 
                    foreach($array as $val){ 
             ?>
                 <option value="<?php echo $val->id; ?>"> <?php echo $val->id; ?> </option>
                
                <?php
                }
            }
        ?>
        </select>
        
      </div>
      
      <div id = "EditShowData">
          
      
      
              <div class="form-group">
                <label for="exampleInputEmail1">User Name : </label>
                <input type="text" class="form-control" id="UserNameEdit" name = "UserName" placeholder="Enter Name" required>
                
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Date  :</label>
                <input type="text" class="form-control" id="TitleNameEdit" name = "TitleName"  placeholder="Date" required>
              </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Location : </label>
                <input type="text" class="form-control" id="companyNameEdit" name = "companyName" placeholder="Location" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Testimonial : </label>
                <textarea class="form-control" id="TestimonialTextareaEdit" name = "TestimonialTextarea" rows="3" required></textarea>
            </div>
              
              <button type="submit" class="btn btn-primary" id="EditDataSubmitButton">Edit</button>
      
      </div>
      
    </form>
    
    

 </div>
 
 
 
    
    
    
    <script>
        $(document).ready(function(){
            
             $('#EditShowData').hide();
            $('#table_id').DataTable();
             $("#TestimonialUpdateAdmin").validate({
                  submitHandler:function(){
                            $('#addDataSubmitButton').attr("disabled", true);
                            var postValue = "action=TestimonialUpdateAdmin&parem=TestimonialUpdateAdminAdd_Data&"+jQuery("#TestimonialUpdateAdmin").serialize();
                            console.log(postValue);
                            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                            console.log(ajaxurl);
                            
                           
                            jQuery.post(ajaxurl,postValue,function(response){
                                console.log(response);
            
                                var data = jQuery.parseJSON(response);
                                if (data.status == "success") {
                                    location.reload();
                                }
                                
                            }) ;
            
            
            
                        }
                     
                  
             
            });
            
            
            
            $("#IdSelect").change(function(){
                 $("#EditShowData").hide();
                if($(this).val() != 0){
                    
                     var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                     var postValue = "action=TestimonialUpdateAdmin&parem=TestimonialUpdateAdminedit_Data&selectedId="+$(this).val();
                      $(this).attr("disabled", true);
                     jQuery.post(ajaxurl,postValue,function(response){
                                console.log(response);
                                $("#IdSelect").attr("disabled", false);
                                $("#EditShowData").show();
                                
                                var data = jQuery.parseJSON(response);
                                console.log(data);
                                if (data.status == "success") {
                                    var message = jQuery.parseJSON(data.message);
                                    
                                    
                                    
                                    
                                    var name = message[0].name;
                                    var title = message[0].title;
                                    var company = message[0].companyName;
                                    var testimonial = message[0].testimonial;
                                    
                                     $("#UserNameEdit").val(name);
                                      $("#TitleNameEdit").val(title); 
                                      $("#companyNameEdit").val(company);
                                       $("#TestimonialTextareaEdit").val(testimonial);
                                    
                                }
                            }) ;
                    
                    
                    
                    
                }
                else{
                    $("#EditShowData").hide();
                }
            });
            
            
            
             $("#TestimonialUpdateEditDataAdmin").validate({
                  submitHandler:function(){
                            $('#EditDataSubmitButton').attr("disabled", true);
                            var postValue = "action=TestimonialUpdateAdmin&parem=TestimonialUpdateAdminEditAdd_Data_form&"+jQuery("#TestimonialUpdateEditDataAdmin").serialize();
                            console.log(postValue);
                            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                            console.log(ajaxurl);
                            
                           
                            jQuery.post(ajaxurl,postValue,function(response){
                                console.log(response);
            
                                var data = jQuery.parseJSON(response);
                               
                                if (data.status == "success") {
                                    location.reload();
                                }
                                
                            }) ;
            
            
            
                        }
                     
                  
             
            });
            
            
        });
        
        
        
        
        
    </script>
    
    