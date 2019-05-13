<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class fromage extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("fromageAction");
  $this->load->helper('url');
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

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('degustation-view');
    $this->load->view('footer-view');
  }

  // Récupération des informations d'un fromage
  public function api()
  {
    if(isset($_GET['id'])){
      $degustation = $this->fromageAction->getFromage($_GET['id']);
      $degustation = json_encode($degustation,true);
      echo $degustation;
    } else {
      echo "Error";
    }
  }

  // Ajout d'un fromage
  public function Ajouter()
  {
    $data['title'] = "Ajouter un fromage";
    $data['pate'] = $this->fromageAction->getTypePate();
    $data['lait'] = $this->fromageAction->getTypeLait();
    $data['pasteurise'] = $this->fromageAction->getPasteurise();
    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-fromage-view');
    $this->load->view('footer-view');
  }
}
