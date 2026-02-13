<?php

namespace app\controllers;
use app\models\CategorieModel;
use Flight;

class CategorieController {
    
    public function createCategorie() {
        $categorieModel = new CategorieModel(Flight::db());
        $name = Flight::request()->data->name;
        if($name === null || $name === '') {
            Flight::halt(400, 'Il manque le nom de la catégorie');
        }
        $data = [$name];
        $creation = $categorieModel->createCategorie($data);
        if($creation) {
            Flight::render('Categorie' , ['pages' => 'AdminPage']);
        } else {
            Flight::halt(500, 'Echec de la création de la catégorie');
        }
    }

    public function updateCategorie() {
        $categorieModel = new CategorieModel(Flight::db());
        $id = Flight::request()->data->id;
        $name = Flight::request()->data->name;
        if($id === null || $id === '') {
            Flight::halt(400, 'ID is required');
        }
        if($name === null || $name === '') {
            Flight::halt(400, 'Name is required');
        }
        $data = [$name, $id];
        $update = $categorieModel->updateCategorie($data);
        if($update) {
            Flight::redirect('/categories');
        } else {
            Flight::halt(500, 'Failed to update category');
        }
    }

    public function deleteCategorie() {
        $categorieModel = new CategorieModel(Flight::db());
        $id = Flight::request()->data->id;
        if($id === null || $id === '') {
            Flight::halt(400, 'ID is required');
        }
        $delete = $categorieModel->deleteCategorie($id);
        if($delete) {
            Flight::redirect('/categories');
        } else {
            Flight::halt(500, 'Failed to delete category');
        }
    }
}