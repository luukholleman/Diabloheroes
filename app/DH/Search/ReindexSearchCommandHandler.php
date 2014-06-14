<?php


namespace DH\Search;


use DH\Command\CommandBus;
use DH\Command\CommandHandlerInterface;
use DH\Command\CommandInterface;
use DH\Hero\Command\IndexHeroInSearchCommand;

class ReindexSearchCommandHandler implements CommandHandlerInterface
{

    public $hero;

    public $career;

    function __construct(\Career $career, \Hero $hero)
    {
        $this->career = $career;
        $this->hero = $hero;
    }


    public function handle(CommandInterface $command)
    {
        foreach ($this->hero->all() as $hero) {
            CommandBus::execute(new IndexHeroInSearchCommand($hero));
        }
//
//        foreach($this->career->all() as $career)
//        {
//            \Search::insert('career-'.$career->id, [
//                'title' => $career->battletag,
//                'content' => "{$career->battletag}",
//                'status' => 'published'
//            ], [
//                'link' => route('hero.profile', [$career->id]),
//                'name' => $career->battletag
//            ]);
//        }
//        \Search::deleteIndex();
//
//        \Search::index('heroes');
//
//        \Search::insert(1, [
//            'title' => 'Aveley',
//            'content' => 'Aveley Level 70 Hero',
//            'status' => 'published'
//        ], [
//            'link' => '/hero/1'
//        ]);
//        \Search::insert(2, [
//            'title' => 'sdvsd',
//            'content' => 'ave Level 70 Hero',
//            'status' => 'published'
//        ], [
//            'link' => '/hero/2'
//        ]);

        dd(\Search::search(null, 'avelye', ['fuzzy' => 0])->get());
    }
}