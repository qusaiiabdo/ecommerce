<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->add('productcontroller/delete/(:any)','productcontroller::delete/$1');
//$routes->get('productcontroller/delete/(:num)', 'ProductController::delete/$1');

$routes->get('/', 'ProductController::index');
$routes->get('/list', 'ProductController::index');
$routes->post('add-product', 'ProductController::store');
//$routes->get('edit-product/(:num)', 'ProductController::edit/$1');
$routes->post('update-product', 'ProductController::update');
$routes->post('delete-product', 'ProductController::delete');

//$routes->get('productcontroller/edit/(:num)','Productcontroller::edit/$1');

$routes->get('productcontroller/test','Productcontroller::test', ['as' => 'test']);
$routes->get('productcontroller/store','Productcontroller::create',['as'=>'create']);
$routes->get('productcontroller/edit/(:num)','Productcontroller::edit/$1',['as'=>'edit']);
$routes->get('productcontroller/delete/(:num)','Productcontroller::delete/$1',['as'=>'delete']);




$routes->group('clientdashboard',['filter'=>'authguard'],function($routes){
    $routes->get('cartItems','Clientdashboard::cartitems',['as'=>'cartitems']);
    $routes->get('checkout','Clientdashboard::checkout');
    $routes->post('addtoCart/(:num)','Clientdashboard::addtoCart/$1');
   // $routes->get('')
});

$routes->get('client/auth/login','client\auth::login',['filter'=>'loggedin', 'as' => 'auth.login']);

$routes->get('clientdashboard/addtoCart/(:num)','Clientdashboard::addtoCart/$1',['filter'=>'authguard']);






// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->match(['get','post'],'/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
