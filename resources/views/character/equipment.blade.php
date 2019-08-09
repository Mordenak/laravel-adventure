

@if ($character)
<form method="post" action="/equipment" class="ajax" id="equip">
	Weapon:
	<select name="weapon">
		<option value="0">-- Nothing --</option>
		@foreach ($weapons as $weapon)
		<option value="{{$weapon['id']}}" {{ $weapon['selected'] ? 'selected' : '' }} >{{$weapon['name']}}</option>
		@endforeach
	</select><br>
	Head:
	<select name="head">
		<option value="0">-- Nothing --</option>
		@foreach ($heads as $head)
		<option value="{{$head['id']}}" {{ $head['selected'] ? 'selected' : '' }} >{{$head['name']}}</option>
		@endforeach
	</select><br>
	Chest:
	<select name="chest">
		<option value="0">-- Nothing --</option>
		@foreach ($chests as $chest)
		<option value="{{$chest['id']}}" {{ $chest['selected'] ? 'selected' : '' }} >{{$chest['name']}}</option>
		@endforeach
	</select><br>
	Legs:
	<select name="legs">
		<option value="0">-- Nothing --</option>
		@foreach ($legs as $leg)
		<option value="{{$leg['id']}}" {{ $leg['selected'] ? 'selected' : '' }} >{{$leg['name']}}</option>
		@endforeach
	</select><br>
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<input type="hidden" name="action" value="equip">
	{{csrf_field()}}
</form>
@endif

<script>
	$('#equip').on('change', 'select', function(e) {
		console.log('fire away');
		$(e.delegateTarget).submit();
	});
</script>

<form method="post" action="/game" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Main</label>
	<input type="submit" id="back_home" style="display: none;">
</form>