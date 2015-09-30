<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

	public static function boot() {
		parent::boot();

		//set NULL value for empty attributes
		static::saving(function($model)  {
			//var_dump($model->getDirty());die();
			foreach ($model->getDirty() as $key => $value) {
				if($value !== 0) {
					$model->{$key} = empty($value) ? null : $value;
				}
			}
		});
	}
}
