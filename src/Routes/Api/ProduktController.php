<?php

declare(strict_types = 1);

namespace App\Routes\Api;

use App\Exception\InfoException;
use App\Service\InvoiceNinja\InvoiceNinja;
use Psr\Container\ContainerInterface;
use Respect\Validation\Validator;
use Slim\Http\Request;
use Slim\Http\Response;

class ProduktController {
	/**
	 * @var InvoiceNinja
	 */
	protected $invoiceNinja;

	/**
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container) {
		$this->invoiceNinja = $container->invoiceNinja;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return Response
	 */
	public function buyNowAction(Request $request, Response $response, array $args): Response {
		$productId   = (int) ($request->getParsedBody()['product_id'] ?? 0);
		$notes       = $request->getParsedBody()['notes'] ?? '';
		$firstName   = $request->getParsedBody()['first_name'] ?? '';
		$lastName    = $request->getParsedBody()['last_name'] ?? '';
		$email       = $request->getParsedBody()['email'] ?? '';
		$address1    = $request->getParsedBody()['address1'] ?? '';
		$postalCode  = $request->getParsedBody()['postal_code'] ?? '';
		$city        = $request->getParsedBody()['city'] ?? '';
		$countryCode = 'DE';
		$state       = '';
		$agbAccepted = isset($request->getParsedBody()['agb_accepted']);

		if (!Validator::notEmpty()->validate($productId)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Kein Produkt angegeben'
			]);
		}

		if (!Validator::notEmpty()->validate($notes)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Bitte eine Produkt Option auswählen'
			]);
		}

		if (!Validator::notEmpty()->validate($firstName)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Bitte gib deinen Vornamen ein'
			]);
		}

		if (!Validator::notEmpty()->validate($lastName)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Bitte gib deinen Nachnamen ein'
			]);
		}

		if (!Validator::email()->validate($email)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Bitte gib eine gültige E-Mail Adresse ein'
			]);
		}

		if (!Validator::notEmpty()->validate($address1)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Bitte gib deine Adresse ein'
			]);
		}

		if (!Validator::postalCode($countryCode)->validate($postalCode)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Bitte gib eine gültige PLZ ein'
			]);
		}

		if (!Validator::notEmpty()->validate($city)) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Bitte gib deine Stadt ein'
			]);
		}

		if ($agbAccepted === false) {
			return $response->withJson([
				'status' => 'error',
				'message' => 'Du musst die AGBs und Widerrufsbestimmungen akzeptieren'
			]);
		}

		try {
			$product = $this->invoiceNinja->fetchProduct($productId);
			$client  = $this->invoiceNinja->fetchClientByEmail($email);

			if ($client === null) {
				$client = $this->invoiceNinja->createClient(
					$firstName,
					$lastName,
					$email,
					$address1,
					$postalCode,
					$city,
					$countryCode,
					$state
				);
			}

			$invoice = $this->invoiceNinja->buyProduct($product, $notes, $client);

			$invitation  = $invoice->invitations[0];
	        $invoiceLink = $invitation->link;

			return $response->withJson([
				'status' => 'success',
				'message' => 'Bestellung erfolgreich',
				'redirect_url' => $invoiceLink
			]);
		}
		catch (InfoException $exception) {
			return $response->withJson([
				'status' => 'error',
				'message' => $exception->getMessage()
			]);
		}
	}
}
