@extends('layouts.main')
@section('title','Baselines |')
@section('content')

<div class="container-fluid">
  <hr>  
  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">Baseline Applications to be added ( from 2018 to 2019 ) <span  class="badge badge-success float-right" id="row_count"></span></h3>
    </div>
    <div class="card-body">
   <table id="example2" class="table row-border table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Branch</th>
                        <th class="sum">Baselines to be entered</th>
                        <th class="sum">Baselines entered</th>
                        <th class="sum">Balance</th>
                        <th class="sum">Today Added</th>
                        <th class="sum">This Week Added</th>
                        <th class="sum">Last Week Added</th>
                        
                        <th>Status</th> 

                    </tr>
                </thead> 
                <tbody>
                    <?php  
                        $no=1;
                        $previous_week = strtotime("-1 week +1 day");
                        $start_week = strtotime("last sunday midnight",$previous_week);
                        $end_week = strtotime("next saturday",$start_week);
                        $start_week = date("Y-m-d",$start_week);
                        $end_week = date("Y-m-d",$end_week);
                     ?>
                    @foreach ($cg_youths as $cg_youth)
                    <?php $count = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->count(); ?>
                        <td>{{ $no++ }}</td>
                        <th>{{ $cg_youth->name }}</th>
                        <td>{{ $cg_youth->target }}</td>
                        <td> {{ $count }}</td>
                        <td>{{ $cg_youth->target - $count}}</td>
                        <td><?php $count2 = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->whereDate('created_at', '=', date('Y-m-d'))->count(); ?> {{ $count2 }}</td>
                        <td><?php $count3 = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count(); ?> {{ $count3 }}</td>
                        <td><?php $count4 = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->whereBetween('created_at', [$start_week, $end_week])->count(); ?> {{ $count4 }}</td>
                        
                        
                        <td>
                            @if($count< $cg_youth->target) <small class="badge badge-danger">{{"Not Completed"}}</small> @else <small class="badge badge-success">{{"Completed"}}</small> @endif
                        </td>
                    </tr>
                    @endforeach
                <tbody> 
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>       
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

   table2.columns( '.sum' ).every( function () {
    var column = this;

            var sum = column
                .data()
                .reduce(function (a, b) { 
                   a = parseInt(a, 10);
                   if(isNaN(a)){ a = 0; }                   

                   b = parseInt(b, 10);
                   if(isNaN(b)){ b = 0; }

                   return a + b;
                });
 
    $( this.footer() ).html( sum );
} );

});
</script>
@endsection

