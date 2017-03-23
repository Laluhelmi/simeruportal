<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('.htm_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Akun:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('.htm_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Akun:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('.htm_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Akun:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('.htm_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Akun:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('.htm_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Akun:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
