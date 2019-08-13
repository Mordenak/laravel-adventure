<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemWeapon extends Model
{
	protected $fillable = ['items_id', 'name', 'equipment_slot', 'damage_low', 'damage_high', 'attack_text'];

	public function item()
		{
		return $this->belongsTo('App\Item');
		}
}
