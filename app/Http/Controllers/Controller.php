<?php namespace App\Http\Controllers;

use App;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	function __construct() {
		$this->MYID = App::make('oauth2-server.authorizer')->getResourceOwnerId();
	}
}
