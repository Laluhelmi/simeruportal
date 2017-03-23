<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('mhs_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Mahasiswa:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('mhs_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Mahasiswa:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('mhs_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Mahasiswa:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('mhs_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Mahasiswa:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('mhs_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Mahasiswa:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
