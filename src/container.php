<?php

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

$container = new DependencyInjection\ContainerBuilder();

$container->register('request_context', 'Symfony\Component\Routing\RequestContext');

$container->register('url_matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
    ->setArguments(array($routes, new Reference('request_context')))
;

$container->register('controller_resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');

$container->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('url_matcher')))
;

$container->register('event_dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
;

$container->register('framework', 'Framework\Framework')
    ->setArguments(array(new Reference('event_dispatcher'), new Reference('controller_resolver')))
;

return $container;
