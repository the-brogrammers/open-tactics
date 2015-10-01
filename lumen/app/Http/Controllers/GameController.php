<?php namespace App\Http\Controllers;
  
use App\Models\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller {

    use RestControllerTrait;

    const MODEL = 'App\Models\Game';

	public function __construct()
	{
		$this->middleware('logged_in');
	}

	//validation rules are only used for store/update requests
	protected $validationRules = ['name' => 'required', 'max_players' => 'required', 'map_id' => 'required'];
}
