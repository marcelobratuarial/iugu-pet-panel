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
// $routes->setAutoRoute(true);
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->post('/logar', 'Logar::signin');
$routes->get('/sair', 'Logar::logout');

$routes->get('/mailteste', 'Home::mailTeste');
$routes->get('/', function () {
    return redirect()->to('dashboard'); 
}); //,['filter' => 'authFilter']);
$routes->get('/perfil', 'Home::perfil', ['filter' => 'authFilter']);
$routes->get('/settings', 'Home::settings', ['filter' => 'authFilter']);
$routes->get('/meus-ganhos', 'Home::meusGanhos', ['filter' => 'authFilter']);
$routes->get('/meus-ganhos', 'Home::meusGanhos', ['filter' => 'authFilter']);
$routes->get('/dashboard', 'Home::index', ['filter' => 'authFilter']);
$routes->get('/planos/edit/(:any)', 'Home::planoEdit/$1', ['filter' => 'authFilter']);
$routes->get('/planos/add', 'Home::planoCreate/$1', ['filter' => 'authFilter']);
$routes->get('/planos', 'Home::planos', ['filter' => 'authFilter']);
$routes->get('/assinaturas', 'Home::assinaturas', ['filter' => 'authFilter']);
$routes->get('/assinaturas/details/(:any)', 'Home::assinatura/$1', ['filter' => 'authFilter']);
$routes->get('/clientes', 'Home::customers', ['filter' => 'authFilter']);
$routes->get('/clientes/details/(:any)', 'Home::customer/$1', ['filter' => 'authFilter']);
$routes->get('/services', 'Home::services');
$routes->get('/assinar/(:any)', 'Home::assinar/$1');
// $routes->get('/api', 'Home::api');
$routes->post('/api', 'Home::api'); //,['filter' => 'authFilter']);
$routes->post('/api/cep', 'Home::getCEP'); //,['filter' => 'authFilter']);
$routes->get('/minha-conta/assinaturas', 'MyAccount::assinaturas', ['filter' => 'authFilter']);
$routes->get('/minha-conta/assinatura/(:any)', 'MyAccount::assinatura/$1', ['filter' => 'authFilter']);
$routes->get('/minha-conta/cartao/(:any)', 'MyAccount::cartao/$1', ['filter' => 'authFilter']);
$routes->get('/minha-conta/cartoes', 'MyAccount::cartoes', ['filter' => 'authFilter']);
$routes->get('/minha-conta/pet/(:any)', 'MyAccount::pet/$1', ['filter' => 'authFilter']);
$routes->get('/minha-conta/meus-pets', 'MyAccount::pets', ['filter' => 'authFilter']);
$routes->get('/minha-conta/meus-dados', 'MyAccount::account', ['filter' => 'authFilter']);
$routes->post('/minha-conta/pet/save', 'MyAccount::savePet', ['filter' => 'authFilter']);
$routes->post('/minha-conta/pet/remover', 'MyAccount::removePet', ['filter' => 'authFilter']);
$routes->post('/minha-conta/user/save', 'MyAccount::saveMyData', ['filter' => 'authFilter']);
$routes->post('/minha-conta/user/np/save', 'MyAccount::saveNewPass', ['filter' => 'authFilter']);

$routes->post('/register', 'RegisterController::store');
$routes->post('/check-cEmail', 'RegisterController::checkCustomerMail');
$routes->post('/check-code', 'RegisterController::code_verify');
// $routes->post('/api', 'Home::index');

$routes->get("/auth", 'MyAccount::login');
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
