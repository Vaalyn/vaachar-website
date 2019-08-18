<?php

declare(strict_types = 1);

namespace App\Service\InvoiceNinja;

use App\Exception\InfoException;
use InvoiceNinja\Models\Client;
use InvoiceNinja\Models\Invoice;
use InvoiceNinja\Models\Product;

class InvoiceNinja {
	public const INVOICE_STATUS_SEND = 2;

	/**
	 * @param array $config
	 */
	public function __construct(array $config) {
		\InvoiceNinja\Config::setUrl($config['api_url']);
		\InvoiceNinja\Config::setToken($config['token']);
	}

	/**
	 * @param int $productId
	 *
	 * @return Product
	 */
	public function fetchProduct(int $productId): Product {
		try {
			return Product::find($productId);
		}
		catch (\Exception $exception) {
			throw new InfoException('Produkt konnte nicht gefunden werden');
		}
	}

	/**
	 * @param string $email
	 *
	 * @return Client|null
	 */
	public function fetchClientByEmail(string $email): ?Client {
		try {
			$clients = Client::all();

			foreach ($clients as $client) {
				foreach ($client->contacts as $contact) {
					if ($contact->email === $email) {
						return $client;
					}
				}
			}

			return null;
		}
		catch (\Exception $exception) {
			return null;
		}
	}

	/**
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $email
	 * @param string $address1
	 * @param string $postalCode
	 * @param string $city
	 * @param string $countryCode
	 * @param string $state
	 *
	 * @return Client
	 */
	public function createClient(
		string $firstName,
		string $lastName,
		string $email,
		string $address1,
		string $postalCode,
		string $city,
		string $countryCode,
		string $state
	): Client {
		try {
			$client = new Client();
			$client->name = sprintf('%s %s', $firstName, $lastName);
			$client->address1 = $address1;
			$client->postal_code = $postalCode;
			$client->city = $city;
			$client->country_code = $countryCode;
			$client->state = $state;

			$client->addContact(
				$email,
				$firstName,
				$lastName
			);

			return $client->save();
		}
		catch (\Exception $exception) {
			throw new InfoException('Fehler beim Registrieren');
		}
	}

	/**
	 * @param Product $product
	 * @param string $notes
	 * @param Client $client
	 *
	 * @return Invoice
	 */
	public function buyProduct(Product $product, string $notes, Client $client): Invoice {
		$invoice                    = new Invoice();
		$invoice->client_id         = $client->id;
		$invoice->email_invoice     = true;
		$invoice->invoice_status_id = self::INVOICE_STATUS_SEND;

		$invoice->addInvoiceItem($product->product_key, $notes, $product->cost);

		try {
			return $invoice->save();
		}
		catch (\Exception $exception) {
			throw new InfoException('Einkauf fehlgeschlagen');
		}
	}
}
