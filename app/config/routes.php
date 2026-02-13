<?php

use app\controllers\ApiExampleController;
use app\controllers\AdminController;
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
session_start();

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
	// $router->get('/user', function() use ($app) {
	// 	$app->render('ModalLogin' , ['page' => 'UserLogin']);
	// });
	$router->get('/admin', function() use ($app) {
		$app->render('ModalLogin' , ['page' => 'AdminLogin']);
	});
	$router->get('/admin', function() use ($app) {
		$controller = new ObjectController();
		
		// $router->get('/Objet', [ObjectController::class, 'getAllObjects']); 
		$app->render('ModalLogin' , ['page' => 'AdminLogin' , 'categories' => $controller->getCategories()]);

		// $app->render('ModalLogin' , ['page' => 'UserLogin']);
	});
	
	
	$router->get('/user', function() use ($app) {
		$controller = new ObjectController();

		$app->render('ModalLogin' , ['page' => 'UserLogin' , 'categories' => $controller->getCategories()]);

		// $app->render('ModalLogin' , ['page' => 'UserLogin']);
	});
	$router->get('/home', function() use ($app) {
		$controller = new ObjectController();
		$app->render('Modal' , ['page' => 'welcome' , 'categories' => $controller->getCategories()]);

		// $app->render('ModalLogin' , ['page' => 'UserLogin']);
	});
	
	$router->get('/logout', function() use ($app) {
		session_unset();
		session_destroy();
		$app->redirect('/');
	});
	$router->get('/Objet', function() use ($app) {
		$controller = new ObjectController();
		$objects = $controller->getAllObjects();
		$Categories = $controller->getCategories();
		$app->render('Modal' , ['page' => 'Object' , 'categories' => $Categories , 'objects' => $objects]);
	});

	$router->get('/stat', function() use ($app) {
		$controller = new ObjectController();
		$controllerAdmin = new AdminController();
		$Categories = $controller->getCategories();
		$stats = $controllerAdmin->showStatistics();
		$app->render('ModalAdmin' , ['page' => 'Statistiques' , 'categories' => $Categories ,'totaluser' => $stats['totalUsers'], 'users' => $stats['users']]);
	});

	$router->get('/objet/create', function() use ($app) {
		$controller = new ObjectController();
		$categories = $controller->getCategories();
		$app->render('Modal' , ['page' => 'CreateObject' , 'categories' => $categories]);
	});
	// $router->get('/Objet', [ObjectController::class, 'getAllObjects']); 
	
	$router->post('/inscription', [LoginController::class, 'register']); 
	$router->post('/adminLogin', [LoginController::class, 'LogintreatmentAdmin']);
	$router->post('/userLogin', [LoginController::class, 'LogintreatmentUser']);

	// $router->group('/api', function() use ($router) {
	// 	$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
	// 	$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
	// 	$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	// });
	
}, [ SecurityHeadersMiddleware::class ]);