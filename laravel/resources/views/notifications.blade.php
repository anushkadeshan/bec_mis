@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header row">
    	<div class="card-title col-md-6">
    		Notifications
    	</div>
    	<div class="col-md-6 text-right">
    		<form>
                {{csrf_field()}}
                <a href="{{ route('unreadNotifications') }}">Unread Noticiations</a>
            </form>
    	</div>
    </div>
    <div class="card-body">
    	<table id="example1">
    		 @if(Auth::user()->notifications->count())
                @foreach(auth()->user()->notifications as $notification)
                @switch($notification->type)
                @case('App\Notifications\notifyAdmin')
    			<a href="" title="" class="dropdown-item">
    					<div class="media">
                    <img src="{{ URL::asset('images/user.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body col-md-5">
                        <h4 class="dropdown-item-title">
                        {{ $notification->data['user']['name'] }}
                        </h4>
                       
                    </div>
                    <div class="col-md-4">
                    	<p class="text-md">User registered with us</p>
                    </div>
                    <div class="col-md-3">
                    	<p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['user']['created_at'] }}</p>

                    </div>
                        
                    </div>
    			</a>
    			@break
                @case('App\Notifications\EmployerAdd')
    					<a href="" title="" class="dropdown-item">
    					<div class="media">
                    <img src="{{ URL::asset('images/employer.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body col-md-5">
                        <h4 class="dropdown-item-title">
                        {{ $notification->data['employer']['name'] }}
                        </h4>
                       
                    </div>
                    <div class="col-md-4">
                    	<p class="text-md">Employer registered with us</p>
                    </div>
                    <div class="col-md-3">
                    	<p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['employer']['created_at'] }}</p>

                    </div>
                        
                    </div>
    			</a>
    			@break
                @case('App\Notifications\vacancyAdd')
                <a href="" title="" class="dropdown-item">
    					<div class="media">
                    <img src="{{ URL::asset('images/job.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body col-md-5">
                        <h4 class="dropdown-item-title">
                        {{ $notification->data['vacancy']['title'] }}
                        </h4>
                       
                    </div>
                    <div class="col-md-4">
                    	<p class="text-md">vacancy information addeed.</p>
                    </div>
                    <div class="col-md-3">
                    	<p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['vacancy']['created_at'] }}</p>

                    </div>
                        
                    </div>
    			</a>
                @break
                @case('App\Notifications\instituteAdd')
              		<a href="" title="" class="dropdown-item">
    					<div class="media">
                    <img src="{{ URL::asset('images/institute.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body col-md-5">
                        <h4 class="dropdown-item-title">
                        {{ $notification->data['institute']['name'] }}
                        </h4>
                       
                    </div>
                    <div class="col-md-4">
                    	<p class="text-md">vacancy information addeed.</p>
                    </div>
                    <div class="col-md-3">
                    	<p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['institute']['created_at'] }}</p>

                    </div>
                        
                    </div>
    			</a>
                @break
                @case('App\Notifications\courseAdd')
                <a href="" title="" class="dropdown-item">
    					<div class="media">
                    <img src="{{ URL::asset('images/institute.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body col-md-5">
                        <h4 class="dropdown-item-title">
                        {{ $notification->data['course']['name'] }}
                        </h4>
                       
                    </div>
                    <div class="col-md-4">
                    	<p class="text-md">A course was added by {{ $notification->data['course']['added_by'] }}.</p>
                    </div>
                    <div class="col-md-3">
                    	<p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['course']['created_at'] }}</p>

                    </div>
                        
                    </div>
    			</a>
    			@break
                @case('App\Notifications\youthAdd')
                <a href="" title="" class="dropdown-item">
    					<div class="media">
                    <img src="{{ URL::asset('images/young.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body col-md-5">
                        <h4 class="dropdown-item-title">
                        {{ $notification->data['youth']['name'] }}
                        </h4>
                       
                    </div>
                    <div class="col-md-4">
                    	<p class="text-md">A youth profile was added by {{ $notification->data['youth']['added_by'] }}.</p>
                    </div>
                    <div class="col-md-3">
                    	<p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['youth']['created_at'] }}</p>

                    </div>
                        
                    </div>
    			</a>
                @endswitch
    			@endforeach
    		@endif
    	</table>
    </div>
</div>
@endsection
