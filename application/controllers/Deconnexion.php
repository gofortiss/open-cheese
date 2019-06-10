<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Deconnexion extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("User_action");
    $this->load->helper('url');
  }
      public function index()
      {
          $this->User_action->deconnect();
      }
}
