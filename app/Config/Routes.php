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

// Penannggung Jawab
$routes->get('/penanggungjawab', 'PenanggungJawab::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);

$routes->get('/penanggungjawab/kpa_ppk', 'PenanggungJawab::kpa_ppk', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/penanggungjawab/getKpaPpk', 'KpaPpk::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/insertKpaPpk', 'KpaPpk::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/penanggungjawab/getDetailKpaPpk/(:num)', 'KpaPpk::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/updateKpaPpk/(:num)', 'KpaPpk::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/deleteKpaPpk', 'KpaPpk::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

$routes->get('/penanggungjawab/pptk', 'PenanggungJawab::pptk', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/penanggungjawab/getPptk', 'Pptk::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/insertPptk', 'Pptk::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/penanggungjawab/getDetailPptk/(:num)', 'Pptk::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/updatePptk/(:num)', 'Pptk::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/deletePptk', 'Pptk::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

$routes->get('/penanggungjawab/bendahara', 'PenanggungJawab::bendahara', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/penanggungjawab/getBendahara', 'Bendahara::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/insertBendahara', 'Bendahara::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/penanggungjawab/getDetailBendahara/(:num)', 'Bendahara::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/updateBendahara/(:num)', 'Bendahara::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/penanggungjawab/deleteBendahara', 'Bendahara::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Dasar
$routes->get('/rekdasar', 'RekeningDasar::index', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/getRekeningDasar/(:num)', 'RekeningDasar::index/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getTahunAnggaran', 'RekeningDasar::getTahunAnggaran', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertRekeningDasar', 'RekeningDasar::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailRekeningDasar/(:num)', 'RekeningDasar::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateRekeningDasar/(:num)', 'RekeningDasar::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteRekeningDasar', 'RekeningDasar::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Dasar Kode Dinas
$routes->get('/rekdasar/dinas', 'RekeningDasar::kodeDinas', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/getKodeDinas', 'KodeDinas::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertKodeDinas', 'KodeDinas::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailKodeDinas/(:num)', 'KodeDinas::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateKodeDinas/(:num)', 'KodeDinas::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteKodeDinas', 'KodeDinas::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Dasar Kode Urusan
$routes->get('/rekdasar/urusan', 'RekeningDasar::kodeUrusan', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/getKodeUrusan', 'KodeUrusan::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertKodeUrusan', 'KodeUrusan::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailKodeUrusan/(:num)', 'KodeUrusan::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateKodeUrusan/(:num)', 'KodeUrusan::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteKodeUrusan', 'KodeUrusan::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Dasar Kode Bidang
$routes->get('/rekdasar/bidang', 'RekeningDasar::kodeBidang', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/getKodeBidang', 'KodeBidang::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertKodeBidang', 'KodeBidang::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailKodeBidang/(:num)', 'KodeBidang::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateKodeBidang/(:num)', 'KodeBidang::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteKodeBidang', 'KodeBidang::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Dasar Kode Program
$routes->get('/rekdasar/program', 'RekeningDasar::kodeProgram', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/getKodeProgram', 'KodeProgram::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertKodeProgram', 'KodeProgram::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailKodeProgram/(:num)', 'KodeProgram::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateKodeProgram/(:num)', 'KodeProgram::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteKodeProgram', 'KodeProgram::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Dasar Kode Kegiatan
$routes->get('/rekdasar/kegiatan', 'RekeningDasar::kodeKegiatan', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/getKodeKegiatan', 'KodeKegiatan::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertKodeKegiatan', 'KodeKegiatan::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailKodeKegiatan/(:num)', 'KodeKegiatan::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateKodeKegiatan/(:num)', 'KodeKegiatan::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteKodeKegiatan', 'KodeKegiatan::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

$routes->get('/rekdasar/unit', 'RekeningDasar::kodeUnit', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekdasar/getKodeUnit', 'KodeUnit::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/insertKodeUnit', 'KodeUnit::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekdasar/getDetailKodeUnit/(:num)', 'KodeUnit::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/updateKodeUnit/(:num)', 'KodeUnit::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekdasar/deleteKodeUnit', 'KodeUnit::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Belanja
$routes->get('/rekbelanja', 'RekeningBelanja::index', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
// Rekening Belanja Kode Sub1
$routes->get('/rekbelanja/kodesub1', 'RekeningBelanja::sub1', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekbelanja/searchRekDasar', 'KodeBelanjaSub1::searchRekDasar', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/rekbelanja/getKodeBelanjaSub1', 'KodeBelanjaSub1::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/insertKodeBelanjaSub1', 'KodeBelanjaSub1::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekbelanja/getDetailKodeBelanjaSub1/(:num)', 'KodeBelanjaSub1::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/updateKodeBelanjaSub1/(:num)', 'KodeBelanjaSub1::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/deleteKodeBelanjaSub1', 'KodeBelanjaSub1::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Belanja Kode Sub2
$routes->get('/rekbelanja/kodesub2', 'RekeningBelanja::sub2', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekbelanja/searchRekBelanjaSub1/(:num)', 'KodeBelanjaSub2::searchReBelanjaSub1/$1', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/rekbelanja/getKodeBelanjaSub2', 'KodeBelanjaSub2::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/insertKodeBelanjaSub2', 'KodeBelanjaSub2::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekbelanja/getDetailKodeBelanjaSub2/(:num)', 'KodeBelanjaSub2::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/updateKodeBelanjaSub2/(:num)', 'KodeBelanjaSub2::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/deleteKodeBelanjaSub2', 'KodeBelanjaSub2::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Belanja Kode Sub3
$routes->get('/rekbelanja/kodesub3', 'RekeningBelanja::sub3', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekbelanja/searchRekBelanjaSub2/(:num)', 'KodeBelanjaSub3::searchReBelanjaSub2/$1', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/rekbelanja/getKodeBelanjaSub3', 'KodeBelanjaSub3::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/insertKodeBelanjaSub3', 'KodeBelanjaSub3::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekbelanja/getDetailKodeBelanjaSub3/(:num)', 'KodeBelanjaSub3::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/updateKodeBelanjaSub3/(:num)', 'KodeBelanjaSub3::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/deleteKodeBelanjaSub3', 'KodeBelanjaSub3::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Belanja Kode Sub4
$routes->get('/rekbelanja/kodesub4', 'RekeningBelanja::sub4', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekbelanja/searchRekBelanjaSub3/(:num)', 'KodeBelanjaSub4::searchReBelanjaSub3/$1', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/rekbelanja/getKodeBelanjaSub4', 'KodeBelanjaSub4::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/insertKodeBelanjaSub4', 'KodeBelanjaSub4::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekbelanja/getDetailKodeBelanjaSub4/(:num)', 'KodeBelanjaSub4::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/updateKodeBelanjaSub4/(:num)', 'KodeBelanjaSub4::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/deleteKodeBelanjaSub4', 'KodeBelanjaSub4::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Rekening Belanja Kode Sub5
$routes->get('/rekbelanja/kodesub5', 'RekeningBelanja::sub5', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekbelanja/searchRekBelanjaSub4/(:num)', 'KodeBelanjaSub5::searchReBelanjaSub4/$1', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/rekbelanja/getKodeBelanjaSub5', 'KodeBelanjaSub5::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/insertKodeBelanjaSub5', 'KodeBelanjaSub5::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/rekbelanja/getDetailKodeBelanjaSub5/(:num)', 'KodeBelanjaSub5::getDetail/$1', ['namespace' => 'App\Controllers\AJAX']);
$routes->post('/rekbelanja/updateKodeBelanjaSub5/(:num)', 'KodeBelanjaSub5::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/rekbelanja/deleteKodeBelanjaSub5', 'KodeBelanjaSub5::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// Orders
$routes->get('/orders/', 'Orders::index', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/orders/getOrders', 'Orders::index', ['namespace' => 'App\Controllers\AJAX']);
$routes->post('/orders/insertOrders', 'Orders::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/orders/getDetailOrders/(:num)', 'Orders::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/orders/updateOrders/(:num)', 'Orders::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/orders/deleteOrders', 'Orders::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/orders/getInstansiRekanan', 'Orders::getInstansiRekanan', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/orders/getRekBelanja/(:num)', 'Orders::searchReBelanja/$1', ['namespace' => 'App\Controllers\AJAX']);

// Rekanan
$routes->get('/rekanan/', 'Rekanan::index', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/rekanan/getRekanan', 'Rekanan::index', ['namespace' => 'App\Controllers\AJAX']);
$routes->post('/rekanan/insertRekanan', 'Rekanan::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
// $routes->get('/orders/getDetailOrders/(:num)', 'Orders::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
// $routes->post('/orders/updateOrders/(:num)', 'KodeBelanjaSub5::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
// $routes->post('/orders/deleteKodeBelanjaSub5', 'KodeBelanjaSub5::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
// $routes->get('/orders/getInstansiRekanan', 'Orders::getInstansiRekanan', ['namespace' => 'App\Controllers\AJAX']);
// $routes->get('/orders/getRekBelanja/(:num)', 'Orders::searchReBelanja/$1', ['namespace' => 'App\Controllers\AJAX']);

// Kuwitansi
$routes->get('/kuwitansi/', 'Kuwitansi::index', ['namespace'=> 'App\Controllers\Main', 'role' => [1,2,3], 'ajax' =>false]);
$routes->get('/kuwitansi/getKuwitansi', 'Kuwitansi::index', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/rekbelanja/searchOrders/(:num)', 'Kuwitansi::searchOrders/$1', ['namespace' => 'App\Controllers\AJAX']);
$routes->post('/kuwitansi/insertKuwitansi', 'Kuwitansi::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/kuwitansi/getDetailKuwitansi/(:num)', 'Kuwitansi::getDetail/$1', ['namespace' => 'App\Controllers\AJAX']);
$routes->post('/kuwitansi/updateKuwitansi/(:num)', 'Kuwitansi::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/kuwitansi/deleteKuwitansi', 'Kuwitansi::deleteData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/kuwitansi/cetakKuwitansi/(:num)', 'Kuwitansi::cetakKuwitansi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

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