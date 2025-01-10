<?php

namespace Config;

// Membuat instance baru dari RouteCollection class.
$routes = Services::routes();

// Memuat file routing sistem terlebih dahulu, sehingga app dan ENVIRONMENT
// dapat mengoverride sesuai kebutuhan.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Admin\AuthAdmin');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // Nonaktifkan autoRoute untuk keamanan

/*
 * --------------------------------------------------------------------
 * Definisi Route
 * --------------------------------------------------------------------
 */

// Route untuk Admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    // Auth Admin
    $routes->get('login', 'AuthAdmin::login');
    $routes->post('login', 'AuthAdmin::doLogin');
    $routes->get('register_admin', 'AuthAdmin::register_admin');
    $routes->post('register_admin', 'AuthAdmin::doRegister_admin');
    $routes->get('logout', 'AuthAdmin::logout');

    // Dashboard
    $routes->get('/', 'Admin::dashboard');
    $routes->get('dashboard', 'Admin::dashboard');

    // Manage Layout
    $routes->match(['get', 'post'], 'manage_layout', 'Admin::manage_layout');

    // Route Kategori
    $routes->get('manageCategories', 'CategoryController::index', ['as' => 'admin.manageCategories']);
    $routes->post('categories/add', 'CategoryController::addCategory', ['as' => 'admin.categories.add']);
    $routes->post('categories/edit', 'CategoryController::editCategory', ['as' => 'admin.categories.edit']);
    $routes->get('categories/delete/(:num)', 'CategoryController::deleteCategory/$1', ['as' => 'admin.categories.delete']);

    // Route Produk
    $routes->get('manageProducts', 'ProductController::index', ['as' => 'admin.manageProducts']);
    $routes->post('products/add', 'ProductController::addProduct', ['as' => 'admin.products.add']);
    $routes->post('products/edit', 'ProductController::editProduct', ['as' => 'admin.products.edit']);
    $routes->get('products/delete/(:num)', 'ProductController::deleteProduct/$1', ['as' => 'admin.products.delete']);
});

/*
 * --------------------------------------------------------------------
 * Routing Tambahan
 * --------------------------------------------------------------------
 *
 * Memuat file routing tambahan di sini jika diperlukan.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
