<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class updateAccount extends CI_Controller {
    public function index()
    {
        // Chargement de la session
        $this->load->model("functions");
        $this->load->helper('url');

        // Appel de la fonction mise à jour de l'utilisateur
        $defaultData = $this->functions->informationsUtilisateur($_SESSION['idUser']);
        $result = $this->functions->updateInformationsUtilisateur($defaultData, $_POST, $_FILES);
        var_dump($result);
        switch ($result->message[0]) {
          case 'pseudo':
              header('Location:'.base_url('index.php/FormAccount?message=pseudo'));
            break;
          case 'success':
              header('Location:'.base_url('index.php/FormAccount?message=success'));
            break;

          case 'motdepasse':
              header('Location:'.base_url('index.php/FormAccount?message=motdepasse'));
            break;
        }
    }
}
