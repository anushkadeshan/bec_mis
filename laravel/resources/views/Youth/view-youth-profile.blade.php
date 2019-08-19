@extends('layouts.main')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Youth Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="@if($youth->gender=="Female"){{ URL::asset('images/young.png')}}@else {{ URL::asset('images/male.jpg')}} @endif"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$youth->name}}</h3>
                @can('follow-youth')
                <button class="btn btn-success btn-block" id="select-youth" data-id="{{$youth->id}}">Select This Youth to hire &nbsp;&nbsp;&nbsp;&nbsp;<i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i></button> 
                @endcan
                <p class="text-muted text-center">@if(!is_null($jobs_details)){{$jobs_details->title}}@endif</p>
                
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{$youth->gender}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Birth Date</b> <a class="float-right">{{$youth->birth_date}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Maritial Status</b> <a class="float-right">{{$youth->maritial_status}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Driving Licence</b> <a class="float-right">{{$youth->driving_licence}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nationality</b> <a class="float-right">{{$youth->nationality}}</a>
                  </li>
                  @can('view-youth-contacts')
                  
                  <li class="list-group-item">
                    <b>Contacts</b> <a class="float-right">{{$youth->phone}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$youth->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Address</b> <a class="float-right">{{$youth->family->address}}</a>
                  </li>
                  @endcan
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-book mr-1"></i> Highest Education Level</strong>

                <p class="text-muted">{{$youth->highest_qualification}}</p>
                <hr>
                <strong><i class="fa fa-book mr-1"></i>Other Education</strong>

                <p class="text-muted">
                  <ul class="list-group list-group-unbordered mb-3">
                  @if(!is_null($results->university)&& !is_null($results->degree))
	                  <li class="list-group-item text-muted">
	                    {{$results->degree}} at {{$results->university}}
	                  </li>
                  @endif
                  @if(!is_null($results->other_professional_qualifications))
	                  <li class="list-group-item text-muted">
	                    {{$results->other_professional_qualifications}}
	                  </li>
                  @endif

                  @if(!is_null($followed_courses))
                  	@foreach($followed_courses as $fc)
	                  <li class="list-group-item text-muted">
	                    Followed {{$fc->course_name}} Course in {{$fc->institute_name}}
	                  </li>
	                @endforeach
                  @endif
                  @if(!is_null($following_course))
	                  <li class="list-group-item text-muted">
	                    Following {{$following_course->course_name}} Course in {{$following_course->institute_name}}
	                  </li>
                  @endif

                </ul>
                </p>

                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                <p class="text-muted">
                	@if(!is_null($youth->family))
                		{{$youth->family->district}}
                	@endif
                </p>

                <hr>


                <strong><i class="fa fa-file-text-o mr-1"></i> Notes</strong>

                <p class="text-muted">
                	@if($youth->disability=="Yes") I'm a differntly abled person.
                	@endif
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card card-success card-outline">
              <div class="card-header p-2">
                <ul class="nav nav-pills">    
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Family Details </a></li>
                  <li class="nav-item"><a class="nav-link " href="#tab_2" data-toggle="tab">Intresting Things</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Language Proficiency </a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="tab_3">
                    <div class="row"> 
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Language</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  Tamil
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  Sinhala
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  English
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Reading</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="reading_tamil" @if(!is_null($language))@if($language->reading_tamil) checked @endif @endif>  

                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="reading_sinhala" @if(!is_null($language))@if($language->reading_sinhala) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="reading_english" @if(!is_null($language))@if($language->reading_english) checked @endif @endif>  
                                  
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Speaking</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="speaking_tamil" @if(!is_null($language))@if($language->speaking_tamil) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="speaking_sinhala" @if(!is_null($language))@if($language->speaking_sinhala) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="speaking_english" @if(!is_null($language))@if($language->speaking_english) checked @endif @endif>  
                                  
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div  class="col-md-3">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <strong>Writing</strong> 
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="writing_tamil" @if(!is_null($language))@if($language->writing_tamil) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="writing_sinhala" @if(!is_null($language))@if($language->writing_sinhala) checked @endif @endif>  
                                  
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <input type="checkbox" readonly name="writing_english" @if(!is_null($language))@if($language->writing_english) checked @endif @endif>  
                                  
                                </a>
                              </li>

                            </ul>
                          </div>
                      </div>
                  </div>

                  <div class="tab-pane" id="tab_2">
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                      	<i class="fa fa-hotel bg-primary"></i>
						          <div class="timeline-item">
                        
                          <h3 class="timeline-header">Intresting Job Industries</h3>

                          <div class="timeline-body text-muted">
                            @if(!is_null($intresting_jobs))
                            	{{implode(', ', $intresting_jobs->industry)}}	
                  			   @endif
                          </div>
                          
                        </div>
                      </li>
                  </ul>

                  <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                      	<i class="fa fa-globe bg-primary"></i>

						<div class="timeline-item">
                        
                          <h3 class="timeline-header">Intresting Job Locations</h3>

                          <div class="timeline-body text-muted">
                            @if(!is_null($intresting_jobs))
                            	{{implode(', ', $intresting_jobs->location)}}	
                              
                  			     @endif
                          </div>
                          
                        </div>
                      </li>
                  </ul>
                  <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                      	<i class="fa fa-graduation-cap bg-primary"></i>
						<div class="timeline-item">
                        
                          <h3 class="timeline-header">Intresting Courses Catogeries</h3>

                          <div class="timeline-body text-muted">
                          	@if(!is_null($intresting_courses))
                            @foreach($intresting_courses as $courses)
                            	{{$courses->course_category}} , 	
                  			@endforeach
                  			@endif
                          </div>
                          
                        </div>
                      </li>
                  </ul>
                  <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                      	<i class="fa fa-award bg-primary"></i>
						<div class="timeline-item">
                        
                          <h3 class="timeline-header">Intresting Self Businesses</h3>

                          <div class="timeline-body text-muted">
                            @if(!is_null($intresting_business))
                            	{{$intresting_business->intresting_business}}	
                  			@endif
                          </div>
                          
                        </div>
                      </li>
                  </ul>
                  </div>
                  <div class="tab-pane active" id="tab_1">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><strong>Head of Household : </strong><span>{{$youth->family->head_of_household}}</span></li>
                      <li class="list-group-item"><strong>NIC of Head of Household : </strong><span>{{$youth->family->nic_head_of_household}}</span></li>

                      <li class="list-group-item"><strong>Family Type : </strong><span>{{$youth->family->family_type}}</span></li>

                      <li class="list-group-item"><strong>Total Income : </strong><span>{{$youth->family->total_income}}</span></li>
                      <li class="list-group-item"><strong>Total Family Members : </strong><span>{{$youth->family->total_members}}</span></li>
                      <li class="list-group-item"><strong>PCI : </strong><span>{{$youth->family->total_income / $youth->family->total_members}}</span></li>
                    </ul>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
@section('scripts')
<script>
	$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
});


$(document).ready(function(){
     $(document).on('click' , '#select-youth' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/select',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully select this youth! ', 'Congratulations', {timeOut: 5000});
            }
            else{
            toastr.error('Error !', ""+data.error+"");
              
            }         
        },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'Something Error')
            },
        });
    });
  });

  @if (session('error'))
  toastr.error('{{session('error')}}')
  @endif
</script>

@endsection