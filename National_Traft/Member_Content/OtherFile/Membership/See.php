<?php
global $wpdb;
$user = $wpdb->get_results("SELECT * FROM `wp_users`");
?>


<form action="javascript:void(0)" method = 'post' id = "see_membership_admin" enctype="multipart/form-data">
  <div class="form-group">
    <label for="email">Select Email Address:</label>
    <select name = "User_Id" >
             <?php 
        foreach ($user as $key) {

        ?>
        
          <option value='<?php echo $key->ID ;?>'><?php echo $key->display_name." , ".$key->user_email ;?></option>
         
        <?php 
        
        }
        ?>
    </select>
</div>
<div class="form-group" id= "User_See_delete">
    <label for="User_See_delete">Select One Option:</label>
    <select name = "User_See_delete" >
          <option value='seeInfo'>See User Information</option>
          <option value='deleteInfo'>Delete User</option>
    </select>
</div>
  <button type="submit" class="btn btn-default" >Submit</button>
 
</form>
<center>
    <br>
    <br>
<div id = "UserResult">
    
    <textarea rows="10" cols="100" disabled>

    </textarea>
    
</div>

</center>
<script>




$(document).ready(function(){

    $("#see_membership_admin").submit(function() {

            var del = $('#User_See_delete select').val();
            
            var conf = true;
            if(del == 'deleteInfo'){
                conf = confirm("Are You sure To delete data ?");
            }
            
            console.log(conf);
            if(conf == true){
                var postValue = "action=MemberLevelAdmin&parem=MemberLevelAdminSee_Data&"+jQuery("#see_membership_admin").serialize();
                //console.log(postValue);
                jQuery.post(mm_content_getAjaxUrl,postValue,function(response){
                        //console.log(response);
    
                        var data = jQuery.parseJSON(response);
                        
                        if(data.status == "seeInfo"){
                             console.log(data.CurrentRuningMembership);
                        
                            if(data.CurrentRuningMembership[0]){
                                  var val = "Membership Information Active:\n\tMembership name : "+data.CurrentRuningMembership[0].name + "\n\tMembership Amount : "+data.CurrentRuningMembership[0].initial_payment+"\n\t";
                                  val += "Membership Starting Date : "+data.CurrentRuningMembership[0].startdate+"\n\tMembership Ending Date : "+data.CurrentRuningMembership[0].enddate+"\n\t"
                                  val += "User Current Credit : "+data.TotalCredit;
                            }
                            else{
                                var val = "Membership Information Active: none \n"
                                val += "User Current Credit : "+data.TotalCredit;
                            }
                            
                          
                             $("#UserResult textarea").val(val);
                        }
                        else if(data.status == "deleteInfo"){
                            $("#UserResult textarea").val("Delete Data Successfully , Please wait for reload page ...");
                            
                            setTimeout(function(){location.reload(); },100)
                        }
                        
                       
                        
                    }) ;
            }

         
		
    });
    
});
</script>