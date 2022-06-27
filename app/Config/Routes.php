<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
 //$routes->resource('tables');
 $routes->group('v1', function ($routes) {
    $routes->post('user/login', 'UserController::login'); 
    $routes->post('user/keylogin', 'UserController::keylogin');
    $routes->post('user/add', 'UserController::postAddUser');
    $routes->get('activation/link', 'UserController::getUserActivateLink');
    $routes->post('activation/now', 'UserController::postUserActivateNow');
    $routes->get('user/(:any)', 'UserController::getUser/$1');
    $routes->get('user', 'UserController::getUser/0');
    $routes->delete('user', 'UserController::deleteUser');
    $routes->get('users', 'APIUser::index');
    $routes->get('users/(:any)', 'APIUser::getUserByUsername/$1');
    $routes->get('tables', 'Tables::list');
    $routes->get('tables/fields/(:any)', 'TablesFields::fields/$1');
    $routes->get('tables/keys/(:any)', 'TablesKeys::list/$1');
    $routes->get('tables/fieldnames/(:any)', 'TablesFields::fieldNames/$1');
    $routes->get('tables/data/(:any)', 'TablesData::getdata/$1/0/0');
    $routes->get('tables/data/(:any)/(:any)/(:any)', 'TablesData::getdata/$1/$2/$3');
    $routes->put('tables/data/(:any)/', 'TablesDataUpdate::updatedata/$1');
    $routes->post('tables/data/(:any)', 'TablesDataInsert::postdata/$1');
    $routes->delete('tables/data/delete/(:any)/(:any)/(:any)', 'TablesDataDelete::deletedata/$1/$2/$3');
    $routes->get('tables/data-by/(:any)/(:any)/(:any)', 'TablesData::getdataby/$1/$2/$3');
    $routes->get('tables/count/(:any)', 'TablesData::getdatacount/$1/0/0');
    $routes->get('tables/search/(:any)', 'Tables::search/$1');
    $routes->get('preview/(:any)', 'Preview::getpreview/$1');
    $routes->get('preview/(:any)/(:any)', 'Preview::getpreview/$1/$2:');
    $routes->post('process/(:any)/(:any)', 'Process::postprocess/$1/$2');
    $routes->post('process/(:any)', 'Process::postprocess/$1/0');
    $routes->get('about', 'About::index');
});
 
 
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
