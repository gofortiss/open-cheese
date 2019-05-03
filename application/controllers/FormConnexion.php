<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormConnexion extends CI_Controller {

  public function index()
  {
    // Titre de la page
    $data['title'] = "Connexion";
    // Vérifie message d'erreur si existant
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'incorrect':
          $data['js'] = 'swal("Erreur", "Il semblerait que vous-vous soyez tromper :(", "error", {button: "Continuer",}).catch(swal.noop);';
          break;

        case 'vide':
          $data['js'] = 'swal("Attention", "Veuillez remplir les champs", "warning", {button: "Retour",}).catch(swal.noop);';
          break;
      }
    }
    // Chargement de la session
    $this->load->helper('url');
    $this->load->model("functions");
    $this->load->view('header-view',$data); // Load header
    $this->load->view('connexion-view');
  }
}
