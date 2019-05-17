<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class fromage extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->database();
  $this->load->model("fromageAction");
  $this->load->model("producteurAction");
  $this->load->helper('url');
}
  public function index()
  {
    // Titre de la page
    $data['title'] = "Détails du fromage";
    // Vérification si un paramètre est existant
      if(isset($_GET['id'])) {
        // Envoi du fromage sélectionner à la vue
        $data['id'] = $_GET['id'];
      } else {
        // Redirection sur la liste des fromages
        header('Location:'.base_url('index.php/fromage/listeFromage'));
      }
    // Récupération des dégustations
    $data['degustation'] = $this->fromageAction->getDegustation($_GET['id']);

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('fromage-details-view');
    $this->load->view('footer-view');
  }

  // Liste des fromages
  public function listeFromage()
  {
    // Titre de la page
    $data['title'] = "Liste des fromages";

    $this->load->view('header-view',$data); // Load header
    $this->load->view('fromage-liste-view');
    $this->load->view('footer-view');

  }

  // Récupération des fromages
  function apiAllFromages()
  {
    $fromages = $this->fromageAction->getAllFromages();
    $fromages = json_encode($fromages,true);
    echo $fromages;
  }


  // Récupération des informations d'un fromage
  public function apiFromage()
  {
    if(isset($_GET['id'])){
      $fromage = $this->fromageAction->getFromage($_GET['id']);
      $fromage = json_encode($fromage,true);
      echo $fromage;
    } else {
      echo "Error";
    }
  }

  // Retourne un tableau JSON des dégustations
  public function apiDegustation()
  {
    if(isset($_GET['id'])){
      $degustation = $this->fromageAction->getDegustation($_GET['id']);
      $degustation = json_encode($degustation,true);
      echo $degustation;
    } else {
      echo "Error";
    }
  }

  // Chargement de la vue ajouter un fromage
  public function ajouterFromage()
  {
    $data['title'] = "Ajouter un fromage";

    //Requête SQL sur les tables (Données liste déroulante)
    $data['pate'] = $this->fromageAction->getTypePate();
    $data['lait'] = $this->fromageAction->getLait();
    $data['pasteurise'] = $this->fromageAction->getPasteurise();
    $data['producteur'] = $this->producteurAction->getAllProducteurs();

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-fromage-view');
    $this->load->view('footer-view');
  }

  // Fonction ajouter un fromage
  public function appelAjoutFromage()
  {
    $this->fromageAction->addFromage($_POST,$_FILES);
    header('Location:'.base_url('index.php/fromage/listeFromage'));
  }

  public function ajouterDegustation()
  {
    $data['title'] = "Ajouter une dégustation";
    // Retour requête SQL sur toute la table fromage
    $data['fromage'] = $this->fromageAction->getAllFromages();

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-degustation-view');
    $this->load->view('footer-view');
  }

  // Fonction ajouter un fromage
  public function appelAjoutDegustation()
  {
    $this->fromageAction->addDegustation($_POST,$_FILES,$_GET['id']);
    header('Location:'.base_url('index.php/fromage/?id='.$_GET['id']));
  }

  // Ajouter un "Like" sur une dégustation
  public function addLike()
  {
    // Vérification si un paramètre est entré
    if(isset($_GET['degustation']) && isset($_GET['fromage']))
    {
      $this->fromageAction->addLikeDegustation($_GET['degustation']);
      // Redirection sur la page du fromage
      header('Location:'.base_url('index.php/fromage/?id='.$_GET['fromage']));
    } else {echo "Nope";}
  }

  // Retourne un tableau JSON qui contient les like d'une dégustation
  public function apiGetLike()
  {
    if(isset($_GET['degustation'])) {
      $existingLike = $this->fromageAction->getLikeDegustation($_GET['degustation']);
      $existingLike = json_encode($existingLike,true);
      echo $existingLike;
    }
  }
}
