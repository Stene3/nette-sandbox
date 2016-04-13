<?php

namespace App;

use Nette\Application\BadRequestException;
use Nette\Application\IPresenter;
use Nette\Application\IResponse;
use Nette\Application\Request;
use Nette\Application\Responses\CallbackResponse;
use Nette\Application\Responses\ForwardResponse;
use Tracy\ILogger;

/**
 * Class ErrorPresenter
 *
 * @package App
 */
class ErrorPresenter implements IPresenter
{
	/** @var ILogger */
	private $logger;

	/**
	 * ErrorPresenter constructor.
	 *
	 * @param ILogger $logger
	 */
	public function __construct(ILogger $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * @return IResponse
	 */
	public function run(Request $request)
	{
		$e = $request->getParameter('exception');

		if ($e instanceof BadRequestException) {
			return new ForwardResponse($request->setPresenterName('Error4xx'));
		}

		$this->logger->log($e, ILogger::EXCEPTION);

		return new CallbackResponse(function () {
			require __DIR__ . '/templates/Error/500.phtml';
		});
	}
}
