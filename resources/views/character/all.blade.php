@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@if ($characters)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>Record</th>
		<th>Name</th>
	</thead>
	<tbody>
		@foreach ($characters as $character)
		<tr>
			<td>{{$character->id}}</td>
			<td><a href="/character/edit/{{$character->id}}">{{$character->name}}</a></td>
			<td>{{$character->name}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection