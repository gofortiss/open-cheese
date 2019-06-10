<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('inc/class.alert.php'); // Appel de la classe alerte
require_once('inc/class.auth.php'); // Appel de la classe authentification
class Fromage extends CI_Controller {
public function __construct(){
  parent::__construct();
  $this->load->database();
  $this->load->model("Fromage_action");
  $this->load->model("Producteur_action");
  $this->load->model("Community_action");
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
    $data['degustation'] = $this->Fromage_action->getDegustation($_GET['id']);

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
    $fromages = $this->Fromage_action->getAllFromageAndProducteur();
    $fromages = json_encode($fromages,true);
    echo $fromages;
  }


  // Récupération des informations d'un fromage et de sa note moyenne
  public function apiFromage()
  {
    if(isset($_GET['id'])){
      $fromage = $this->Fromage_action->getFromage($_GET['id']);
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
      $data['degustation'] = $this->Fromage_action->getDegustation($_GET['id']);
      $data['note_moyenne'] = $this->Fromage_action->getMoyenneNoteFromage($data['degustation']);
      $degustation = json_encode($data,true);
      echo $degustation;
    } else {
      echo "Error";
    }
  }

  // Retourne un tableau JSON des dégustations d'un utilisateur
  public function apiDegustationUtilisateur()
  {
    if(isset($_GET['id'])){
      $data['degustation'] = $this->Fromage_action->getDegustationUtilisateur($_GET['id']);
      $degustation = json_encode($data['degustation'],true);
      echo $degustation;
    } else {
      echo "Error";
    }
  }

  // Retourne un tableau JSON des dégustations des utilisateurs suivis
  public function apiDegustationFollowing()
  {
    $data['friends'] = $this->Community_action->getFriendsList();
    $data['degustation'] = [];
    foreach ($data['friends'] as $key => $value) {
      array_push($data['degustation'], $this->Fromage_action->getDegustationUtilisateur($value->num_tblutilisateur2));
    }
    $degustation = json_encode($data['degustation'],true);
    echo $degustation;

  }

  // Retourne un tableau JSON des producteurs
  public function apiProducteur()
  {
    if(isset($_GET['id'])){
      $producteur = $this->Fromage_action->getProducteur($_GET['id']);
      $producteur = json_encode($producteur,true);
      echo $producteur;
    } else {
      echo "Error";
    }
  }

  // Chargement de la vue ajouter un fromage
  public function ajouterFromage()
  {
    $alert = new Alert(); // Nouvelle instance alerte
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'exist':
          $data['js'] = $alert->warning("Huhu","Le fromage existe déjà, ou il y a une erreur avec le producteur");
          break;
        case 'photo':
          $data['js'] = $alert->error("Attention","Il y a eu un problème avec le fichier");
          break;
      }
    }

    $data['title'] = "Ajouter un fromage";
    //Requête SQL sur les tables (Données liste déroulante)
    $data['pate'] = $this->Fromage_action->getTypePate();
    $data['lait'] = $this->Fromage_action->getLait();
    $data['pasteurise'] = $this->Fromage_action->getPasteurise();
    $data['producteur'] = $this->Producteur_action->getAllProducteurs();

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-fromage-view');
    $this->load->view('footer-view');
  }

  public function ajouterProducteur()
  {
    $alert = new Alert();
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

     // Contrôle des messages d'erreurs
    if(isset($_GET['message'])) {
      switch ($_GET['message']) {
        case 'producteur':
            $data['js'] = $alert->warning("Ouups","Le producteur existe déjà");
          break;
        case 'photo':
            $data['js'] = $alert->error("Mhhhh","Il y a eu un problème avec l'image");
          break;
      }
    }

    //Requête SQL sur les tables (Données liste déroulante)
    $data['typeproducteur'] = $this->Producteur_action->getTypeProducteur();
    $data['pays'] = $this->Producteur_action->getPays();
    $data['canton'] = $this->Producteur_action->getCanton();
    $data['title'] = "Ajouter un producteur";
    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-producteur-view');
    $this->load->view('footer-view');
  }

  // Fonction ajouter un fromage
  public function appelAjoutFromage()
  {
    // Création d'un cookie avec les valeur des inputs
    setcookie ('fromage', json_encode($_POST), time() + 240); // heure de création + 240 sec

    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

    $info = $this->Fromage_action->insertFromage($_POST,$_FILES);
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
    // Création d'un cookie avec les valeur des inputs
    setcookie ('producteur', json_encode($_POST), time() + 240); // heure de création + 240 sec

    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

    $return = $this->Producteur_action->insertProducteur($_POST,$_FILES);
    // Redirection
    switch ($return->message[0]) {
      case 'success' :
          header('Location:'.base_url('index.php/fromage/listeFromage'));
        break;
      case 'exist' :
          header('Location:'.base_url('index.php/fromage/ajouterProducteur?message=producteur'));
        break;
      case 'photo' :
          header('Location:'.base_url('index.php/fromage/ajouterProducteur?message=photo'));
        break;
    }
  }

  public function ajouterDegustation()
  {
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

    $data['title'] = "Ajouter une dégustation";
    // Retour requête SQL sur toute la table fromage
    $data['fromage'] = $this->Fromage_action->getAllFromageAndProducteur();

    // Chargement des vues
    $this->load->view('header-view',$data); // Load header
    $this->load->view('ajout-degustation-view');
    $this->load->view('footer-view');
  }

  // Fonction ajouter un fromage
  public function appelAjoutDegustation()
  {
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

    $this->Fromage_action->insertDegustation($_POST,$_FILES,$_GET['id']);
    header('Location:'.base_url('index.php/fromage/?id='.$_GET['id']));
  }

  // Ajouter un "Like" sur une dégustation
  public function appelLike()
  {
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

    // Vérification si un paramètre est entré
    if(isset($_GET['degustation']))
    {
      $this->Fromage_action->insertLikeDegustation($_GET['degustation']);
    } else {echo "Nope";}
  }

  // Retourne un tableau JSON qui contient les like d'une dégustation
  public function apiGetLike()
  {
    $auth = new Authentification(); // Nouvelle instance authentification
    $auth->auth(); // Redirection si l'utilisateur n'est pas connecté

    if(isset($_GET['degustation'])) {
      $existingLike = $this->Fromage_action->getLikeDegustation($_GET['degustation']);
      $existingLike = json_encode($existingLike,true);
      echo $existingLike;
    }
  }
}
