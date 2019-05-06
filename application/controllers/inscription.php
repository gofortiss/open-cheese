<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inscription extends CI_Controller {
    public function index()
    {
        // Chargement de la session
        $this->load->model("functions");
        $this->load->helper('url');
        $result = $this->functions->inscription($_POST,$_FILES);
        switch ($result->message[0]) {
          case 'success':
              header('Location:'.base_url('index.php/FormAccount'));
            break;
          case 'pseudo':
              header('Location:'.base_url('index.php/FormInscription?message=pseudo')); // Renvoi de la page avec message erreur (Pseudo déjà utilisé)
            break;
          case 'motdepasse':
              header('Location:'.base_url('index.php/FormInscription?message=motdepasse')); // Renvoi de la page avec message erreur (Mot de passe correspond pas)
            break;
        }
    }
}
