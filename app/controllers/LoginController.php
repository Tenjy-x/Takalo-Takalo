<?php

namespace app\controllers;

use app\models\UserModel; 
use flight\Engine;
use Flight;

class LoginController {
    public function register() {
        $userModel = new UserModel(Flight::db());
        $username = Flight::request()->data->username;
        $password = Flight::request()->data->password;
        $email = Flight::request()->data->email;
        $role = Flight::request()->data->role;

        if($password === null || $password === '') {
            Flight::halt(400, 'Mot de passe requis');
        }
        $emailBase = $userModel->findByEmail($email);
        if($emailBase != null && !empty($emailBase)) {
            Flight::halt(409, 'Email déjà utilisé');
        }
        
        $password = password_hash($password , PASSWORD_DEFAULT); 
        // if($username === null || $username === '') { 
        //     Flight::halt(400, 'Nom d\'utilisateur requis');
        // }
        // if($email === null || $email === '') {
        //     Flight::halt(400, 'Email requis');
        // }
        // if($role !== 'user' && $role !== 'admin') {
        //     Flight::halt(400, 'Rôle invalide');
        // }
        // $FindUser = $userModel->findUserByUsername($username);
        // if($FindUser != null && !empty($FindUser)) {
        //     Flight::halt(409, 'Nom d\'utilisateur déjà pris');
        // }
        $data = [$username , $email , $password , $role];

        $creation = $userModel->createUser($data);
        Flight::render('ModalLogin' , ['page' => 'Register']);

    }

    public function LogintreatmentAdmin() {
        $username = Flight::request()->data->username;
        $password = Flight::request()->data->password;
        
        $users = new UserModel(Flight::db());

        if($password === null || $password === '') {
            Flight::halt(400, 'Mot de passe requis');
        }

        $FindUser = $users->findUserByUsername($username);
        if($FindUser == null || empty($FindUser)) {
            $data = [$username , password_hash($password, PASSWORD_DEFAULT)];
            $users->createAdmin($data);
            $newUser = $users->findUserByUsername($username);
            $_SESSION['admin'] = $newUser[0];
        } else {
            $user = $FindUser[0];
            $storedPassword = $user['password'] ?? null;
            if($storedPassword === null || !password_verify($password, $storedPassword)) {
                Flight::halt(401, 'Identifiants invalides');
            }
            $_SESSION['admin'] = $user;
        }

        Flight::redirect("/index");
    }

    public function LogintreatmentUser() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $users = new UserModel(Flight::db());
            $username = Flight::request()->data->username;
            $password = Flight::request()->data->password;
            $email = Flight::request()->data->email;

            $data = [$email , $username];

            $find = $users->findByEmailAndUsername($data);
            if($find == null || empty($find)) {
                Flight::render('ModalLogin' , ['page' => 'UserLogin' , 'error' => 'Email or Username Not Found']);
            }
            if($find != null && password_verify($password, $find[0]['mot_de_passe'])) {
                $_SESSION['user'] = $find[0];
                // Flight::redirect("/index");
                Flight::render('Modal' , ['page' => 'welcome']);
            }else{
               Flight::render('ModalLogin' , ['page' => 'UserLogin' , 'error' => 'Password invalid']);
            }
            // if($FindUser == null || empty($FindUser)) {
            //     $data = [$username];
            //     $users->createUser($data);
            //     $newUser = $users->findUserByUsername($username);
            //     $_SESSION['user'] = $newUser[0];
            // } else {
            //     $_SESSION['user'] = $FindUser[0];
            // }        
    }
}

