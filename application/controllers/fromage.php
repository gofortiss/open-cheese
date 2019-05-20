<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('inc/class.alert.php'); // Appel de la classe alerte
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
    $fromages = $this->fromageAction->getAllFromageAndProducteur();
    $fromages = json_encode($fromages,true);
    echo $fromages;
  }


  // Récupération des informations d'un fromage et de sa note moyenne
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
      $data['degustation'] = $this->fromageAction->getDegustation($_GET['id']);
      $data['note_moyenne'] = $this->fromageAction->getMoyenneNoteFromage($data['degustation']);
      $degustation = json_encode($data,true);
      echo $degustation;
    } else {
      echo "Error";
    }
  }

  // Retourne un tableau JSON des producteurs
  public function apiProducteur()
  {
    if(isset($_GET['id'])){
      $producteur = $this->fromageAction->getProducteur($_GET['id']);
      $producteur = json_encode($producteur,true);
      echo $producteur;
    } else {
      echo "Error";
    }
  }

  // Chargement de la vue ajouter un fromage
  public function ajouterFromage()
  {
    $alert = new Alert();
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'exist':
          $data['js'] = $alert->warning("Huhu","Le fromage existe dàjà");
          break;
        case 'photo':
          $data['js'] = $alert->error("Attention","Il y a eu un problème avec le fichier");
          break;
      }
    }

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

  public function ajouterProducteur()
  {
    $alert = new Alert();
     // Contrôle des messages d'erreurs
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'producteur':
            $data['js'] = $alert->warning("Ouuuups","Le producteur existe déjà");
          break;
      }
    }

    //Requête SQL sur les tables (Données liste déroulante)
    $data['typeproducteur'] = $this->producteurAction->getTypeProducteur();
    $data['pays'] = $this->producteurAction->getPays();
    $data['canton'] = $this->producteurAction->getCanton();
    $data['title'] = "Ajouter un producteur";
    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-producteur-view');
    $this->load->view('footer-view');
  }

  // Fonction ajouter un fromage
  public function appelAjoutFromage()
  {
    $info = $this->fromageAction->insertFromage($_POST,$_FILES);
    // Redirection
    switch ($info->message[0]) {
      case 'success' :
          header('Location:'.base_url('index.php/fromage/listeFromage'));
        break;
      case 'exist' :
          header('Location:'.base_url('index.php/fromage/ajouterFromage?message=exist'));
        break;
      case 'photo' :
          header('Location:'.base_url('index.php/fromage/ajouterFromage?message=photo'));
        break;
    }
  }

  // Controller qui appel la fonction d'ajout du producteur
  public function appelAjoutProducteur()
  {
    $success = $this->producteurAction->insertProducteur($_POST,$_FILES);
    // Redirection
    switch ($success->success) {
      case true :
          header('Location:'.base_url('index.php/fromage/listeFromage'));
        break;
      case false :
          header('Location:'.base_url('index.php/fromage/ajouterProducteur?message=producteur'));
        break;
    }
  }

  public function ajouterDegustation()
  {
    $data['title'] = "Ajouter une dégustation";
    // Retour requête SQL sur toute la table fromage
    $data['fromage'] = $this->fromageAction->getAllFromageAndProducteur();

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-degustation-view');
    $this->load->view('footer-view');
  }

  // Fonction ajouter un fromage
  public function appelAjoutDegustation()
  {
    $this->fromageAction->insertDegustation($_POST,$_FILES,$_GET['id']);
    header('Location:'.base_url('index.php/fromage/?id='.$_GET['id']));
  }

  // Ajouter un "Like" sur une dégustation
  public function appelLike()
  {
    // Vérification si un paramètre est entré
    if(isset($_GET['degustation']) && isset($_GET['fromage']))
    {
      $this->fromageAction->insertLikeDegustation($_GET['degustation']);
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
