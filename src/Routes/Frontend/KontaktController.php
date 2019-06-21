<?php

declare(strict_types = 1);

namespace App\Routes\Frontend;

use Gregwar\Captcha\CaptchaBuilder;
use Psr\Container\ContainerInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\PhpRenderer;
use Vaalyn\AuthenticationService\AuthenticationInterface;
use Vaalyn\SessionService\SessionInterface;

class KontaktController {
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
	 * @var SessionInterface
	 */
	protected $session;

	/**
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container) {
		$this->authentication = $container->authentication;
		$this->flashMessages  = $container->flashMessages;
		$this->renderer       = $container->renderer;
		$this->router         = $container->router;
		$this->session        = $container->session;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return Response
	 */
	public function __invoke(Request $request, Response $response, array $args): Response {
		$captchaImage = $this->generateCaptcha();

		$email = $this->session->get('kontakt_email') ?? '';
		$name = $this->session->get('kontakt_name') ?? '';
		$message = $this->session->get('kontakt_message') ?? '';

		return $this->renderer->render($response, '/kontakt/kontakt.php', [
			'authentication' => $this->authentication,
			'captchaImage' => $captchaImage,
			'email' => $email,
			'flashMessages' => $this->flashMessages->getMessages(),
			'name' => $name,
			'message' => $message,
			'request' => $request,
			'router' => $this->router,
			'pageTitle' => 'Kontakt'
		]);
	}

	/**
	 * @return string
	 */
	protected function generateCaptcha(): string {
		$builder = new CaptchaBuilder;
		$builder->build(225, 60);

		$this->session->set('kontakt_captcha_phrase', $builder->getPhrase());

		return $builder->inline();
	}
}
