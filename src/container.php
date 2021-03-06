<?php

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Yaml\Yaml;

$parameters = Yaml::parse(__DIR__.'/../config/parameters.yml');
$container = new DependencyInjection\ContainerBuilder(new ParameterBag($parameters['parameters']));

$container->register('request_context', 'Symfony\Component\Routing\RequestContext');

$container->setParameter('routes', include __DIR__.'/../src/app.php');

$container->register('url_matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
    ->setArguments(array('%routes%', new Reference('request_context')))
;

$container->register('controller_resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');

$container->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('url_matcher')))
;

$container->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
    ->setArguments(array('Formation\\Controller\\ErrorController::exceptionAction'))
;

$container->register('listener.container_aware', 'Framework\EventListener\ContainerAwareListener')
    ->setArguments(array($container))
;

$container->register('event_dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.container_aware')))
;

$container->register('framework', 'Framework\Framework')
    ->setArguments(array(new Reference('event_dispatcher'), new Reference('controller_resolver')))
;

$container->setParameter('twig.views', __DIR__.'/../views');
$container->setParameter('twig.config', array(
    'debug'            => true,
    'strict_variables' => true,
    'cache'            => __DIR__.'/../cache/twig',
));

$container->register('twig.loader', 'Twig_Loader_Filesystem')
    ->setArguments(array('%twig.views%'))
;

$container->register('twig', 'Twig_Environment')
    ->setArguments(array(new Reference('twig.loader'), '%twig.config%'))
;

$container->register('database', 'Framework\Database\Connection')
    ->setArguments(array(
        $container->getParameter('database.dsn'),
        $container->getParameter('database.user'),
        $container->getParameter('database.password')
    ))
;

$container->register('article_xmascard_repository', 'Formation\Repository\ArticleXmasCardRepository')
    ->setArguments(array(new Reference('database')))
;


$container->register('session', 'Framework\Session');

return $container;
