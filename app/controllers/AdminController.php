<?php

namespace app\controllers;

use app\models\UserModel;
use flight\Engine;
use Flight;

class AdminController {
    public function showStatistics() {
        $userModel = new UserModel(Flight::db());
        $totalUsers = $userModel->countUsers();
        $users = $userModel->getAllUsers();
        return $data = ['totalUsers' => $totalUsers, 'users' => $users];
    }
}