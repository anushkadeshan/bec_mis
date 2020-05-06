@extends('layouts.main')
@section('content')
@cannot('management')
@cannot('me-dashboard')
<div class="container-fluid">
    <br>    
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/education')}}">
            <div class="info-box bg-info-gradient">
              <span class="info-box-icon"><i class="fas fa-graduation-cap"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Education</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div> 
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/career-guidance')}}">
            <div class="info-box bg-success-gradient">
              <span class="info-box-icon"><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Career Guidance</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/skill-development')}}">
            <div class="info-box bg-warning-gradient">
              <span class="info-box-icon"><i class="fa fa-award"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-white">Skill Development</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="{{url('/job-linking')}}">
            <div class="info-box bg-danger-gradient">
              <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Job Linking</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->
</div>
@endcan
@endcan
<hr>
<div class="container-fluid">
@cannot('branch')
  <div  class="row" style="background-color: #5E6971; color: white;">
    <div class="col-md-4"> 
    <br>     
      <div class="form-group">
        <select name="branch_id" id="branch_id" class="form-control">
          <option value="">Select Branch</option>
          @foreach($branches as $branch)
          <option value="{{$branch->name}}">{{$branch->name}}</option>
          @endforeach
        </select> 
      </div>
    </div>
    <div class="col-md-4"> 
    <br>     
      <div class="form-group">
        <select name="status" id="status" class="form-control">
          <option value="">Select Status</option>
          <option value="Completed">Completed</option>
          <option value="Not Completed">Not Completed</option>
        </select> 
      </div>
    </div>
  </div>
  <br> 
@endcan
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Completion Reports to be added ( from 2018 to 2020 ) <span  class="badge badge-success float-right" id="row_count"></span></h3>
    </div>
    <div class="card-body">
   <table id="example2" class="table row-border table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        @cannot('branch')<th>Branch</th> @endcan
                        <th>Report</th>
                        <th>Reports to be entered</th>
                        <th>Reports entered</th>
                        <th>Today Added</th>
                        
                        <th>Status</th>

                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($reports as $report)
                    <tr class="employer{{$report->id}}">
                        <td>{{ $no++ }}</td>
                        @cannot('branch')<th>{{ $report->name }}</th> @endcan
                        <td>{{ $report->report }}</td>
                        <td>{{ $report->target }}</td>
                        <td><?php $count = DB::table($report->table_name)->where('branch_id',$report->branch_id)->count(); ?> {{ $count }}</td>
                        <td><?php $count2 = DB::table($report->table_name)->where('branch_id',$report->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereDate($report->table_name.'.created_at', '=', date('Y-m-d'))->count(); ?> {{ $count2 }}</td>
                        
                        
                        <td>
                            @if($count< $report->target) <small class="badge badge-danger">{{"Not Completed"}}</small> @else <small class="badge badge-success">{{"Completed"}}</small> @endif
                        </td>
                    </tr>
                    @endforeach
                <tbody>        
            </table> 
          </div>
        </div>
    <hr>
  <div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Youths to be added from Completion Reports( from 2018 to 2020 ) <span  class="badge badge-success float-right" id="row_count1"></span></h3>
     </div>
    <div class="card-body"> 
   <table id="example3" class="table row-border table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                         @cannot('branch')<th>Branch</th> @endcan
                        <th>Report</th>
                        <th>Youths to be entered</th>
                        <th>Youths Added</th>
                        <th>Today Added</th>
                        <th>This Week Added</th>
                        <th>Last Week Added</th>
                        <th>Status</th>

                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>

                    <?php  
                        $no=1;
                        $previous_week = strtotime("-1 week +1 day");
                        $start_week = strtotime("last sunday midnight",$previous_week);
                        $end_week = strtotime("next saturday",$start_week);
                        $start_week = date("Y-m-d",$start_week);
                        $end_week = date("Y-m-d",$end_week);
                     ?>
                    @foreach ($youths as $youth)
                     <tr class="employer{{$youth->id}}">
                        <td>{{ $no++ }}</td>
                        @cannot('branch')<th>{{ $youth->name }}</th> @endcan
                        <td>{{ $youth->report }}</td>
                        <td>{{ $youth->target }}</td>
                        
                        <td>

                          <?php $count2 = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->count(); 

                          $individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->count()?> 

                          @if($youth->report=='Job Interviews/Placements') {{ $count2 + $individual }} @else{{$count2}}@endif

                        </td>

                        <td>
                          @if($youth->report=='Job Interviews/Placements')
                            <?php $count = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereDate($youth->table_name_youth.'.created_at', '=', date('Y-m-d'))->count(); 

                            $today_individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->whereDate('created_at', '=', date('Y-m-d'))->count();
                            ?> 
                          {{ $count + $today_individual }}</td>
                          @else
                            <?php $count = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereDate($youth->table_name_youth.'.created_at', '=', date('Y-m-d'))->count(); ?> {{ $count }}</td>
                          @endif
                          
                        <td>

                          @if($youth->report=='Job Interviews/Placements')
                            <?php $count_thisweek = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count();

                            $this_individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count();
                             ?> 
                             {{ $count_thisweek + $this_individual }}
                          @else
                            <?php $count_thisweek = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count(); ?> {{ $count_thisweek }}
                          @endif
                          

                        </td>

                        <td>
                          @if($youth->report=='Job Interviews/Placements')
                            <?php $count_last_week = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [$start_week, $end_week])->count();

                            $lastWeek_individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->whereBetween('created_at', [$start_week, $end_week])->count();

                             ?> 

                            {{ $count_last_week + $lastWeek_individual }}
                          @else
                            <?php $count_last_week = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [$start_week, $end_week])->count(); ?> 

                            {{ $count_last_week }}
                          @endif
                          


                        </td>
                        

                        
                        
                        <td>
                          @if($youth->report=='Job Interviews/Placements')
                                      @if($youth->target ==$count2 + $individual ) <small class="badge badge-success">{{"Completed"}}</small> @elseif( $youth->target <= $count2 + $individual) <small class="badge badge-success">{{"Completed"}}</small> @else <small class="badge badge-danger">{{"Not Completed"}}</small> @endif
                         @else
                                     @if($youth->target ==$count2 ) <small class="badge badge-success">{{"Completed"}}</small> @elseif( $youth->target <= $count2) <small class="badge badge-success">{{"Completed"}}</small> @else <small class="badge badge-danger">{{"Not Completed"}}</small> @endif
                                @endif
                          
                            

                        </td>
                    </tr>
                    @endforeach
                <tbody>        
            </table>
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

   var table3 = $('#example3').DataTable( {

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

   $('#branch_id').on('change', function () {
          table2.columns(1).search( this.value ).draw();
          table3.columns(1).search( this.value ).draw();
          var info2 = $('#example2').DataTable().page.info();
          var info3 = $('#example3').DataTable().page.info();
          $('#row_count').text(info2.recordsDisplay+ ' rows filtered out of  ' +info2.recordsTotal);
          $('#row_count1').text(info3.recordsDisplay+ ' rows filtered out of  ' +info3.recordsTotal);
      } );

   $('#status').on('change', function () {
          const regExSearch = '^' + this.value + '$';
          table2.columns(6).search(regExSearch, true, false).draw();
          table3.columns(8).search(regExSearch, true, false).draw();
          var info2 = $('#example2').DataTable().page.info();
          var info3 = $('#example3').DataTable().page.info();
          $('#row_count').text(info2.recordsDisplay+ ' rows filtered out of  ' +info2.recordsTotal);
          $('#row_count1').text(info3.recordsDisplay+ ' rows filtered out of  ' +info3.recordsTotal);
      } );

});
</script>
@endsection

