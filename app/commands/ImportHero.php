<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportHero extends Command
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hero:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		try {
			$apiHero = new \Diabloheroes\D3api\Hero($this->argument('battletag'), $this->argument('hero_id'), $this->argument('region'));

			$apiHero->connector->cache = true;
			$apiHero->connector->cachingDir = app_path() . '/storage/api/';

			$apiHero->fetch();

			$hero = Hero::firstOrNew(['blizzard_id' => $apiHero->getId()]);

			if ($this->option('career') != null)
				$hero->career_region_id = $this->option('career');

			$hero->fill([
				'region' => $this->argument('region'),
				'name' => $apiHero->getName(),
				'gender' => $apiHero->getGender(),
				'klass' => new Klass($apiHero->getClass()),
				'level' => $apiHero->getLevel(),
				'hardcore' => $apiHero->getHardcore(),
				'dead' => $apiHero->getDead(),
				'last_played' => date('c', $apiHero->getLastUpdated()),
			]);

			$hero->save();

			foreach ($apiHero->getStats() as $name => $value) {
				$stat = Stat::firstOrCreate(['name' => $name]);

				$heroStat = \Hero\Stat::firstOrNew([
					'hero_id' => $hero->id,
					'stat_id' => $stat->id,
				]);

				$heroStat->value = $value;

				$heroStat->save();
			}

			$hero->destroySkillActives();

			foreach ($apiHero->getActiveSkills() as $apiSkillActive) {
				$skillActiveCategory = \Skill\Active\Category::firstOrCreate([
					'name' => $apiSkillActive->getCategorySlug()
				]);

				$skillActive = \Skill\Active::firstOrNew([
					'skill_active_category_id' => $skillActiveCategory->id,
					'slug' => $apiSkillActive->getSlug(),
				]);

				$skillActive->fill([
					'name' => $apiSkillActive->getName(),
					'icon' => $apiSkillActive->getIcon(),
					'level' => $apiSkillActive->getLevel(),
					'tooltip_url' => $apiSkillActive->getTooltipUrl(),
					'description' => $apiSkillActive->getDescription(),
					'simple_description' => $apiSkillActive->getSimpleDescription(),
					'skill_calc_id' => $apiSkillActive->getSkillCalcId()
				]);

				$skillActive->save();

				if ($apiSkillActive->hasRune()) {
					$apiRune = $apiSkillActive->getRune();

					$rune = Rune::firstOrNew([
						'slug' => $apiRune->getSlug()
					]);

					$rune->fill([
						'type' => $apiRune->getType(),
						'name' => $apiRune->getName(),
						'level' => $apiRune->getLevel(),
						'tooltip_url' => $apiRune->getTooltipUrl(),
						'description' => $apiRune->getDescription(),
						'simple_description' => $apiRune->getSimpleDescription(),
						'skill_calc_id' => $apiRune->getSkillCalcId(),
						'order' => $apiRune->getOrder()
					]);

					$rune->save();
				}

				$heroSkillActive = \Hero\Skill\Active::firstOrNew([
					'skill_active_id' => $skillActive->id,
					'hero_id' => $hero->id,
				]);

				if (isset($rune))
					$heroSkillActive->rune_id = $rune->id;

				$heroSkillActive->save();
			}

			foreach ($apiHero->getPassiveSkills() as $apiSkillPassive) {
				$skillPassive = \Skill\Passive::firstOrNew([
					'slug' => $apiSkillPassive->getSlug()
				]);

				$skillPassive->fill([
					'name' => $apiSkillPassive->getName(),
					'icon' => $apiSkillPassive->getIcon(),
					'level' => $apiSkillPassive->getLevel(),
					'tooltip_url' => $apiSkillPassive->getTooltipUrl(),
					'description' => $apiSkillPassive->getDescription(),
					'flavor' => $apiSkillPassive->getFlavor(),
					'skill_calc_id' => $apiSkillPassive->getSkillCalcId(),
				]);

				$skillPassive->save();

				$heroSkillPassive = \Hero\Skill\Passive::firstOrNew([
					'skill_passive_id' => $skillPassive->id,
					'hero_id' => $hero->id,
				]);

				$heroSkillPassive->save();
			}

			echo sprintf("\tHero %s imported\n", $apiHero->getName());

			foreach ($apiHero->getItems(false) as $item) {
				$this->call('item:import', [
					'item' => $item->getTooltipParams(),
					'region' => 'eu',
					'--hero' => $hero->id,
					'--slot' => $item->getSlot()
				]);
			}

		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('battletag', InputArgument::REQUIRED, 'Battletag to import'),
			array('hero_id', InputArgument::REQUIRED, 'Hero id to import'),
			array('region', InputArgument::REQUIRED, 'Region'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('career', null, InputOption::VALUE_OPTIONAL, 'Career id', null),
		);
	}

}
