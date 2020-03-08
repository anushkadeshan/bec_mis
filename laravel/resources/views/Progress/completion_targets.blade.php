@extends('layouts.main')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="card-title">Completion Reports Count</h3> 
                </div>
                <div class="col-md-6">
                    
                </div>
                @can('create-Employer')
                <div class="col-md-3 text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#exampleModalCenter">Add a Target</button>
                </div>
                @endcan
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Report</th>
                        <th>Type</th>
                        <th>Target</th>
                        <th>Branch</th>
                        <th>Action</th>

                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($reports as $report)
                    <tr class="employer{{$report->id}}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $report->report }}</td>
                        <td>{{ $report->year }}</td>
                        <td>{{ $report->target }}</td>
                        <td>{{ $report->name }}</td>
                        
                        <td>
                            <div class="btn-group">
                                
                                {{ csrf_field() }}
                                    <button type="button" id="edit-target" data-id="{{$report->id}}"  data-report="{{$report->report}}" data-year="{{$report->year}}" data-target="{{$report->target}}" data-table_name="{{$report->table_name}}" data-table_name_youth="{{$report->table_name_youth}}" data-table_name_youth_id="{{$report->table_name_youth_id}}"data-branch_id="{{$report->branch_id}}" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>
    </div>  
    <!-- Model for create employer -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Target Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
                  
              <form role="form" method="post" id="myForm">
                  {{ csrf_field() }}
                  <div  class="row">
                   
                  
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="location">Type</label>  
                        <select name="year" id="year" class="form-control">
                                <option value="">Select Option</option>
                                <option>Reports</option>
                                <option>Youths</option>
                            </select>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="location">Report</label>  
                        <select class="form-control" id="report" name="report">
                               @foreach($activities_reports as $activities_report)
                                <option value="{{ $activities_report->report}}">{{ $activities_report->report }}</option>
                                @endforeach
                            </select>
                        
                    </div>
                </div>
            
             <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Target</label>
                    <input type="integer" class="form-control" id="phone" name="target" placeholder="Enter Target">
                     <span class="help-block"><strong></strong></span>
                  </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label for="company_type">Table</label>
                    <select name="table_name" id="table_name" class="form-control">
                      <option value="">Select Option</option>
                      <option>regional_meetings</option>
                      <option>mentoring</option>
                      <option>stake_holder_meetings</option>
                      <option>kickoffs</option>
                      <option>households</option>
                      <option>tot_cg</option>
                      <option>career_guidances</option>
                      <option>pes_units</option>
                      <option>pes_unit_supports</option>
                      <option>cg_trainings</option>
                      <option>course_supports</option>
                      <option>provide_soft_skills</option>
                      <option>finacial_supports</option>
                      <option>partner_trainings</option>
                      <option>institute_reviews</option>
                      <option>incoperation_soft_skills</option>
                      <option>tvec_meetings</option>
                      <option>assesments</option>
                      <option>awareness</option>
                      <option>placement_individual</option>
                      <option>placements</option>
                    </select>
                  </div>
             </div>
             
             
             <div class="col-md-6">
                <div class="form-group">
                    <label for="company_type">Table Youths</label>
                    <select name="table_name_youth" id="table_name_youth" class="form-control">
                      <option value="">Select Option</option>
                      <option>cg_youths</option>
                      <option>course_supports_youth</option>
                      <option>finacial_supports_youths</option>
                      <option>partner_trainings_youth</option>
                      <option>placements_youths</option>
                      <option>provide_soft_skills_youths</option>
                    </select>
                  </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label for="company_type">Table Youths ID</label>
                    <select name="table_name_youth_id" id="table_name_youth_id" class="form-control">
                      <option value="">Select Option</option>
                      <option>career_guidances_id</option>
                      <option>course_support_id</option>
                      <option>finacial_support_id</option>
                      <option>partner_trainings_id</option>
                      <option>placements_id</option>
                      <option>provide_softskill_id</option>
                    </select>
                  </div>
             </div>
             <div class="col-md-6">    
                  <div class="form-group">
                    <label for="company_type">Branch</label>
                    <select name="branch_id" id="branch_id" class="form-control">
                      <option value="">Select Option</option>
                      @foreach($branches as $branch)
                      <option value="{{$branch->id}}">{{$branch->name}}</option>
                      @endforeach
                    </select>
                  </div>
            </div>
            </div>     
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
</div>


<!-- Model for edit employer -->

    <!-- Modal -->
    <div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Target Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
                  
              <form role="form" method="get" id="myForm1">
                  {{ csrf_field() }}
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="location">Type</label>  
                        <select name="year" id="year1" class="form-control">
                                <option value="">Select Option</option>
                                <option>Reports</option>
                                <option>Youths</option>
                            </select>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="location">Report</label>  
                        <select class="form-control" id="report1" name="report">
                               @foreach($activities_reports as $activities_report)
                                <option value="{{ $activities_report->report}}">{{ $activities_report->report }}</option>
                                @endforeach
                            </select>
                        
                    </div>
                </div>
                <div class="row">
                    
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Target</label>
                    <input type="integer" class="form-control" id="target1" name="target" placeholder="Enter Target">
                     <span class="help-block"><strong></strong></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="company_type">Table</label>
                    <select name="table_name" id="table_name1" class="form-control">
                      <option value="">Select Option</option>
                      <option>regional_meetings</option>
                      <option>mentoring</option>
                      <option>stake_holder_meetings</option>
                      <option>kickoffs</option>
                      <option>households</option>
                      <option>tot_cg</option>
                      <option>career_guidances</option>
                      <option>pes_units</option>
                      <option>pes_unit_supports</option>
                      <option>cg_trainings</option>
                      <option>course_supports</option>
                      <option>provide_soft_skills</option>
                      <option>finacial_supports</option>
                      <option>partner_trainings</option>
                      <option>institute_reviews</option>
                      <option>incoperation_soft_skills</option>
                      <option>tvec_meetings</option>
                      <option>assesments</option>
                      <option>awareness</option>
                      <option>placement_individual</option>
                      <option>placements</option>
                    </select>
                  </div>
                </div>
                
                <div class="col-md-6">
                <div class="form-group">
                    <label for="company_type">Table Youths</label>
                    <select name="table_name_youth" id="table_name_youth1" class="form-control">
                      <option value="">Select Option</option>
                      <option>cg_youths</option>
                      <option>course_supports_youth</option>
                      <option>finacial_supports_youths</option>
                      <option>partner_trainings_youth</option>
                      <option>placements_youths</option>
                      <option>provide_soft_skills_youths</option>
                    </select>
                  </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label for="company_type">Table Youths ID</label>
                    <select name="table_name_youth_id" id="table_name_youth_id1" class="form-control">
                      <option value="">Select Option</option>
                      <option>career_guidances_id</option>
                      <option>course_support_id</option>
                      <option>finacial_support_id</option>
                      <option>partner_trainings_id</option>
                      <option>placements_id</option>
                      <option>provide_softskill_id</option>
                    </select>
                  </div>
             </div>
             <div class="col-md-6">
                  <div class="form-group">
                    <label for="company_type">Branch</label>
                    <select name="branch_id" id="branch_id1" class="form-control">
                      <option value="">Select Option</option>
                      @foreach($branches as $branch)
                      <option value="{{$branch->id}}">{{$branch->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
          </div>
          <input type="hidden" name="c_id" id="c_id">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-primary">Update changes</button>
          </div>
      </form>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

$(document).ready(function(){
     $("#myForm").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/completion_targets-add',   
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
              toastr.success('Succesfully Added Traget Details ! ', 'Congratulations', {timeOut: 5000});
              $("#myForm")[0].reset();

            }
            else{
            $('#loading').hide();
               toastr.error('Please check!', 'Something Error !');  
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

  @if (session('error'))
  toastr.error('{{session('error')}}')
  @endif  

    new ClipboardJS('.copy');

$(document).on('click', '#edit-target', function(){
        var id = $(this).data('id');
        $('#year1').val($(this).data('year'));
        $('#report1').val($(this).data('report'));
        $('#target1').val($(this).data('target'));
        $('#table_name1').val($(this).data('table_name'));
        $('#table_name_youth1').val($(this).data('table_name_youth'));
        $('#table_name_youth_id1').val($(this).data('table_name_youth_id'));
        $('#branch_id1').val($(this).data('branch_id'));
        $('#c_id').val($(this).data('id'));

        $('#updateModel').modal('show');

        
    });

$(document).ready(function(){
     $("#myForm1").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/completion_targets-update',   
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
              toastr.success('Succesfully updated Traget Details ! ', 'Congratulations', {timeOut: 5000});
              $("#myForm")[0].reset();

            }
            else{
            $('#loading').hide();
               toastr.error('Please check!', 'Something Error !');  
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

<script src="{{ asset('js/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
  $(function () {
    // bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5({
      toolbar: { fa: true },
      size: 'default'
    })
  })
</script>
<style type="text/css" media="screen">
  #autocomplete, #institute, #course, #youths,#review_reports {
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
#autocomplete,  #institute, #course, #youths, #review_reports> li {
  padding: 3px 20px;
}
#autocomplete, #institute, #course, #youths, #review_reports > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
@endsection