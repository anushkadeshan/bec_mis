
$(document).ready(function(){
// User Activate     
$(document).on('ifClicked', '.isActive', function(){       
    id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/userActivate',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Status Successfully Changed ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });
              
        $('.isActive').on('ifToggled', function(event) {
                  $(this).closest('tr').toggleClass('warning');
        });
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
$('select').on('change' , function (event){
    var id = $(this).attr('data-id');
    var isAdmin = $(this).children("option:selected").val();
    //alert(role);
    $.ajax({
        type: 'POST',
        url: SITE_URL + '/changeRole/',
                  
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
            'isAdmin': isAdmin
            
        },
        cache: false,          
        success: function(data) {              
        toastr.success('Admin Role Successfully Changed ! ', 'Congratulations', {timeOut: 5000});
        //$('#example1').DataTable().ajax.reload();           
        },

        error: function (jqXHR, exception) {    
            console.log(jqXHR);
            toastr.error('Something Error !', 'Status not Changed!')
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
});