<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class degustation extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->database();
  $this->load->model("degustationAction");
  $this->load->model("fromageAction");
  $this->load->helper('url');
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Nouvelle dégustation";
    if(isset($_GET['id'])) {
      $data['id'] = $_GET['id'];
    } else {
      $data['id'] = 0;
    }

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('fromage-details-view');
    $this->load->view('footer-view');
  }
}
