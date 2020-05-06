@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<br>
	<h4>Course Category</h4>
	<form action="" id="cat">
		<div class="form-group col-md-6">
			<input type="text" name="course_category" class="form-control">
		</div>	
		{{ csrf_field() }}
		<button type="button" id="add-cat" class="btn btn-primary btn-flat">Add Category</button>
	</form>
<div class="col-md-6">
  <ul>
  @foreach($cat as $c)

    <li>{{$c->course_category}}</li>
  
  @endforeach
  </ul>
</div>
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
  // add youth personal data to database
        $(document).on('click', '#add-cat', function(){
          var form = $('#cat');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/courses/add-cat',
            data: form.serialize(),
                success:function(data){
                  
                      toastr.success('Successfull Added course category Information ! ', 'Congratulations', {timeOut: 5000});
                      $("#cat")[0].reset();                             
                },

                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
 });
</script>
@endsection