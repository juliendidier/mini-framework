<?php

require_once __DIR__.'/../src/autoload.php';

use Framework\ResponseEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;

$routes = include __DIR__.'/../src/app.php';

$request = Request::createFromGlobals();

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addListener('response', function (ResponseEvent $event) {
    $response = $event->getResponse();

    if ($response->isRedirection()
        || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
        || 'html' !== $event->getRequest()->getRequestFormat()
    ) {
        return;
    }

    $response->setContent($response->getContent().'<hr />'.date('U'));
});

$framework = new Framework\Framework($matcher, $resolver, $dispatcher);
$response = $framework->handle($request);

$response->send();
