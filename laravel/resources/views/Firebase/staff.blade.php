@extends('layouts.firebase')
@section('title',' Mobile App Dashboard')
@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Staff Registered</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>EPF</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>District</th>
                                <th>Reporting To</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($snapshot_users as $su)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$su->data()['epf']}}</td>
                                <td>{{$su->data()['name']}}</td>
                                <td>{{$su->data()['phone']}}</td>
                                <td>{{$su->data()['district']}}</td>
                                <td>{{$su->data()['reportingTo']}}</td>
                                <td>
                                    <a href="{{url('firebase-sessions/staff/'.$su->data()['uid'])}}"><button type="button" class="btn btn-success">View Sessions</button></a>
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

