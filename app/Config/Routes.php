<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==================== HOME ====================
$routes->get('/', 'User::login');

// ==================== AUTHENTIFICATION ====================
$routes->get('/login', 'User::login');
$routes->post('/authenticate', 'User::authenticate');
$routes->get('/register', 'User::registerStep1');
$routes->post('/register/step2', 'User::registerStep2');
$routes->post('/register/complete', 'User::register');
$routes->get('/logout', 'User::logout');

// ==================== PROFIL UTILISATEUR (Front Office) ====================
$routes->get('/profile', 'User::profile');
$routes->post('/profile/update', 'User::updateProfile');

// ==================== OBJECTIFS (Front Office) ====================
$routes->get('/objectifs/choose', 'Objectif::chooseObjectifs');
$routes->post('/objectifs/add', 'Objectif::addObjectif');
$routes->get('/objectifs/remove/(:num)', 'Objectif::removeObjectif/$1');

// ==================== CODES/PORTEFEUILLE ====================
$routes->post('/codes/redeem', 'Code::redeem');

// ==================== GOLD ====================
$routes->get('/gold/activate', 'Gold::activate');
$routes->post('/gold/purchase', 'Gold::purchase');

// ==================== SUGGESTIONS (Front Office) ====================
$routes->get('/suggestions', 'Suggestion::index');
$routes->get('/suggestions/regime/(:num)', 'Suggestion::showRegimeDetails/$1');
$routes->get('/suggestions/activite/(:num)', 'Suggestion::showActiviteDetails/$1');
$routes->get('/suggestions/purchase/(:num)', 'Suggestion::purchaseRegime/$1');
$routes->post('/suggestions/purchase', 'Suggestion::confirmPurchase');

// ==================== BACK OFFICE - AUTHENTIFICATION ADMIN ====================
$routes->get('/admin/login', 'User::login');
$routes->post('/admin/authenticate', 'User::authenticate');
$routes->get('/admin/logout', 'User::logout');

// ==================== BACK OFFICE - DASHBOARD ====================
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/stats', 'Dashboard::stats');
$routes->get('/dashboard/ajax-stats', 'Dashboard::ajaxStats');
$routes->get('/dashboard/export-pdf', 'Dashboard::exportPdf');

// ==================== BACK OFFICE - ACTIVITES ====================
$routes->get('/activites', 'Activite::index');
$routes->get('/activites/create', 'Activite::create');
$routes->post('/activites/store', 'Activite::store');
$routes->get('/activites/edit/(:num)', 'Activite::edit/$1');
$routes->post('/activites/update/(:num)', 'Activite::update/$1');
$routes->get('/activites/delete/(:num)', 'Activite::delete/$1');

// ==================== BACK OFFICE - REGIMES ====================
$routes->get('/regimes', 'Regime::index');
$routes->get('/regimes/create', 'Regime::create');
$routes->post('/regimes/store', 'Regime::store');
$routes->get('/regimes/edit/(:num)', 'Regime::edit/$1');
$routes->post('/regimes/update/(:num)', 'Regime::update/$1');
$routes->get('/regimes/delete/(:num)', 'Regime::delete/$1');
$routes->get('/regimes/manage-prices/(:num)', 'Regime::managePrices/$1');
$routes->post('/regimes/add-price/(:num)', 'Regime::addPrice/$1');

// ==================== BACK OFFICE - CODES ====================
$routes->get('/codes', 'Code::index');
$routes->get('/codes/create', 'Code::create');
$routes->post('/codes/store', 'Code::store');
$routes->get('/codes/edit/(:num)', 'Code::edit/$1');
$routes->post('/codes/update/(:num)', 'Code::update/$1');
$routes->get('/codes/delete/(:num)', 'Code::delete/$1');

// ==================== BACK OFFICE - OBJECTIFS ====================
$routes->get('/objectifs', 'Objectif::index');
$routes->get('/objectifs/create', 'Objectif::create');
$routes->post('/objectifs/store', 'Objectif::store');
$routes->get('/objectifs/edit/(:num)', 'Objectif::edit/$1');
$routes->post('/objectifs/update/(:num)', 'Objectif::update/$1');
$routes->get('/objectifs/delete/(:num)', 'Objectif::delete/$1');

// ==================== BACK OFFICE - UTILISATEURS ====================
$routes->get('/users', 'User::index');
$routes->get('/users/view/(:num)', 'User::view/$1');

// ==================== BACK OFFICE - GOLD ====================
$routes->get('/gold/transactions', 'Gold::index');

// ==================== BACK OFFICE - PARAMETRES ====================
$routes->get('/parametres', 'Parametre::index');
$routes->get('/parametres/create', 'Parametre::create');
$routes->post('/parametres/store', 'Parametre::store');
$routes->get('/parametres/edit/(:num)', 'Parametre::edit/$1');
$routes->post('/parametres/update/(:num)', 'Parametre::update/$1');
$routes->get('/parametres/delete/(:num)', 'Parametre::delete/$1');