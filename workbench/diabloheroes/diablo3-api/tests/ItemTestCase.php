<?php
use Diabloheroes\D3api\Item;
use Diabloheroes\D3api\Connector\Stub\Item as StubItem;
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/15/14
 * Time: 7:41 PM
 */

class ItemTestCase extends \PHPUnit_Framework_TestCase{

    /**
     * @var Item
     */
    private $item;

    public function setUp()
    {
        $this->item = new Item("item/CkQI15rXiQUSBwgEFX_5Tl0d8nAHrR2aBgDLHSK8Wy8dnQeVJB1RUwyyIgsIARWKQgMAGA4gKjCJAjjXA0AASA9QDmCRBBj-5ffUC1AEWAI", Item::EU);

        $this->item->connector = new StubItem();

        $this->item->fetch();
    }

    public function test_getName()
    {
        $this->assertSame("The Font", $this->item->getName());
    }

    public function test_getId()
    {
        $this->assertSame("Helm_208", $this->item->getId());
    }

	public function test_getIcon()
	{
		$this->assertSame("helm_208_wizard_male", $this->item->getIcon());
	}

	public function test_getDisplayColor()
	{
		$this->assertSame("yellow", $this->item->getDisplayColor());
	}

	public function test_getTooltipParams()
	{
		$this->assertSame("item/CkQI15rXiQUSBwgEFX_5Tl0d8nAHrR2aBgDLHSK8Wy8dnQeVJB1RUwyyIgsIARWKQgMAGA4gKjCJAjjXA0AASA9QDmCRBBj-5ffUC1AEWAI", $this->item->getTooltipParams());
	}

	public function test_getReguiredLevel()
	{
		$this->assertSame(70, $this->item->getRequiredLevel());
	}

	public function test_getItemLevel()
	{
		$this->assertSame(70, $this->item->getItemLevel());
	}

    public function test_getBonusAffixes()
    {
        $this->assertSame(0, $this->item->getBonusAffixes());
    }

    public function test_getTwoHanded()
    {
        $this->assertSame(false, $this->item->getTwoHanded());
    }

    public function test_getTypeId()
    {
        $this->assertSame("GenericHelm", $this->item->getTypeId());
    }

    public function test_getArmor()
    {
        $this->assertSame(array('min' => 680.0, 'max' => 680.0), $this->item->getArmor());
    }

    public function test_getArmorMin()
    {
        $this->assertSame(680.0, $this->item->getArmorMin());
    }

    public function test_getArmorMax()
    {
        $this->assertSame(680.0, $this->item->getArmorMax());
    }

    public function test_getAttributes()
    {
        $this->assertInternalType('array', $this->item->getAttributes());
        $this->assertNotEmpty($this->item->getAttributes()['primary']);
        $this->assertNotEmpty($this->item->getAttributes()['secondary']);
    }

    public function test_getPrimaryAttributes()
    {
        $this->assertInternalType('array', $this->item->getPrimaryAttributes());
    }

    public function test_getSecondaryAttributes()
    {
        $this->assertInternalType('array', $this->item->getSecondaryAttributes());
    }

    public function test_getPassiveAttributes()
    {
        $this->assertInternalType('array', $this->item->getPassiveAttributes());
    }

    public function test_getRawAttributes()
    {
        $this->assertInternalType('array', $this->item->getRawAttributes());
    }

    public function test_getRandomAffixes()
    {
        $this->assertInternalType('array', $this->item->getRandomAffixes());
    }

    public function test_getGems()
    {
        $this->assertInternalType('array', $this->item->getGems());
    }

    public function test_getCraftedBy()
    {
        $this->assertInternalType('array', $this->item->getCraftedBy());
    }
} 