<?php

use app\controllers\ApiExampleController;
use app\controllers\ObjectController;
use app\controllers\LoginController; 
use app\models\UserModel;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {
	$router->get('/index', function() use ($app) {
		$app->render('welcome');
	});
	$router->get('/', function() use ($app) {
		$app->render('index');
	});
	
	$router->get('/register', function() use ($app) {
		$app->render('ModalLogin' , ['page' => 'Register']);
	});
	$router->get('/user', function() use ($app) {
		$app->render('ModalLogin' , ['page' => 'UserLogin']);
	});
	$router->get('/admin', function() use ($app) {
		$app->render('ModalLogin' , ['page' => 'AdminLogin']);
	});
	
	$router->get('/Objet', [ObjectController::class, 'getAllObjects']); 
	
	$router->get('/logout', function() use ($app) {
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		session_unset();
		session_destroy();
		$app->redirect('/');
	});
	
	$router->post('/inscription', [LoginController::class, 'register']); 
	$router->post('/adminLogin', [LoginController::class, 'LogintreatmentAdmin']);
	$router->post('/userLogin', [LoginController::class, 'LogintreatmentUser']);

	// $router->group('/api', function() use ($router) {
	// 	$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
	// 	$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
	// 	$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	// });
	
}, [ SecurityHeadersMiddleware::class ]);