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
                            <div class="form-group">
                              <label for="company_type">Company Type</label>
                              <select id="company_type" name="company_type" class="form-control">
                                <option value="">Select Option</option>
                                <option>Sole Trader</option>
                                <option>Partnerships</option>
                                <option>Private Company</option>
                                <option>Public Company</option>
                                <option>Non-Profit Organization</option>
                                <option>Trust</option>
                              </select>
                               <span class="help-block"><strong></strong></span>
                            </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <label for="industry">Industry</label>
                              <select id="industry" name="industry" class="form-control">
                                <option value="">Select Option  </option>
                                <option>Agriculture &amp; Food Processing</option>
                                <option>Automobiles</option>
                                <option>Banking &amp; Financial Services</option>
                                <option>BPO / KPO</option>
                                <option>Civil &amp; Construction</option>
                                <option>Consumer Goods &amp; Durables</option>
                                <option>Consulting</option>
                                <option>Education</option>
                                <option>Engineering</option>
                                <option>Ecommerce &amp; Internet</option>
                                <option>Events &amp; Entertainment</option>
                                <option>Export &amp; Import</option>
                                <option>Government &amp; Public Sector</option>
                                <option>Healthcare</option>
                                <option>Hotel, Travel &amp; Leisure</option>
                                <option>Insurance</option>
                                <option>IT &amp; Telecom</option>
                                <option>Logistics &amp; Transportation</option>
                                <option>Manufacturing</option>
                                <option>Manpower &amp; Security</option>
                                <option>News &amp; Media</option>
                                <option>NGO &amp; Non profit</option>
                                <option>Pharmaceutical</option>
                                <option>Real Estate</option>
                                <option>Wholesale &amp; Retail</option>
                                <option>Others</option>
                              </select>
                               <span class="help-block"><strong></strong></span>
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
                  <h3 class="card-title">Employer Details</h3>
                </div>
                <div class="card-body">
                   <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Employer Name</th>
                        <th>Address</th>
                        <th>Contacts</th>
                        <th>Email</th>
                        <th>Company Type</th>
                        <th>Industry</th>
                    </tr>
                </thead> 
                <tbody>
                @foreach($employers as $employer)
                  <tr>
                    <td>{{$employer->name}}</td>
                    <td>{{$employer->address}}</td>
                    <td>{{$employer->phone}}</td>
                    <td>{{$employer->email}}</td>
                    <td>{{$employer->company_type}}</td>
                    <td>{{$employer->industry}}</td>                                                          
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
                "targets": [ 1 ],
                "visible": true,
            },
            {
                "targets": [ 2 ],
                "visible": true
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

      $('#company_type').on('change', function () {
          table.columns(4).search( this.value ).draw();
      } );
      $('#industry').on('change', function () {
          table.columns(5).search( this.value ).draw();
      } );

});
</script>
@endsection