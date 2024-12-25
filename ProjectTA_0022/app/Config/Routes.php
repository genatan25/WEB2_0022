<?php

namespace Config;

$routes = Services::routes();

// Default Route
$routes->get('/', 'Auth::login');

// Authentication Routes
$routes->get('/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/register', 'Auth::register');
$routes->post('/auth/create', 'Auth::create');
$routes->get('/logout', 'Auth::logout');

// Admin Routes
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'authGuardAdmin']);
$routes->get('/admin/manage-products', 'Admin::manageProducts', ['filter' => 'authGuardAdmin']);
$routes->get('/admin/add-product', 'Admin::addProduct', ['filter' => 'authGuardAdmin']);
$routes->post('/admin/store-product', 'Admin::storeProduct', ['filter' => 'authGuardAdmin']);
$routes->get('/admin/edit-product/(:num)', 'Admin::editProduct/$1', ['filter' => 'authGuardAdmin']);
$routes->post('/admin/update-product/(:num)', 'Admin::updateProduct/$1', ['filter' => 'authGuardAdmin']);
$routes->get('/admin/delete-product/(:num)', 'Admin::deleteProduct/$1', ['filter' => 'authGuardAdmin']);

// User Routes
$routes->get('/user/home', 'User::home', ['filter' => 'authGuardUser']);
$routes->get('/user/products', 'User::productList', ['filter' => 'authGuardUser']);

// Cart Routes
$routes->get('/cart', 'Cart::viewCart', ['filter' => 'authGuardUser']);
$routes->post('/cart/add', 'Cart::addToCart', ['filter' => 'authGuardUser']);
$routes->post('/checkout', 'Cart::checkout', ['filter' => 'authGuardUser']);

// Error Pages
$routes->set404Override(function () {
    echo view('error/404');
});
