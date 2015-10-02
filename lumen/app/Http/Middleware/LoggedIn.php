<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class LoggedIn
{
    /**
     * Filter the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$api_token = $request->header('X-TOKEN');
        if ($api_token) {
			$user = User::where('api_token', $api_token)->where('token_expires_at', '>=', \Carbon\Carbon::now())->first();
			//return response()->json($user);
			if ($user) {
				//extend token validity
				$user->refresh_token();
				app()->current_user = $user;
				return $next($request);
			}
        }

		$response = [
			'code' => 401,
			'status' => 'error',
			'message' => 'Unauthorized'
		];
		return response()->json($response, $response['code']);
    }
}
