<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->options('(:any)', function () {
    return service('response')
        ->setHeader('Access-Control-Allow-Origin', '*')
        ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->setStatusCode(200);
});

$routes->group('api', function ($routes) {
    $routes->post('auth/login', 'Api\AuthController::login');
    $routes->get('elections', 'Api\ElectionController::index');
    $routes->get('elections/(:num)', 'Api\ElectionController::show/$1');
    $routes->post('elections', 'Api\ElectionController::create');
    $routes->put('elections/(:num)', 'Api\ElectionController::update/$1');
    $routes->delete('elections/(:num)', 'Api\ElectionController::delete/$1');
});

