<?php

namespace Framework;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

class Framework extends HttpKernel
{
    public function __construct($routes)
    {
        $context = new RequestContext();
        $matcher = new UrlMatcher($routes, $context);
        $resolver = new ControllerResolver();

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new RouterListener($matcher));
        $dispatcher->addSubscriber(new ResponseListener('UTF-8'));

        parent::__construct($dispatcher, $resolver);
    }
}

