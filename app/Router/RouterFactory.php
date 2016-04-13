<?php

namespace App;

use Nette\Application\IRouter;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;

/**
 * Class RouterFactory
 *
 * @package App
 */
class RouterFactory
{
	/**
	 * @return IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList;
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

		return $router;
	}
}
