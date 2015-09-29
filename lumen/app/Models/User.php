<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	//bin2hex(openssl_random_pseudo_bytes(16));
	//function __construct($attributes = array()) {
		//parent::__construct($attributes);
	//}

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
