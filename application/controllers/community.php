<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('inc/class.auth.php'); // Appel de la classe authentification
class community extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->model("communityAction");
  $this->load->model("userAction");
  $this->load->helper('url');
  $this->load->database();
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Liste des utilisateurs";
    // Vérifie si l'utilisateur est déconnecté
    $this->load->view('header-view',$data); // Load header
    $this->load->view('utilisateur-liste-view');
    $this->load->view('footer-view');
  }

  public function afficherProfil()
  {
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté
    // Vérification du paramètre d'url
    if (isset($_GET['id'])) {
      // Si l'id est égal à l'utilisateur connecté redirection sur mon compte
      if($_GET['id'] == $_SESSION['idUser']) {
        header('Location:'.base_url('index.php/moncompte'));
      }
      // Recupération des données de l'utilisateur
      $data['user'] = $this->userAction->getInformationsUtilisateur($_GET['id']);
      // Titre de la page
      $data['title'] = "Profil de l'utilisateur ".$data['user'][0]->pseudo;
      // Vérifie si l'utilisateur est déconnecté
      $this->load->view('header-view',$data); // Load header
      $this->load->view('profil-utilisateur-view');
      $this->load->view('footer-view');
    }
    else{
      // Redirection sur la liste des fromages
        header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }


  // Nouvel ami
  public function appelNouvelAmi()
  {
    // Vérification du paramètre d'url et que l'utilisateur soit connecté
    if(isset($_GET['id'])) {
      echo json_encode($this->communityAction->newRelation($_GET['id']),true); // Ajour d'une relation
      $this->communityAction->newRelation($_GET['id']); // Liste des relations de l'utilisateur connecté
    } else {
      header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

  // appel d'une relations
  public function appelRelation()
  {
    // Vérification du paramètre d'url et que l'utilisateur soit connecté
    if(isset($_GET['id'])) {
      echo json_encode($this->communityAction->getRelation($_GET['id']),true); // Ajour d'une relation
    } else {
      header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

  // Retirer ami
  public function appelRetirerAmi()
  {
    // Vérification du paramètre d'url et que l'utilisateur soit connecté
    if(isset($_GET['id'])) {
      echo json_encode($this->communityAction->deleteRelation($_GET['id']),true); // Ajour d'une relation
    } else {
      header('Location:'.base_url('index.php/fromage/listeFromage'));
    }
  }

  // Liste amis
  public function apiAmis()
  {
      echo json_encode($this->communityAction->getFriendsList()); // Ajour d'une relation
  }

  // Liste des utilisateurs
  public function apiUtilisateur()
  {
    echo json_encode($this->communityAction->getAllUtilisateur());
  }
}
