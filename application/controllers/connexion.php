<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Connexion extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("userAction");
    $this->load->helper('url');
  }

  public function index()
  {
    // Titre de la page
    $data['title'] = "Connexion";
    // Vérifie message d'erreur si existant
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'incorrect':
          $data['js'] = 'swal("Erreur", "Pseudo ou mot de passe incorrect :(", "error", {button: "Continuer",}).catch(swal.noop);';
          break;
      }
    }
    // Vérifie si l'utilisateur est déconnecté
    if(empty($_SESSION['idUser']))
    {
      $this->load->view('header-view',$data); // Load header
      $this->load->view('connexion-view');
      $this->load->view('footer-view');
    }
    else {
      header('Location:'.base_url('index.php/moncompte'));
    }
  }

  public function appelConnexion()
  {
    $result = $this->userAction->connexion($_POST);

    // Contrôle résultat
    if($result->success)
    {
      header('Location:'.base_url('index.php/moncompte'));
    }
    else
    {
      header('Location:'.base_url('index.php/connexion?message=incorrect')); // Renvoi de la page avec message erreur
    }
  }
}
