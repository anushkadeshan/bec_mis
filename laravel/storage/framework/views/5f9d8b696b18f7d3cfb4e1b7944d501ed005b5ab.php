<?php $__env->startSection('content'); ?>
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Stakeholder meetings -Edit </h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Participants</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<form name="stake" id="stake" method="post" enctype="multipart/form-data">
	          	<div class="row">
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="district">1. District</label>
						    <select name="district" id="district" class="form-control" data-dependent="dsd">
								<option value="<?php echo e($meeting->district); ?>"><?php echo e($meeting->district); ?></option>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dsd">2. DSD </label>
						    <select name="dsd" id="dsd" class="form-control">
								<option value=""><?php echo e($meeting->dsd); ?></option>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
	          				<label for="gn_division">3. GN Divisions Covered</label><br>	
    						<?php echo e($meeting->gnd); ?>

   						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dm_name">4. District Manager</label> <br>	
    						<?php echo e($meeting->dm_name); ?>

						    
						</div>
	          		</div>
	          	</div>
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">7. Meeting Date</label>
						    <input type="date" name="program_date" id="program_date" class="form-control" value="<?php echo e($meeting->program_date); ?>">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">8. Time Start</label>
						    <input type="time" name="time_start" id="time_start" class="form-control" value="<?php echo e($meeting->time_start); ?>">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">9. Time End</label>
						    <input type="time" name="time_end" id="time_end" class="form-control" value="<?php echo e($meeting->time_end); ?>">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">10. Venue</label>
						    <input type="text" name="venue" id="venue" class="form-control" value="<?php echo e($meeting->venue); ?>">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">11. Program Cost</label>
						    <input type="number" name="program_cost" id="program_cost" class="form-control" value="<?php echo e($meeting->program_cost); ?>">
						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    No of participants
	                  </span>
                </div>
                <br>		
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">12. Total Male</label>
						    <input type="number" name="total_male" id="total_male" class="form-control" value="<?php echo e($meeting->total_male); ?>">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">13. Total Female</label>
						    <input type="number" name="total_female" id="total_female" class="form-control" value="<?php echo e($meeting->total_female); ?>">
						</div>
	            	</div>
	            	
	            </div>	
	          
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">14. Decisions taken/comments made by the participants</label>
						    <textarea class="textarea" name="decisions" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> <?php echo e($meeting->decisions); ?></textarea>
						</div>
	            	</div>	            	
	            </div>
	            <?php echo e(csrf_field()); ?>

	            <input type="hidden" id="r_id" name="m_id" value="<?php echo e($meeting->m_id); ?>">

				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Update</button>
	          </form>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	<div class="form-group">
  
	          			<table id="example1" class="table table-striped" id="dynamic_field">
						  <thead>
						    <tr>
						      <th></th>
						      <th scope="col">Name</th>
						      <th scope="col">Gender</th>
						      <th scope="col">Designation</th>
						      <th scope="col">Institute</th>
						      <th scope="col">Phone</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php $no = 1 ?>
						  	<?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						    <tr>
						      <td><?php echo e($no++); ?></td>
						      <th><input type="text" name="name[]" class="form-control name-list" value="<?php echo e($participant->name); ?>"></th>
						      <td><input type="text" name="gender[]" class="form-control position-list" value="<?php echo e($participant->gender); ?>"></td>
						      <td><input type="text" name="designation[]" class="form-control branch-list" value="<?php echo e($participant->designation); ?>"></td>
						      <td><input type="text" name="institute[]" class="form-control branch-list" value="<?php echo e($participant->institute); ?>"></td>
						      <td><input type="text" name="phone[]" class="form-control branch-list" value="<?php echo e($participant->phone); ?>"></td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="<?php echo e($participant->id); ?>" data-name="<?php echo e($participant->name); ?>" data-gender="<?php echo e($participant->gender); ?>" data-designation="<?php echo e($participant->designation); ?>" data-institute="<?php echo e($participant->institute); ?>" data-Phone="<?php echo e($participant->phone); ?>" id="edit2"><i class="fa fa-edit"></i></button></td>
						    </tr>
						    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </tbody>
						</table>
						<h5>Add a participant ( if you missed )</h5>
						<table id="example1" class="table table-striped" id="dynamic_field">
						  <thead>
						    <tr>
						      
						      <th scope="col">Name</th>
						      <th scope="col">Gender</th>
						      <th scope="col">Designation</th>
						      <th scope="col">Institute</th>
						      <th scope="col">Phone</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <form id="add-participant">
						      	
						      <th><input type="text" name="name" class="form-control name-list" ></th>
						      <td><input type="text" name="gender" class="form-control position-list"></td>
						      <td><input type="text" name="designation" class="form-control branch-list"></td>
						      <td><input type="text" name="institute" class="form-control branch-list"></td>
						      <td><input type="text" name="phone" class="form-control branch-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" id="add2">Add</button></td>
	            			 <input type="hidden" name="m_id" value="<?php echo e($meeting->m_id); ?>">
	            				<?php echo e(csrf_field()); ?>


					          </form>
						    </tr>
						  </tbody>
						</table>
						
						
	          	</div>
	          	
	            <div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Participants Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
                  
              <form role="form" method="get" id="myForm1">
                  <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name1" name="name" >
                     
                  </div>
                  <div class="form-group">
                    <label for="name">Gender</label>
                    <input type="text" class="form-control" id="gender1" name="gender" >
                     
                  </div>

                  <div class="form-group">
                    <label for="name">Designation</label>
                    <input type="text" class="form-control" id="designation1" name="designation" >
                     
                  </div>
                  <div class="form-group">
                    <label for="name">Institute</label>
                    <input type="text" class="form-control" id="institute1" name="institute" >
                     
                  </div>
                  <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="text" class="form-control" id="phone1" name="phone" >
                     
                  </div>
                  <input type="hidden" id="id_p" name="id_p"></input>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="update-part" class="btn btn-primary">Update changes</button>
          </div>
        </div>
      </div>
    </div>
	          </div>

	        </div>
	        <!-- /.tab-content -->
	      </div><!-- /.card-body -->
	    </div>
	    <!-- ./card -->
	  </div>
	  <!-- /.col -->
	</div>
	
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>

$(document).ready(function(){
     $("#stake").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-stake-holder',   
            data: new FormData(this),
   			contentType: false,
         	cache: false,
  			processData:false,

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully updated Stake Holder Meeting Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#stake")[0].reset();

            }
            else{
             printValidationErrors(data.error);
              
            }         
        },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'Something Error')
            },
        });
    });
  });
 
 function printValidationErrors(msg){
        $.each(msg, function(key,value){
        	toastr.error('Validation Error !', ""+value+"");
        });
    }

  <?php if(session('error')): ?>
  toastr.error('<?php echo e(session('error')); ?>')
  <?php endif; ?>  

   //edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#phone1').val($(this).data('phone'));
        $('#designation1').val($(this).data('designation'));
        $('#institute1').val($(this).data('institute'));
        $('#gender1').val($(this).data('gender'));
        
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-meeting',
                      
            data: form.serialize(),

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully updated the report ! ', 'Congratulations', {timeOut: 5000});
			  $("#myForm1")[0].reset();

            }
            else{
             printValidationErrors(data.error);
              
            }         
        },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'Something Error')
            },
        });
    });
  });

  //add participant
   $(document).ready(function(){
     $(document).on('click' , '#add2' ,function (){
        var form = $('#add-participant');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-part',
                      
            data: form.serialize(),

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully added a participant ! ', 'Congratulations', {timeOut: 5000});
			  $("#add-participant")[0].reset();

            }
            else{
             printValidationErrors(data.error);
              
            }         
        },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'Something Error')
            },
        });
    });
  });
</script>
<script src="<?php echo e(asset('js/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<script>
  $(function () {
    // bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5({
      toolbar: { fa: true },
      size: 'default'
    })
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>