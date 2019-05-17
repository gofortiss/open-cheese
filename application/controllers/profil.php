<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class profil extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("friendAction");
  $this->load->database();
  $this->load->model("userAction");
  $this->load->helper('url');
}
  public function index()
  {
    // Vérification du paramètre d'url
    if (isset($_GET['id'])) {
      // Titre de la page
      $data['title'] = "Profil";
      // Recupération des données de l'utilisateur
      $data['user'] = $this->userAction->getInformationsUtilisateur($_GET['id']);
      // Vérifie si l'utilisateur est déconnecté
      $this->load->view('header-view',$data); // Load header
      $this->load->view('profil-utilisateur-view');
      $this->load->view('footer-view');
    }
    else{
      // Redirection sur la liste des fromages
        header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

  public function newFriend()
  {
    // Vérification du paramètre d'url et que l'utilisateur soit connecté
    if(isset($_GET['id']) && isset($_SESSION['idUser'])) {
      $liste = $this->friendAction->getAllRelation(); // Liste de toutes les relations
      $relation = $this->friendAction->getRelation($liste); // Liste des relations de l'utilisateur connecté
      $this->friendAction->newRelation($_GET['id'], $relation); // Liste des relations de l'utilisateur connecté

    } else {
      header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

}
