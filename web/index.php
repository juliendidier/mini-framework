<?php

require_once __DIR__.'/../src/autoload.php';

use Framework\Framework;
use Symfony\Component\HttpFoundation\Request;

$routes = include __DIR__.'/../src/app.php';

$request = Request::createFromGlobals();
$framework = new Framework($routes);

$framework
    ->handle($request)
    ->send()
;
