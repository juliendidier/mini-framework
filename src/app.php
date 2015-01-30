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

$routes->add('cart_add', new Routing\Route('/cart/add', array(
    '_controller' => 'Formation\Controller\CartController::addAction'
)));
$routes->add('cart_show', new Routing\Route('/cart', array(
    '_controller' => 'Formation\Controller\CartController::showAction'
)));
$routes->add('cart_item_edit', new Routing\Route('/cart/{id}/edit', array(
    '_controller' => 'Formation\Controller\CartController::editAction'
)));
$routes->add('cart_discount', new Routing\Route('/cart/discount', array(
    '_controller' => 'Formation\Controller\CartController::discountAction'
)));

return $routes;
