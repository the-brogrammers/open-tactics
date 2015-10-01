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
		$api_token = $request->input('token');
        if ($api_token) {
			$user = User::where('api_token', $api_token)->where('token_expires_at', '>=', \Carbon\Carbon::now())->first();
			if ($user) {
				//extend token validity
				$user->token_expires_at = \Carbon\Carbon::now()->addMinutes(config('user.token_duration'));
				$user->save();

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
