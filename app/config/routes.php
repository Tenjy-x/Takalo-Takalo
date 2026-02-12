<?php

use app\controllers\ApiExampleController;
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

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});


	$router->post('/inscription', [loginController::class, 'register']);
	$router->get('/adminLogin', [loginController::class, 'LogintreatmentAdmin']);
	$router->post('/userLogin', [loginController::class, 'LogintreatmentUser']);

	// $router->group('/api', function() use ($router) {
	// 	$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
	// 	$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
	// 	$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	// });
	
}, [ SecurityHeadersMiddleware::class ]);