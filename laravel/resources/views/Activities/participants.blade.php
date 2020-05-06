@extends('layouts.main')
@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>Stake Holders <small class="badge badge-success">{{$participants->count()}}  </small></h3>
		</div>
		<div class="card-body">
			<table id="example1" class="table row-border table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>DS</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Institute</th>
                        <th>Phone</th>
                    </tr>
                    <tbody>
                    <?php $no=1; ?>
                    @foreach($participants as $participant)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$participant->name}}</td>
                        <td>{{$participant->DSD_Name}}</td>
                        <td>{{$participant->gender}}</td>
                        <td>{{$participant->designation}}</td>
                        <td>{{$participant->institute}}</td>
                        <td>{{$participant->phone}}</td>
                    </tr> 
                    @endforeach
                    </tbody>
                </thead>        
            </table>
</div>
	</div>
</div>
@endsection