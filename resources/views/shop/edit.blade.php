@extends('layouts.admin')

@section('content')

@if (isset($shop))
Editing a shop:
@else
Creating a shop:
@endif
	
<div>
	<form action="/shop/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($shop) ? $shop->name : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($shop) ? $shop->description : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Room:</label>
			<div class="col-md-2">
				<input type="text" name="rooms_id" class="form-control room-lookup" placeholder="Lookup a room:" value="{{isset($shop) ? $shop->rooms_id : ''}}">
			</div>

			<label class="col-md-2 col-form-label text-md-right">Buys?</label>
			<div class="col-md-3">
				<div class="form-check">
					<input type="checkbox" name="buys_weapons" class="form-check-input" id="weapons" {{isset($shop) && $shop->buys_weapons ? 'checked' : ''}}>
					<label class="form-check-label" for="weapons">
						Weapons
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_armors" class="form-check-input" id="armor" {{isset($shop) && $shop->buys_armors ? 'checked' : ''}}>
					<label class="form-check-label" for="armor">
						Armor
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_accessories" class="form-check-input" id="accessories" {{isset($shop) && $shop->buys_accessories ? 'checked' : ''}}>
					<label class="form-check-label" for="accessories">
						Accessories
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_consumables" class="form-check-input" id="consumables" {{isset($shop) && $shop->buys_consumables ? 'checked' : ''}}>
					<label class="form-check-label" for="consumables">
						Consumables
					</label>
				</div>
				<div class="form-check">
					<input type="checkbox" name="buys_others" class="form-check-input" id="others" {{isset($shop) && $shop->buys_others ? 'checked' : ''}}>
					<label class="form-check-label" for="others">
						Others
					</label>
				</div>
			</div>
		</div>

		<!-- Items? -->
		<h3>Shop Items</h3>
		<a class="btn btn-secondary" onclick="addShopItem(this);">Add Shop Item</a>
		<br><br>

		<div class="shop-items">
			<div class="shop-forms">
			@if (isset($shop) && $shop->shop_items()->count() > 0)
				@foreach ($shop->shop_items() as $shop_item)
				<input type="hidden" name="shop_items[{{$shop_item->id}}][id]" value="{{$shop_item->id}}">
				<div class="form-group row">
					<label class="col-md-2 col-form-label text-md-right">Item:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[{{$shop_item->id}}][item_id]" value="{{$shop_item->item()->id}}" class="form-control item-lookup">
					</div>
					<label class="col-md-2 col-form-label text-md-right">Markup:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[{{$shop_item->id}}][markup]" value="{{$shop_item->markup}}" class="form-control">
					</div>
					<label class="col-md-2 col-form-label text-md-right">Price:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[{{$shop_item->id}}][price]" value="{{$shop_item->price}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-2 col-form-label text-md-right">Item:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[0][item_id]" class="form-control item-lookup">
					</div>
					<label class="col-md-2 col-form-label text-md-right">Markup:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[0][markup]" class="form-control">
					</div>
					<label class="col-md-2 col-form-label text-md-right">Price:</label>
					<div class="col-md-2">
						<input type="text" name="shop_items[0][price]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		@if (isset($shop))
		<input type="hidden" name="id" id="db-id" value="{{$shop->id}}">
		@endif

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-2">
				<a href="/shop/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-1">
				<input type="submit" value="Save" class="btn btn-primary" style="position: absolute;">
			</div>
		</div>
	</form>
</div>

@if (isset($shop))
<form method="post" action="/shop/delete">
	{{csrf_field()}}
	<input type="hidden" name="id" value="{{$shop->id}}">
	<input type="submit" value="Delete" class="btn btn-danger">
</form>
@endif

<script>
function addShopItem($btn)
	{
	var $tmp = $('.shop-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/shop_items\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/shop_items\[\d*\]/, 'shop_items['+new_id+']');
		$(this).attr('name', name);
		});

	$('.shop-forms').append($tmp);
	$('.shop-forms').last().find('input[name="id"]').remove();
	}
</script>
@endsection