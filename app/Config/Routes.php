<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/home', 'Home::index');
$routes->get('/calculator_1', 'Calculator::index');
$routes->get('/my_functon', 'Calculator::my_function');
$routes->get('/addition', 'Calculator::add');
$routes->get('/accounts', 'Account_controller::index');
$routes->post('/accounts/loginPost', 'Account_controller::loginPost');
$routes->post('/accounts/save_account_data', 'Account_controller::save_account_data');
$routes->post('/accounts/delete_account_data', 'Account_controller::delete_account_data');
$routes->post('/accounts/update_account_data', 'Account_controller::update_account_data');
$routes->get('/accounts/sesson_data', 'Account_controller::sesson_data');
$routes->get('/accounts_data', 'Accounts_data_controller::index');
$routes->post('/accounts_data/save_accounts_data', 'Accounts_data_controller::save_accounts_data');
$routes->post('/accounts_data/delete_accounts_data', 'Accounts_data_controller::delete_accounts_data');
$routes->post('/csvPost', 'Accounts_data_controller::csvPost');
$routes->get('/dashboard', 'Dashboard_controller::index');
$routes->post('/accounts_data/get_fields_data', 'Accounts_data_controller::get_fields_data');
$routes->post('/accounts_data/update_acc_data', 'Accounts_data_controller::update_acc_data');
$routes->get('/login', 'Login_controller::login');
$routes->post('/Login_controller/loginPost', 'Login_controller::loginPost');
$routes->get('/logout', 'Login_controller::logout');
$routes->get('/signup', 'SignupController::index');
$routes->post('/SingupController/signupPost', 'SignupController::signupPost');
$routes->get('/at', 'At_controller::index', ['filter' => 'auth']);



