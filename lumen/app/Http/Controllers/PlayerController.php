<?php namespace App\Http\Controllers;
  
use App\Models\Player;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerController extends Controller {

    use RestControllerTrait;

    const MODEL = 'App\Models\Player';

	public function __construct()
	{
		$this->middleware('logged_in');
	}

	//validation rules are only used for store/update requests
	protected $validationRules = ['color' => 'required', 'user_id' => 'required'];
}
