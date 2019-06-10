<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Liste_historique extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("Historique");
  $this->load->model("Community_action");
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Liste des dégustations";

    // Chargement de la session
    $this->load->helper('url');
    // Vérifie si l'utilisateur est déconnecté
    $this->load->view('header-view',$data); // Load header
    $this->load->view('Historique-liste-view');
    $this->load->view('footer-view');
  }

  // Affiche toutes les dégustations de tout les utilisateurs
    public function apiHistorique()
  {
      $degustations = $this->Historique->getAllDegustations();
      $degustations = json_encode($degustations,true);
      echo $degustations;
  }

  // // Retourne un tableau des dégustations d'un utilisateur
  //   public function apiDegustationUtilisateur()
  // {
  //   if(isset($_GET['id'])){
  //     $data['degustation'] = $this->Fromage_action->getDegustationUtilisateur($_GET['id']);
  //     $degustation = json_encode($data,true);
  //     echo $degustation;
  //   } else {
  //     echo "Error";
  //   }
  // }
}
