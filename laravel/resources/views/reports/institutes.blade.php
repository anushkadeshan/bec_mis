@extends('layouts.reports')
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
            @can('view-reports') <li class="breadcrumb-item"><a href="{{Route('reports/index')}}">Reprots Selection</a></li> @endcan
              <li class="breadcrumb-item active">Training Institutes</li>
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
                                  <label for="bank_account">Courses</label>
                                  <select name="course" id="course" class="form-control">
                                    <option value="">All</option>
                                    @foreach($courses as $course) 
                                    <option>{{$course->name}}</option>
                                    @endforeach                               
                                  </select>
                                </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                  <label for="smart_phone">Location</label>
                                    <input type="text" name="location" id="location" class="form-control">
                                </div>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                  <label for="training">TVEC Registered ?</label>
                                  <select name="tvec" id="tvec" class="form-control">
                                    <option value="">All</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    
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
                  <h3 class="card-title">Training Institutes Details <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example" class="table row-border table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Contact Person</th>
                        <th>Contacts</th>
                        <th>TVEC Registered</th>
                        <th>Reg No.</th>
                        <th>Courses</th>
                    </tr>
                </thead> 
                <tbody>
              @foreach($institutes as $institute)
                  <tr>
                    <td>{{$institute->name}}</td>
                    <td>{{$institute->location}}</td>
                    <td>{{$institute->address}}</td>
                    <td>{{$institute->contact_person}}</td>
                    <td>{{$institute->phone}}
                        <br>  
                        @if(!is_null($institute->email))({{$institute->email}}) @endif
                    </td>
                    <td>{{$institute->is_registerd}}</td>
                    <td>{{$institute->reg_no}}</td>                    
                    <td>
                      @foreach($institute->courses as $courses)
                      {{ json_encode($courses->name)}}
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
                "targets": [ 7 ],
                "visible": false,
            },
            {
                "targets": [ 2 ],
                "visible": true
            },

            {
                "targets": [ 3 ],
                "visible": true
            }
        ],
        @can('view-reports')
        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],

        @endcan
    } );


      $('#course').on('change', function () {
          table.columns(7).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' institutes filtered out of  ' +info.recordsTotal);
      } );

      $('#location').on('keyup', function () {
          table.columns(1).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' institutes filtered out of  ' +info.recordsTotal);
      } );
      $('#tvec').on('change', function () {
          table.columns(5).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' institutes filtered out of  ' +info.recordsTotal);
      } );

});
</script>
@endsection