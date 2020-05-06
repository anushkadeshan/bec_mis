@extends('layouts.reports')
@section('title','Youth Placed in Jobs |')
@section('content')
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
                              <label for="bank_account"> Employer ? </label>
                              <select name="bank_account" id="bank_account" class="form-control">
                                <option value="">All</option>
                                @foreach($employers as $employer)
                                <option>{{$employer->name}}</option>
                                @endforeach
                                
                              </select>
                            </div>
                    </a>
                  </li> 
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="company_type">Company Type</label>
                              <select id="company_type" name="company_type" class="form-control">
                                <option value="">All</option>
                                <option>Sole Trader</option>
                                <option>Partnerships</option>
                                <option>Private Company</option>
                                <option>Public Company</option>
                                <option>Non-Profit Organization</option>
                                <option>Trust</option>
                              </select>
                            </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="industry">Industry</label>
                    <select id="industry" name="industry" class="form-control">
                      <option value="">All  </option>
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
                        </div> 
                    </a>
                  </li>  
                  @cannot('branch')
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                        <label for="disability">Branch &nbsp;&nbsp;</label>
                        <select name="branch_id" id="branch_id" class="form-control">
                          <option value="">All</option>
                          @foreach($branches as $branch)
                          <option value="{{$branch->name}}">{{$branch->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </a>
                  </li>

                 
                  </li>
                  @endcan                 
                  </ul>
                </div>
              </div>	
        </div>	
        <div class="col-md-9">
            <div class="card">
        <div class="card-header">
            <h3 class="card-title">Youth Information whom placed in Jobs <small class="badge badge-success"> {{count($youths)}}</small><span  class="badge badge-success float-right" id="row_count"></span></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>DS Division</th>
                        <th>Employer</th>
                        <th>Vacancy</th>
                        <th>Salary</th>
                        <th>Company Type</th>
                        <th>Industry</th>
                        @cannot('branch')<th>Branch</th>@endcan
                        <th></th>
                    </tr>
                </thead> 
                 <tbody>
                      @php 
                        $no=1
                      @endphp
                      @foreach($youths as $youth)
                        <tr>
                          <td>{{$no++}}</td>
                          <td>{{$youth->youth_name}}</td>
                          <td>{{$youth->DSD_Name}}</td>
                          <td>{{$youth->emp_name}}</td>
                          <td>{{$youth->vacancy}}</td>
                          <td>{{$youth->salary}}</td>
                          <td>{{$youth->company_type}}</td>
                          <td>{{$youth->industry}}</td>
                          @cannot('branch')<td>{{$youth->branch_name}}</td>@endcan
                          <td><a href="{{ URL::to('youth/' . $youth->youth_id . '/view') }}" target="_blank">
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
<script type="">
  $(document).ready(function() {

   var table2 = $('#example2').DataTable( {

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],

    } );

   	$('#bank_account').on('change', function () {
          table2.columns(3).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
    $('#company_type').on('change', function () {
          table2.columns(6).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#industry').on('change', function () {
          table2.columns(7).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#branch_id').on('change', function () {
          table2.columns(8).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

});
</script>
@endsection 