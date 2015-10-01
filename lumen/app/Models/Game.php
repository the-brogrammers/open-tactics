<?php namespace App\Models;

class Game extends BaseModel {

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
	protected $table = 'games';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'max_players', 'map_id'];

	public function players()
	{
		return $this->belongsToMany('App\Models\Player')->withPivot('joined_at');
	}

	public function map()
	{
		return $this->belongsTo('App\Models\Map');
	}
}
