@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Employer Reports</h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{Route('reports/index')}}">Reprots Selection</a></li>
              <li class="breadcrumb-item active">Employer Reports</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
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
                            <div class="form-group" >
                            <label for="business_function">Business Function</label>
                            <select class="form-control" id="business_function" name="business_function">
                                <option value="">All</option>
                                <option>Administration</option>
                                <option>Accounting &amp; Finance</option>
                                <option>Customer Support</option>
                                <option>Data Entry &amp; Analysis</option>
                                <option>Creative, Design &amp; Architecture</option>
                                <option>Education &amp; Training</option>
                                <option>Hospitality</option>
                                <option>Human Resources</option>
                                <option>IT &amp; Telecom</option>
                                <option>Legal</option>
                                <option>Logistics</option>
                                <option>Management</option>
                                <option>Manufacturing</option>
                                <option>Marketing &amp; PR</option>
                                <option>Operations</option>
                                <option>Quality Assurance</option>
                                <option>Research &amp; Technical</option>
                                <option>Sales &amp; Distribution</option>
                                <option>Security</option>
                                <option>Others</option>
                            </select>
                        </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                <label for="location">Location</label>  
                                <input class="form-control" type="text" id="location" name="location" placeholder="Enter Location">
                            </div> 
                        </a>
                      </li> 

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group"> 
                                <label for="specializaion">Educational Specialization</label>
                                    <select name="specializaion" id="specializaion" class="form-control">
                                        <option value="">All</option>
                                        <option>Art &amp; Humanities</option>
                                        <option>Business &amp; Management</option>
                                        <option>Accounting</option>
                                        <option>Design &amp; Fashion</option>
                                        <option>Engineering</option>
                                        <option>Events &amp; Hospitality</option>
                                        <option>Finance &amp; Commerce</option>
                                        <option>Human Resources</option>
                                        <option>Information Technology</option>
                                        <option>Law</option>
                                        <option>Marketing &amp; Sales</option>
                                        <option>Media &amp; Journalism</option>
                                        <option>Medicine</option>
                                        <option>Sciences</option>
                                        <option>Vocational &amp; Technical</option>
                                        <option>Others</option>
                                    </select>
                            </div>
                        </a>
                      </li>   

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                                <label for="job_type">Job Type</label>
                                <select id="job_type" name="job_type" class="form-control">
                                    <option value="">All</option>
                                    <option>Full Time</option>
                                    <option>Part Time</option>
                                    <option>Contractual</option>
                                    <option>Internship</option>
                                    <option>Temporary</option>
                                    <option>Work from Home</option>                                 
                                </select>
                            </div>
                        </a>
                      </li>  

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <label for="min_qualification">Minimum qualification</label>
                                  <select name="min_qualification" id="min_qualification" class="form-control">
                                    <option value="">All</option>
                                    <option>Ordinary Level</option>
                                    <option>Advanced Level</option>
                                    <option>Certificate</option>
                                    <option>Diploma</option>
                                    <option>Higher Diploma</option>
                                    <option>Degree</option>
                                    <option>Masters</option>
                                    <option>Doctorate</option>
                                    <option>Skilled Apprentice</option>
                                  </select>
                            </div>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <label for="employer">Employer</label>
                                  <select name="employer" id="employer" class="form-control">
                                    <option value="">All</option>
                                    @foreach($employers as $employer)
                                    <option value="{{$employer->name}}">{{$employer->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </a>
                      </li>         
                      </ul>
                    </div>
                  </div>
    </div>
    <div class="col-md-9">
      <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Vacancy Details <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example" class="table table-bordered table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Job Type</th>
                        <th>Business Function</th>
                        <th>Location</th>
                        <th>Min Qualfi.</th>
                        <th>Specializaion</th>
                        <th>Employer</th>
                    </tr>
                </thead> 
                <tbody>
                @foreach($vacancies as $vacancies)
                  <tr>
                    <td>{{$vacancies->title}}</td>
                    <td>{{$vacancies->description}}</td>
                    <td>{{$vacancies->job_type}}</td>
                    <td>{{$vacancies->business_function}}</td>
                    <td>{{$vacancies->location}}</td>
                    <td>{{$vacancies->min_qualification}}</td>                                                          
                    <td>{{$vacancies->specializaion}}</td>                                                          
                    <td>{{$vacancies->employer->name}}</td>                                                          
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
        "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false,
            },
            {
                "targets": [ 7 ],
                "visible": false
            },

            {
                "targets": [ 3 ],
                "visible": true
            }
        ],

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

      $('#business_function').on('change', function () {
          table.columns(3).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' vacancies filtered out of  ' +info.recordsTotal);
      } );
      $('#location').on('keyup', function () {
          table.columns(4).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' vacancies filtered out of  ' +info.recordsTotal);
      } );

      $('#specializaion').on('change', function () {
          table.columns(6).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' vacancies filtered out of  ' +info.recordsTotal);
      } );
      $('#job_type').on('change', function () {
          table.columns(2).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' vacancies filtered out of  ' +info.recordsTotal);
      } );

      $('#min_qualification').on('change', function () {
          table.columns(5).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' vacancies filtered out of  ' +info.recordsTotal);
      } );
      $('#employer').on('change', function () {
          table.columns(7).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' vacancies filtered out of  ' +info.recordsTotal);
      } );

});
</script>
@endsection