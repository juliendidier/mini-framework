<?php

namespace Framework;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;

class Controller extends ContainerAware
{
    protected function render($template, $params)
    {
        $html = $this->container->get('twig')->render($template, $params);

        return new Response($html);
    }
}
