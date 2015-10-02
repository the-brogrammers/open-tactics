<?php namespace App\Models;

class Player extends BaseModel {

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
	protected $table = 'players';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['color', 'user_id'];

	public function games()
	{
		return $this->belongsToMany('App\Models\Game')->withPivot('joined_at');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
