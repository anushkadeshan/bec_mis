@extends('layouts.main')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Youth Profile  </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">User Profile </li>
          <li class="breadcrumb-item active"><font class="badge badge-primary">{{request()->route('id')}}</font> </li>
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

            <h3 class="profile-username text-center">{{$youth->name}} @if($youth->bss==1) <span  class="badge badge-success">BSS</span> @endif </h3> 
            @can('follow-youth')
            <button class="btn btn-success btn-block" id="select-youth" data-id="{{$youth->id}}">Select This Youth to hire &nbsp;&nbsp;&nbsp;&nbsp;<i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i></button> 
            @endcan
            <p class="text-muted text-center">@if(!is_null($jobs_details)){{$jobs_details->title}}@endif</p>
            
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Full Name</b> <a class="float-right">{{$youth->full_name}}</a>
              </li>
              <li class="list-group-item">
                <b>Gender</b> <a class="float-right">{{$youth->gender}}</a>
              </li>
              <?php 
              $dateOfBirth = $youth->birth_date;
              $today = date("Y-m-d");
              $diff = date_diff(date_create($dateOfBirth), date_create($today));
              
              ?>
              <li class="list-group-item">
                <b>Birth Date</b> <a class="float-right">{{$youth->birth_date}} <font class="badge badge-primary">Age is {{$diff->format('%y')}}</font></a>
              </li>
              <li class="list-group-item">
                <b>Maritial Status</b> <a class="float-right">{{$youth->maritial_status}}</a>
              </li>
              <li class="list-group-item">
                <b>Driving Licence</b> <a class="float-right">{{$youth->driving_licence}}</a>
              </li>
              <li class="list-group-item">
                <b>Race</b> <a class="float-right">{{$youth->nationality}}</a>
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
              <li class="list-group-item">
                <b>DS Division</b> <a class="float-right">{{$youth->DSD_Name}}</a>
              </li>
              <li class="list-group-item">
                <b>GN Division</b> <a class="float-right">{{$youth->GN_Office}}</a>
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
                @if(!is_null($results))
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
            @can('view-M&E-reports')  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">BEC Program Status </a></li>@endcan
            
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
         <div class="tab-content">
          
          <div class="tab-pane active" id="tab_1">
            @if (Auth::user()->can('view-youth-contacts'))
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Head of Household : </strong><span>{{$youth->family->head_of_household}}</span></li>
              <li class="list-group-item"><strong>NIC of Head of Household : </strong><span>{{$youth->family->nic_head_of_household}}</span></li>

              <li class="list-group-item"><strong>Family Type : </strong><span>{{$youth->family->family_type}}</span></li>

              <li class="list-group-item"><strong>Total Income : </strong><span>{{$youth->family->total_income}}</span></li>
              <li class="list-group-item"><strong>Total Family Members : </strong><span>{{$youth->family->total_members}}</span></li>
              <li class="list-group-item"><strong>PCI : </strong><span>@if(!is_null($youth->family->total_members)){{$youth->family->total_income / $youth->family->total_members}}@endif</span></li>
            </ul>
            @else
            Content is not allowed
            @endif
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
@can('view-M&E-reports')
<div class="tab-pane" id="tab_4">
  <ul class="timeline timeline-inverse">
    <!-- timeline time label -->
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
      @if(is_null($cg)) <i class="fa fa-hotel bg-default"></i> @else <i class="fa fa-hotel bg-success"></i>@endif
      <div class="timeline-item">
        
        <h3 class="timeline-header">Career Guidance <span  style="float: right" class="text-success">@if(!is_null($cg))<i class="far fa-check-circle"></i>@endif</span></h3>

        <div class="timeline-body text-muted">
          @if(!is_null($cg))
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Date : </strong><span>{{$cg->program_date}}</span></li>
            <li class="list-group-item"><strong>Vanue : </strong><span>{{$cg->venue}}</span></li>
            <li class="list-group-item"><strong>Career Field : </strong><span>{{$cg->career_field1}}</span></li>
            <li class="list-group-item"><strong>Career Field 2 : </strong><span>{{$cg->career_field2}}</span></li>
            <li class="list-group-item"><strong>Career Field 3 : </strong><span>{{$cg->career_field3}}</span></li>
          </ul>
          @else
          No data Available
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
      @if(is_null($soft))<i class="fa fa-globe bg-default"></i>@else <i class="fa fa-globe bg-success"></i>@endif

      <div class="timeline-item">
        
        <h3 class="timeline-header">Soft Skills Course <span  style="float: right" class="text-success">@if(!is_null($soft))<i class="far fa-check-circle"></i>@endif</span> </h3>

        <div class="timeline-body text-muted">
          @if(!is_null($soft))
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Institute : </strong><span>{{$soft->name}}</span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span>{{$soft->start_date}}</span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span>{{$soft->end_date}}</span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                @switch($soft->dropout)
                @case(1)
                <small class="badge badge-danger">{{"Dropout"}}</small>
                @break
                @case(0)
                @if($soft->end_date < date("Y-m-d"))
                <small class="badge badge-warning">{{"Finished"}}</small>
                @else
                <small class="badge badge-success">{{"Ongoing"}}</small>
                @endif
                @break
                @default
                
                @endswitch
              </span>
            </li>
            @if($soft->dropout==1)<li class="list-group-item"><strong>Reason to Dropout : </strong><span>{{$soft->reoson_to_dropout}}</span></li>@endif
          </ul>
          @else
          No data Available
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
      @if(is_null($gvt))<i class="fa fa-graduation-cap bg-default"></i>@else <i class="fa fa-hotel bg-success"></i>@endif
      <div class="timeline-item">
        
        <h3 class="timeline-header">Support to Follow Gvt. Courses <span  style="float: right" class="text-success">@if(!is_null($gvt))<i class="far fa-check-circle"></i>@endif</span></h3>

        <div class="timeline-body text-muted">
          @if(!is_null($gvt))
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Institute : </strong><span>{{$gvt->institute_name}}</span></li>
            <li class="list-group-item"><strong>Course Name : </strong><span>{{$gvt->course_name}}</span></li>
            <li class="list-group-item"><strong>Course Type : </strong><span>{{$gvt->course_type}}</span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span>{{$gvt->start_date}}</span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span>{{$gvt->end_date}}</span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                @switch($gvt->dropout)
                @case(1)
                <small class="badge badge-danger">{{"Dropout"}}</small>
                @break
                @case(0)
                @if($gvt->end_date < date("Y-m-d"))
                <small class="badge badge-warning">{{"Finished"}}</small>
                @else
                <small class="badge badge-success">{{"Ongoing"}}</small>
                @endif
                @break
                @default
                
                @endswitch
              </span>
            </li>
            @if($gvt->dropout==1)<li class="list-group-item"><strong>Reason to Dropout : </strong><span>{{$gvt->reoson_to_dropout}}</span></li>@endif
          </ul>
          @else
          No data Available
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
      @if(is_null($financial))<i class="fa fa-award bg-default"></i>@else <i class="fa fa-award bg-success"></i>@endif
      <div class="timeline-item">
        
        <h3 class="timeline-header">Finacial Assistance for Courses <span  style="float: right" class="text-success">@if(!is_null($financial))<i class="far fa-check-circle"></i>@endif</span></h3>

        <div class="timeline-body text-muted">
          @if(!is_null($financial))
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Institute : </strong><span>{{$financial->institute_name}}</span></li>
            <li class="list-group-item"><strong>Course Name : </strong><span>{{$financial->course_name}}</span></li>
            <li class="list-group-item"><strong>Course Type : </strong><span>{{$financial->course_type}}</span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span>{{$financial->start_date}}</span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span>{{$financial->end_date}}</span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                @switch($financial->dropout)
                @case(1)
                <small class="badge badge-danger">{{"Dropout"}}</small>
                @break
                @case(0)
                @if($financial->end_date < date("Y-m-d"))
                <small class="badge badge-warning">{{"Finished"}}</small>
                @else
                <small class="badge badge-success">{{"Ongoing"}}</small>
                @endif
                @break
                @default
                
                @endswitch
              </span>
            </li>
            @if($financial->dropout==1)<li class="list-group-item"><strong>Reason to Dropout : </strong><span>{{$financial->reoson_to_dropout}}</span></li>@endif
            <li class="list-group-item"><strong>Approved Ammount : </strong><span>{{$financial->approved_amount}}</span></li>
            <li class="list-group-item"><strong>Installments : </strong><span>{{$financial->installments}}</span></li>
          </ul>
          @else
          No data Available
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
      @if(is_null($partner))<i class="fa fa-award bg-default"></i>@else <i class="fa fa-award bg-success"></i>@endif
      <div class="timeline-item">
        
        <h3 class="timeline-header">Support to Courses with Partnerships <span  style="float: right" class="text-success">@if(!is_null($partner))<i class="far fa-check-circle"></i>@endif</span></h3>

        <div class="timeline-body text-muted">
          @if(!is_null($partner))
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Institute : </strong><span>{{$partner->institute_name}}</span></li>
            <li class="list-group-item"><strong>Course Name : </strong><span>{{$partner->course_name}}</span></li>
            <li class="list-group-item"><strong>Course Type : </strong><span>{{$partner->course_type}}</span></li>
            <li class="list-group-item"><strong>Course Start Date : </strong><span>{{$partner->start_date}}</span></li>
            <li class="list-group-item"><strong>Course End Date : </strong><span>{{$partner->end_date}}</span></li>
            <li class="list-group-item"><strong>Course Status : </strong>
              <span>
                @switch($partner->dropout)
                @case(1)
                <small class="badge badge-danger">{{"Dropout"}}</small>
                @break
                @case(0)
                @if($partner->end_date < date("Y-m-d"))
                <small class="badge badge-warning">{{"Finished"}}</small>
                @else
                <small class="badge badge-success">{{"Ongoing"}}</small>
                @endif
                @break
                @default
                
                @endswitch
              </span>
            </li>
            @if($partner->dropout==1)<li class="list-group-item"><strong>Reason to Dropout : </strong><span>{{$partner->reoson_to_dropout}}</span></li>@endif
            <li class="list-group-item"><strong>Approved Ammount : </strong><span>{{$partner->approved_amount}}</span></li>

          </ul>
          @else
          No data Available
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
      @if(is_null($placement) || is_null($individual))<i class="fa fa-briefcase bg-default"></i>@else <i class="fa fa-briefcase bg-success"></i>@endif
      <div class="timeline-item">
        
        <h3 class="timeline-header">Job Placement <span  style="float: right" class="text-success">@if(!is_null($placement) || !is_null($individual))<i class="far fa-check-circle"></i>@endif</span></h3>

        <div class="timeline-body text-muted">
         @if(!is_null($placement))
         <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Employer : </strong><span>{{$placement->name}}</span></li>
          <li class="list-group-item"><strong>Vacancy Placed : </strong><span>{{$placement->vacancies}}</span></li>
          <li class="list-group-item"><strong>Salary : </strong><span>{{$placement->salary}}</span></li>                          
        </ul>
        @elseif(!is_null($individual))
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Employer : </strong><span>{{$individual->name}}</span></li>
          <li class="list-group-item"><strong>Vacancy Placed : </strong><span>{{$individual->vacancy}}</span></li>
          <li class="list-group-item"><strong>Salary : </strong><span>{{$individual->salary}}</span></li>                          
        </ul>
        @else
        No data Available
        @endif
      </div>
      
    </div>
  </li>
</ul>
</div>
@endcan
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