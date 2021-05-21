@extends('layouts.firebase')
@section('title',' Mobile App Dashboard')
@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Users</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Uid</th>
                                <th>Email</th>
                                <th>is Enabled</th>
                                <th>Created</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$user->uid}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <form action="{{url('firebase-disableUser')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="uid" value="{{$user->uid}}">
                                        <div class="form-group">
                                            <select name="status" onchange="this.form.submit()" id="disable" class="form-control">
                                                <option @if($user->disabled==false) selected @endif value="false">Enabled</option>
                                                <option @if($user->disabled==true) selected @endif value="true">Disabled</option>
                                            </select>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    {{$user->metadata->createdAt->format('Y-m-d | H:i:s')}}
                                </td>
                                <td>
                                    {{$user->metadata->lastLoginAt->format('Y-m-d | H:i:s')}}
                                </td>
                                <td>
                                    <a onclick="return confirm('Are you sure?')" href="{{url('firebase-deleteUser/'.$user->uid)}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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

