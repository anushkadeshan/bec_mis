<template>
    <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                   <i class="fas fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{Auth::user()->unreadNotifications->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Notifications</span>
                
                @if(Auth::user()->unreadNotifications->count())
                @foreach(auth()->user()->unreadNotifications as $notification)
                <small><a style="text-overflow: ellipsis;" href="#" class="dropdown-item">
                  {{ $notification->data['user']['name'] }} Registered with us
                </a> </small>
                @endforeach
                @else
                <a href="#" class="dropdown-item dropdown-footer">No Notifications</a>
                @endif
                </div>
                
            </li>
</template>

<script>
    props : ['user'],
</script>
