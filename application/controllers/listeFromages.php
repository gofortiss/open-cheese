<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class listeFromages extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("fromageAction");
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Liste des fromages";

    // Chargement de la session
    $this->load->helper('url');
    // Vérifie si l'utilisateur est déconnecté
    $this->load->view('header-view',$data); // Load header
    $this->load->view('fromage-liste-view');
    $this->load->view('footer-view');
  }

    public function api()
  {
      $fromages = $this->fromageAction->getAllFromages();
      $fromages = json_encode($fromages,true);
      echo $fromages;
  }
}
