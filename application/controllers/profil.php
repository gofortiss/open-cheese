<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class profil extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("userAction");
  $this->load->helper('url');
}
  public function index()
  {
    if (isset($_GET['id'])) {
      // Titre de la page
      $data['title'] = "Profil";
      // Recupération des données de l'utilisateur
      $data['user'] = $this->userAction->getInformationsUtilisateur($_GET['id']);
      // Vérifie si l'utilisateur est déconnecté
      $this->load->view('header-view',$data); // Load header
      $this->load->view('profil-utilisateur-view');
      $this->load->view('footer-view');
    }
    else{
        header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

}
