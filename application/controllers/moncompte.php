<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class moncompte extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("userAction");
    $this->load->helper('url');
  }

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
    // Vérifie si l'utilisateur est déconnecté
    if(isset($_SESSION['idUser']))
    {
      $data['userInfo'] = $this->userAction->getInformationsUtilisateur($_SESSION['idUser']);
      $this->load->view('header-view',$data); // Load header
      $this->load->view('moncompte-view');
      $this->load->view('footer-view');
    }
    else {
      header('Location:'.base_url('index.php/Connexion'));
    }
  }
    public function connexion()
  {
    // Retour du résultat
    $result = $this->functions->connexion($_POST);
    // Contrôle résultat
    if($result->success)
    {
      header('Location:'.base_url('index.php/moncompte'));
    }
    else
    {
      header('Location:'.base_url('index.php/moncompte?message=incorrect')); // Renvoi de la page avec message erreur
    }
  }

    public function update()
  {
    // Appel de la fonction mise à jour de l'utilisateur
    $defaultData = $this->userAction->informationsUtilisateur($_SESSION['idUser']); // Données par défaut inscrite dans la db
    $result = $this->userAction->updateInformationsUtilisateur($defaultData, $_POST, $_FILES); // Nouvelles données
    switch ($result->message[0]) {
      case 'pseudo':
          header('Location:'.base_url('index.php/moncompte?message=pseudo'));
        break;
      case 'success':
          header('Location:'.base_url('index.php/moncompte?message=success'));
        break;

      case 'motdepasse':
          header('Location:'.base_url('index.php/moncompte?message=motdepasse'));
        break;
      case 'photo':
          header('Location:'.base_url('index.php/moncompte?message=photo'));
        break;
    }
  }
}
