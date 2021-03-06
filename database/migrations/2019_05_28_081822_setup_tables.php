<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('operations', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->string('name');
		// 	$table->string('type')->nullable();
		// 	$table->string('shortcut')->nullable();
		// 	$table->text('description')->nullable();
		// 	$table->timestamps();
		// });

		Schema::create('world', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('cycle');
			$table->integer('year');
			$table->timestamps();
			});

		Schema::create('zones', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('uid')->unique()->nullable();
			$table->string('name');
			$table->text('travel_text');
			$table->text('description')->nullable();
			$table->string('img_src')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('font_color')->nullable();
			$table->string('label_color')->nullable();
			$table->string('custom_view')->nullable();
			$table->timestamps();
		});

		Schema::create('zone_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('format')->nullable();
			$table->string('custom_view')->nullable();
			$table->timestamps();
		});

		Schema::create('zone_to_zone_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('zone_properties_id');
			$table->foreign('zone_properties_id')->references('id')->on('zone_properties');
			$table->jsonb('data');
			$table->timestamps();
		});

		Schema::create('zone_levels', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('level');
			$table->string('name')->nullable();
			$table->boolean('inherit_creatures')->default(true);
			$table->boolean('inherit_properties')->default(true);
			$table->text('description')->nullable();
			$table->string('img_src')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('font_color')->nullable();
			$table->string('label_color')->nullable();
			$table->string('custom_view')->nullable();
			$table->timestamps();
		});

		Schema::create('zone_level_to_zone_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('level');
			$table->integer('zone_properties_id');
			$table->foreign('zone_properties_id')->references('id')->on('zone_properties');
			$table->jsonb('data');
			$table->timestamps();
		});

		Schema::create('zone_areas', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->string('uid')->unique()->nullable();
			$table->string('name');
			$table->text('travel_text')->nullable();
			$table->text('description')->nullable();
			$table->boolean('inherit_creatures')->default(true);
			$table->boolean('inherit_properties')->default(true);
			$table->string('bg_color')->nullable();
			$table->string('bg_img')->nullable();
			$table->string('font_color')->nullable();
			$table->string('label_color')->nullable();
			$table->string('custom_view')->nullable();
			$table->timestamps();
		});

		// Schema::create('zone_area_to_zone_properties', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->integer('zone_areas_id');
		// 	$table->foreign('zone_areas_id')->references('id')->on('zone_areas');
		// 	$table->integer('zone_properties_id');
		// 	$table->foreign('zone_properties_id')->references('id')->on('zone_properties');
		// 	$table->jsonb('data');
		// 	$table->timestamps();
		// });

		Schema::create('zone_layouts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('seq');
			$table->string('rooms_array')->nullable();
			$table->timestamps();
		});

		Schema::create('room_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('format')->nullable();
			$table->string('custom_view')->nullable();
			$table->text('description')->nullable();
			$table->timestamps();
		});

		Schema::create('rooms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('zone_level')->default(0);
			$table->integer('zone_areas_id')->nullable();
			$table->foreign('zone_areas_id')->references('id')->on('zone_areas');
			$table->string('uid')->nullable();
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->text('custom_view')->nullable();
			$table->integer('darkness_level')->nullable();
			$table->string('img_src')->nullable();
			$table->boolean('spawns_enabled')->default(true);
			$table->boolean('inherit_creatures')->default(true);
			$table->boolean('inherit_properties')->default(true);
			$table->integer('north_rooms_id')->nullable();
			$table->foreign('north_rooms_id')->references('id')->on('rooms');
			$table->integer('east_rooms_id')->nullable();
			$table->foreign('east_rooms_id')->references('id')->on('rooms');
			$table->integer('south_rooms_id')->nullable();
			$table->foreign('south_rooms_id')->references('id')->on('rooms');
			$table->integer('west_rooms_id')->nullable();
			$table->foreign('west_rooms_id')->references('id')->on('rooms');
			$table->integer('up_rooms_id')->nullable();
			$table->foreign('up_rooms_id')->references('id')->on('rooms');
			$table->integer('down_rooms_id')->nullable();
			$table->foreign('down_rooms_id')->references('id')->on('rooms');
			$table->integer('northeast_rooms_id')->nullable();
			$table->foreign('northeast_rooms_id')->references('id')->on('rooms');
			$table->integer('southeast_rooms_id')->nullable();
			$table->foreign('southeast_rooms_id')->references('id')->on('rooms');
			$table->integer('southwest_rooms_id')->nullable();
			$table->foreign('southwest_rooms_id')->references('id')->on('rooms');
			$table->integer('northwest_rooms_id')->nullable();
			$table->foreign('northwest_rooms_id')->references('id')->on('rooms');
			$table->integer('room_properties_id')->nullable();
			$table->foreign('room_properties_id')->references('id')->on('room_properties');
			$table->timestamps();
		});

		Schema::create('races', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('gender');
			$table->timestamps();
		});

		Schema::create('alignments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('color');
			$table->boolean('selectable');
			$table->timestamps();
		});

		Schema::create('stat_costs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('races_id');
			$table->foreign('races_id')->references('id')->on('races');
			$table->float('strength_cost')->default(1.0);
			$table->float('dexterity_cost')->default(1.0);
			$table->float('constitution_cost')->default(1.0);
			$table->float('wisdom_cost')->default(1.0);
			$table->float('intelligence_cost')->default(1.0);
			$table->float('charisma_cost')->default(1.0);
			$table->timestamps();
		});

		Schema::create('starting_stats', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('races_id');
			$table->foreign('races_id')->references('id')->on('races');
			$table->integer('strength')->default(20);
			$table->integer('dexterity')->default(20);
			$table->integer('constitution')->default(20);
			$table->integer('wisdom')->default(20);
			$table->integer('intelligence')->default(20);
			$table->integer('charisma')->default(20);
			$table->timestamps();
		});

		Schema::create('item_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('table_name');
			$table->string('model_name');
			$table->timestamps();
		});

		Schema::create('items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('item_types_id');
			$table->foreign('item_types_id')->references('id')->on('item_types');
			$table->bigInteger('value')->nullable();
			$table->float('weight')->nullable();
			$table->float('is_stackable')->default(false);
			$table->float('drops_on_death')->default(true);
			$table->integer('score_req')->nullable();
			$table->timestamps();
		});

		Schema::create('item_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('format')->nullable();
			$table->text('description')->nullable();
			$table->timestamps();
		});

		Schema::create('item_to_item_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('item_properties_id');
			$table->foreign('item_properties_id')->references('id')->on('item_properties');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->jsonb('data');
			$table->timestamps();
		});

		Schema::create('weapon_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('item_weapons', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('weapon_types_id');
			$table->foreign('weapon_types_id')->references('id')->on('weapon_types');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('equipment_slot');
			$table->string('attack_text');
			$table->integer('damage_low');
			$table->integer('damage_high');
			$table->float('fatigue_use');
			$table->float('accuracy')->default(0.8);
			$table->float('crit_chance')->nullable();
			$table->string('required_stat')->nullable();
			$table->integer('required_amount')->nullable();
			$table->timestamps();
		});

		Schema::create('item_armors', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('equipment_slot');
			$table->integer('armor');
			$table->integer('strength_bonus')->nullable();
			$table->integer('dexterity_bonus')->nullable();
			$table->integer('constitution_bonus')->nullable();
			$table->integer('wisdom_bonus')->nullable();
			$table->integer('intelligence_bonus')->nullable();
			$table->integer('charisma_bonus')->nullable();
			$table->timestamps();
		});

		Schema::create('item_accessories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('equipment_slot');
			$table->integer('strength_bonus')->nullable();
			$table->integer('dexterity_bonus')->nullable();
			$table->integer('constitution_bonus')->nullable();
			$table->integer('wisdom_bonus')->nullable();
			$table->integer('intelligence_bonus')->nullable();
			$table->integer('charisma_bonus')->nullable();
			$table->timestamps();
		});

		Schema::create('item_foods', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->integer('potency');
			$table->timestamps();
		});

		Schema::create('item_jewels', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->timestamps();
		});

		Schema::create('item_dusts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			// TODO: Remove duplicate name for now?  Consider re-adding?
			// $table->string('name');
			$table->timestamps();
		});

		// ???
		// Schema::create('item_scrolls', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->integer('items_id');
		// 	$table->foreign('items_id')->references('id')->on('items');
		// 	$table->timestamps();
		// });

		Schema::create('item_others', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->timestamps();
		});

		Schema::create('equipment_slots', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('guilds', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('rooms_id')->nullable();
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->text('description')->nullable();
			$table->string('custom_view')->nullable();
			$table->timestamps();
		});

		Schema::create('characters', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('users_id');
			$table->foreign('users_id')->references('id')->on('users');
			$table->string('name')->unique();
			$table->integer('races_id');
			$table->foreign('races_id')->references('id')->on('races');
			$table->integer('last_rooms_id');
			$table->foreign('last_rooms_id')->references('id')->on('rooms');
			$table->integer('alignments_id')->nullable();
			$table->foreign('alignments_id')->references('id')->on('alignments');
			$table->integer('guilds_id')->nullable();
			$table->foreign('guilds_id')->references('id')->on('guilds');
			$table->integer('guild_rank')->nullable();
			$table->bigInteger('xp');
			$table->bigInteger('gold');
			$table->bigInteger('bank');
			$table->integer('health');
			$table->integer('max_health');
			$table->float('mana');
			$table->integer('max_mana');
			// I know this is strange:
			$table->float('fatigue');
			$table->integer('max_fatigue');
			$table->integer('strength');
			$table->integer('dexterity');
			$table->integer('constitution');
			$table->integer('wisdom');
			$table->integer('intelligence');
			$table->integer('charisma');
			$table->integer('quest_points')->default(0);
			$table->integer('score');
			$table->integer('death_count')->default(0);
			$table->timestamps();
		});

		// TODO: Neat idea that may not become relevant?
		// Will need to track 'RoomActions' in here somehow:
		Schema::create('zone_instances', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			// Maybe throw some sort of UID on this?
			$table->integer('expires_on')->nullable();
			$table->timestamps();
		});

		// TODO: Redo this?
		Schema::create('inventories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->timestamps();
		});

		Schema::create('inventory_items',function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('inventory_id');
			$table->foreign('inventory_id')->references('id')->on('inventories');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('quantity')->default(1);
			$table->timestamps();
		});

		Schema::create('inventory_item_to_item_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('item_properties_id');
			$table->foreign('item_properties_id')->references('id')->on('item_properties');
			$table->integer('inventory_items_id');
			$table->foreign('inventory_items_id')->references('id')->on('inventory_items');
			$table->jsonb('data');
			$table->timestamps();
		});

		Schema::create('ground_items',function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('expires_on');
			$table->timestamps();
		});

		Schema::create('ground_item_to_item_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('item_properties_id');
			$table->foreign('item_properties_id')->references('id')->on('item_properties');
			$table->integer('ground_items_id');
			$table->foreign('ground_items_id')->references('id')->on('ground_items');
			$table->jsonb('data');
			$table->timestamps();
		});

		Schema::create('equipment', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('weapon')->nullable();
			$table->foreign('weapon')->references('id')->on('inventory_items');
			$table->integer('shield')->nullable();
			$table->foreign('shield')->references('id')->on('inventory_items');
			$table->integer('head')->nullable();
			$table->foreign('head')->references('id')->on('inventory_items');
			$table->integer('neck')->nullable();
			$table->foreign('neck')->references('id')->on('inventory_items');
			$table->integer('chest')->nullable();
			$table->foreign('chest')->references('id')->on('inventory_items');
			$table->integer('legs')->nullable();
			$table->foreign('legs')->references('id')->on('inventory_items');
			$table->integer('hands')->nullable();
			$table->foreign('hands')->references('id')->on('inventory_items');
			$table->integer('feet')->nullable();
			$table->foreign('feet')->references('id')->on('inventory_items');
			$table->integer('amulet')->nullable();
			$table->foreign('amulet')->references('id')->on('inventory_items');
			$table->integer('left_ring')->nullable();
			$table->foreign('left_ring')->references('id')->on('inventory_items');
			$table->integer('right_ring')->nullable();
			$table->foreign('right_ring')->references('id')->on('inventory_items');
			$table->integer('bracelet')->nullable();
			$table->foreign('bracelet')->references('id')->on('inventory_items');
			$table->timestamps();
		});

		Schema::create('forges', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('custom_view')->nullable();
			$table->timestamps();
		});

		Schema::create('forge_recipes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('forges_id')->nullable();
			$table->foreign('forges_id')->references('id')->on('forges');
			$table->integer('item_weapons_id');
			$table->foreign('item_weapons_id')->references('id')->on('items');
			$table->integer('item_armors_id');
			$table->foreign('item_armors_id')->references('id')->on('items');
			$table->integer('item_foods_id');
			$table->foreign('item_foods_id')->references('id')->on('items');
			$table->integer('item_jewels_id');
			$table->foreign('item_jewels_id')->references('id')->on('items');
			$table->integer('item_dusts_id');
			$table->foreign('item_dusts_id')->references('id')->on('items');
			$table->integer('alignments_id')->nullable();
			$table->foreign('alignments_id')->references('id')->on('alignments');
			$table->integer('guilds_id')->nullable();
			$table->foreign('guilds_id')->references('id')->on('guilds');
			$table->string('name')->nullable();
			$table->integer('result_items_id');
			$table->foreign('result_items_id')->references('id')->on('items');
			$table->timestamps();
		});

		Schema::create('traders', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->string('name');
			$table->text('description')->nullable();
			$table->boolean('trades_weapons')->default(false);
			$table->boolean('trades_armors')->default(false);
			$table->boolean('trades_accessories')->default(false);
			$table->boolean('trades_foods')->default(false);
			$table->boolean('trades_jewels')->default(false);
			$table->boolean('trades_dusts')->default(false);
			$table->boolean('trades_others')->default(false);
			$table->timestamps();
		});

		Schema::create('trader_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('traders_id');
			$table->foreign('traders_id')->references('id')->on('traders');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->integer('from_characters_id');
			$table->foreign('from_characters_id')->references('id')->on('characters');
			$table->timestamps();
		});

		Schema::create('creatures', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('attack_text')->nullable();
			$table->string('img_src')->nullable();
			$table->boolean('is_hostile')->default(false);
			$table->boolean('is_blocking')->default(false);
			$table->integer('alignments_id')->nullable();
			$table->foreign('alignments_id')->references('id')->on('alignments');
			$table->float('alignment_strength')->nullable();
			$table->integer('health');
			$table->integer('armor');
			$table->float('magic_resistance');
			$table->float('scroll_resistance');
			$table->integer('damage_low');
			$table->integer('damage_high');
			$table->integer('attacks_per_round');
			$table->integer('award_xp');
			$table->float('xp_variation')->default(0.10);
			$table->integer('award_gold');
			$table->float('gold_variation')->default(0.375);
			$table->timestamps();
		});

		Schema::create('creature_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('format')->nullable();
			$table->string('custom_view')->nullable();
			$table->timestamps();
		});

		Schema::create('creature_to_creature_properties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('creatures_id');
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->integer('creature_properties_id');
			$table->foreign('creature_properties_id')->references('id')->on('creature_properties');
			$table->jsonb('data');
			$table->timestamps();
		});

		Schema::create('creature_groups', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->timestamps();
		});

		Schema::create('creature_to_creature_groups', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('creatures_id');
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->integer('creature_groups_id');
			$table->foreign('creature_groups_id')->references('id')->on('creature_groups');
			$table->integer('weight')->nullable();
			$table->integer('priority')->nullable();
			$table->integer('score_req')->nullable();
			$table->timestamps();
		});

		Schema::create('spawn_rules', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('creatures_id')->nullable();
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->integer('creature_groups_id')->nullable();
			$table->foreign('creature_groups_id')->references('id')->on('creature_groups');
			$table->integer('zones_id')->nullable();
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->integer('zone_level')->nullable();
			$table->integer('zone_areas_id')->nullable();
			$table->foreign('zone_areas_id')->references('id')->on('zone_areas');
			$table->integer('rooms_id')->nullable();
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->float('chance')->nullable();
			$table->integer('spawn_hour')->nullable();
			$table->boolean('random_hour')->default(false);
			$table->integer('priority')->nullable();
			$table->integer('score_req')->nullable();
			$table->boolean('spawns_once')->default(false);
			$table->timestamps();
		});

		// TODO: SpawnRules replacements:
		// Schema::create('creature_group_spawns', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->integer('creature_groups_id');
		// 	$table->foreign('creature_groups_id')->references('id')->on('creature_groups');
		// 	$table->integer('zones_id')->nullable();
		// 	$table->foreign('zones_id')->references('id')->on('zones');
		// 	$table->integer('zone_level')->nullable();
		// 	$table->integer('zone_areas_id')->nullable();
		// 	$table->foreign('zone_areas_id')->references('id')->on('zone_areas');
		// 	$table->integer('rooms_id')->nullable();
		// 	$table->foreign('rooms_id')->references('id')->on('rooms');
		// 	$table->integer('spawn_hour')->nullable();
		// 	$table->boolean('random_hour')->default(false);
		// 	$table->timestamps();
		// 	});

		// Schema::create('creature_spawns', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->integer('creatures_id');
		// 	$table->foreign('creatures_id')->references('id')->on('creatures');
		// 	$table->integer('zones_id')->nullable();
		// 	$table->foreign('zones_id')->references('id')->on('zones');
		// 	$table->integer('zone_level')->nullable();
		// 	$table->integer('zone_areas_id')->nullable();
		// 	$table->foreign('zone_areas_id')->references('id')->on('zone_areas');
		// 	$table->integer('rooms_id')->nullable();
		// 	$table->foreign('rooms_id')->references('id')->on('rooms');
		// 	$table->float('chance')->nullable();
		// 	$table->integer('spawn_hour')->nullable();
		// 	$table->boolean('random_hour')->default(false);
		// 	$table->integer('priority')->nullable();
		// 	$table->integer('score_req')->nullable();
		// 	$table->boolean('spawns_once')->default(false);
		// 	$table->timestamps();
		// });

		Schema::create('loot_tables', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('creatures_id')->nullable();
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->float('chance');
			$table->boolean('prevent_others')->default(false);
			$table->timestamps();
		});

		Schema::create('character_settings',function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('refresh_rate')->default(60);
			$table->boolean('brief_mode')->default(false);
			$table->boolean('life_gauge')->default(true);
			$table->boolean('mana_gauge')->default(true);
			$table->boolean('fatigue_gauge')->default(true);
			$table->integer('food_sort')->default(0);
			$table->boolean('number_commas')->default(false);
			$table->boolean('creature_images')->default(true);
			$table->timestamps();
		});

		Schema::create('shops', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->string('name');
			$table->text('description')->nullable();
			$table->boolean('buys_weapons')->default(false);
			$table->boolean('buys_armors')->default(false);
			$table->boolean('buys_accessories')->default(false);
			$table->boolean('buys_foods')->default(false);
			$table->boolean('buys_jewels')->default(false);
			$table->boolean('buys_dusts')->default(false);
			$table->boolean('buys_others')->default(false);
			$table->timestamps();
		});

		Schema::create('shop_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('shops_id');
			$table->foreign('shops_id')->references('id')->on('shops');
			$table->integer('items_id');
			$table->foreign('items_id')->references('id')->on('items');
			$table->bigInteger('price')->nullable();
			$table->float('markup')->default(2.0);
			$table->timestamps();
		});

		Schema::create('quests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('pickup_message')->nullable();
			$table->string('completion_message')->nullable();
			$table->boolean('optional')->default(false);
			$table->integer('wisdom_req')->default(0);
			$table->integer('intelligence_req')->default(0);
			$table->integer('score_req')->default(0);
			$table->string('progression_req')->nullable();
			$table->integer('quest_prereq')->nullable();
			$table->foreign('quest_prereq')->references('id')->on('quests');
			$table->integer('pickup_rooms_id')->nullable();
			$table->foreign('pickup_rooms_id')->references('id')->on('rooms');
			$table->integer('turnin_rooms_id')->nullable();
			$table->foreign('turnin_rooms_id')->references('id')->on('rooms');
			$table->timestamps();
		});

		Schema::create('quest_tasks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->string('uid')->nullable();
			$table->string('name')->nullable();
			$table->string('log_entry')->nullable();
			$table->string('pickup_message')->nullable();
			$table->string('completion_message')->nullable();
			$table->integer('seq')->nullable();
			$table->timestamps();
		});
		
		Schema::create('quest_rewards', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->integer('item_reward')->nullable();
			$table->foreign('item_reward')->references('id')->on('items');
			$table->bigInteger('xp_reward')->nullable();
			$table->bigInteger('gold_reward')->nullable();
			$table->bigInteger('quest_point_reward')->nullable();
			// comma separate string list of item rewards, pick 1
			$table->string('item_choices')->nullable();
			$table->timestamps();
		});

		Schema::create('character_quests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->boolean('complete')->default(false);
			$table->boolean('rewarded')->default(false);
			$table->timestamps();
		});

		// One size fits all spatula
		Schema::create('room_actions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('redirect_room')->nullable();
			$table->foreign('redirect_room')->references('id')->on('rooms');
			$table->string('uid')->nullable();
			$table->text('description')->nullable();
			$table->string('action')->nullable();
			$table->string('failed_action')->nullable();
			$table->string('success_action')->nullable();
			$table->string('display')->nullable();
			// comma seperated list of blocked directions until the action is performed?
			$table->string('directions_blocked')->nullable();
			$table->boolean('show_on_req')->default(false);
			$table->boolean('remember')->default(false);
			$table->integer('expires_after')->nullable();
			$table->integer('has_item')->nullable();
			$table->foreign('has_item')->references('id')->on('items');
			$table->integer('completed_quest')->nullable();
			$table->foreign('completed_quest')->references('id')->on('quests');
			$table->integer('completed_quest_task')->nullable();
			$table->foreign('completed_quest_task')->references('id')->on('quest_tasks');
			$table->integer('strength_req')->default(0)->nullable();
			$table->integer('dexterity_req')->default(0)->nullable();
			$table->integer('constitution_req')->default(0)->nullable();
			$table->integer('wisdom_req')->default(0)->nullable();
			$table->integer('intelligence_req')->default(0)->nullable();
			$table->integer('charisma_req')->default(0)->nullable();
			$table->integer('score_req')->default(0)->nullable();
			$table->timestamps();
		});

		Schema::create('character_room_actions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('room_actions_id');
			$table->foreign('room_actions_id')->references('id')->on('room_actions');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('expires_after')->nullable();
			$table->timestamps();
		});

		Schema::create('quest_criterias', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quest_tasks_id');
			$table->foreign('quest_tasks_id')->references('id')->on('quest_tasks');
			$table->string('name')->nullable(); // ???
			$table->text('description')->nullable(); // ???
			$table->integer('zone_target')->nullable();
			$table->foreign('zone_target')->references('id')->on('zones');
			$table->integer('room_target')->nullable();
			$table->foreign('room_target')->references('id')->on('rooms');
			$table->integer('room_action_target')->nullable();
			$table->foreign('room_action_target')->references('id')->on('room_actions');
			$table->integer('item_target')->nullable();
			$table->foreign('item_target')->references('id')->on('items');
			$table->integer('creature_target')->nullable();
			$table->foreign('creature_target')->references('id')->on('creatures');
			$table->integer('creature_room_target')->nullable();
			$table->foreign('creature_room_target')->references('id')->on('rooms');
			$table->integer('alignment_target')->nullable();
			$table->foreign('alignment_target')->references('id')->on('alignments');
			$table->integer('creature_amount')->nullable();
			$table->timestamps();
		});

		Schema::create('character_quest_criterias', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quest_criterias_id');
			$table->foreign('quest_criterias_id')->references('id')->on('quest_criterias');
			$table->integer('character_quests_id');
			$table->foreign('character_quests_id')->references('id')->on('character_quests');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('progress')->nullable();
			$table->boolean('complete')->default(false);
			$table->timestamps();
		});
		
		Schema::create('spell_types', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->timestamps();
		});

		Schema::create('spells', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('spell_types_id');
			$table->foreign('spell_types_id')->references('id')->on('spell_types');
			$table->text('description')->nullable();
			$table->string('formula')->nullable();
			$table->integer('duration')->nullable();
			$table->timestamps();
		});

		Schema::create('teleport_targets', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('spells_id');
			$table->foreign('spells_id')->references('id')->on('spells');
			$table->string('name');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('level_req')->nullable();
			$table->integer('wisdom_req')->nullable();
			$table->timestamps();
		});

		Schema::create('character_spells', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('spells_id');
			$table->foreign('spells_id')->references('id')->on('spells');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('level');
			$table->timestamps();
		});

		Schema::create('character_spell_buffs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('character_spells_id');
			$table->foreign('character_spells_id')->references('id')->on('character_spells');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('expires_on');
			$table->jsonb('buff');
			$table->timestamps();
		});

		Schema::create('racial_modifiers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->timestamps();
		});

		Schema::create('race_racial_modifiers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('racial_modifier_id');
			$table->foreign('racial_modifier_id')->references('id')->on('racial_modifiers');
			$table->integer('races_id');
			$table->foreign('races_id')->references('id')->on('races');
			$table->float('value');
			$table->timestamps();
		});		

		Schema::create('combat_logs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('creatures_id');
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->integer('rooms_id');
			$table->foreign('rooms_id')->references('id')->on('rooms');
			$table->integer('remaining_health');
			$table->integer('expires_on')->nullable();
			$table->timestamps();
		});

		Schema::create('kill_counts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('creatures_id');
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->bigInteger('count')->nullable();
			$table->timestamps();
		});

		Schema::create('creature_kills', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('creatures_id');
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->bigInteger('count');
			$table->timestamps();
		});

		Schema::create('graveyard', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->integer('creatures_id');
			$table->foreign('creatures_id')->references('id')->on('creatures');
			$table->integer('zones_id');
			$table->foreign('zones_id')->references('id')->on('zones');
			$table->timestamps();
		});

		Schema::create('wall_score_ranks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('color');
			$table->integer('score_req');
			$table->timestamps();
		});

		Schema::create('kill_ranks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('min_count');
			$table->timestamps();
		});

		Schema::create('spell_ranks', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('min_count');
			$table->timestamps();
		});

		// Deprecate 8/24: Rooms will only have 1 special property each:
		// Schema::create('room_property_rooms', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->integer('rooms_id');
		// 	$table->foreign('rooms_id')->references('id')->on('rooms');
		// 	$table->integer('room_properties_id');
		// 	$table->foreign('room_properties_id')->references('id')->on('room_properties');
		// 	$table->timestamps();
		// });

		// This is a cheat until I can do something better::
		// Schema::create('game_progression', function (Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->integer('characters_id');
		// 	$table->foreign('characters_id')->references('id')->on('characters');
		// 	$table->boolean('sewer_lifted')->default(false);
		// 	$table->boolean('park_ranger')->default(false);
		// 	$table->timestamps();
		// });

		Schema::create('chat_rooms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->integer('score_req')->nullable();
			$table->timestamps();
		});

		Schema::create('chat_room_messages', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('chat_rooms_id');
			$table->foreign('chat_rooms_id')->references('id')->on('chat_rooms');
			$table->integer('characters_id');
			$table->foreign('characters_id')->references('id')->on('characters');
			$table->string('message');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('wall_score_ranks');
		Schema::dropIfExists('kill_ranks');
		Schema::dropIfExists('spell_ranks');
		Schema::dropIfExists('race_racial_modifiers');
		Schema::dropIfExists('racial_modifiers');
		Schema::dropIfExists('character_stats');
		Schema::dropIfExists('stat_costs');
		Schema::dropIfExists('starting_stats');
		Schema::dropIfExists('equipment');
		Schema::dropIfExists('spawn_rules');
		Schema::dropIfExists('loot_tables');
		Schema::dropIfExists('shop_items');
		Schema::dropIfExists('shops');
		Schema::dropIfExists('forge_recipes');
		Schema::dropIfExists('forges');
		Schema::dropIfExists('trader_items');
		Schema::dropIfExists('traders');
		Schema::dropIfExists('item_weapons');
		Schema::dropIfExists('weapon_types');
		// legacy
		Schema::dropIfExists('item_consumables');
		Schema::dropIfExists('item_foods');
		Schema::dropIfExists('item_armors');
		Schema::dropIfExists('item_accessories');
		Schema::dropIfExists('item_jewels');
		Schema::dropIfExists('item_dusts');
		Schema::dropIfExists('item_others');
		Schema::dropIfExists('item_property_items');
		Schema::dropIfExists('item_to_item_properties');
		Schema::dropIfExists('inventory_item_to_item_properties');
		Schema::dropIfExists('ground_item_to_item_properties');
		Schema::dropIfExists('item_properties');
		Schema::dropIfExists('inventory_items');
		Schema::dropIfExists('ground_items');
		Schema::dropIfExists('inventories');
		
		Schema::dropIfExists('quest_rewards');
		Schema::dropIfExists('character_room_actions');
		Schema::dropIfExists('character_settings');
		Schema::dropIfExists('character_quest_criterias');
		Schema::dropIfExists('character_quests');
		Schema::dropIfExists('quest_criterias');
		Schema::dropIfExists('chat_room_messages');
		Schema::dropIfExists('chat_rooms');
		// another legacy add:
		Schema::dropIfExists('quest_criteria');
		Schema::dropIfExists('room_actions');
		Schema::dropIfExists('items');
		Schema::dropIfExists('item_types');
		Schema::dropIfExists('equipment_slots');
		Schema::dropIfExists('max_values');
		// Schema::dropIfExists('creature_stats');
		Schema::dropIfExists('damage_types');
		Schema::dropIfExists('reward_tables');
		// Schema::dropIfExists('user_settings');
		// Schema::dropIfExists('character_spells');
		Schema::dropIfExists('combat_logs');
		Schema::dropIfExists('kill_counts');
		Schema::dropIfExists('creature_kills');
		Schema::dropIfExists('graveyard');
		Schema::dropIfExists('creature_to_creature_properties');
		Schema::dropIfExists('creature_properties');
		Schema::dropIfExists('creature_to_creature_groups');
		Schema::dropIfExists('creature_groups');
		Schema::dropIfExists('creatures');
		Schema::dropIfExists('zone_instances');
		Schema::dropIfExists('game_progression');
		Schema::dropIfExists('spell_property_spells');
		Schema::dropIfExists('spells_to_spell_properties');
		Schema::dropIfExists('spell_levels');
		Schema::dropIfExists('character_spell_buffs');
		Schema::dropIfExists('character_spells');
		Schema::dropIfExists('teleport_targets');
		Schema::dropIfExists('spells');
		Schema::dropIfExists('spell_types');
		Schema::dropIfExists('spell_properties');
		Schema::dropIfExists('characters');
		Schema::dropIfExists('alignments');
		Schema::dropIfExists('quest_tasks');
		Schema::dropIfExists('quests');
		// Schema::dropIfExists('quest_criteria_quests');

		Schema::dropIfExists('room_property_rooms');
		Schema::dropIfExists('guilds');
		Schema::dropIfExists('rooms');
		Schema::dropIfExists('room_properties');
		Schema::dropIfExists('zone_level_to_zone_properties');
		Schema::dropIfExists('zone_levels');
		Schema::dropIfExists('zone_layouts');
		Schema::dropIfExists('zone_area_to_zone_properties');
		Schema::dropIfExists('zone_areas');
		Schema::dropIfExists('zone_rotations');
		Schema::dropIfExists('zone_property_zone_levels');
		Schema::dropIfExists('zone_property_zones');
		Schema::dropIfExists('zone_to_zone_properties');
		Schema::dropIfExists('zone_properties');
		Schema::dropIfExists('properties');
		Schema::dropIfExists('world');
		Schema::dropIfExists('zone_layouts');
		Schema::dropIfExists('zones');
		// legacy
		Schema::dropIfExists('player_races');
		Schema::dropIfExists('races');
	}
}
