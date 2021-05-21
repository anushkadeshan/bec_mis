@component('mail::message')

# Year to Day Progress Report

@component('mail::panel')
<h4 style="color:black">Career Guidance</h4>
@endcomponent
@component('mail::table')
|Branch | CG Youths |
|:-------------|:--------|
|@foreach($data['cg'] as $d)
  {{$d->branch_name}} | {{$d->count}}             
@endforeach 
@endcomponent

<hr>
@component('mail::panel')
<h4 style="color:black">Soft Skills</h4>
@endcomponent

@component('mail::table')
|Branch | Soft Skills Youths |
|:-------------|:--------|
@foreach($data['soft'] as $d)
  {{$d->branch_name}} | {{$d->count}}             
@endforeach 
@endcomponent

<hr>
@component('mail::panel')
<h4 style="color:black">Financial Assistance</h4>
@endcomponent

@component('mail::table')
|Branch | Finacial Assisted Youths |
|:-------------|:--------|
@foreach($data['vt'] as $d)
  {{$d->branch_name}} | {{$d->count}}             
@endforeach 
@endcomponent

<hr>
@component('mail::panel')
<h4 style="color:black">Government Course Supports</h4>
@endcomponent

@component('mail::table')
|Branch | Supported Youths |
|:-------------|:--------|
@foreach($data['vt'] as $d)
  {{$d->branch_name}} | {{$d->count}}             
@endforeach 
@endcomponent

<hr>
@component('mail::panel')
<h4 style="color:black">Job Placement</h4>
@endcomponent

@component('mail::table')
|Branch | Placed Youths |
|:-------------|:--------|
@foreach($data['placement'] as $d)
  {{$d->branch_name}} | {{$d->count}}             
@endforeach 
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
