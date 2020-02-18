@extends('layouts.main')
@section('content')
<div class="container-fluid">

</div>
<div class="container-fluid">
  <div class="row">
  
    <div class="col-md-12">
      <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Resource People<span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Proffession</th>
                        <th>Institute</th>
                        <th>CV</th>
                    </tr>
                </thead> 
                <tbody>
                @foreach($resources as $resource)
                  <tr>
                    <td>{{$resource->name}}</td>
                    <td>{{$resource->profession}}</td>
                    <td>{{$resource->institute}}</td>
                    <td><a href="{{ url('download/cv') }}/{{$resource->cv}}"><button type="button" class="btn btn-primary btn-flat btn-sm"><i class="fas fa-file-download"> &nbsp; Download</i></button></a></td>               
                    
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
<style>
  
</style>
@endsection