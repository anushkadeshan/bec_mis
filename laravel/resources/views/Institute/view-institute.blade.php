@extends('layouts.main')
@section('content')
<div class="container" >
	<section class="content-header">
 
        <div class="row">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('institutes/view')}}">All Institues</a></li>
              <li class="breadcrumb-item active">{{$institute->name}}</li>
            </ol>
          </div>
        </div>
      
    </section>
    <div class="card" style="margin-top: 10px">
        <div class="card-header">
        	<div class="row">
        		
        		<div class="col-md-6">
        			<h2 class="card-title">{{$institute->name}} - {{$institute->location}}</h2> 

        		</div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#addModel">Add Courses Provided</button>
            </div>
        	</div>
        </div>
        <!-- /.card-header --> 
        <div class="card-body">  
           <div class="row">
           		<div class="col-md-2 text-dark-grey">
           			<div class="nav-item">
           				Institute Name
           			</div>
           			<div class="nav-item">
           				Location
           			</div>
           			<div class="nav-item">
           				Address
           			</div>
           			<div class="nav-item">
           				Email
           			</div>
                <div class="nav-item">
                  Phone
                </div>
           			<div class="nav-item">
           				Contact Person
           			</div>
           			<div class="nav-item">
           				is Registered in TVEC ?
           			</div>
                <div class="nav-item">
                  @if($institute->reg_no)
                  TVEC Reg. No
                  @endif
                </div>	
           		</div>
           		<div class="col-md-5 text-muted">
           			<div class="nav-item">
           				{{ $institute->name }}
           			</div>
           			<div class="nav-item">
           				{{ $institute->location }}
           			</div>
           			<div class="nav-item">
           				{{ $institute->address }}
           			</div>
           			<div class="nav-item">
                  @if($institute->email){{ $institute->email }}
                  @else
                  {{ "not mentioned" }}
                  @endif
           			</div>
                <div class="nav-item">
                  {{ $institute->phone }}
                </div>
           			<div class="nav-item">
                  @if($institute->contact_person){{ $institute->contact_person }}
                  @else
                  {{ "not mentioned" }}
                  @endif
           			</div>
                <div class="nav-item">
                  {{ $institute->is_registerd }}
                </div>
           			<div class="nav-item">
           				@if($institute->reg_no){{ $institute->reg_no }}
           				@else
           			
           				@endif
           				
           			</div>	
           		</div>
           		<div class="col-md-1">
           			<div class="nav-item">
           				Courses
           			</div>
           			
           		</div>
           		<div class="col-md-4 text-muted">
                @foreach($institute->courses as $course)
           			<a href="{{URL::to('courses/'.$course->id.'/view')}}">
                   <div class="nav-item">
                      {{$course->name}}
                    </div>
                </a>
           			@endforeach
           		</div>	
           </div>	      		
            
        </div>
       
</div>
</div>
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Courses which institute provided</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <form action="" method="" id="courses" accept-charset="utf-8">
         <div class="form-group">
          <label for=""></label>
          {{csrf_field()}}
          <select name="course_id[]" id="institute_id" class="form-control" multiple size="18">
            @foreach($courses as $course)
            <option
            @foreach($institute->courses as $cou)
            @if($course->id == $cou->id) selected="selected" @endif
            @endforeach
            value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
          </select>
        <input type="hidden" name="institute_id" value="{{$institute->id}}">
         </div> 
             </form>      
        </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="add-courses" class="btn btn-primary">Save changes</button>
          </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function (){
    $(document).on('click','#add-courses', function(){
      var form = $('#courses');

          $.ajax({
            type: 'POST',
                url: SITE_URL + '/institutes/add-courses',
                data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Courses added to institute Successfull! ', 'Congratulations', {timeOut: 5000});
                      $("#courses")[0].reset();
                      window.location.reload();                     
                  }
                  else{
                      printValidationErrors(data.error);

                  }
                },
                error:function(data,jqXHR){
                  console.log(jqXHR);
                  
                }

          });
    });


  });
</script>
@endsection