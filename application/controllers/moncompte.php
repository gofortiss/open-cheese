<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('inc/class.alert.php'); // Appel de la classe alerte
class moncompte extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("userAction");
    $this->load->database();
    $this->load->helper('url');
  }

  public function index()
  {
    // Titre de la page
    $data['title'] = "Mon compte";
    // Nouvelle alerte
    $alert = new Alert();
    // Vérifie message d'erreur si existant
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'pseudo':
          $data['js'] = $alert->warning("Attention","Le pseudo est déjà utilisé");
        break;
        case 'success':
          $data['js'] = $alert->success("Parfait","Les données ont bien été modifées");
          break;
        case 'motdepasse':
          $data['js'] = $alert->error("Erreur","Les mots de passe ne correspondent pas");
          break;
        case 'photo':
          $data['js'] = $alert->error("Oupss","Il y a eu un problème avec le fichier");
          break;
      }
    }
    // Vérifie si l'utilisateur est déconnecté
    if(isset($_SESSION['idUser']))
    {
      $data['userInfo'] = $this->userAction->getInformationsUtilisateur($_SESSION['idUser']); // Récupération des données de l'utilisateur
      $this->load->view('header-view',$data); // Chargement du header
      $this->load->view('moncompte-view'); // Chargemnt de la page
      $this->load->view('footer-view'); // Chargement du footer
    }
    else {
      header('Location:'.base_url('index.php/Connexion'));
    }
  }

    public function appelUpdate()
  {
    // Appel de la fonction mise à jour de l'utilisateur
    $defaultData = $this->userAction->getInformationsUtilisateur(); // Données par défaut inscrite dans la db
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
