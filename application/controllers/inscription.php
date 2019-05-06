<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inscription extends CI_Controller {
    public function index()
    {
        // Chargement de la session
        $this->load->model("functions");
        $this->load->helper('url');

        // Création d'un cookie avec les valeur des inputs
        setcookie ('inscription', json_encode($_POST), time() + 240); // heure de création + 240 sec
        // Appel de la fonction création d'utilisateur
        $result = $this->functions->inscription($_POST,$_FILES);
        // Switch qui renvois sur les pages associée au message
        switch ($result->message[0]) {
          case 'success':
              header('Location:'.base_url('index.php/FormAccount'));
              unset($_COOKIE['inscription']); // Suppression du cookie si l'inscription est effectuée
            break;
          case 'pseudo':
              header('Location:'.base_url('index.php/FormInscription?message=pseudo')); // Renvoi de la page avec message erreur (Pseudo déjà utilisé)
            break;
          case 'motdepasse':
              header('Location:'.base_url('index.php/FormInscription?message=motdepasse')); // Renvoi de la page avec message erreur (Mot de passe correspond pas)
            break;
          case 'fichier':
              header('Location:'.base_url('index.php/FormInscription?message=fichier')); // Renvoi de la page avec message erreur (Mot de passe correspond pas)
            break;
        }
    }
}
