<?php namespace App\Models;

class Map extends BaseModel {

	public static function boot() {
		parent::boot();

		//static::creating(function ($user) {
			//$user->api_token = bin2hex(openssl_random_pseudo_bytes(16));
			//$user->password = bcrypt($user->password);
			//return true;
		//});
	}

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'maps';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'tiles'];

	public function games()
	{
		return $this->hasMany('belongsToManyApp\Models\Game');
	}
}
