<?php
require_once('inc/class.alert.php'); // Appel de la classe alerte
defined('BASEPATH') OR exit('No direct script access allowed');
class home extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("userAction");
    $this->load->model("communityAction");
    $this->load->model("fromageAction");
    $this->load->helper('url');
  }
  public function index()
  {

    // Création du flux d'activité des suivis
    if(isset($_SESSION['idUser'])){
      $data['friends'] = $this->communityAction->getFriendsList();
      $data['degustation'] = [];
      foreach ($data['friends'] as $key => $value) {
        array_push($data['degustation'], $this->fromageAction->getDegustationUtilisateur($value->num_tblutilisateur2));
      }
    }


    // Titre de la page
    $data['title'] = "Accueil";

    $this->load->view('header-view',$data); // Load header
    $this->load->view('accueil-view');
    $this->load->view('footer-view');
  }
}
