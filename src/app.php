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


$routes->add('article_list', new Routing\Route('/articles', array(
    '_controller' => 'Formation\Controller\ArticleController::listAction'
)));
$routes->add('article_show', new Routing\Route('/articles/{name}', array(
    '_controller' => 'Formation\Controller\ArticleController::showAction'
)));

return $routes;
