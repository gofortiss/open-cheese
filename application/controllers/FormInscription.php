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
        case 'pseudo':
          $data['js'] = 'swal("Attention", "Le pseudo est déjà utilisé", "warning", {button: "Continuer",}).catch(swal.noop);';
          break;
        case 'motdepasse':
          $data['js'] = 'swal("Erreur", "Les mots de passe ne correspondent pas", "error", {button: "Continuer",}).catch(swal.noop);';
          break;
        case 'fichier':
          $data['js'] = 'swal("Erreur", "Un problème avec le fichier est survenu", "error", {button: "Continuer",}).catch(swal.noop);';
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
