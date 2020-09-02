@extends('layouts.main')
@section('title','Users |')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Information</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Branch</th>
                        <th>Activate</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no=1 ?>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form method="post">
                            {{ csrf_field() }}
                            <div class="form-group">                
                                <select class="form-control" data-id="{{$user->id}}" id="role" name="role">
                                    <option value="0">Select a Role</option>
                                    @foreach ($roles as $role)
                                    <option  
                                    @foreach($user->roles as $roleA)
                                    @if($roleA->id==$role->id) selected @endif 
                                    @endforeach
                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            </form>          
                        </td>
                        <td>
                            <form method="post">
                            {{ csrf_field() }}
                            <div class="form-group"> 
                                <select class="form-control" data-id="{{$user->id}}" id="branch" name="branch">
                                    <option value="0">Assign</option>
                                    @foreach ($branches as $branch)
                                    <option  
                                    @if($user->branch==$branch->id) selected @endif 
                                    value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </form>    
                        </td>
                        
                        <td><div class="form-group">
                            <form method="post" id="userActivate">
                            {{ csrf_field() }}
                            <label>
                                <input type="checkbox" id="isActive" class="flat-red isActive" data-id="{{$user->id}}" @if ($user->isActive) checked @endif>
                            </label>
                            
                        </form>
                    </div>       
                        </td>
                        <td>
                            <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                <button type="button" id="delete" data-id="{{$user->id}}" class="btn btn-block btn-danger btn-flat">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>
    </div>  
    
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
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


        //Assign A branch
        $(document).on('change' , '#branch', function (){
            var user_id = $(this).attr('data-id');
            var branch = $(this).children("option:selected").val();
            //alert(role);
            $.ajax({
                type: 'POST',
                url: SITE_URL + '/branch',
                          
                data: {
                    '_token': $('input[name=_token]').val(),
                    'user_id': user_id,
                    'branch': branch
                    
                },
                cache: false,          
                success: function(data) {              
                toastr.success('Branch Successfully Assigned ! ', 'Congratulations', {timeOut: 5000});
                //$('#example1').DataTable().ajax.reload();           
                },

                error: function (jqXHR, exception) {    
                    console.log(jqXHR);
                    toastr.error('Something Error !', 'Status not Changed!');
                    
                },
            });
        });
    });
    
</script>

@endsection

