<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class listeHistorique extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("historique");
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Liste des dégustations";

    // Chargement de la session
    $this->load->helper('url');
    // Vérifie si l'utilisateur est déconnecté
    $this->load->view('header-view',$data); // Load header
    $this->load->view('historique-liste-view');
    $this->load->view('footer-view');
  }

    public function apiHistorique()
  {
      $degustations = $this->historique->getAllDegustations();
      $degustations = json_encode($degustations,true);
      echo $degustations;
  }
}
