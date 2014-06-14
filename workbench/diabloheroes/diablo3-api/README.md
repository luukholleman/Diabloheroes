Diablo-3-PHP-API
================
Library to connect to the Diablo 3 API

# Requirements
* PHP 5.3
* Curl

# Career Usage
## Constants
    const BARBARIAN = 'barbarian';
    const CRUSADER = 'crusader';
    const DEMON_HUNTER = 'demon-hunter';
    const MONK = 'monk';
    const WITCH_DOCTOR = 'witch-doctor';
    const WIZARD = 'wizard';

    const ACT1 = 'act1';
    const ACT2 = 'act2';
    const ACT3 = 'act3';
    const ACT4 = 'act4';
    const ACT5 = 'act5';

    const EU = 'eu';
    const US = 'us';
    const KR = 'kr';

## Methods
    use Diabloheroes\D3api\Career;

    $career = new Career('Aveley#2218', Career::EU);

    $career->fetch();

    //returns an array of Diabloheroes\D3api\Hero objects
    $career->getHeroes();

    //returns Diabloheroes\D3api\Hero of the last played hero
    $career->getLastPlayedHero();

    //returns an array with acts as keys and bools (completed or not) as values
    $career->getProgression();

    //returns a bool if the act is completed
    $career->getProgression(Career::ACT1); // or Career::ACT2, Career::ACT3, Career::ACT4, Career::ACT5

    //these methods should speak for themselfs
    $career->getMonstersKilled();
    $career->getElitesKilled();
    $career->getHardcoreMonstersKilled();
    $career->getTimePlayed(Career::BARBARIAN); // or Career::CRUSADER, Career::DEMON_HUNTER, Career::MONK, Career::WITCH_DOCTOR, Career::WIZARD
    $career->getParagonLevel();
    $career->getHardcoreParagonLevel();
    $career->getBattletag();

# Hero Usage
## Hero constants
    const LIFE = "life";
	const DAMAGE = "damage";
	const ATTACKSPEED = "attackSpeed";
	const ARMOR = "armor";
	const STRENGTH = "strength";
	const DEXTERITY = "dexterity";
	const VITALITY = "vitality";
	const INTELLIGENCE = "intelligence";
	const PHYSICALRESIST = "physicalResist";
	const FIRERESIST = "fireResist";
	const COLDRESIST = "coldResist";
	const LIGHTNINGRESIST = "lightningResist";
	const POISONRESIST = "poisonResist";
	const ARCANERESIST = "arcaneResist";
	const CRITDAMAGE = "critDamage";
	const BLOCKCHANCE = "blockChance";
	const BLOCKAMOUNTMIN = "blockAmountMin";
	const BLOCKAMOUNTMAX = "blockAmountMax";
	const DAMAGEINCREASE = "damageIncrease";
	const CRITCHANCE = "critChance";
	const DAMAGEREDUCTION = "damageReduction";
	const THORNS = "thorns";
	const LIFESTEAL = "lifeSteal";
	const LIFEPERKILL = "lifePerKill";
	const GOLDFIND = "goldFind";
	const MAGICFIND = "magicFind";
	const LIFEONHIT = "lifeOnHit";
	const PRIMARYRESOURCE = "primaryResource";
	const SECONDARYRESOURCE = "secondaryResource";

    const EU = 'eu';
    const US = 'us';
    const KR = 'kr';

## Methods
    use Diabloheroes\D3api\Hero;

    $hero = new Hero('Aveley#2218', 123456, Hero::EU);

    $hero->fetch();

    // returns an array with the stat as key, value as value
    $hero->getStats();

    // returns an array of all the items, see item usage
    $hero->getItems();

    // returns the value of a stat
    $hero->getStat(Hero::ARMOR); // or another stat, see hero constants

    // these methods should speak for themself
    $hero->getId();
    $hero->getName();
    $hero->getClass(); // returns class as string
    $hero->getGender(); // 0 for male, 1 for female
    $hero->isMale(); // bool
    $hero->isFemale(); // bool
    $hero->getLevel();
    $hero->getParagonLevel();
    $hero->getHardcore(); // 0 for softcore, 1 for hardcore
    $hero->isHardcore(); // bool
    $hero->getDead(); // bool
    $hero->isDead(); // bool
    $hero->getLastUpdated();
    $hero->getEliteKills();

# Item Usage
    use Diabloheroes\D3api\Item;

    $item = new Item("item/CkQI15rXiQUSBwgEFX_5Tl0d8nAHrR2aBgDLHSK8Wy8dnQeVJB1RUwyyIgsIARWKQgMAGA4gKjCJAjjXA0AASA9QDmCRBBj-5ffUC1AEWAI", Item::EU);

    $item->fetch();

    // these methods should speak for themself
    $item->getId();
    $item->getName();
    $item->getIcon();
    $item->getDisplayColor();
    $item->getTooltipParams();
    $item->getRequiredLevel();
    $item->getItemLevel();
    $item->getBonusAffixes();
    $item->getBonusAffixesMax();
    $item->getAccountBound();
    $item->getTypeName();
    $item->getTwoHanded();
    $item->getTypeId();
    $item->getArmor();
    $item->getArmorMin();
    $item->getArmorMax();
    $item->getAttributes();
    $item->getPrimaryAttributes();
    $item->getSecondaryAttributes();
    $item->getPassiveAttributes();
    $item->getRawAttributes();
    $item->getRandomAffixes();
    $item->getGems();
    $item->getSocketEffects();
    $item->getCraftedBy();