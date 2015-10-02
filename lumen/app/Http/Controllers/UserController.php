<?php namespace App\Http\Controllers;
  
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    use RestControllerTrait;

    const MODEL = 'App\Models\User';

	public function __construct()
	{
		$this->middleware('logged_in', ['except' => ['store', 'login']]);
	}

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
			if (!$user->token_is_valid()) {
				$api_token = $user->generate_api_token();
				$user->api_token = $api_token['token'];
				$user->token_expires_at = $api_token['token_expires_at'];
			}
			$user->last_login = \Carbon\Carbon::now();
			$user->save();
			return $this->sendSuccessResponse(['token' => $user->api_token, 'token_expires_at' => $user->token_expires_at->toW3cString()]);
		}

		return $this->notFoundResponse();
	}
}
