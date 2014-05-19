<?php
namespace Ranklist;


/**
 * Ranklist\Category
 *
 * @property integer $id
 * @property string $name
 * @property integer $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\Ranklist[] $ranklists
 */
class Category extends \Eloquent{
	public $guarded = ['id'];

	public $table = 'ranklist_categories';

	public $timestamps = false;

	public function ranklists()
	{
		return $this->hasMany('Ranklist', 'ranklist_category_id');
	}
} 