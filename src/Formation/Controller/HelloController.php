<?php

namespace Formation\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
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
