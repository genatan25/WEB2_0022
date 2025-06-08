<?php

// Route untuk Admin dengan prefiks 'admin'
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

    //detail produk
    $routes->get('productDetails', 'ProductDetails::index', ['as' => 'admin.productDetails']);
    $routes->post('productDetails/add', 'ProductDetails::add', ['as' => 'admin.productDetails.add']);
    $routes->post('productDetails/edit', 'ProductDetails::edit', ['as' => 'admin.productDetails.edit']);
    $routes->get('productDetails/delete/(:num)', 'ProductDetails::delete/$1', ['as' => 'admin.productDetails.delete']);

    //order
    $routes->get('orders', 'OrdersController::index', ['as' => 'admin.orders']);
    $routes->get('orders/getTransactionDetails/(:num)', 'OrdersController::getTransactionDetails/$1');
});


$routes->group('user/auth', ['namespace' => 'App\Controllers\User'], function ($routes) {
    // Halaman Login
    $routes->get('login', 'AuthUser::login');

    // Proses Login
    $routes->post('loginProcess', 'AuthUser::loginProcess');

    // Halaman Registrasi
    $routes->get('register', 'AuthUser::register');

    // Proses Registrasi
    $routes->post('registerProcess', 'AuthUser::registerProcess');

    // Proses Logout
    $routes->get('logout', 'AuthUser::logout');
});

/*
 * --------------------------------------------------------------------
 * Rute Pengguna
 * --------------------------------------------------------------------
 */
$routes->get('/', 'User\HomeController::index');
$routes->group('user', ['namespace' => 'App\Controllers\User'], function ($routes) {
    $routes->get('/', 'HomeController::index'); // /user/
    $routes->get('product-list', 'ProductListController::index'); // /user/product-list
    $routes->get('tentang-kami', 'TentangKamiController::index'); // /user/tentang-kami
    $routes->get('product-detail/(:num)', 'HomeController::productDetail/$1'); // /user/product-detail/{id}

    $routes->get('/order', 'OrderController::index');
    $routes->get('/order/show/(:num)', 'OrderController::show/$1');
    $routes->get('/order/cancel/(:num)', 'OrderController::cancel/$1');
    $routes->post('/order/create', 'OrderController::create');
});
$routes->post('user/purchase', 'Admin\OrdersController::purchase');


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
