<span style="color: #00FFFF">
	<strong>Equipment</strong>
</span>
<br><br>
@if( Session::has("errors") )
<p style="color: red;display: inline;">
{{ Session::pull("errors") }}
<p>
@endif
@if ($character)
<form method="post" action="/equipment" class="ajax" id="equip">
	Weapon:<br>
	<select name="equipment[weapon]">
		<option value="0">-- Nothing --</option>
		@foreach ($weapons as $weapon)
		<option value="{{$weapon['id']}}" {{ $weapon['selected'] ? 'selected' : '' }} >{{$weapon['name']}}</option>
		@endforeach
	</select><br>
	Shield:<br>
	<select name="equipment[shield]">
		<option value="0">-- Nothing --</option>
		@foreach ($shields as $shield)
		<option value="{{$shield['id']}}" {{ $shield['selected'] ? 'selected' : '' }} >{{$shield['name']}}</option>
		@endforeach
	</select><br>
	Head:<br>
	<select name="equipment[head]">
		<option value="0">-- Nothing --</option>
		@foreach ($heads as $head)
		<option value="{{$head['id']}}" {{ $head['selected'] ? 'selected' : '' }} >{{$head['name']}}</option>
		@endforeach
	</select><br>
	Neck:<br>
	<select name="equipment[neck]">
		<option value="0">-- Nothing --</option>
		@foreach ($necks as $neck)
		<option value="{{$neck['id']}}" {{ $neck['selected'] ? 'selected' : '' }} >{{$neck['name']}}</option>
		@endforeach
	</select><br>
	Chest:<br>
	<select name="equipment[chest]">
		<option value="0">-- Nothing --</option>
		@foreach ($chests as $chest)
		<option value="{{$chest['id']}}" {{ $chest['selected'] ? 'selected' : '' }} >{{$chest['name']}}</option>
		@endforeach
	</select><br>
	Hands:<br>
	<select name="equipment[hands]">
		<option value="0">-- Nothing --</option>
		@foreach ($hands as $hand)
		<option value="{{$hand['id']}}" {{ $hand['selected'] ? 'selected' : '' }} >{{$hand['name']}}</option>
		@endforeach
	</select><br>
	Legs:<br>
	<select name="equipment[legs]">
		<option value="0">-- Nothing --</option>
		@foreach ($legs as $leg)
		<option value="{{$leg['id']}}" {{ $leg['selected'] ? 'selected' : '' }} >{{$leg['name']}}</option>
		@endforeach
	</select><br>
	Feet:<br>
	<select name="equipment[feet]">
		<option value="0">-- Nothing --</option>
		@foreach ($feets as $feet)
		<option value="{{$feet['id']}}" {{ $feet['selected'] ? 'selected' : '' }} >{{$feet['name']}}</option>
		@endforeach
	</select><br>
	-- Accessories --<br>
	Neck:<br>
	<select name="equipment[amulet]">
		<option value="0">-- Nothing --</option>
		@foreach ($amulets as $amulet)
		<option value="{{$amulet['id']}}" {{ $amulet['selected'] ? 'selected' : '' }} >{{$amulet['name']}}</option>
		@endforeach
	</select><br>
	Left Ring:<br>
	<select name="equipment[left_ring]">
		<option value="0">-- Nothing --</option>
		@foreach ($left_rings as $ring)
		<option value="{{$ring['id']}}" {{ $ring['selected'] ? 'selected' : '' }} >{{$ring['name']}}</option>
		@endforeach
	</select><br>
	Right Ring:<br>
	<select name="equipment[right_ring]">
		<option value="0">-- Nothing --</option>
		@foreach ($right_rings as $ring)
		<option value="{{$ring['id']}}" {{ $ring['selected'] ? 'selected' : '' }} >{{$ring['name']}}</option>
		@endforeach
	</select><br>
	Bracelet:<br>
	<select name="equipment[bracelet]">
		<option value="0">-- Nothing --</option>
		@foreach ($bracelets as $bracelet)
		<option value="{{$bracelet['id']}}" {{ $bracelet['selected'] ? 'selected' : '' }} >{{$bracelet['name']}}</option>
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

<span style="color: #00FFFF">
	<strong>Menu:</strong>
</span>
<form method="post" action="/menu" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="back_home">Menu</label>
	<input type="submit" id="back_home" style="display: none;">
</form>
<form method="post" action="/show_stats" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="stats">Stats</label>
	<input type="submit" id="stats" style="display: none;">
</form>
<form method="post" action="/equipment" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="equipment" class="disabled" disabled>Equipment</label>
	<input type="submit" id="equipment" style="display: none;">
</form>
<form method="post" action="/food" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="food">Food</label>
	<input type="submit" id="food" style="display: none;">
</form>
@if ($character->spells())
<form method="post" action="/spells" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="spells">Spells</label>
	<input type="submit" id="spells" style="display: none;">
</form>	
@endif
<form method="post" action="/settings" class="ajax">
	{{csrf_field()}}
	<input type="hidden" name="character_id" value="{{$character->id}}">
	<label for="settings">Options</label>
	<input type="submit" id="settings" style="display: none;">
</form>
<br><br>
<form method="get" action="/home">
	{{csrf_field()}}
	<label for="char_select">Logout</label>
	<input type="submit" id="char_select" style="display: none;">
</form>