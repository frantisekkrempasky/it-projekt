<?php

declare(strict_types=1);

// Zapnutie výpisu chýb (aby sme videli prípadné problémy)
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Načítanie konfigurácie a knižníc
require __DIR__ . '/config.php';
require __DIR__ . '/vendor/autoload.php';

use App\Router;
use App\Http\Request;
use App\Controller\HomeController;
use App\Controller\AccessoryController;
use App\Controller\LocationController;
use App\Controller\StatusController;
use App\Controller\TypeController;
use App\Controller\BicycleController;

$prefix = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path   = substr($path, strlen($prefix));
$path   = '/' . trim($path, '/');
define('BASE_URL', $prefix);

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/kontrola', [HomeController::class, 'index']);
$router->get('/debug', [HomeController::class, 'index']);

// O aplikácii
$router->get('/o-aplikacii', [HomeController::class, 'about']);

// Číselníky
$router->get('/accessories', [AccessoryController::class, 'index']);
$router->get('/locations', [LocationController::class, 'index']);
$router->get('/statuses', [StatusController::class, 'index']);
$router->get('/types', [TypeController::class, 'index']);

// Hlavná entita - Bicykle
$router->get('/bicycles', [BicycleController::class, 'index']);
$router->get('/bicycles/{id}', [BicycleController::class, 'show']);

$response = $router->dispatch(Request::fromGlobals());
$response->send();
