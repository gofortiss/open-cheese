<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class listeDegustations extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("degustations");
  $this->load->model("functions");
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Liste des dégustations";

    // Chargement de la session
    $this->load->helper('url');
    // Vérifie si l'utilisateur est déconnecté
    $this->load->view('header-view',$data); // Load header
    $this->load->view('degustations-liste-view');
    $this->load->view('footer-view');
  }

    public function api()
  {
      $degustations = $this->degustations->getDegustations();
      $degustations = json_encode($degustations,true);
      echo $degustations;
  }
}
