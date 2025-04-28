<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/upload', 'Home::upload');
$routes->post('/upload/csv', 'Home::uploadCsv');
