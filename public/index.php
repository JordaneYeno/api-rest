<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require '../config/db.php';

$app = new \Slim\App();

$app->get('/', function (Request $request, Response $response, array $args) {

    $response->getBody()->write("Hello");
    return $response;
});


// marque
require  '../routes/marques.php';

// chaussure
require  '../routes/chaussures.php';


$app->run();    

?>