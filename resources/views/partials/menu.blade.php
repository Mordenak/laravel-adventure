@section('menu')
<div style="text-align: left;">
	It is the 200th cycle in<br>
	the year of our lord 505?<br>
	<br>
	There is 1 active players online.
	<br><br>
	<span style="color: #00FFFF">
		<strong>Menu:</strong>
	</span>
	<form method="post" action="/game" class="ajax">
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
		<label for="equipment">Equipment</label>
		<input type="submit" id="equipment" style="display: none;">
	</form>
	<form method="post" action="/food" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="food">Food</label>
		<input type="submit" id="food" style="display: none;">
	</form>	
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
</div>
@endsection