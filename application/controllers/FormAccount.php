<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormAccount extends CI_Controller {

  public function index()
  {
    // Titre de la page
    $data['title'] = "Mon compte";
    // Vérifie message d'erreur si existant
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'incorrect':
          $data['js'] = 'swal("Erreur", "Pseudo ou mot de passe incorrect :(", "error", {button: "Continuer",}).catch(swal.noop);';
          break;
      }
    }
    // Chargement de la session
    $this->load->helper('url');
    $this->load->model("functions");
    // Vérifie si l'utilisateur est déconnecté
    if(isset($_SESSION['idUser']))
    {
      $this->load->view('header-view',$data); // Load header
      $this->load->view('moncompte-view');
      $this->load->view('footer-view');
    }
    else {
      header('Location:'.base_url('index.php/FormConnexion'));
    }
  }
}
