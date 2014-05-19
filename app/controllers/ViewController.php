<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/28/14
 * Time: 8:58 PM
 */

class ViewController extends BaseController {
	public function getView($view){
		return View::make($view);
	}
} 