<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormInscription extends CI_Controller {

  public function index()
  {
    // Titre de la page
    $data['title'] = "Inscription";
    // Vérifie message d'erreur si existant
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'motdepasse':
          $data['js'] = 'swal("Attention", "Les mot de passe ne correspondent pas", "error", {button: "Retour",}).catch(swal.noop);';
          break;
      }
    }
    // Chargement de la session
    $this->load->helper('url');
    $this->load->model("functions");
    // Vérifie si l'utilisateur est déconnecté
    if(empty($_SESSION['idUser']))
    {
      $this->load->view('header-view',$data); // Load header
      $this->load->view('inscription-view');
      $this->load->view('footer-view');
    }
    else {
      header('Location:'.base_url('index.php/FormAccount'));
    }
  }
}
