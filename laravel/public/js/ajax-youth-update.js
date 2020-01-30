$(document).ready(function(){
//serahc course id
			 $('#course_name').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/courseList',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#courseList').fadeIn();  
			           $('#courseList').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', '#followed li', function(){  
			    	$('#courseList').fadeOut(); 
			        $('#course_name').val($(this).text()); 
			        var course_id = $(this).attr('id');
			        $('#course_id').val(course_id);
			         
			    });  
		});

$(document).ready(function(){
  // add youth personal data to database
        $(document).on('click', '#personal_info', function(){
          var form = $('#youth');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-personal',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfull updated Personal Information ! ', 'Congratulations', {timeOut: 5000});
                      $("#youth")[0].reset(); 
                      $('#tabs a[href="#tab_2"]').tab('show');
                      $('#tabs a[href="#tab_2"]').attr("data-toggle", "tab");

                  }
                  else{

                      printValidationErrors(data.error);

                  }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});


      function printValidationErrors(msg){
        $.each(msg, function(key,value){
          toastr.error('Validation Error !', ""+value+"");
        });
      }

$(document).ready(function(){
  // add youth education data to database
        $(document).on('click', '#update-education', function(){
          var form = $('#education');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-results',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated Education Information ! ', 'Congratulations', {timeOut: 5000});
                      $("#education")[0].reset(); 
                      $('#tabs a[href="#tab_7"]').tab('show');
                      $('#tabs a[href="#tab_7"]').attr("data-toggle", "tab");
        


                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
  // add youth education data to database
        $(document).on('click', '#update-language', function(){
          var form = $('#language');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-language',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated Language Information ! ', 'Congratulations', {timeOut: 5000});
                      $("#language")[0].reset(); 
                      $('#tabs a[href="#tab_3"]').tab('show');
                      $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");


                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});


$(document).ready(function(){
  // add youth courses data to database
        $(document).on('click', '#update-course', function(){
          var form = $('#courses');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-followed-course',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated course ! ', 'Congratulations', {timeOut: 5000});
                      $("#courses")[0].reset();   
                      $('#update-model').modal('hide');

                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
  // add permantat jobs data to database
        $(document).on('click', '#update-jobs', function(){
          var form = $('#jobs');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-jobs',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated details ! ', 'Congratulations', {timeOut: 5000});
                      window.location.reload();
                      $("#jobs")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab"); 
                      $(".sa-success").addClass("hide");
                      setTimeout(function() {
                        $(".sa-success").removeClass("hide");
                      }, 20);
  


                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
  // add temp_jobs  data to database
        $(document).on('click', '#update-tempory', function(){
          var form = $('#temp_jobs');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-tempory',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully Added details ! ', 'Congratulations', {timeOut: 5000});
                      $("#temp_jobs")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab"); 
                      $(".sa-success").addClass("hide");
                      setTimeout(function() {
                        $(".sa-success").removeClass("hide");
                      }, 20);


                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
  // add following courses  data to database
        $(document).on('click', '#update-following-course', function(){
          var form = $('#vt_courses');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-following-course',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated details ! ', 'Congratulations', {timeOut: 5000});
                      $("#vt_courses")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab"); 
                      $(".sa-success").addClass("hide");
                      setTimeout(function() {
                        $(".sa-success").removeClass("hide");
                      }, 20);

                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
  // add no Jobs  data to database
        $(document).on('click', '#update-no-jobs', function(){
          var form = $('#no_jobs');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-no-jobs',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated details ! ', 'Congratulations', {timeOut: 5000});
                      $("#no_jobs")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab"); 
                      $(".sa-success").addClass("hide");
                      setTimeout(function() {
                        $(".sa-success").removeClass("hide");
                      }, 20);
                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
  // add Self Employed  data to database
        $(document).on('click', '#update-self', function(){
          var form = $('#self_employed');

          $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/update-self',
            data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfully updated details ! ', 'Congratulations', {timeOut: 5000});
                      $("#self_employed")[0].reset();
                      $('#tabs a[href="#tab_5"]').tab('show');
                      $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab"); 
                      $(".sa-success").addClass("hide");
                      setTimeout(function() {
                        $(".sa-success").removeClass("hide");
                      }, 20);
                }
                else{
                  printValidationErrors(data.error);
                }
                },
                error:function(data, jqXHR,error){
                  console.log(jqXHR, error);
                }

       });
    });
});

$(document).ready(function(){
    $(document).on('click' , '#next', function(){
        
        if($('#course_name').val()==""){
            $('#tabs a[href="#tab_4"]').tab('show');
            $('#tabs a[href="#tab_4"]').attr("data-toggle", "tab");
            $('#tabs a[href="#tab_3"]').removeAttr("data-toggle", "tab");
        }

        else{
          
          toastr.error('Something Error !', 'Please Add course before going to next!');

        }
        

    });
});
  $(document).ready(function(){
//serahc family id
       $('#fam_id').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/familyList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){ 
                 $('#familyList').fadeIn();  
                 $('#familyList').html(data);
                }
               });
              }
          });

          $(document).on('click', '#family li', function(){  
            $('#familyList').fadeOut(); 
              $('#fam_id').val($(this).text()); 
              var family_id = $(this).attr('id');
              $('#family_id').val(family_id);
               
          });  
    });
$(document).ready(function(){
  $(document).on('change' , '#current_status', function (){
    var id = $('#youth_id_3').val();
    var current_status = $(this).children("option:selected").val();
    $.ajax({
        type: 'POST',
        url: SITE_URL + '/youth/changeStatus',
                  
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
            'current_status': current_status
            
        },
        cache: false,          
        success: function(data) {
        load_status_data(current_status);              
        toastr.success('Status Succesfully Changed ! ', 'Congratulations', {timeOut: 5000});
                  
        },

        error: function (jqXHR, exception) {    
            console.log(jqXHR);
            toastr.error('Something Error !', 'Status not Changed!');
            
        },
    });
});
});

function load_status_data(current_status){
  if(current_status=="Permanent Job After Vocational/Prof Training"){
    $('#temp_job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#job').show();

  }

  if(current_status=="Permanent Job without Vocational/Prof Training"){
      $('#temp_job').hide();
      $('#vt_course').hide();
      $('#no_job').hide();
      $('#self').hide();
      $('#job').show();

    }

  if(current_status=="Temporary Job After Vocational/Prof Training"){
    $('#job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#temp_job').show();
  }

  if(current_status=="Temporary Job without Vocational/Prof Training"){
    $('#job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#temp_job').show();
  }

  if(current_status=="Following a course"){
    $('#job').hide();
    $('#temp_job').hide();
    $('#no_job').hide();
    $('#self').hide();
    $('#vt_course').show();
  }

  if(current_status=="Self Employed"){
    $('#job').hide();
    $('#temp_job').hide();
    $('#vt_course').hide();
    $('#no_job').hide();
    $('#self').show();
  }

  if(current_status=="No Job"){
    $('#job').hide();
    $('#temp_job').hide();
    $('#vt_course').hide();
    $('#self').hide();
    $('#no_job').show();

  }
}

$(document).ready(function(){
//serahc course id
       $('#course_name2').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/courseList1',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#courseList2').fadeIn();  
                 $('#courseList2').html(data);
                }
               });
              }
          });

          $(document).on('click', '#following li', function(){  
            $('#courseList2').fadeOut(); 
              $('#course_name2').val($(this).text()); 
              var course_id = $(this).attr('id');
              $('#course_id2').val(course_id);
               
          });  
    });

$(document).ready(function() {
        $('#followed_courses').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                
            ]
        } );
      } );
//restric future dates
$(document).ready(function () {
        var today = new Date();
        var day=today.getDate()>9?today.getDate():"0"+today.getDate(); // format should be "DD" not "D" e.g 09
        var month=(today.getMonth()+1)>9?(today.getMonth()+1):"0"+(today.getMonth()+1);
        var year=today.getFullYear();

        $("#completed_at").attr('max', year + "-" + month + "-" + day);
});
//open edit model
$(document).on('click', '#edit-course', function(){
        var id = $(this).data('id');
        $('#youth_course_id').val($(this).data('id'));
        $('#youth_course_id1').val($(this).data('id'));
        $('#course_name').val($(this).data('course_name'));
        $('#course_id').val($(this).data('course_id'));
        $('#status').val($(this).data('status'));
        $('#provided_by_bec').val($(this).data('provided_by_bec'));
        $('#completed_at').val($(this).data('completed_at'));

        $('#update-model').modal('show');
        $('#completed_at').val($(this).data('completed_at'));

        
    });
$(document).ready(function(){
//serahc course id
       $('#course_name3').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/courseList1',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#courseList3').fadeIn();  
                 $('#courseList3').html(data);
                }
               });
              }
          });

          $(document).on('click', '#following li', function(){  
            $('#courseList3').fadeOut(); 
              $('#course_name3').val($(this).text()); 
              var course_id = $(this).attr('id');
              $('#course_id3').val(course_id);
               
          });  
    });

