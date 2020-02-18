 @extends('layouts.main')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Youth Information in Soft SKills Training <small class="badge badge-success"> {{count($youths)}}</small></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Directed Date</th>
                        <th>Institute</th>
                        <th>Course Start</th>
                        <th>Course End</th>
                        <th>Branch</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no=1 ?>
                    @foreach ($youths as $youth)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $youth->youth_name }}</td>
                        <td>{{ $youth->meeting_date }}</td>
                        <td>{{ $youth->institute_name }}</td>
                        <td>{{ $youth->start_date }}</td>
                        <td>{{ $youth->end_date }}</td>
                        <td>{{ $youth->ext }}</td>
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
@endsection