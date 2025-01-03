<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthAdmin');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Admin Authentication Routes
$routes->get('/admin/login', 'AuthAdmin::login');
$routes->post('/admin/login', 'AuthAdmin::doLogin');
$routes->get('/admin/register_admin', 'AuthAdmin::register_admin');
$routes->post('/admin/register_admin', 'AuthAdmin::doRegister_admin'); // Disesuaikan dengan nama method
$routes->get('/admin/logout', 'AuthAdmin::logout');

// Admin Routes
$routes->get('/admin', 'Admin::dashboard');
$routes->get('/admin/manage-products', 'Admin::manageProducts');
$routes->post('/admin/product/add', 'Admin::addProduct');
$routes->post('/admin/product/edit', 'Admin::editProduct');
$routes->post('/admin/product/delete', 'Admin::deleteProduct');

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}