<?php namespace App\Http\Controllers;
  
use App\Models\Map;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller {

    use RestControllerTrait;

    const MODEL = 'App\Models\Map';

	public function __construct()
	{
		$this->middleware('logged_in');
	}

	//validation rules are only used for store/update requests
	protected $validationRules = ['name' => 'required', 'tiles' => 'required'];
}
