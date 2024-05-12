<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/users/registrasi', 'Users::registrasi');
$routes->post('/users/registrasi', 'Users::postRegistrasi');

$routes->get('/users/login', 'Users::login');
$routes->post('/users/login', 'Users::postLogin');

$routes->get('/users/akun', 'Users::akun');
$routes->post('/users/akun', 'Users::postAkun');

$routes->get('/users/password', 'Users::password');
$routes->post('/users/password', 'Users::postPassword');

$routes->get('/users/logout', 'Users::logout');

$routes->get('/alamat/add', 'Alamat::add');
$routes->post('/alamat/add', 'Alamat::postAdd');

$routes->get('/alamat/update', 'Alamat::update');
$routes->post('/alamat/update/(:any)', 'Alamat::postUpdate/$1');

$routes->delete('/delete/(:any)', 'Alamat::delete/$1');

$routes->get('/petPay/add', 'PetPay::add');
$routes->post('/petPay/add', 'PetPay::PostAdd');

$routes->get('/petPay/topUp', 'PetPay::topUp');
$routes->post('/petPay/topUp', 'PetPay::postTopUp');

$routes->post('/keranjang/add/(:any)', 'Keranjang::postAdd/$1');

$routes->post('/transaksi/bayar', 'Transaksi::bayar');
$routes->get('/transaksi/product/(:any)', 'Transaksi::product/$1');
// 

// Admin
$routes->get('/admin/login', 'Admin::login');
$routes->post('/admin/login', 'Admin::postLogin');

$routes->get('/admin/registrasi', 'Admin::registrasi');
$routes->post('/admin/registrasi', 'Admin::postRegistrasi');

$routes->get('/admin/akun', 'Admin::akun');
$routes->post('/admin/akun', 'Admin::postAkun');

$routes->get('/admin/password', 'Admin::password');
$routes->post('/admin/password', 'Admin::postPassword');

$routes->get('/admin/addProduct', 'Admin::addProduct');
$routes->post('/admin/addProduct', 'Admin::postAddProduct');

$routes->get('/admin/updateProduct', 'Admin::updateProduct');
$routes->post('/admin/updateProduct/(:any)', 'Admin::postUpdateProduct/$1');

$routes->delete('/productDelete/(:any)', 'Admin::deleteProduct/$1');