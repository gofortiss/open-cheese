<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class deconnect extends CI_Controller {
      public function index()
      {
          // Chargement de la session
          $this->load->model("functions");
          $this->load->helper('url');
          unset($_SESSION['idUser']);
          header('Location:'.base_url('index.php/FormHome'));
      }
}
