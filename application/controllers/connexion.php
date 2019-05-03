<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Connexion extends CI_Controller {
    public function index()
    {

        // Chargement de la session
        $this->load->model("functions");
        $this->load->helper('url');

        // Vérifie si le mot de passe et l'adresse e-mail ne sois pas vides
        if($_POST['pseudo'] != "" && $_POST['password'] != "")
        {
            // Retour du résultat
            $result = $this->functions->connexion($_POST['pseudo'], $_POST['password']);
            var_dump($result);
            // Contrôle résultat
            if($result->success)
            {
              header('Location:'.base_url('index.php/FormAccount'));
            }
            else
            {
              header('Location:'.base_url('index.php/FormConnexion?message=incorrect')); // Renvoi de la page avec message erreur
            }
        }
        else
        {
          header('Location:'.base_url('index.php/FormConnexion?message=vide')); // Renvoi de la page avec message chaîne vide
        }
    }
}
