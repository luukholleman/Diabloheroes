<?php

/**
 * Item
 *
 * @property integer $id
 * @property integer $hero_id
 * @property string $blizzard_id
 * @property string $name
 * @property string $icon
 * @property string $tooltip_params
 * @property integer $required_level
 * @property integer $item_level
 * @property integer $bonus_affixes
 * @property integer $bonus_affixes_max
 * @property boolean $account_bound
 * @property string $type_name
 * @property boolean $two_handed
 * @property string $type_id
 * @property integer $armor
 * @property integer $armor_max
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereHeroId($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereBlizzardId($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereIcon($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereTooltipParams($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereRequiredLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereItemLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereBonusAffixes($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereBonusAffixesMax($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereAccountBound($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereTypeName($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereTwoHanded($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereArmor($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereArmorMax($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Item whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Item\Attribute\Raw[] $itemAttributeRaw
 */
class Item extends \Eloquent {
    public $guarded = ['id'];

	public function itemAttributeRaw()
	{
		return $this->hasMany('\Item\Attribute\Raw');
	}

	public function getStatValue(Item\Attribute $itemAttribute)
	{
		try
		{
			$itemAttributeRaw = $this->itemAttributeRaw()->whereItemAttributeId($itemAttribute->id)->firstOrFail();

			return $itemAttributeRaw->max;
		}
		catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{

		}
	}
} 