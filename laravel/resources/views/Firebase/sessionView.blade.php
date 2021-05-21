@extends('layouts.firebase')
@section('title',' Mobile App Dashboard')
@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <h2>Staff Visit</h2>
            <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-headline">
								<div class="panel-heading">
									<h3 class="panel-title">Staff Details</h3>
									<p class="panel-subtitle"></p>
								</div>
								<div class="panel-body">
                                    <ul class="list-unstyled list-justify">
										<li><strong>Name</strong> : <span class="text-muted">{{$user->data()['name']}}</span></li>
										<li><strong>EPF</strong> : <span>{{$user->data()['epf']}}</span></li>
										<li><strong>Phone</strong> : <span>{{$user->data()['phone']}}</span></li>
                                        <li><strong>Reporting To</strong> : <span>{{$user->data()['reportingTo']}}</span></li>
                                        <li><strong>District</strong> : <span>{{$user->data()['district']}}</span></li>
									</ul>

								</div>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-headline">
								<div class="panel-heading">
									<h3 class="panel-title">Session Details</h3>
									<p class="panel-subtitle"></p>
								</div>
								<div class="panel-body">
                                    <ul class="list-unstyled list-justify">
										<li><strong>ID</strong> : <span class="text-muted">{{$session['id']}}</span></li>
										<li><strong>Date</strong> : <span>{{$session['date']}}</span></li>
										<li><strong><strong>Client</strong></strong> : <span>{{$session['client']}}</span></li>
                                        <li><strong>Purpose To</strong> : <span>{{$session['purpose']}}</span></li>
                                        <hr>
                                        <li><strong>Session Start Time</strong> : <span>{{$session['start_time']}}</span></li>
                                        <li><strong>Session End Time</strong> : <span>{{$session['end_time']}}</span></li>
                                        <hr>
                                        <li><strong>Session Start Latitude</strong> : <span>{{$session['start_lat']}}</span></li>
                                        <li><strong>Session Start Longitude</strong> : <span>{{$session['start_long']}}</span></li>
                                        <li><strong>Session Start Address</strong> : <span class="text-right">
                                            @php
                                               $myArray = explode(',', $session['start_address']);
                                            @endphp
                                            @foreach($myArray as $key => $item)
                                                {{$item}} <br>
                                            @endforeach
                                            </span></li>

                                        <br>
                                        <div class="btn-group">
                                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$session['start_lat']}},{{$session['start_long']}}">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-location-arrow"></i>
                                                    View Start Location
                                                </button>
                                            </a>
                                        </div>
                                        <hr>
                                        <li><strong>Session End Latitude</strong> : <span>{{$session['end_lat']}}</span></li>
                                        <li><strong>Session End Longitude</strong> : <span>{{$session['end_long']}}</span></li>
                                        <li><strong>Session End Address</strong> : <span class="text-right">
                                            @php
                                               $myArray = explode(',', $session['end_address']);
                                            @endphp
                                            @foreach($myArray as $key => $item)
                                                {{$item}} <br>
                                            @endforeach
                                            </span></li>
                                        <br>
                                        <div class="btn-group">
                                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$session['end_lat']}},{{$session['end_long']}}">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="fa fa-location-arrow"></i>
                                                    View End Location
                                                </button>
                                            </a>
                                        </div>
                                        <br>
                                        <br>
                                        <a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin={{$session['start_lat']}},{{$session['start_long']}}&destination={{$session['end_lat']}},{{$session['end_long']}}">
                                            <button type="button" class="btn btn-success">
                                                    <i class="fa fa-map-signs"></i>
                                                     View Directions
                                            </button>
                                        </a>
                                        <strong> Approximate Length between two locations </strong>: {{$distance}}m
                                        <hr>
                                        <li><strong>Created At</strong> : <span>{{date('Y-m-d | H:i:s',strtotime($session['created_at']))}}</span></li>
                                        <li><strong>Updated At</strong> : <span>@if(isset($session['updated_at']))
                                            {{date('Y-m-d | H:i:s',strtotime($session['updated_at']))}}
                                            @endif</span></li>
									</ul>
								</div>
							</div>
                        </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
   function changeStatus(a,id) {
        var value = (a.value || a.options[a.selectedIndex].value);
        alert(value);  //crossbrowser solution =)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: BaseUrl+'/change/role',
            dataType: "json",
            data:{
                'role':value,
                'user':id
            },
            success: function(response) {
                location.reload();
            }
        });
    }
</script>
@endpush

