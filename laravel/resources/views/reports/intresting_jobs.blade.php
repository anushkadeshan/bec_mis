@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Personal Reports</h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{Route('reports/index')}}">Reprots Selection</a></li>
              <li class="breadcrumb-item active">Personal Reports</li>
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
                                <label for="industry">Intrsting Industry</label>
                                <select id="industry" name="industry" class="form-control" >
                                  <option value="">All</option>
                                  <option>Agriculture &amp; Food Processing</option>
                                  <option>Automobiles</option>
                                  <option>Banking &amp; Financial Services</option>
                                  <option>BPO or KPO </option>
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
                              </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                              <label for="location">Intresting Location</label>
                              <select name="location" id="location" class="form-control">
                                <option value="">All</option>
                                <option>Home District</option>
                                <option>Home Province</option>
                                <option>Other City</option>
                                <option>Colombo</option>
                                <option>Industrial Zone</option>
                                <option>Abroad</option>   
                              </select>
                            </div>
                        </a>
                      </li>
                      @can('admin')
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Branch &nbsp;&nbsp;</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                              <option value="">All</option>
                              @foreach($branches as $branch)
                              <option value="{{$branch->id}}">{{$branch->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </a>
                      </li>
                      @endcan                  
                      </ul>
                    </div>
                  </div>
    </div>
    <div class="col-md-9">
      <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Youth Details <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example" class="table table-bordered table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contacts</th>
                        <th>Industries</th>
                        <th>Locations</th>
                        <th>Ind Json</th>
                        <th>Loc Json</th>
                        <th>Salary</th>
                        <th>branch</th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                @foreach($youths as $youth)
                  <tr>
                    <td>{{$youth->name}}</td>
                    <td>{{$youth->address}}</td>
                    <td>{{$youth->phone}}
                        <br>  
                        @if(!is_null($youth->email))({{$youth->email}}) @endif
                    </td>
                    <td>
                      <?php $industries = json_decode($youth->industry) ?>
                      @if(!empty($industries))
                      {{ implode(', ', $industries)}}
                      @endif
                      
                    </td>
                    <td>
                      <?php $locations = json_decode($youth->location) ?>
                      @if(!empty($locations))
                      {{ implode(', ', $locations)}}
                      @endif
                    </td>
                    <td>{{$youth->industry}}</td>
                    <td>{{$youth->location}}</td>
                    <td>{{$youth->min_salary}}</td>
                    <td>{{$youth->branch_id}}</td>
                    
                    <td><a href="{{ URL::to('youth/' . $youth->youth_id . '/view') }}">
                                    <button type="button" id="view-youth" data-id="{{$youth->youth_id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a></td>
                    
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
                "targets": [ 6 ],
                "visible": false
            },

            {
                "targets": [ 7 ],
                "visible": false,
            },

            {
                "targets": [ 8 ],
                "visible": false
            }
        ],

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],


    });

    

      $('#industry').on('change', function () {
          table.columns(5).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#location').on('change', function () {
          table.columns(6).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      // Event listener to the two range filtering inputs to redraw on input
    $('#min_salary').keyup( function() {
        table.draw();
        var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
    } );

    $('#branch_id').on('change', function () {
          table.columns(8).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );


} );
</script>
@endsection