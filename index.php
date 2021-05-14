<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$loader = new FilesystemLoader('templates');
$view  = new Environment($loader);



$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) use ($view) {
    $body  = $view->render('index.twig');
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function (Request $request, Response $response, $args) use ($view) {
    $body  = $view->render('about.twig', ['name' => 'St.A$$']);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function (Request $request, Response $response, $args) use ($view) {
    $body  = $view->render('post.twig', ['url_key' => $args['url_key']]);
    $response->getBody()->write($body);
    return $response;
});



$app->run();

