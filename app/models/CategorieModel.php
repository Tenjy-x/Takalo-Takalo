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

    function createCategorie($data) {
        $st = $this->db->prepare("INSERT INTO categorie (name) VALUES (?)");
        return $st->execute($data);
    }

    function updateCategorie($data) {
        $st = $this->db->prepare("UPDATE categorie SET name = ? WHERE id = ?");
        return $st->execute($data);
    }

    function deleteCategorie($id) {
        $st = $this->db->prepare("DELETE FROM categorie WHERE id = ?");
        return $st->execute([$id]);
    }
}
