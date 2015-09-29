<?php namespace App\Http\Controllers;
  
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    use RestControllerTrait;

    const MODEL = 'App\Models\User';

	//validation rules are only used for store/update requests
    protected $validationRules = ['name' => 'required', 'email' => 'required'];
}
