<?php

namespace App;

use Nette\Application\BadRequestException;
use Nette\Application\Request;

/**
 * Class Error4xxPresenter
 *
 * @package App
 */
class Error4xxPresenter extends BasePresenter
{

	/**
	 * @throws BadRequestException
	 */
	public function startup()
	{
		parent::startup();

		if (!$this->getRequest()->isMethod(Request::FORWARD)) {
			$this->error();
		}
	}

	/**
	 * @param BadRequestException $exception
	 */
	public function renderDefault(BadRequestException $exception)
	{
		// load template 403.latte or 404.latte or ... 4xx.latte
		$file = __DIR__ . "/templates/Error/{$exception->getCode()}.latte";
		$this->template->setFile(is_file($file) ? $file : __DIR__ . '/templates/Error/4xx.latte');
	}
}
