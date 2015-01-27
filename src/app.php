<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => 'Formation\Controller\HelloController::helloAction'
)));
$routes->add('bye', new Routing\Route('/bye', array(
    '_controller' => 'Formation\Controller\HelloController::byeAction'
)));

return $routes;
