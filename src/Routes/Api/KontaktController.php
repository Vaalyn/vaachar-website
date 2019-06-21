<?php

declare(strict_types = 1);

namespace App\Routes\Api;

use App\Exception\MailNotSendException;
use App\Service\Mailer\Mailer;
use Psr\Container\ContainerInterface;
use Respect\Validation\Validator;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\PhpRenderer;
use Vaalyn\SessionService\SessionInterface;

class KontaktController {
	/**
	 * @var Messages
	 */
	protected $flashMessages;

	/**
	 * @var Mailer
	 */
	protected $mailer;

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
	 * @var string
	 */
	protected $mailerEmailAddress;

	/**
	 * @var string
	 */
	protected $mailerName;

	/**
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container) {
		$this->flashMessages = $container->flashMessages;
		$this->mailer        = $container->mailer;
		$this->renderer      = $container->renderer;
		$this->router        = $container->router;
		$this->session       = $container->session;

		$this->mailerEmailAddress = $container->config['mailer']['fromAddress'];
		$this->mailerName         = $container->config['mailer']['from'];
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return Response
	 */
	public function __invoke(Request $request, Response $response, array $args): Response {
		$email   = $request->getParsedBody()['email'] ?? '';
		$name    = $request->getParsedBody()['name'] ?? '';
		$message = $request->getParsedBody()['message'] ?? '';
		$captcha = strtolower($request->getParsedBody()['captcha'] ?? '');

		$this->session->set('kontakt_email', $email);
		$this->session->set('kontakt_name', $name);
		$this->session->set('kontakt_message', $message);

		if (!$this->validateEmail($email)) {
			$this->flashMessages->addMessage('Formular Fehler', 'Ungültige E-Mail Adresse');

			return $this->redirectToKontaktPage($response);
		}

		if (!$this->validateName($name)) {
			$this->flashMessages->addMessage('Formular Fehler', 'Name darf nicht leer sein');

			return $this->redirectToKontaktPage($response);
		}

		if (!$this->validateMessage($message)) {
			$this->flashMessages->addMessage('Formular Fehler', 'Nachricht darf nicht leer sein');

			return $this->redirectToKontaktPage($response);
		}

		if (!$this->validateCaptcha($captcha)) {
			$this->flashMessages->addMessage('Formular Fehler', 'Das eingegebene Captcha ist ungültig');

			return $this->redirectToKontaktPage($response);
		}

		$this->session->delete('kontakt_captcha_phrase');

		try {
			$this->sendKontaktEmail($email, $name, $message);
		}
		catch (MailNotSendException $exception) {
			$this->flashMessages->addMessage('Server Fehler', 'Nachricht konnte nicht versendet werden');

			return $this->redirectToKontaktPage($response);
		}

		$this->session->delete('kontakt_email');
		$this->session->delete('kontakt_name');
		$this->session->delete('kontakt_message');

		$this->flashMessages->addMessage('Information', 'Nachricht erfolgreich versendet');

		return $this->redirectToKontaktPage($response);
	}

	/**
	 * @param string $email
	 *
	 * @return bool
	 */
	protected function validateEmail(string $email): bool {
		return Validator::email()->validate($email);
	}

	/**
	 * @param string $name
	 *
	 * @return bool
	 */
	protected function validateName(string $name): bool {
		return Validator::notEmpty()->validate($name);
	}

	/**
	 * @param string $message
	 *
	 * @return bool
	 */
	protected function validateMessage(string $message): bool {
		return Validator::notEmpty()->validate($message);
	}

	/**
	 * @param string $captcha
	 *
	 * @return bool
	 */
	protected function validateCaptcha(string $captcha): bool {
		$sessionCaptchaPhrase = $this->session->get('kontakt_captcha_phrase');

		if (!isset($sessionCaptchaPhrase)) {
			return false;
		}

		return ($sessionCaptchaPhrase === $captcha);
	}

	/**
	 * @param Response $response
	 *
	 * @return Response
	 */
	protected function redirectToKontaktPage(Response $response): Response {
		return $response->withRedirect($this->router->pathFor('kontakt'));
	}

	/**
	 * @param string $email
	 * @param string $name
	 * @param string $message
	 *
	 * @return void
	 */
	protected function sendKontaktEmail(string $email, string $name, string $message): void {
		$emailMessageBody = $this->renderer->fetch(
			'/mailer/kontakt/kontakt.php',
			[
				'email' => $email,
				'name' => $name,
				'message' => $message
			]
		);

		$this->mailer->sendMail(
			'Kontaktformular VaaChar',
			$this->mailerEmailAddress,
			$this->mailerName,
			$emailMessageBody
		);
	}
}
