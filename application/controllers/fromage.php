<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class fromage extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->database();
  $this->load->model("fromageAction");
  $this->load->helper('url');
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Détails du fromage";
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

  // Liste des fromages
  public function listeFromage()
  {
    // Titre de la page
    $data['title'] = "Liste des fromages";

    $this->load->view('header-view',$data); // Load header
    $this->load->view('fromage-liste-view');
    $this->load->view('footer-view');

  }

  // Récupération des fromages
  function apiAllFromages()
  {
    $fromages = $this->fromageAction->getAllFromages();
    $fromages = json_encode($fromages,true);
    echo $fromages;
  }


  // Récupération des informations d'un fromage
  public function apiFromage()
  {
    if(isset($_GET['id'])){
      $degustation = $this->fromageAction->getFromage($_GET['id']);
      $degustation = json_encode($degustation,true);
      echo $degustation;
    } else {
      echo "Error";
    }
  }

  // Chargement de la vue ajouter un fromage
  public function ajouterFromage()
  {
    $data['title'] = "Ajouter un fromage";

    //Requête SQL sur les tables (Données liste déroulante)
    $data['pate'] = $this->db->get('tbltypepate');
    $data['lait'] = $this->db->get('tbllait');
    $data['pasteurise'] = $this->db->get('tblpasteurise');
    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-fromage-view');
    $this->load->view('footer-view');
  }

  // Fonction ajouter un fromage
  public function Ajout()
  {
    $fromages = $this->fromageAction->addFromage($_POST,$_FILES);
  }
}
