<div>
   @foreach($locations as $location)
   		<tr>
   			<td>{{$location->DSD_Name}}</td>
   			<td>{{$location->total}}</td>
   			<td></td>
   		</tr>
   @endforeach
</div>
v