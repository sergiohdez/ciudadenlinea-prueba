<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->post('estudiantes/register', 'Estudiantes::register');
$routes->get('estudiantes/create', 'Estudiantes::create');
$routes->post('estudiantes/create', 'Estudiantes::create');
$routes->get('pages/view/(:segment)', 'Pages::view/$1');
$routes->get('cursos/page/(:segment)', 'Pages::index/$1');
$routes->get('/', 'Pages::index');
