@extends('layouts.reports')
@section('title','Courses |')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Training Institutes Reports</h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              @can('view-reports')<li class="breadcrumb-item"><a href="{{Route('reports/index')}}">Reprots Selection</a></li>@endcan
              <li class="breadcrumb-item active">Courses</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <div class="card card-warning card-outline">
                    <div class="card-header">
                      <h3 class="card-title">Filters</h3>
                    </div>
                    <div class="card-body">
                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #5E6971; color: white;">
                        
                        <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                  <label for="bank_account">Institute</label>
                                  <select name="institute" id="ins" class="form-control">
                                    <option value="">All</option>
                                    @foreach($institutes as $institute) 
                                    <option>{{$institute->name}}</option>
                                    @endforeach                               
                                  </select>
                                </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                  <label for="smart_phone"> Duration Months</label>
                                    <input type="text" name="duration" id="duration" class="form-control">
                                </div>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <label for="contact_person">Course Type</label>
                              <select name="course_type" id="course_type" class="form-control">
                                <option value="">Select Option</option>
                                <option value="Vocational Training">Vocational Training</option>
                                <option value="Proffessional Training">Proffessional Training</option>
                                <option value="Soft Skills">Soft Skills</option>
                              </select>
                              </div>
                        </a>
                      </li>  
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                  <label for="bank_account">Standards</label>
                                  <select name="standard" id="standard" class="form-control">
                                    <option value="">All</option>
                                    @foreach($standards as $standard) 
                                    <option>{{$standard->standard}}</option>
                                    @endforeach                               
                                  </select>
                                </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                <label for="course_time">Full/ Part Time</label>
                                <select name="course_time" id="course_time" class="form-control">
                                  <option value="">All</option>
                                  <option>Full Time</option>
                                  <option>Part Time</option>
                                  <option>Both</option>
                                </select>
                            </div> 
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <label for="medium">Medium</label>
                              <select class="form-control" name="medium[]" id="medium" multiple>
                                <option>Sinhala</option>
                                <option>English</option>
                                <option>Tamil</option>
                              </select>
                             </div>
                        </a>
                      </li>                 
                      </ul>
                    </div>
                  </div>
    </div>
    <div class="col-md-9">
      <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Courses Details <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example" class="table row-border table-hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Duration (Months)</th>
                        <th>Course Fee</th>
                        <th>Type</th>
                        <th>Standard</th>
                        <th>Time</th>
                        <th>Medium</th>
                        <th>Institutes</th>
                        <th>Institutes json</th>
                    </tr>
                </thead> 
                <tbody>
            @foreach($courses as $course)
                  <tr>
                    <td>{{$course->name}}</td>
                    <td>{{$course->duration}}</td>
                    <td>{{$course->course_fee}}</td>
                    <td>{{$course->course_type}}</td>
                    <td>{{$course->standard}}</td>
                    <td>{{$course->course_time}}</td>
                    <td>{{$course->medium}}</td>                    
                    <td>
                      @foreach($course->institutes as $institute)
                      <a href="{{ URL::to('institute/' . $institute->id . '/view') }}" title="">{{ $institute->name}} </a><br> 
                      @endforeach
                    </td>
                      <td>
                      @foreach($course->institutes as $institute)
                      {{ json_encode($institute->name)}}
                      @endforeach
                    </td>                  
                  </tr>
                  @endforeach 
                </tbody>
            </table>      
                </div>
            </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script >

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
});

/* Custom filtering function which will search data in column four between two values */


$(document).ready(function() {
   var table = $('#example').DataTable( {
        "columnDefs": [
            {
                "targets": [ 6 ],
                "visible": false,
            },
            {
                "targets": [ 8 ],
                "visible": false
            },

            {
                "targets": [ 5 ],
                "visible": false
            }
        ],
        @can('view-reports')
        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        @endcan
    } );

      $('#ins').on('change', function () {
          table.columns(8).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' courses filtered out of  ' +info.recordsTotal);
      } );

      $('#duration').on('keyup', function () {
          table.columns(1).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' courses filtered out of  ' +info.recordsTotal);
      } );
      $('#course_type').on('change', function () {
          table.columns(3).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' courses filtered out of  ' +info.recordsTotal);
      } );

      $('#standard').on('change', function () {
          table.columns(4).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' courses filtered out of  ' +info.recordsTotal);
      } );

      $('#course_time').on('change', function () {
          table.columns(5).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' courses filtered out of  ' +info.recordsTotal);
      } );

      $('#medium').on('change', function () {
          table.columns(6).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' courses filtered out of  ' +info.recordsTotal);
      } );
});
</script>
@endsection