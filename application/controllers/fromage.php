<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class fromage extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("degustations");
  $this->load->model("functions");
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Dégustation";
    if(isset($_GET['id'])) {
      $data['id'] = $_GET['id'];
    } else {
      $data['id'] = 0;
    }

    // Chargement de la session
    $this->load->helper('url');
    // Vérifie si l'utilisateur est déconnecté
    $this->load->view('header-view',$data); // Load header
    $this->load->view('degustation-view');
    $this->load->view('footer-view');
  }

    public function api()
  {
    if(isset($_GET['id'])){
      $degustation = $this->degustations->getDegustation($_GET['id']);
      $degustation = json_encode($degustation,true);
      echo $degustation;
    } else {
      echo "Error";
    }
  }
}
