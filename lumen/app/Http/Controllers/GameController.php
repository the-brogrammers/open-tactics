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

	public function join($id)
	{
		$game = Game::with('players')->find($id);
		if ($game) {
			if ($game->is_joinable()) {
				$player = new \App\Models\Player(['user_id' => app()->current_user->id]);
				$game->players()->save($player, ['joined_at' => \Carbon\Carbon::now()]);
				return $this->sendSuccessResponse(['game' => $game]);
			}
			else {
				return $this->sendErrorResponse($game, 520, 'game is full');
			}
		}
		return $this->notFoundResponse();
	}
}
