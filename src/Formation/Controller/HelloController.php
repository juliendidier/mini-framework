<?php

namespace Formation\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAware;

class HelloController extends ContainerAware
{
    public function helloAction(Request $request, $name)
    {
        return new Response(sprintf('Hello %s', $name));
    }

    public function byeAction(Request $request)
    {
        return new Response('Bye...');
    }
}
