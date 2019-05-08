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
        case 'success':
          $data['js'] = 'swal("Parfait", "Les données ont bien été modifées", "success", {button: "Continuer",}).catch(swal.noop);';
          break;
        case 'pseudo':
          $data['js'] = 'swal("Attention", "Le pseudo est déjà utilisé", "warning", {button: "Continuer",}).catch(swal.noop);';
          break;
        case 'motdepasse':
          $data['js'] = 'swal("Erreur", "Les mots de passe ne correspondent pas", "error", {button: "Continuer",}).catch(swal.noop);';
          break;
        case 'photo':
          $data['js'] = 'swal("Oupss", "Il y a eu un problème avec le fichier", "error", {button: "Continuer",}).catch(swal.noop);';
          break;
      }
    }
    // Chargement de la session
    $this->load->helper('url');
    $this->load->model("functions");
    // Vérifie si l'utilisateur est déconnecté
    if(isset($_SESSION['idUser']))
    {
      $data['userInfo'] = $this->functions->informationsUtilisateur($_SESSION['idUser']);
      $this->load->view('header-view',$data); // Load header
      $this->load->view('moncompte-view');
      $this->load->view('footer-view');
    }
    else {
      header('Location:'.base_url('index.php/FormConnexion'));
    }
  }
}
