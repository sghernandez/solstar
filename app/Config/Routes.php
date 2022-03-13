<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('Backend\Controllers');
$routes->setDefaultController('Cantantes');
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

$routes->get('/', '\App\Modules\Backend\Controllers\Cantantes::index');

$routes->get('cantantes', '\App\Modules\Backend\Controllers\Cantantes::index');
$routes->get('save', '\App\Modules\Backend\Controllers\Cantantes::save');
$routes->post('save', '\App\Modules\Backend\Controllers\Cantantes::save');
$routes->post('ajax_list', '\App\Modules\Backend\Controllers\Cantantes::ajax_list');
$routes->get('form', '\App\Modules\Backend\Controllers\Cantantes::form');


# $routes->put('productos/(:any)', 'Productos::update/1');
# $routes->patch('productos/(:any)', 'Productos::update/1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
