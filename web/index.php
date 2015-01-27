<?php

require_once __DIR__.'/../src/autoload.php';

use Framework\Framework;
use Symfony\Component\HttpFoundation\Request;

$container = include __DIR__.'/../src/container.php';

$request = Request::createFromGlobals();

$container
    ->get('framework')
    ->handle($request)
    ->send()
;
