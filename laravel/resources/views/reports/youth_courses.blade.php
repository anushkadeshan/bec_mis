@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Personal Reports</h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{Route('reports/index')}}">Reprots Selection</a></li>
              <li class="breadcrumb-item active">Personal Reports</li>
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
                                  <label for="course">Course</label>
                                  <select name="course" id="course" class="form-control">
                                    <option value="">All</option>
                                    @foreach($courses as $course)
                                    <option value="{{$course->name}}">{{$course->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                  <label for="smart_phone">Status</label>
                                  <select name="status" id="status" class="form-control">
                                    <option value="">All</option>
                                    <option>Following</option>
                                    <option>OJT</option>
                                    <option>Followed</option>
                                    <option>Drop Out</option>
                                    
                                  </select>
                                </div>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                  <label for="training">Provided by</label>
                                  <select name="berendina" id="berendina" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Berendina</option>
                                    <option value="0">Other</option>
                                    
                                  </select>
                            </div> 
                        </a>
                      </li> 
                      @can('admin')
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Branch &nbsp;&nbsp;</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                              <option value="">All</option>
                              @foreach($branches as $branch)
                              <option value="{{$branch->id}}">{{$branch->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </a>
                      </li>
                      @endcan                  
                      </ul>
                    </div>
                  </div>
    </div>
    <div class="col-md-9">
      <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Youth Details <span class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example" class="table table-bordered table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contacts</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Provided by</th>
                        <th>Completed at</th>
                        <th>Branch</th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                @foreach($youths as $youth)
                  <tr>
                    <td>{{$youth->youth_name}}</td>
                    <td>{{$youth->address}}</td>
                    <td>{{$youth->phone}}
                        <br>  
                        @if(!is_null($youth->email))({{$youth->email}}) @endif
                    </td>
                    <td>{{$youth->course_name}}</td>
                    <td>{{$youth->status}}</td>
                    <td>{{$youth->provided_by_bec}}</td>                    
                    <td>{{$youth->completed_at}}</td>                    
                    <td>{{$youth->branch_id}}</td>                    
                    <td><a href="{{ URL::to('youth/' . $youth->youth_id . '/view') }}">
                                    <button type="button" id="view-youth" data-id="{{$youth->youth_id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a></td>
                    
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
                "targets": [ 5 ],
                "visible": false,
            },
            {
                "targets": [ 7 ],
                "visible": false
            },

            {
                "targets": [ 3 ],
                "visible": true
            }
        ],

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );


      $('#course').on('change', function () {
          table.columns(3).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#status').on('change', function () {
          table.columns(4).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#berendina').on('change', function () {
          table.columns(5).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#branch_id').on('change', function () {
          table.columns(7).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

});
</script>
@endsection