<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('mahasiswa', 'Mahasiswa::index');
$routes->get('mahasiswa/(:num)', 'Mahasiswa::show/$1');
$routes->post('mahasiswa', 'Mahasiswa::create');
$routes->put('mahasiswa/(:num)', 'Mahasiswa::update/$1');
$routes->delete('mahasiswa/(:num)', 'Mahasiswa::delete/$1');
$routes->get('dosen', 'Dosen::index');
$routes->get('dosen/(:num)', 'Dosen::show/$1');
$routes->post('dosen', 'Dosen::create');
$routes->put('dosen/(:num)', 'Dosen::update/$1');
$routes->delete('dosen/(:num)', 'Dosen::delete/$1');
$routes->get('kelas', 'Kelas::index');
$routes->get('kelas/(:num)', 'Kelas::show/$1');
$routes->post('kelas', 'Kelas::create');
$routes->put('kelas/(:num)', 'Kelas::update/$1');
$routes->delete('kelas/(:num)', 'Kelas::delete/$1');
$routes->get('krs', 'Krs::index');
$routes->get('krs/(:num)', 'Krs::show/$1');
$routes->post('krs', 'Krs::create');
$routes->put('krs/(:num)', 'Krs::update/$1');
$routes->delete('krs/(:num)', 'Krs::delete/$1');
$routes->get('matkul', 'Matkul::index');
$routes->get('matkul/(:num)', 'Matkul::show/$1');
$routes->post('matkul', 'Matkul::create');
$routes->put('matkul/(:num)', 'Matkul::update/$1');
$routes->delete('matkul/(:num)', 'Matkul::delete/$1');
$routes->get('prodi', 'Prodi::index');
$routes->get('prodi/(:num)', 'Prodi::show/$1');
$routes->post('prodi', 'Prodi::create');
$routes->put('prodi/(:num)', 'Prodi::update/$1');
$routes->delete('prodi/(:num)', 'Prodi::delete/$1');
$routes->get('user', 'User::index');
$routes->get('user/(:num)', 'User::show/$1');
