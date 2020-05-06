@extends('layouts.main')
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-12">
      <!-- Custom Tabs -->
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Career Guidance & Career fair workshop</h3>
          <ul class="nav nav-pills ml-auto p-2" id="tabs">
            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Resourse Person</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Participants</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Youth Identified</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Career Test</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_6" data-toggle="tab">Attachments</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <form name="cg" id="cg" method="post" enctype="multipart/form-data">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                <label for="district">1. District</label>
                <select name="district" id="district" class="form-control" data-dependent="dsd">
                <option value="">Select Option</option>
                @foreach($districts as $district)
                <option value="{{ $district->name_en}}">{{ $district->name_en }}</option>
                @endforeach
                 </select>
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dsd">2. DSD (Leave blank if not relevant)</label>
                <select name="dsd" id="dsd" class="form-control">
                <option value="">Select Option</option>
                
                 </select>
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="gn_division">3. GN Divisions Covered</label>
                <select name="gnd[]" id="gn_division" class="form-control" multiple>
                  <option value="">Select Option</option>
                </select>
              </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">4. District Manager</label>
                <select name="dm_name" id="dm_name" class="form-control">
                <option value="">Select Option</option>
                @foreach($managers as $manager)
                <option value="{{ $manager->manager}}">{{ $manager->manager }}</option>
                @endforeach
                 </select>
            </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                <label for="dm_name">5. Title of the Action</label>
                <select name="title_of_action[]" id="title_of_action" class="form-control" multiple>
                  <?php 
                  $activitiess = array('Conducting career guidance programs to facilitate youth in identifying suitable career options','Organizing & conducting career fairs just after the CG training','Identification of youth who need financial support for vocational / professional educations -soft skills, job linkages as well');

                  $codes = array('2.1.6','2.1.7','2.1.8');
                 ?>
                <option value="">Select Option</option>
                @foreach($activities as $activity)
                <option @if(in_array($activity->activity,$activitiess)) selected @endif value="{{ $activity->activity}}">{{ $activity->activity }}</option>
                @endforeach
                 </select>
            </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                <label for="dm_name">6. Activity code as per the Logframe</label>
                <select name="activity_code[]" id="activity_code" class="form-control" multiple>
                <option value="">Select Option</option>
                @foreach($activities as $activity)
                <option @if(in_array($activity->code,$codes)) selected @endif value="{{ $activity->code}}">{{ $activity->code }}</option>
                @endforeach
                 </select>
            </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">7. Program Date</label>
                <input type="date" name="program_date" id="program_date" class="form-control">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">8. Time Start</label>
                <input type="time" name="time_start" id="time_start" class="form-control">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">9. Time End</label>
                <input type="time" name="time_end" id="time_end" class="form-control">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">10. Venue</label>
                <input type="text" name="venue" id="venue" class="form-control">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">11. Program Cost</label>
                <input type="number" name="program_cost" id="program_cost" class="form-control">
            </div>
                </div>
              </div>
              <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
                    <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
                      No of Youth Participated
                    </span>
                </div>
                <br>    
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">12. Total Male</label>
                <input type="number" name="total_male" id="total_male" class="form-control">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">13. Total Female</label>
                <input type="number" name="total_female" id="total_female" class="form-control">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">14. PWD Male</label>
                <input type="number" name="pwd_male" id="pwd_male" class="form-control">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">15. PWD Female</label>
                <input type="number" name="pwd_female" id="pwd_female" class="form-control">
            </div>
                </div>
                
              </div>  
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                <label for="dm_name">16. Mode of Conduct</label>
                <textarea class="textarea" name="mode_of_conduct" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
                </div>                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                <label for="dm_name">17. Topics Discussed </label>
                <textarea class="textarea" name="topics" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
                </div>                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                <label for="dm_name">18. Deliverables</label>
                <textarea class="textarea" name="deliverables" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
                </div>                
              </div>
             <button type="button" class="btn btn-primary" id="gvt">Next</button>
            </div>

            <div class="tab-pane" id="tab_2">
              <div class="row">
                <div class="form-group col-md-6">

            <label for="family_id">Resourse Person</label>
                          
                        <div class="input-group">
                        
                        <input data-toggle="tooltip" data-placement="top" title="Search Resorse Person name and select" type="text" id="res_name" name="res_id" class="form-control" placeholder="Search Name of Resourse Person">
                        <div style="cursor: pointer" onclick="window.open('{{Route('activities/resourse-person')}}', '_blank');" class="input-group-prepend">
                          <span data-toggle="tooltip" data-placement="top" title="Add Resourse Person to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                        </div>  
                      </div>
                      <div id="res_list"></div>
                          <input type="hidden" id="resourse_person_id" name="resourse_person_id" value="">
          </div>
          <div class="form-group col-md-2">

            
          </div>  
              </div>
              <button type="button" id="part" class="btn btn-info btn-flat">Next</button>  
            </div>
            <div class="tab-pane" id="tab_3">
              <div class="form-group">
  
                  <table class="table table-borderless" id="dynamic_field">
              <thead>
                <tr>
                  <th scope="col">Name of the institute/company</th>
                  <th scope="col">Type of institute/company (Private or Government)</th>
                  <th scope="col">Business Address of the institute/company</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th><input type="text" name="name[]" class="form-control name-list"></th>
                  <td><select name="type[]" class="form-control"><option value="Private">Private</option><option value="Government">Government</option></select></td>
                  <td><input type="text" name="address[]" class="form-control branch-list"></td>
                  
                  <td><button type="button" class="btn btn-success btn-flat" id="add">Add More</button></td>
                </tr>
                
              </tbody>
            </table>
            
              </div>
              <button type="button" id="youth" class="btn btn-info btn-flat">Next</button>  
            </div>
            <div class="tab-pane" id="tab_4">
              <h5 class="text-muted"> Youth Participated to CG Program</h5>

              <div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
                <div class="col-md-6">
                  <div class="form-group">
                <label for="dm_name">Search Youth by name or NIC and copy youth id </label>
                <div class="input-group">                       
                            <input data-toggle="tooltip" data-placement="top" title="Search youth name or NIC select" type="text" id="youth1" name="youth" class="form-control" placeholder="Search Name or NIC of youth">
                            <div style="cursor: pointer" onclick="window.open('{{Route('youth/add')}}', '_blank');" class="input-group-prepend">
                              <span data-toggle="tooltip" data-placement="top" title="Add a youth to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                            </div>  
                         </div>
                        <div id="youth_list"></div>
            </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                <label for="dm_name">Youth ID</label>

                    <div class="input-group"> 
                              <input type="text" id="youth_id" class="form-control" value="" >
                              <div data-clipboard-target="#youth_id" id="copy" style="cursor: pointer" class="input-group-prepend copy">
                                <span data-toggle="tooltip" data-placement="top" title="copy to clipboard" class="input-group-text"><i class="fas fa-copy"></i></span>
                              </div>
                          </div>
                        </div>

                </div>
              </div>
              <div class="form-group">
  
                  <table class="table table-borderless" id="dynamic_field1">
              <thead>
                <tr>
                  <th scope="col">Youth ID</th>
                  <th scope="col">Career Field according to career test</th>
                  <th scope="col">2nd Priority</th>
                  <th scope="col">3rd Priority</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th><input type="number" name="youth_id[]" class="form-control"></th>
                  <td><select name="career_field1[]" class="form-control position-list">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select></td>
                  <td><select name="career_field2[]" class="form-control position-list">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select></td>
                  <td><select name="career_field3[]" class="form-control position-list">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select></td>
                  <td><button type="button" class="btn btn-success btn-flat" id="add1"><i class="fas fa-plus"></i></button></td>
                </tr>
                
              </tbody>
            </table>
              </div>
              <div class="card card-body">
                
              
              <h5 class="text-muted"> No. of youth identified to support on VT/Professional education</h5>
              <div class="form-group">
  
                  <table class="table table-bordered" id="dynamic_field">
              <thead>
                <tr>
                  <th scope="col">Identified requirement</th>
                  <th scope="col">Male</th>
                  <th scope="col">Female</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th><label>No. of youth in immediate job search</label>
                  <input type="hidden" name="requirement[]"  value="No. of youth in immediate job search" class="form-control name-list"></th>
                  <td><input type="number" name="male[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>No. of youth need soft skill training prior to job placement/VT/professional training</label>
                  <input type="hidden" name="requirement[]"  value="No. of youth need soft skill training prior to job placement/VT/professional training" class="form-control name-list"></th>
                  <td><input type="number" name="male[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>No. of youth identified to support on VT courses</label>
                  <input type="hidden" name="requirement[]"  value="No. of youth identified to support on VT courses" class="form-control name-list"></th>
                  <td><input type="number" name="male[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>No. of youth identified to support on professional courses</label>
                  <input type="hidden" name="requirement[]"  value="No. of youth identified to support on professional courses" class="form-control name-list"></th>
                  <td><input type="number" name="male[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Youth who need further assistance in identifying a career</label>
                  <input type="hidden" name="requirement[]"  value="Youth who need further assistance in identifying a career" class="form-control name-list"></th>
                  <td><input type="number" name="male[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female[]" class="form-control branch-list"></td>
                </tr>
                
              </tbody>
            </table>

            </div>
            </div>
              <button type="button" id="test" class="btn btn-info btn-flat">Next</button>  
            
              
            </div>
            <div class="tab-pane" id="tab_5">
              <h5 class="text-muted">Summary of the career test(Refer the career test format)</h5>

              <div class="form-group">
                  <table class="table table-bordered" id="dynamic_field">
              <thead>
                <tr>
                  <th scope="col">Career Field</th>
                  <th scope="col">Male</th>
                  <th scope="col">Female</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th><label>Field work</label>
                  <input type="hidden" name="career_field[]"  value="Field work" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Skill work</label>
                  <input type="hidden" name="career_field[]"  value="Skill work" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Scientific service</label>
                  <input type="hidden" name="career_field[]"  value="Scientific service" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Arts & Communication</label>
                  <input type="hidden" name="career_field[]"  value="Arts & Communication" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Management, Business & Finance</label>
                  <input type="hidden" name="career_field[]"  value="Management, Business & Finance" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Office related</label>
                  <input type="hidden" name="career_field[]"  value="Office related" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Public relations</label>
                  <input type="hidden" name="career_field[]"  value="Public relations" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
                <tr>
                  <th><label>Youth in dilemma</label>
                  <input type="hidden" name="career_field[]"  value="Youth in dilemma" class="form-control name-list"></th>
                  <td><input type="number" name="male1[]" class="form-control branch-list"></td>
                  <td><input type="number" name="female1[]" class="form-control branch-list"></td>
                </tr>
              </tbody>
            </table>
              <button type="button" id="att" class="btn btn-info btn-flat">Next</button>  
            
              </div>
            </div>
            <div class="tab-pane" id="tab_6">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Attendance Sheet(scan as a one file)</label>
                    <input type="file" name="attendance" class="form-control">
                  </div>  
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Photos</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                  </div>  
                </div>
              </div>  
              {{csrf_field()}}
        <button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>
            </div>

          </div>
          </form>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- ./card -->
    </div>
    <!-- /.col -->
  </div>
</div>

@endsection
@section('scripts')
<script>
	$(document).ready(function(){
   	  $(document).on('change','#district',function(e){
   	  		
   	  		var district = e.target.value;
   	  		

   	  		$.get('/ds-division?district=' +district, function(data){
   	  			//success
   	  			console.log(data);
   	  			$('#dsd').empty();
   	  			$('#gnd').empty();
   	  			$.each(data, function(index, dsObj){
   	  				$('#dsd').append('<option value="'+dsObj.ID+'">'+dsObj.DSD_Name+'</option>');

   	  			});
   	  		});
   	  });

   	  $(document).on('change','#dsd',function(e){
   	  		
   	  		var ds_division = e.target.value;
   	  		

   	  		$.get('/gn-division?ds_division=' +ds_division, function(data){
   	  			//success
   	  			console.log(data);
   	  			$('#gn_division').empty();
   	  			$.each(data, function(index, gnObj){
   	  				$('#gn_division').append('<option value="'+gnObj.GN_Office+'">'+gnObj.GN_Office+'</option>');

   	  			});
   	  		});
   	  });

      $(document).on('click','#gvt', function(){
        $('#tabs a[href="#tab_2"]').tab('show');
      });
      $(document).on('click','#part', function(){
        $('#tabs a[href="#tab_3"]').tab('show');
      });
      $(document).on('click','#youth', function(){
        $('#tabs a[href="#tab_4"]').tab('show');
      });
      $(document).on('click','#test', function(){
        $('#tabs a[href="#tab_5"]').tab('show');
      });

      $(document).on('click','#att', function(){
        $('#tabs a[href="#tab_6"]').tab('show');
      });
   	});

  $(document).ready(function(){
//search resourse Person
       $('#res_name').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/resoursePersonList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#res_list').fadeIn();  
                 $('#res_list').html(data);
                }
               });
              }
          });

          $(document).on('click', '#resourse_person li', function(){  
            $('#res_list').fadeOut(); 
              $('#res_name').val($(this).text()); 
              var res_id = $(this).attr('id');
              $('#resourse_person_id').val(res_id);
               
          });  
    });
  @if (session('error'))
  toastr.error('{{session('error')}}')
  @endif 

$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" class="form-control name_list" /></td><td><select name="type[]" class="form-control"><option value="Private">Private</option><option value="Government">Government</option></select></td><td><input type="text" name="address[]" class="form-control branch-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });

$(document).ready(function(){
     $("#cg").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activities/add-cg',   
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
              toastr.success('Succesfully Add Career guidance and career fair Details ! ', 'Congratulations', {timeOut: 5000});
              $("#cg")[0].reset();

            }
            else{
             toastr.error('Something Error !', 'May be youth details are mismatched');
             printValidationErrors(data.error);
             return false;
              
            }         
        },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'May be youth details are mismatched');
                
            },
        });
    });
  });
 function printValidationErrors(msg){
        $.each(msg, function(key,value){
          toastr.error('Validation Error !', ""+value+"");
        });
    }

  $(document).ready(function(){
//search resourse Person
       $('#youth1').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/youthList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#youth_list').fadeIn();  
                 $('#youth_list').html(data);
                }
               });
              }
          });

          $(document).on('click', '#youths li', function(){  
            $('#youth_list').fadeOut(); 
              $('#youth1').val($(this).text()); 
              $('#youth_id').focus(); 
              var ins_id = $(this).attr('id');
              $('#youth_id').val(ins_id);
               
          });  
}); 

  new ClipboardJS('.copy');


$(document).ready(function(){  
      var i=1;  
      $('#add1').click(function(){  
           i++;  
           $('#dynamic_field1').append('<tr id="row'+i+'"><th><input type="number" name="youth_id[]" class="form-control"></th><td><select name="career_field1[]" class="form-control position-list"><option>Field Work</option><option>Skill Work</option><option>Scientific Service</option><option>Arts & Communication</option><option>Management, Business & Finance</option><option>Office Related</option><option>Public Relations</option><option>Youth in Dilemma</option></select></td><td><select name="career_field2[]" class="form-control position-list"><option>Field Work</option><option>Skill Work</option><option>Scientific Service</option><option>Arts & Communication</option><option>Management, Business & Finance</option><option>Office Related</option><option>Public Relations</option><option>Youth in Dilemma</option></select></td><td><select name="career_field3[]" class="form-control position-list"><option>Field Work</option><option>Skill Work</option><option>Scientific Service</option><option>Arts & Communication</option><option>Management, Business & Finance</option><option>Office Related</option><option>Public Relations</option><option>Youth in Dilemma</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove1"><i class="fas fa-times"></i></button></td></tr>');  
           $('#youth1').val("");
           $('#youth_id').val("");
      });  
      $(document).on('click', '.btn_remove1', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });  
</script>
<style type="text/css" media="screen">
  #autocomplete, #resourse_person, #youths {
    position: absolute;
    z-index: 1000;
    cursor: default;
    padding: 0;
    margin-top: 2px;
    list-style: none;
    background-color: #ffffff;
    border: 1px solid #ccc;
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
       -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
#autocomplete,  #resourse_person, #youths > li {
  padding: 3px 20px;
}
#autocomplete, #resourse_person, #youths > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
@endsection