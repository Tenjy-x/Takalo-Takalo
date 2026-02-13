<?php

namespace app\controllers;

use app\models\UserModel; 
use app\models\CategorieModel;
use app\models\ObjectModel;
use flight\Engine;
use Flight;

class ObjectController {
    public function getAllObjects() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            Flight::halt(401, 'Vous devez être connecté');
            return;
        }
        $categorieModel = new CategorieModel(Flight::db());
        $categories = $categorieModel->getAllCategories();
        $userid = $user['id_utilisateur'];
        $objectModel = new ObjectModel(Flight::db());
        $objects = $objectModel->getAllobjetById($userid);

        Flight::render("Modal", [ 'page' => 'Object', 'objects' => $objects , 'categories' => $categories ]);
    }
}