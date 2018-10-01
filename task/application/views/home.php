<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
      <title>TASK</title>
      <link rel="stylesheet" href="<?php echo CSS_URL; ?>bootstrap.min.css">
      <script src="<?php echo JS_URL; ?>jquery.min.js"></script>
      <script src="<?php echo JS_URL; ?>bootstrap.min.js"></script>
      <script src="<?php echo CSS_URL; ?>bootstrap-datepicker.css"></script>
      <script src="<?php echo JS_URL; ?>bootstrap-datepicker.js"></script>
      <style>
         .table_ouline{
         padding: 10px;
         border: 1px solid #ccc;
		 margin-top:30px;
         }	
      </style>
   </head>
   <body>
      <div class="container">
         <div class="table_ouline">
            <div class="row">
               <div class="col-md-12">
                  <h3 style="text-align:center;">Employee Details</h2>
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="col-md-2">EMP ID</th>
                           <th class="col-md-2">EMP Name</th>
                           <th class="col-md-2">EMP Email</th>
                           <th class="col-md-2">EMP Phone</th>
                           <th class="col-md-2">EMP DOB</th>
                           <th class="col-md-2">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php for($i=0;$i<count($emp_details);$i++) { ?>
                        <tr>
                           <td><?php echo $emp_details[$i]['emp_id']; ?></td>
                           <td><?php echo $emp_details[$i]['emp_name']; ?></td>
                           <td><?php echo $emp_details[$i]['emp_email']; ?></td>
                           <td><?php echo $emp_details[$i]['emp_phone']; ?></td>
                           <td><?php echo $emp_details[$i]['emp_dob']; ?></td>
                           <td>
                              <a href="javascript:void(0);" class="btn btn-success" onclick="edituser(<?php echo $emp_details[$i]['emp_id']; ?>)">Edit</a>
                              <a href="javascript:void(0);" class="btn btn-danger" onclick="deleteuser(<?php echo $emp_details[$i]['emp_id']; ?>)">Delete</a>
                           </td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <div class="text-center">
                     <button type="button" class="btn btn-success" id="add_data">Add</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade modal_border_input" id="myModal" tabindex="-1">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title"><b>Add Employee</b></h5>
               </div>
               <?php echo form_open_multipart(SITE_URL.'/Admin/add_employee', array('id' => 'form_validation')); ?>
               <div class="modal-body">
                  <div class="row">
					<div class="col-md-7">
                     <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text" name="emp_name" class="form-control" required />
                     </div>
                     <div class="form-group">
                        <label>Employee Email</label>
                        <input type="text" name="emp_email" pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})" class="form-control" required />
                     </div>
                     <div class="form-group">
                        <label>Employee Phone</label>
                        <input type="text"  minlength="10" maxlength="10"  pattern="[0-9]{10}" name="emp_phone" class="form-control" required />
                     </div>
                     <div class="form-group">
                        <label>Employee DOB</label>
                        <input type="text" name="emp_dob" id="user_dob" class="form-control" />
                     </div>
					 </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Add</button>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
      <div class="modal fade modal_border_input" id="EModal" tabindex="-1">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title pull-left"><b>Edit User</b></h5>
               </div>
               <?php echo form_open_multipart(SITE_URL.'Admin/updateuser', array('id' => 'form_validation')); ?>
               <div class="modal-body" id="edit_modal">
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Update</button>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
      <script>
         $(document).ready(function(){
         	$("#add_data").click(function(){
         		$("#myModal").modal('show');
         	});
         });
      </script>
      <script>
         function edituser(id)
         {
         	$.get( "<?php echo SITE_URL;?>Admin/edituser/" + id, function( data ) {
         		$('#EModal').modal('show');
         		//alert(data);
         		
         
         		$("#edit_modal").html(data);
         	});
         
         }
      </script>
      <script>
         function deleteuser(id)
         {
         	  $.ajax({
         		type : "POST",
         		url  : "<?php echo SITE_URL.'Admin/deleteuser'; ?>",
         		data : "rid="+id,
         		async: false,
         		success : function(response) {
         			window.location.href = "<?php echo SITE_URL; ?>";
         		},
         		error: function() {
         			//alert('Error occured');
         		}
         	});
         }
      </script>
      <script>
         $('#user_dob').datepicker({
         	//startDate: '2016-07-1',
         format: "yyyy-mm-dd",
         startView: "date", 
         minViewMode: "date"
         });  
         
         
         	  
      </script>
   </body>
</html>