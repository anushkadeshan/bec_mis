@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-10">
                      
            <h4>Financaly Supported  Youth but still No Job -Course Finished on  {{\Request::segment(3)}} <small class="badge badge-success"> {{$youths->count()}}</small></h4>
          </div>
          <div class="col-md-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Youth List  </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                
                    
                    <table id="example1" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Institute</th>
                            <th>Course End at</th>
                            <th></th>
                        </tr>
                        <tbody> 
                          <?php $count=1 ?>
                          @foreach($youths as $youth)
                          <tr>
                            <td>{{$count++}}</td>
                            <td>{{$youth->youth_name}}</td>
                            <td>{{$youth->youth_phone}}</td>
                            <td>{{$youth->course_name}}</td>
                            <td>{{$youth->institute_name}}</td>
                            <td>{{ date("Y-m-d",strtotime($youth->end_date))  }}</td>
                            <td><a href="{{ URL::to('youth/' . $youth->youth_id . '/view') }}" target="_blank">
                                    <button type="button" id="view-youth" data-id="{{$youth->youth_id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                        </a></td>
                          </tr>
                          @endforeach
                        </tbody>
                    </thead>        
                 </table>
          
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('js/printThis.js') }}" ></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

$(document).ready(function() {

var dataTable = $("#example2").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    });

}
@endsection