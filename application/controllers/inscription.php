<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inscription extends CI_Controller {
    public function index()
    {
        // Chargement de la session
        $this->load->model("functions");
        $this->load->helper('url');
        $result = $this->functions->inscription($_POST,$_FILES);
        var_dump($result);
    }
}
