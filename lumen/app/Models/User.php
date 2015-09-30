<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	//function __construct($attributes = array()) {
		//parent::__construct($attributes);
	//}

	public static function boot() {
		parent::boot();

		static::creating(function ($user) {
			$user->api_token = bin2hex(openssl_random_pseudo_bytes(16));
			$user->password = bcrypt($user->password);
			return true;
		});
	}

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

}
