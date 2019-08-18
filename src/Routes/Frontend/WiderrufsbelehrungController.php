<?php

declare(strict_types = 1);

namespace App\Routes\Frontend;

use Psr\Container\ContainerInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\PhpRenderer;
use Vaalyn\AuthenticationService\AuthenticationInterface;

class WiderrufsbelehrungController {
	/**
	 * @var AuthenticationInterface
	 */
	protected $authentication;

	/**
	 * @var Messages
	 */
	protected $flashMessages;

	/**
	 * @var PhpRenderer
	 */
	protected $renderer;

	/**
	 * @var Router
	 */
	protected $router;

	/**
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container) {
		$this->authentication = $container->authentication;
		$this->flashMessages = $container->flashMessages;
		$this->renderer = $container->renderer;
		$this->router = $container->router;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return Response
	 */
	public function __invoke(Request $request, Response $response, array $args): Response {
		return $this->renderer->render($response, '/widerruf/widerrufsbelehrung.php', [
			'authentication' => $this->authentication,
			'flashMessages' => $this->flashMessages->getMessages(),
			'request' => $request,
			'router' => $this->router,
			'pageTitle' => 'Widerrufsbelehrung',
		]);
	}
}
