<?php
 
$route['default_controller'] = 'CampaignController/adminDashboard'; // Default route for Admin Dashboard
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$routes->get('login', 'AuthController::login');
$routes->post('do_login', 'AuthController::do_login');
$routes->get('logout', 'AuthController::logout');

// Admin routes
$routes->get('admin/dashboard', 'CampaignController::index');
$routes->get('admin/create', 'CampaignController::create');
$routes->post('admin/store', 'CampaignController::store');

// Field Worker routes
$routes->get('field-worker/dashboard', 'FieldWorkerController::index');
$routes->post('field-worker/submit', 'FieldWorkerController::submitData');

 
 

// API Routes (Optional - can be extended)
$route['api/campaigns'] = 'VaccinationController/getCampaigns';
$route['api/submit-coverage'] = 'VaccinationController/submitCoverage';
