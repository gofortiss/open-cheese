<?php
class Authentification {
    // Constructeur par défaut
    public function __construct(){
        $this->auth = "";
    }

    public function auth(){
        if(!isset($_SESSION['idUser'])) {
          return header('Location: '.base_url('index.php/Connexion'));
        }
    }
}
