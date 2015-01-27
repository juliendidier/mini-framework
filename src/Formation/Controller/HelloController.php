<?php

namespace Formation\Controller;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    public function helloAction(Request $request, $name)
    {
        return $this->render('Home/hello.html.twig', array(
            'name' => $name,
        ));
    }

    public function byeAction(Request $request)
    {
        return new Response('Bye...');
    }
}
