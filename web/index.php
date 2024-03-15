<?php

declare(strict_types = 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use DI\Container;
use DI\Bridge\Slim\Bridge;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Using Composer for PHP class autoloading
require_once(__DIR__.'/../vendor/autoload.php');

// Global Path Variables
define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

// initiate container
$container = new Container();

$container->set(Twig::class, function() {
  return Twig::create(VIEW_PATH, [
    'cache'       => STORAGE_PATH . '/cache',
    'auto_reload' => true,
  ]);
});

// Defining HomeController
$container->set('HomeController', function ($container) {
  return new \App\Controllers\HomeController();
});


// creating App using bridge
$app = Bridge::create($container);

// for error handling
$app->addErrorMiddleware(true, false, false);

// Define the route and fetch the controller from the container
$app->get('/', function ($request, $response, $args) use ($container) {
  return $container->get('HomeController')->index($request, $response, $args);
});

$app->run();

/*



// Create DI container
$container = new Container();
// Add Twig to Container
$container->set(Twig::class, function() {
  return Twig::create(__DIR__.'/../views');
});
// Add Monolog to Container
$container->set(LoggerInterface::class, function () {
  $logger = new Logger('default');
  $logger->pushHandler(new StreamHandler('php://stderr'), Level::Debug);
  return $logger;
});

// Create main Slim app
$app = Bridge::create($container);
$app->addErrorMiddleware(true, false, false);


// Our web handlers
$app->get('/', function(Request $request, Response $response, LoggerInterface $logger, Twig $twig) {
  $logger->debug('logging output.');
  return $twig->render($response, 'index.twig', array("phpversiono" => phpversion()));
});

$app->run();

*/
