@extends('layouts.main')
@section('title','Employers |')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 class="card-title">Employer Information</h3> 
        		</div>
        		<div class="col-md-6">
        			
        		</div>
                @can('create-Employer')
        		<div class="col-md-3 text-right">
        			<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#exampleModalCenter">Add Employer Information</button>
        		</div>
                @endcan
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Contacts</th>
                        <th width ="50">Address</th>
                        <th>Industry</th>
                        @can('update-Employer')
                        <th>Action</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($employers as $employer)
                    <tr class="employer{{$employer->id}}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $employer->name }}</td>
                        <td>{{ $employer->phone }}
                        <br> <small><i class="fas fa-envelope-square"></i> </small> <small> {{ $employer->email }}</small>    
                        </td>
                        <td>{{ $employer->address }}</td>
                        <td>{{ $employer->industry }}</td>
                        @can('update-Employer')
                        <td>
                            <div class="btn-group">
                                <form id="userDelete" method="post" action="" >
                                {{ csrf_field() }}
                                    <button type="button" id="edit-employer" data-id="{{$employer->id}}" data-name="{{$employer->name}}" data-phone="{{$employer->phone}}" data-email="{{$employer->email}}" data-address="{{$employer->address}}"  data-company_type="{{$employer->company_type}}" data-industry="{{$employer->industry}}"class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                                </form> 
                            
                                <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                    <button type="button" id="delete-employer" data-id="{{$employer->id}}" class="btn btn-block btn-danger btn-flat btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                            
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>
    </div>  
    <!-- Model for create employer -->

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Employer Information</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
              <!-- form start -->
                  
              <form role="form" method="post" id="myForm">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="name">Employer Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employer Name">
                     <span class="help-block"><strong></strong></span>
                  </div>
                  <div class="form-group">
                    <label for="name">Telephone</label>
                    <input type="integer" class="form-control" id="phone" name="phone" placeholder="Enter Employer Phone Number">
                     <span class="help-block"><strong></strong></span>
                  </div>

                  <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Employer Email Address">
                     <span class="help-block"><strong></strong></span>
                  </div>

                  <div class="form-group">
                    <label for="address">Employer Address</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Enter Employer Address" rows="4"></textarea>
                     <span class="help-block"><strong></strong></span>
                  </div>

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
                  <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}"></input>
              </form>
            <div class="print-error-msg" style="display: none; list-style: none;">
                  <ul>
                      
                  </ul>
              </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="add-employer" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>


<!-- Model for edit employer -->

    <!-- Modal -->
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
                    <label for="name">Email</label>
                    <input type="email" class="form-control" id="email1" name="email" placeholder="Enter Employer Email Address">
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
            <button type="button" id="update-employer" class="btn btn-primary">Update changes</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection