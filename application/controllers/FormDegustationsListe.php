<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormDegustationsListe extends CI_Controller {

  public function index()
  {
    // Titre de la page
    $data['title'] = "Liste des dégustations";

    // Chargement de la session
    $this->load->helper('url');
    $this->load->model("functions");
    // Vérifie si l'utilisateur est déconnecté
    $this->load->view('header-view',$data); // Load header
    $this->load->view('degustations-liste-view');
    $this->load->view('footer-view');
  }
}
