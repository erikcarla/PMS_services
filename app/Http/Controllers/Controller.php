<?php namespace App\Http\Controllers;

use App;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public static $MYID;
	function __construct() {
		$this->MY_ID = App::make('oauth2-server.authorizer')->getResourceOwnerId();
	}
}
