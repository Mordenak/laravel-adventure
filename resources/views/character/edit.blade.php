@extends('layouts.admin')

@section('content')

@if (isset($character))
Editing a character:
@else
Creating a character:
@endif
<br>
<div>
	<form action="/character/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($character) ? $character->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Race:</label>
			<div class="col-md-3">
				<input type="text" name="player_races_id" value="{{isset($character) ? $character->player_races_id : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Alignment:</label>
			<div class="col-md-3">
				<input type="text" name="alignments_id" value="{{isset($character) ? $character->alignments_id : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Last Room:</label>
			<div class="col-md-3">
				<input type="text" name="last_rooms_id" value="{{isset($character) ? $character->last_rooms_id : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">XP:</label>
			<div class="col-md-3">
				<input type="text" name="xp" value="{{isset($character) ? $character->xp : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Gold:</label>
			<div class="col-md-3">
				<input type="text" name="gold" value="{{isset($character) ? $character->gold : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Bank:</label>
			<div class="col-md-3">
				<input type="text" name="bank" value="{{isset($character) ? $character->bank : ''}}" class="form-control">
			</div>
		</div>

		<h3>Stats</h3>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Health:</label>
			<div class="col-md-3">
				<input type="text" name="health" value="{{isset($character) ? $character->health : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Mana:</label>
			<div class="col-md-3">
				<input type="text" name="mana" value="{{isset($character) ? $character->mana : ''}}" class="form-control"> </div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Fatigue:</label>
			<div class="col-md-3">
				<input type="text" name="fatigue" value="{{isset($character) ? $character->fatigue : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Strength:</label>
			<div class="col-md-3">
				<input type="text" name="strength" value="{{isset($character) ? $character->strength : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Dexterity:</label>
			<div class="col-md-3">
				<input type="text" name="dexterity" value="{{isset($character) ? $character->dexterity : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Constitution:</label>
			<div class="col-md-3">
				<input type="text" name="constitution" value="{{isset($character) ? $character->constitution : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Wisdom:</label>
			<div class="col-md-3">
				<input type="text" name="wisdom" value="{{isset($character) ? $character->wisdom : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Intelligence:</label>
			<div class="col-md-3">
				<input type="text" name="intelligence" value="{{isset($character) ? $character->intelligence : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Charisma:</label>
			<div class="col-md-3">
				<input type="text" name="charisma" value="{{isset($character) ? $character->charisma : ''}}" class="form-control">
			</div>
		</div>

		@if (isset($character))
		<input type="hidden" name="id" id="db-id" value="{{$character->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/character/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
@endsection