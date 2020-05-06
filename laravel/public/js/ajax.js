
$(document).ready(function(){

//user Delete
$(document).on('click' , '#delete' ,function (){
    id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: SITE_URL + '/userDelete',
                  
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
                  
        success: function(data) {              
        toastr.success('User Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
        //$('#example1').DataTable().ajax.reload();           
        },

        error: function (jqXHR, exception) {    
            console.log(jqXHR);
            toastr.error('Something Error !', 'Status not Changed!')
        },
    });
});


//Change Admin Role
$(document).on('change' , '#role', function (){
    var user_id = $(this).attr('data-id');
    var role_id = $(this).children("option:selected").val();
    //alert(role);
    $.ajax({
        type: 'POST',
        url: SITE_URL + '/changeRole/',
                  
        data: {
            '_token': $('input[name=_token]').val(),
            'user_id': user_id,
            'role_id': role_id
            
        },
        cache: false,          
        success: function(data) {              
        toastr.success('Admin Role Successfully Changed ! ', 'Congratulations', {timeOut: 5000});
        //$('#example1').DataTable().ajax.reload();           
        },

        error: function (jqXHR, exception) {    
            console.log(jqXHR);
            toastr.error('Something Error !', 'Status not Changed!');
            
        },
    });
});


    $(document).on('click' ,'#read', function(){
        var id = $(this).attr('data-id');

        $.ajax({
            'type': 'POST',
            'url': SITE_URL + '/markAsRead/',

            data: {
                '_token': $('input[name=_token]').val(),
                'id': id,
            },
            success: function(data){

            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
            
        },


        });
    });


    //employer Delete
    $(document).on('click' , '#delete-employer' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/employerDelete',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('User Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.employer' +id).remove();
            //$('#example1').DataTable().ajax.reload();           
            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'You Do not have permission to delete employer')
            },
        });
    });


    //Employer add
    $(document).on('click' , '#add-employer' ,function (){
        var form = $("#myForm");
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/employerInsert',
                      
            data: form.serialize(),
                      
            success: function(data) {  

            if($.isEmptyObject(data.error)){
                toastr.success('Employer Successfully Added to the database ! ', 'Congratulations', {timeOut: 5000});
                $("#myForm")[0].reset();
                
                $('.print-error-msg').css('display', 'none');
            } 
            else{
                $('.print-error-msg').focus();
                printMessageErrors(data.error);
                toastr.error('Validation Error !', 'Please provide information');

            }      
            
            
            //$('#example1').DataTable().ajax.reload();           
            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
    });

    function printMessageErrors(msg){
        $('.print-error-msg').find('ul').empty();
        $('.print-error-msg').css('display', 'block');

        $.each(msg, function(key,value){

            $('.print-error-msg').find('ul').append("<li class='alert alert-danger'>" +value+ "</li>");
        });
    }

    $(document).on('click', '#edit-employer', function(){
        var id = $(this).data('id');
        $('#id').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#phone1').val($(this).data('phone'));
        $('#email1').val($(this).data('email'));
        $('#address1').val($(this).data('address'));
        $('#company_type1').val($(this).data('company_type'));
        $('#industry1').val($(this).data('industry'));
        
        $('#updateModel').modal('show');
        
    });

    $(document).on('click' , '#update-employer' , function(){
       var form = $("#myForm1"); 
       $.ajax({
        type : 'POST',
        url : SITE_URL + '/employerUpdate',
        data : form.serialize(),

        success: function(data){
            if($.isEmptyObject(data.error)){
                toastr.success('Employer Successfully updated ! ', 'Congratulations', {timeOut: 5000});
                $("#myForm1")[0].reset();
                $('.print-error-msg').css('display', 'none');
                $('#updateModel').modal('hide');
            }
            else{
                $('.print-error-msg').focus();
                printMessageErrors(data.error);
                toastr.error('Validation Error !', 'Please provide required information');

            }

        },

        error: function(jqXHR, exception){
            toastr.error('Error !', 'You Do not have permission to update employer')
        },

       });

    });
    //open model for Emploer profile
    
    $(document).on('click', '#editOrAdd-profile', function(){
        var id = $(this).data('id');
        $('#id').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#phone1').val($(this).data('phone'));
        $('#email1').val($(this).data('email'));
        $('#address1').val($(this).data('address'));
        $('#company_type1').val($(this).data('company_type'));
        $('#industry1').val($(this).data('industry'));
        
        $('#updateModel').modal('show');
        
    });

    //update or insert employer profile details
    $(document).on('click' , '#update-employer-profile' , function(){
       var form = $("#myForm1"); 
       $.ajax({
        type : 'POST',
        url : SITE_URL + '/e-profile-update',
        data : form.serialize(),

        success: function(data){
            if($.isEmptyObject(data.error)){
                toastr.success('Profile Successfully updated ! ', 'Congratulations', {timeOut: 5000});
                $("#myForm1")[0].reset();
                $('.print-error-msg').css('display', 'none');
                $('#updateModel').modal('hide');
            }
            else{
                $('.print-error-msg').focus();
                printMessageErrors(data.error);
                toastr.error('Validation Error !', 'Please provide required information');

            }

        },

        error: function(jqXHR, exception){
            toastr.error('Error !', 'You Do not have permission to update employer')
        },

       });

    });
});