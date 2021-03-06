<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestData extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Starts @ id 5
		DB::table('quests')->insert([
			['name' => 'Clear the Beach', 'pickup_message' => 'WIP: Help me clear out the beach.', 'completion_message' => 'WIP: Thanks for clearing out those crabs!', 'optional' => false, 'wisdom_req' => 0, 'intelligence_req' => 0, 'score_req' => 0, 'progression_req' => null, 'quest_prereq' => null, 'pickup_rooms_id' => 23, 'turnin_rooms_id' => 23, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);

		DB::table('quest_tasks')->insert([
			['quests_id' => 1, 'uid' => 'clear_beach', 'name' => 'Clear the Beach', 'log_entry' => 'Gain entry to the Outskirts', 'pickup_message' => null, 'completion_message' => null, 'seq' => 1],
			]);

		DB::table('quest_criterias')->insert([
			['quest_tasks_id' => 1, 'name' => 'Clear the Beach', 'description' => null, 'zone_target' => 3, 'room_action_target' => null, 'item_target' => null, 'creature_target' => null, 'creature_room_target' => null, 'alignment_target' => null, 'creature_amount' => null]
			]);

		DB::table('quest_rewards')->insert([
			['quests_id' => 1, 'xp_reward' => 50000, 'gold_reward' => 100, 'quest_point_reward' => 5, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
			]);
	}
}
