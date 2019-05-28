<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('inc/class.auth.php'); // Appel de la classe authentification
class profil extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("friendAction");
  $this->load->model("userAction");
  $this->load->helper('url');
  $this->load->database();
}
  public function index()
  {
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté
    // Vérification du paramètre d'url
    if (isset($_GET['id'])) {
      // Recupération des données de l'utilisateur
      $data['user'] = $this->userAction->getInformationsUtilisateur($_GET['id']);
      // Titre de la page
      $data['title'] = "Profil de l'utilisateur ".$data['user'][0]->pseudo;
      // Vérifie si l'utilisateur est déconnecté
      $this->load->view('header-view',$data); // Load header
      $this->load->view('profil-utilisateur-view');
      $this->load->view('footer-view');
      var_dump($data);
    }
    else{
      // Redirection sur la liste des fromages
        header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

  public function appelNouvelAmi()
  {
    // Vérification du paramètre d'url et que l'utilisateur soit connecté
    if(isset($_GET['id'])) {
      $this->friendAction->newRelation($_GET['id']); // Liste des relations de l'utilisateur connecté
    } else {
      header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

}
