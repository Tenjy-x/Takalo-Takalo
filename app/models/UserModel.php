<?php
namespace app\models;
use Flight;

class UserModel {
    private $db;
    public function __construct($db) {
      $this->db = $db;
    }

    public function createUser($data) {
        $st = $this->db->prepare("INSERT INTO utilisateur(nom , email , mot_de_passe , role) VALUES (? , ? , ? , ?)");
        $st->execute($data);
    }

    public function findByEmail($email) {
      $st = $this->db->prepare("SELECT * FROM utilisateur WHERE email = ?"); 
      $st->execute([$email]);
       return $st->fetchAll(); 
    }

    public function findByEmailadmin($data) {
      $st = $this->db->prepare("SELECT * FROM utilisateur WHERE email = ? AND nom = ? AND role = 'admin'"); 
      $st->execute($data);
       return $st->fetchAll(); 
    } 

    public function findByEmailAndUsername($data) {
      $st = $this->db->prepare("SELECT * FROM utilisateur WHERE email = ? AND nom = ? AND role = 'user'");
      $st->execute($data);
      return $st->fetchAll();
    }

    public function getAllUsers() {
      $st = $this->db->prepare("SELECT * FROM utilisateur");
      $st->execute();
      return $st->fetchAll();
    }

    public function countUsers() {
      $st = $this->db->prepare("SELECT COUNT(*) as total FROM utilisateur");
      $st->execute();
      return $st->fetch()['total'];
    }
    
}