<?php

declare(strict_types = 1);

use App\Routes\Api;
use App\Routes\Frontend;

$app->group('/api', function() {
	$this->get('/ping', Api\PingController::class)->setName('api.ping');

	$this->post('/kontakt', Api\KontaktController::class)->setName('api.kontakt');

	$this->post('/login', Api\LoginController::class . ':loginAction')->setName('api.login');
});

$app->get('/', Frontend\HomeController::class)->setName('home');

$app->get('/dashboard', Frontend\DashboardController::class)->setName('dashboard');

$app->get('/datenschutz', Frontend\DatenschutzController::class)->setName('datenschutz');

$app->get('/dtg-druck', Frontend\DtgDruckController::class)->setName('dtg-druck');

$app->get('/3d-druck', Frontend\DreiDDruckController::class)->setName('3d-druck');

$app->get('/impressum', Frontend\ImpressumController::class)->setName('impressum');

$app->get('/kontakt', Frontend\KontaktController::class)->setName('kontakt');

$app->get('/login', Frontend\LoginController::class . ':getLoginAction')->setName('login');
$app->post('/login', Frontend\LoginController::class . ':loginAction')->setName('login.action');

$app->get('/logout', Frontend\LogoutController::class)->setName('logout');
