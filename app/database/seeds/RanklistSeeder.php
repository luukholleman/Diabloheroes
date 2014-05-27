<?php

class RanklistSeeder extends Seeder{
	public function run()
	{
        $career = \Ranklist\Category::firstOrCreate([
			'name' => 'Career',
            'type' => 'career',
			'order' => 0
		]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $career->id,
				'name' => 'Paragon',
				'stat' => 'paragon',
			]);

            Ranklist::firstOrCreate([
                'ranklist_category_id' => $career->id,
                'name' => 'Elite kills',
                'stat' => 'eliteKills'
            ]);


		$general = \Ranklist\Category::firstOrCreate([
			'name' => 'General',
            'type' => 'hero',
			'order' => 1
		]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $general->id,
				'name' => 'DPS',
				'stat' => 'dps',
			]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $general->id,
				'name' => 'Heroscore',
				'stat' => 'heroscore',
			]);

		$core = \Ranklist\Category::firstOrCreate([
			'name' => 'Main',
            'type' => 'hero',
			'order' => 2
		]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $core->id,
				'name' => 'Armor',
				'stat' => 'armor',
			]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $core->id,
				'name' => 'Intelligence',
				'stat' => 'intelligence',
			]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $core->id,
				'name' => 'Dexterity',
				'stat' => 'dexterity',
			]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $core->id,
				'name' => 'Strength',
				'stat' => 'strength',
			]);

		$resistance = \Ranklist\Category::firstOrCreate([
			'name' => 'Resistance',
            'type' => 'hero',
			'order' => 3
		]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $resistance->id,
				'name' => 'Fire Resistance',
				'stat' => 'fireResistance',
			]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $resistance->id,
				'name' => 'Arcance Resistance',
				'stat' => 'arcaneResistance',
			]);

		$life = \Ranklist\Category::firstOrCreate([
			'name' => 'Life',
            'type' => 'hero',
			'order' => 4
		]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $life->id,
				'name' => 'Life',
				'stat' => 'life',
			]);

			Ranklist::firstOrCreate([
				'ranklist_category_id' => $life->id,
				'name' => 'Life on Hit',
				'stat' => 'lifeOnHit',
			]);
	}
} 