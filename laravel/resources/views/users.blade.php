@extends('layouts.main')
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
                        <th>Created At</th>
                        <th>updated At</th>
                        <th>Activate</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form method="post">
                            {{ csrf_field() }}
                            <div class="form-group">                
                                <select class="form-control" data-id="{{$user->id}}" id="role" name="role">
                                    <option value="0">Select a Role</option>
                                    @foreach ($roles as $role)
                                    <option @if($user->isAdmin==$role->id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            </form>          
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        
                        <td><div class="form-group">
                            <form method="post" id="userActivate">
                            {{ csrf_field() }}
                            <label>
                                <input type="checkbox" class="flat-red isActive" data-id="{{$user->id}}" @if ($user->isActive) checked @endif>
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

