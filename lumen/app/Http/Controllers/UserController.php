<?php namespace App\Http\Controllers;
  
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    use RestControllerTrait;

    const MODEL = 'App\Models\User';

	//validation rules are only used for store/update requests
    protected $validationRules = ['name' => 'required', 'email' => 'required'];

	public function login(Request $request)
	{
		$v = \Validator::make($request->all(), [
			'email'    => 'required|email',
			'password' => 'required',
		]);

		if($v->fails())
		{
			throw new \Exception("ValidationException");
		}

		$credentials = $request->only('email', 'password');

		if (\Auth::attempt($credentials)) {
			$user = \Auth::user();
			$user->last_login = \Carbon\Carbon::now();
			$user->save();
			return $this->showResponse(array('token' => $user->api_token));
		}

		return $this->notFoundResponse();
	}
}
