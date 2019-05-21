<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Deconnexion extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("userAction");
    $this->load->helper('url');
  }
      public function index()
      {
          $this->userAction->deconnect();
      }
}
