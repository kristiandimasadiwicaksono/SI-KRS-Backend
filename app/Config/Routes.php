<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('mahasiswa');
$routes->resource('kelas');
$routes->resource('krs');
$routes->resource('matkul');
$routes->resource('prodi');

$routes->get('user', 'User::index');
$routes->get('user/(:num)', 'User::show/$1');

$routes->post('login', 'Auth::login');

$routes->group('api', ['filter' => 'auth'], function ($routes) {
    $routes->get('protected', 'ProtectedController::index');
});
