@extends('layouts.main')
@section('title','Family PCI |')
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
                        <th>Youth ID</th>
                        <th>Youth Name</th>
                        <th>Family Name</th>
                        <th>PCI</th>
                        <th>Branch</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($data as $family)
                      @if($family->total_members!=0)
                      @if($family->total_income/$family->total_members>=10000)
                       <tr>
                       	<td>{{$family->youth_id}}</td>
                       	<td>{{$family->youth_name}}</td>
                       	<td>{{$family->head_of_household}}</td>
                       	<td>{{number_format((float)$family->total_income/$family->total_members, 2, '.', '')}}</td>
                       	<td>{{$family->ext}}</td>
                       </tr> 	
                       @endif
                       @endif
                    @endforeach
                <tbody>        
            </table>      
            
        </div>

    </div>
</div>
</div>
@endsection