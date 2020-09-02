 @extends('layouts.reports')
@section('content')
<div class="container">
    <br>
    <div class="row">
        
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">FInacial Assistance duplicates Youths <small class="badge badge-success"> {{count($youths)}}</small> <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">  
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Youth Name</th>
                                <th>Youth ID</th>
                                <th>Duplicates Count</th>
                                <th>Branch</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($youths as $youth)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $youth->name }} </td>
                                <td>{{ $youth->youth_id }} </td>
                                <td>{{ $youth->count }}</td>
                                <td>{{$youth->branch_name}}</td>  
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
       

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );


      
});
</script>
@endsection