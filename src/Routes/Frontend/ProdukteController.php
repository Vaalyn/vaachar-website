<?php

declare(strict_types = 1);

namespace App\Routes\Frontend;

use InvoiceNinja;
use Psr\Container\ContainerInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\PhpRenderer;
use Vaalyn\AuthenticationService\AuthenticationInterface;

class ProdukteController {
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
		$products = $this->fetchProducts();

		return $this->renderer->render($response, '/produkte/produkte.php', [
			'authentication' => $this->authentication,
			'flashMessages' => $this->flashMessages->getMessages(),
			'products' => $products,
			'request' => $request,
			'router' => $this->router
		]);
	}

	/**
	 * @return InvoiceNinja\Models\Product[]
	 */
	protected function fetchProducts() {
		$allProducts = InvoiceNinja\Models\Product::all();

		$products = [];
		foreach ($allProducts as $product) {
			if ($product->is_deleted === false) {
				$products[] = $product;
			}
		}

		return $products;
	}
}
