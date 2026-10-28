<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('siswa/create', 'Home::create');
$routes->post('siswa/save', 'Home::store');
$routes->post('siswa/store', 'Home::store');
$routes->post('siswa/update/(:num)', 'Home::update/$1');
$routes->post('siswa/delete/(:num)', 'Home::delete/$1');
