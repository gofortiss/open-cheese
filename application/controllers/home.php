<?php
require_once('inc/class.alert.php'); // Appel de la classe alerte
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("User_action");
    $this->load->model("Community_action");
    $this->load->model("Fromage_action");
    $this->load->helper('url');
  }
  public function index()
  {

    // Création du flux d'activité des suivis
    if(isset($_SESSION['idUser'])){
      $data['friends'] = $this->Community_action->getFriendsList();
      $data['degustation'] = [];
      foreach ($data['friends'] as $key => $value) {
        array_push($data['degustation'], $this->Fromage_action->getDegustationUtilisateur($value->num_tblutilisateur2));
      }
    }


    // Titre de la page
    $data['title'] = "Accueil";

    $this->load->view('header-view',$data); // Load header
    $this->load->view('accueil-view');
    $this->load->view('footer-view');
  }
}
