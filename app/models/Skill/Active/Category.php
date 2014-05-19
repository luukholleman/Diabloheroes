<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/26/14
 * Time: 1:02 PM
 */

namespace Skill\Active;


/**
 * Skill\Active\Category
 *
 * @property integer $id
 * @property string $name
 */
class Category extends \Eloquent {
    public $guarded = ['id'];

    public $table = 'skill_active_categories';

    public $timestamps = false;
} 