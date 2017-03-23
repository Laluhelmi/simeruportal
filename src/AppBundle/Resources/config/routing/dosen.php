<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('dosen_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Dosen:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('dosen_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Dosen:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));




return $collection;
