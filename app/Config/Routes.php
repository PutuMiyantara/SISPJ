<?php

namespace Config;

/**
 * --------------------------------------------------------------------
 * URI Routing
 * --------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *    example.com/class/method/id
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 * The RouteCollection object allows you to modify the way that the
 * Router works, by acting as a holder for it's configuration settings.
 * The following methods can be called on the object to modify
 * the default operations.
 *
 *    $routes->defaultNamespace()
 *
 * Modifies the namespace that is added to a controller if it doesn't
 * already have one. By default this is the global namespace (\).
 *
 *    $routes->defaultController()
 *
 * Changes the name of the class used as a controller when the route
 * points to a folder instead of a class.
 *
 *    $routes->defaultMethod()
 *
 * Assigns the method inside the controller that is ran when the
 * Router is unable to determine the appropriate method to run.
 *
 *    $routes->setAutoRoute()
 *
 * Determines whether the Router will attempt to match URIs to
 * Controllers when no specific route has been defined. If false,
 * only routes that have been defined here will be available.
 */
// $routes->setDefaultNamespace( 'App\Controllers\Main');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('BaseController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('\App\Controllers\BaseController::error404');
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
$routes->get('/', 'basecontroller::default');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// LOGIN
$routes->get('/login', 'Auth::index', ['namespace' => 'App\Controllers\Main']);
$routes->post('/auth/login', 'Auth::index', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/auth/logout', 'Auth::logout', ['namespace' => 'App\Controllers\AJAX']);

// USER Main
$routes->get('/home/admin', 'User::admin', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/user', 'User::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/user/tambah', 'User::tambah', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
// USER AJAX
$routes->get('/user/getUser', 'User::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => false]);
$routes->post('/user/insertData', 'User::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/user/getDetail/(:num)', 'User::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 2, 3], 'ajax' => true]);
$routes->post('/user/updateData/(:num)', 'User::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 2, 3], 'ajax' => true]);
$routes->post('/user/deleteUser', 'User::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' =>3, 'ajax' => true]);

// Rekening Dasar Main
$routes->get('/rekdasar', 'RekeningDasar::index', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/tambah', 'RekeningDasar::index', ['namespace'=> 'App\Controller\Main', 'role' => [1,2,3], 'ajax' =>false]);

// Rekening Dasar Kode Dinas Main
$routes->get('/rekdasar/dinas', 'RekeningDasar::kodeDinas', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
// Rekening Dasar Kode Dinas AJAX
$routes->get('/rekdasar/getKodeDinas', 'KodeDinas::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertKodeDinas', 'KodeDinas::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailKodeDinas/(:num)', 'KodeDinas::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateKodeDinas/(:num)', 'KodeDinas::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteKodeDinas', 'KodeDinas::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

$routes->get('/rekdasar/urusan', 'RekeningDasar::kodeUrusan', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);

$routes->get('/rekdasar/bidang', 'RekeningDasar::kodeBidang', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);

$routes->get('/rekdasar/program', 'RekeningDasar::kodeProgam', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);

$routes->get('/rekdasar/kegiatan', 'RekeningDsar::kodeKegiatan', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);

$routes->get('/rekdasar/unit', 'RekeningDasar::kodeUnit', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);

// Rekening Belanja
$routes->get('/rekbelanja', 'RekeningBelanja::index', ['namespace'=> 'App\Controller\Main', 'role' => [1,2,3], 'ajax' =>false]);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}