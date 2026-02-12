<?php

namespace app\models;
use Flight;

class ObjectModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    function createObject($data) {
        $st = $this->db->prepare("INSERT INTO objet(titre, description , prix_estimatif , id_utilisateur_proprietaire , id_categorie) VALUES (? , ? , ? , ? , ?)");
        $st->execute($data);
    }
}