<?php

namespace app\models;
use Flight;

class CategorieModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    function getAllCategories() {
        $st = $this->db->prepare("SELECT * FROM categorie");
        $st->execute();
        return $st->fetchAll();
    }
}
