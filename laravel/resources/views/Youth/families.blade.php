@extends('layouts.main')
@section('title','Families |')
@section('content')
<div class="container-fluid">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-4">
        			<h3 class="card-title">Family Details</h3> 
        		</div>
        		<div class="col-md-6">
        			
        		</div> 
                
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Youth ID</th>
                        <th>Youth Name</th>
                        <th>Family Name</th>
                        <th>DSD Name</th>
                        <th>GND Name</th>
                        <th>Branch</th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($data as $family)
                      
                       <tr>
                        <td>{{$no++}}</td>
                       	<td>{{$family->youth_id}}</td>
                       	<td>{{$family->youth_name}}</td>
                       	<td>{{$family->head_of_household}}</td>
                        <td>{{$family->DSD_Name}}</td>
                        <td>{{$family->GN_Office}}</td>
                        <td>{{$family->ext}}</td>
                       	<td><a href="{{url('youth/' . $family->youth_id . '/edit')}}"><button type="button" class="btn btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button></a></td>
                       </tr> 	
                    @endforeach
                <tbody>        
            </table>      
            
        </div>

    </div>
</div>
</div>
@endsection