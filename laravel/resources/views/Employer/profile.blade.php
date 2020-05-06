@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Basic Details</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" ><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <strong>Name :</strong>  <span id="name">@if(!empty($employer)){{$employer->name}} @endif</span>
                      <span class="badge bg-primary float-right"></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <strong>Address : </strong> <span id="address">@if(!empty($employer)){{$employer->address}} @endif</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     <strong>Telephone :</strong> <span id="phone">@if(!empty($employer)){{$employer->phone}} @endif</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     <strong>Email :</strong> <span id="email">@if(!empty($employer)){{$employer->email}} @endif</span>
                      <span class="badge bg-warning float-right"></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     <strong> Company Type :	</strong> <span id="company_type">@if(!empty($employer)){{$employer->company_type}} @endif</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                     <strong>Industry :</strong> <span id="industry">@if(!empty($employer)){{$employer->industry}} @endif</span>
                    </a>
                  </li>
             	 </br>
                  <li class="nav-item">
        				<form id="userDelete" method="post" action="" >
                      		{{ csrf_field() }} <button type="button" id="edit-employer" @if(!empty($employer)) data-id="{{$employer->id}}"  data-name="{{$employer->name}}" data-phone="{{$employer->phone}}" data-email="{{$employer->email}}" data-address="{{$employer->address}}"  data-company_type="{{$employer->company_type}}" data-industry="{{$employer->industry}}" @endif class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i> Add/Edit Information</button>
                         </form>                  	
                 
                  </li>
              	</br>
                
              </div>
              
              <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-4">
			     <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-clipboard-list"></i></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Number of Vacancies </span>
                <span class="info-box-number">{{ $vacancies_count}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-file-contract"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Number of Applications</span>
                <span class="info-box-number">{{$applications_count}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            
            <!-- /.info-box -->
		    </div>	
</div>
{{--model--}}
<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Employer Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
                  
              <form role="form" method="get" id="myForm1">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Employer Name</label>
                    <input type="text" class="form-control" id="name1" name="name" placeholder="Enter Employer Name">
                     <span class="help-block"><strong></strong></span>
                  </div>
                  <div class="form-group">
                    <label for="name">Telephone</label>
                    <input type="integer" class="form-control" id="phone1" name="phone" placeholder="Enter Employer Phone Number">
                     <span class="help-block"><strong></strong></span>
                  </div>

                  <div class="form-group">
                    <label for="address">Employer Address</label>
                    <textarea class="form-control" id="address1" name="address" placeholder="Enter Employer Address" rows="4"></textarea>
                     <span class="help-block"><strong></strong></span>
                  </div>

                  <div class="form-group">
                    <label for="company_type">Company Type</label>
                    <select id="company_type1" name="company_type" class="form-control">
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

                  <div class="form-group">
                    <label for="industry">Industry</label>
                    <select id="industry1" name="industry" class="form-control">
                        <option value="">Select Option  </option>
                        <option>Agriculture &amp; Food Processing</option>
                        <option>Automobiles</option>
                        <option>Banking &amp; Financial Services</option>
                        <optio>BPO / KPO</option>
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
                  <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}"></input>
                  <input type="hidden" id="id" name="id"></input>
              </form>
            <div class="print-error-msg" style="display: none; list-style: none;">
                  <ul>
                      
                  </ul>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="update-employer-profile" class="btn btn-primary">Add/ Update changes</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
@if($errors->any())
<script>
toastr.error('Error !', 'Please complete the profile before add vacancies');
</script>
@endif

@endsection