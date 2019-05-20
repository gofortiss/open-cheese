<?php
require_once('inc/class.alert.php'); // Appel de la classe alerte
defined('BASEPATH') OR exit('No direct script access allowed');
class Inscription extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("userAction");
    $this->load->helper('url');
  }
  public function index()
  {
    // Titre de la page
    $data['title'] = "Inscription";
    // Nouvelle alerte
    $alert = new Alert();
    // Vérifie message d'erreur si existant
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'pseudo':
          $data['js'] = $alert->warning("Attention","Le pseudo est déjà utilisé");
          break;
        case 'date':
          $data['js'] = $alert->warning("Attention","Il y a eu un problème avec la date");
          break;
        case 'motdepasse':
          $data['js'] = $alert->error("Erreur","Les mots de passe ne correspondent pas");
          break;
        case 'fichier':
          $data['js'] = $alert->error("Erreur","Un problème avec le fichier est survenu");
          break;
      }
    }
    // Vérifie si l'utilisateur est déconnecté
    if(empty($_SESSION['idUser']))
    {
      $this->load->view('header-view',$data); // Load header
      $this->load->view('inscription-view');
      $this->load->view('footer-view');
    }
    else {
      header('Location:'.base_url('index.php/moncompte'));
    }
  }

  public function appelInscription()
  {
      // Création d'un cookie avec les valeur des inputs
      setcookie ('inscription', json_encode($_POST), time() + 240); // heure de création + 240 sec
      // Appel de la fonction création d'utilisateur
      $result = $this->userAction->inscription($_POST,$_FILES);
      // Switch qui renvois sur les pages associée au message
      switch ($result->message[0]) {
        case 'success':
            header('Location:'.base_url('index.php/Connexion'));
            unset($_COOKIE['inscription']); // Suppression du cookie si l'inscription est effectuée
          break;
        case 'pseudo':
            header('Location:'.base_url('index.php/Inscription?message=pseudo')); // Renvoi de la page avec message erreur (Pseudo déjà utilisé)
          break;
        case 'date':
            header('Location:'.base_url('index.php/Inscription?message=date')); // Renvoi de la page avec message erreur (Pseudo déjà utilisé)
          break;
        case 'motdepasse':
            header('Location:'.base_url('index.php/Inscription?message=motdepasse')); // Renvoi de la page avec message erreur (Mot de passe correspond pas)
          break;
        case 'fichier':
            header('Location:'.base_url('index.php/Inscription?message=fichier')); // Renvoi de la page avec message erreur (Mot de passe correspond pas)
          break;
      }
  }
}
