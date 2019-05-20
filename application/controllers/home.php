<?php
require_once('inc/class.alert.php'); // Appel de la classe alerte
defined('BASEPATH') OR exit('No direct script access allowed');
class home extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("userAction");
    $this->load->helper('url');
  }
  public function index()
  {
    // Titre de la page
    $data['title'] = "Accueil";

    $this->load->view('header-view',$data); // Load header
    $this->load->view('accueil-view');
    $this->load->view('footer-view');
  }
}
