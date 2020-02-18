@extends('layouts.main')
@section('content')
<div class="container">
<div class="row">
    <div class="col-12">
      <!-- Custom Tabs -->
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Career Guidance & Career fair workshop - Edit</h3>
          <ul class="nav nav-pills ml-auto p-2" id="tabs">
            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Participants</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Youth Identified</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Career Test</a></li>
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
                <option value="{{ $meeting->district}}">{{ $meeting->district }}</option>
                 </select>
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dsd">2. DSD (Leave blank if not relevant)</label>
                <select name="dsd" id="dsd" class="form-control">
                <option value="{{$meeting->dsd}}">{{$meeting->dsd}}</option>
                 </select>
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="gn_division">3. GN Divisions Covered</label>
                {{$meeting->gnd}}
              </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">4. District Manager</label>
                <select name="dm_name" id="dm_name" class="form-control">
                <option value="{{ $meeting->dm_name}}">{{ $meeting->dm_name }}</option>
                 </select>
            </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">7. Program Date</label>
                <input type="date" name="program_date" id="meeting_date" class="form-control" value="{{$meeting->program_date}}">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">8. Time Start</label>
                <input type="time" name="time_start" id="time_start" class="form-control" value="{{$meeting->time_start}}">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">9. Time End</label>
                <input type="time" name="time_end" id="time_end" class="form-control" value="{{$meeting->time_end}}">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">10. Venue</label>
                <input type="text" name="venue" id="venue" class="form-control" value="{{$meeting->venue}}">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">11. Program Cost</label>
                <input type="text" name="program_cost" id="program_cost" class="form-control" value="{{$meeting->program_cost}}">
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
                <input type="number" name="total_male" id="total_male" class="form-control" value="{{$meeting->total_male}}">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">13. Total Female</label>
                <input type="number" name="total_female" id="total_female" class="form-control" value="{{$meeting->total_female}}">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">14. PWD Male</label>
                <input type="number" name="pwd_male" id="pwd_male" class="form-control" value="{{$meeting->pwd_male}}">
            </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                <label for="dm_name">15. PWD Female</label>
                <input type="number" name="pwd_female" id="pwd_female" class="form-control" value="{{$meeting->pwd_female}}">
            </div>
                </div>
                
              </div>  
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                <label for="dm_name">16. Mode of Conduct</label>
                <textarea class="textarea" name="mode_of_conduct" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->mode_of_conduct}}</textarea>
            </div>
                </div>                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                <label for="dm_name">17. Topics Discussed </label>
                <textarea class="textarea" name="topics" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->topics}}</textarea>
            </div>
                </div>                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                <label for="dm_name">18. Deliverables</label>
                <textarea class="textarea" name="deliverables" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->deliverables}}</textarea>
                </div>
                </div>                
              </div>
               <div class="row">
                <div class="form-group col-md-6">

                <label for="family_id">Resourse Person</label>
                          
                        <div class="input-group">
                        
                        <input data-toggle="tooltip" data-placement="top" title="Search Resorse Person name and select" type="text" id="res_name" name="res_id" class="form-control" placeholder="Search Name of Resourse Person" value="{{$meeting->r_name}}">
                        <div style="cursor: pointer" onclick="window.open('{{Route('activities/resourse-person')}}', '_blank');" class="input-group-prepend">
                          <span data-toggle="tooltip" data-placement="top" title="Add Resourse Person to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                        </div>  
                      </div>
                      <div id="res_list"></div>
                      <input type="hidden" id="resourse_person_id" name="resourse_person_id" value="{{$meeting->resourse_person_id}}">
          </div> 
              </div>
              {{csrf_field()}}
              <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

              <button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>
              </form>
            </div>
            <div class="tab-pane" id="tab_3">
              <div class="form-group">
                <table id="example1" class="table table-striped" id="dynamic_field">
              <thead>
                <tr>
                  <th scope="col">Name of the institute/company</th>
                  <th scope="col">Type of institute/company (Private or Government)</th>
                  <th scope="col">Business Address of the institute/company</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($participants as $participant)
                <tr>
                  <th>{{$participant->name}}</th>
                  <td>{{$participant->type}}</td>
                  <td>{{$participant->address}}</td>
                  <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$participant->id}}" data-name="{{$participant->name}}" data-type="{{$participant->type}}" data-address="{{$participant->address}}" id="edit2"><i class="fa fa-edit"></i></button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <h5>Add a participant (if you missed)</h5>
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
                  <form id="add-participant">
                  <td><input type="text" name="name" class="form-control name-list"></td>
                  <td><select name="type" class="form-control"><option value="Private">Private</option><option value="Government">Government</option></select></td>
                  <td><input type="text" name="address" class="form-control branch-list"></td>
                  <input type="hidden" name="m_id" value="{{$meeting->m_id}}">
                  <td><button type="button" class="btn btn-success btn-flat" id="add2">Add</button></td>
                  {{ csrf_field() }}

                </form>
                </tr>
                
              </tbody>
            </table>
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
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Name of the institute/company</label>
                    <input type="text" class="form-control" id="name1" name="name" >
                     
                  </div>
                  <div class="form-group">
                    <label for="name">Type of institute/company (Private or Government)</label>
                    <select name="type" id="type1" class="form-control"><option value="Private">Private</option><option value="Government">Government</option></select>
                     
                  </div>

                  <div class="form-group">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" id="address1" name="address" >
                     
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
            <div class="tab-pane" id="tab_4">
              <h5 class="text-muted"> Youth Participated to CG Program</h5>
              <table id="example1" class="table table-striped" id="dynamic_field1">
              <thead>
                <tr>
                  <th scope="col">Youth</th>
                  <th scope="col">Career Field according to career test</th>
                  <th scope="col">2nd Priority</th>
                  <th scope="col">3rd Priority</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($cg_youths as $youth)
                <tr>
                  <th>{{$youth->name}}</th>
                  <td>{{$youth->career_field1}}</td>
                  <td>{{$youth->career_field2}}</td>
                  <td>{{$youth->career_field3}}</td>
                  <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$youth->cg_youths_id}}" data-name="{{$youth->name}}" data-career_field1="{{$youth->career_field1}}" data-career_field2="{{$youth->career_field2}}" data-career_field3="{{$youth->career_field3}}" id="edit3"><i class="fas fa-edit"></i></button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="modal fade" id="updateModel2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  
              <form role="form" method="get" id="myForm2">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Career Field </label>
                    <select name="career_field1" class="form-control position-list" id="career_field11">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select>
                     
                  </div>

                  <div class="form-group">
                    <label for="name">2nd Priority</label>
                    <select name="career_field2" class="form-control position-list" id="career_field22">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select>
                     
                  </div>
                  <div class="form-group">
                    <label for="name">3rd Priority</label>
                    <select name="career_field3" class="form-control position-list" id="career_field33">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select>
                     
                  </div>
                  <input type="hidden" id="id_y" name="id_y"></input>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="update-youth" class="btn btn-primary">Update changes</button>
          </div>
        </div>
      </div>
    </div>
    <h5>Add a new youth (if you have missed)</h5>
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
                  <form id="add-youth">
                  <th><input type="number" name="youth_id" class="form-control"></th>
                  <td><select name="career_field1" class="form-control position-list">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select></td>

                  <td><select name="career_field2" class="form-control position-list">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select></td>

                  <td><select name="career_field3" class="form-control position-list">
                    <option>Field Work</option>
                    <option>Skill Work</option>
                    <option>Scientific Service</option>
                    <option>Arts & Communication</option>
                    <option>Management, Business & Finance</option>
                    <option>Office Related</option>
                    <option>Public Relations</option>
                    <option>Youth in Dilemma</option>
                  </select></td>
                  <input type="hidden" name="m_id" value="{{$meeting->m_id}}">
                  {{ csrf_field() }}

                  <td><button type="button" class="btn btn-success btn-flat" id="add3">Add</button></td>
                  </form>
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
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($cg_youth_selected as $cg_ys)
                <tr>                  
                  <th><label>{{$cg_ys->requirement}}</label></th>
                  <td>{{$cg_ys->male}}</td>
                  <td>{{$cg_ys->female}}</td>
                  <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$cg_ys->id}}" data-male="{{$cg_ys->male}}" data-female="{{$cg_ys->female}}"  id="edit4"><i class="fas fa-edit"></i></button></td>
                </tr>

                @endforeach
                
              </tbody>
            </table>

            </div>
            </div>
              <div class="modal fade" id="updateModel3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Requirments Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
                  
              <form role="form" method="get" id="myForm3">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Male </label>
                    <input type="text" class="form-control" name="male" id="maler">
                     
                  </div>
                  <div class="form-group">
                    <label for="name">Female </label>
                    <input type="text" class="form-control" name="female" id="femaler" >
                     
                  </div>

        
                  <input type="hidden" id="id_r" name="id_r"></input>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="update-req" class="btn btn-primary">Update changes</button>
          </div>
        </div>
      </div>
    </div>
            
              
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
                  <th scope="col"></th>

                </tr>
              </thead>
              <tbody>
                @foreach($cg_careertest_summary as $cts)
                <tr>
                  <th><label>{{$cts->career_field}}</label></th>
                  <td>{{$cts->male}}</td>
                  <td>{{$cts->female}}</td>
                  <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$cts->id}}" data-male="{{$cts->male}}" data-female="{{$cts->female}}"  id="edit5"><i class="fas fa-edit"></i></button></td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
            <div class="modal fade" id="updateModel4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Requirments Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
                  
              <form role="form" method="get" id="myForm4">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Male </label>
                    <input type="text" class="form-control" name="male" id="malec">
                     
                  </div>
                  <div class="form-group">
                    <label for="name">Female </label>
                    <input type="text" class="form-control" name="female" id="femalec" >
                     
                  </div>

        
                  <input type="hidden" id="id_c" name="id_c"></input>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="update-cts" class="btn btn-primary">Update changes</button>
          </div>
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

      
   	});

//edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#type1').val($(this).data('type'));
        $('#address1').val($(this).data('address'));        
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-cg',
                      
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
              location.reload();


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
            url: SITE_URL + '/activity/cg/add-part-cg',
                      
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
              location.reload();


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

  //edit 

  $(document).on('click', '#edit3', function(){
        var id = $(this).data('id');
        $('#id_y').val($(this).data('id'));
        $('#career_field11').val($(this).data('career_field1'));
        $('#career_field22').val($(this).data('career_field2'));
        $('#career_field33').val($(this).data('career_field3'));        
        $('#updateModel2').modal('show');
        
    });

   //update youth
   $(document).ready(function(){
     $(document).on('click' , '#update-youth' ,function (){
        var form = $('#myForm2');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-youth',
                      
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
              $("#myForm2")[0].reset();
              location.reload();


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

  //add youth
   $(document).ready(function(){
     $(document).on('click' , '#add3' ,function (){
        var form = $('#add-youth');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-youth-cg',
                      
            data: form.serialize(),

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully added a youth ! ', 'Congratulations', {timeOut: 5000});
            $("#add-youth")[0].reset();
            location.reload();


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

   //edit 

  $(document).on('click', '#edit4', function(){
        var id = $(this).data('id');
        $('#id_r').val($(this).data('id'));
        $('#maler').val($(this).data('male'));
        $('#femaler').val($(this).data('female'));     
        $('#updateModel3').modal('show');
        
    });

   //update youth
   $(document).ready(function(){
     $(document).on('click' , '#update-req' ,function (){
        var form = $('#myForm3');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-req',
                      
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
            $("#myForm3")[0].reset();
            location.reload();


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

   //edit 

  $(document).on('click', '#edit5', function(){
        var id = $(this).data('id');
        $('#id_c').val($(this).data('id'));
        $('#malec').val($(this).data('male'));
        $('#femalec').val($(this).data('female'));     
        $('#updateModel4').modal('show');
        
    });

   //update youth
   $(document).ready(function(){
     $(document).on('click' , '#update-cts' ,function (){
        var form = $('#myForm4');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-cts',
                      
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
            $("#myForm4")[0].reset();
            location.reload();


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
     $("#cg").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/edit-cg',   
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
              toastr.success('Succesfully updated Career guidance and career fair Details ! ', 'Congratulations', {timeOut: 5000});
              $("#cg")[0].reset();
              location.reload();


            }
            else{
             //toastr.error('Something Error !', 'May be youth details are mismatched');
             printValidationErrors(data.error);
             return false;
              
            }         
        },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                //toastr.error('Something Error !', 'May be youth details are mismatched');
                
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