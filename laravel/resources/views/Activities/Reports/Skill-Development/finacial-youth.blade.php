@extends('layouts.reports')
@section('title','Finacially Assisted Youths |')
@section('content')
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
                              <label for="bank_account"> Course ? </label>
                              <select name="bank_account" id="bank_account" class="form-control">
                                <option value="">All</option>
                                @foreach($courses as $course)
                                <option>{{$course->course_name}}</option>
                                @endforeach
                                
                              </select>
                            </div>
                    </a>
                  </li> 
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="bank_account"> Institute ? </label>
                              <select name="bank_account" id="bank_account1" class="form-control">
                                <option value="">All</option>
                                @foreach($institutes as $institute)
                                <option>{{$institute->institute_name}}</option>
                                @endforeach
                                
                              </select>
                            </div>
                    </a>
                  </li> 
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="smart_phone">Course Status ?</label>
                              <select name="smart_phone" id="smart_phone" class="form-control">
                                <option value="">All</option>
                                <option>Finished</option>
                                <option>Ongoing</option>
                                <option>Dropout</option>
                                
                              </select>
                            </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="training">Job Placement ?</label>
                              <select name="training" id="training" class="form-control">
                                <option value="">All</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                                
                              </select>
                        </div> 
                    </a>
                  </li>  
                  @cannot('branch')
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                        <label for="disability">Branch &nbsp;&nbsp;</label>
                        <select name="branch_id" id="branch_id" class="form-control">
                          <option value="">All</option>
                          @foreach($branches as $branch)
                          <option value="{{$branch->ext}}">{{$branch->name}}</option>
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
            <div class="card">
        <div class="card-header">
            <h3 class="card-title">Youth Information whom Financially supported <small class="badge badge-success"> {{count($youths)}}</small><span  class="badge badge-success float-right" id="row_count"></span></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Institute</th>
                        <th>Course</th>
                        <th>Type</th>
                        <th>Course Start</th>
                        <th>Course End</th>
                        <th>Course Status</th>
                        <th>Job Link</th>
                        @cannot('branch')<th>Branch</th>@endcan
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no=1 ?>
                    @foreach ($youths as $youth)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $youth->youth_name }}</td>
                        <td>{{ $youth->institute_name }}</td>
                        <td>{{ $youth->course_name }}</td>
                        <td>{{ $youth->course_type }}</td>
                        <td>{{ $youth->start_date }}</td>
                        <td>{{ $youth->end_date }}</td>
                        <td>
                            @switch($youth->dropout)
                                @case(1)
                                    <small class="badge badge-danger">{{"Dropout"}}</small>
                                @break
                                @case(0)
                                    @if($youth->end_date < date("Y-m-d"))
                                        <small class="badge badge-warning">{{"Finished"}}</small>
                                    @else
                                        <small class="badge badge-success">{{"Ongoing"}}</small>
                                    @endif
                                @break
                                @default
                                        
                            @endswitch
                            
                        </td>
                        <td align="center">
                            <?php 
                                $placement = DB::table('placements_youths')->where('youth_id',$youth->youth_id)->first();
                                $ind = DB::table('placement_individual')->where('youth_id',$youth->youth_id)->first();
                            ?>

                            @if(!is_null($placement)||!is_null($ind))<span class="text-center text-success"><i class="fas fa-check-circle"><span style="display: none">1</span></i></span> @else <span class="text-center text-danger"><i class="fas fa-times-circle"><span style="display: none">0</span></i></span> @endif
                        </td>
                        @cannot('branch')<td>{{ $youth->ext }}</td>@endcan
                        <td><a href="{{ URL::to('youth/' . $youth->youth_id . '/view') }}" target="_blank">
                                    <button type="button" id="view-youth" data-id="{{$youth->youth_id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                        </a></td>
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>
    </div>    
        </div>

        
    </div>
      
 
</div>
@endsection
@section('scripts')
<script type="">
  $(document).ready(function() {
   var table2 = $('#example2').DataTable( {
        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );
    $('#bank_account').on('change', function () {
          table2.columns(3).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
    $('#bank_account1').on('change', function () {
          table2.columns(2).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
    $('#smart_phone').on('change', function () {
          table2.columns(7).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#training').on('change', function () {
          table2.columns(8).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#branch_id').on('change', function () {
          table2.columns(9).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
});
</script>
@endsection