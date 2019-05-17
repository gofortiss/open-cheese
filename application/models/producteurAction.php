<?php
require_once('inc/connexion.inc.php');
require_once('inc/image.inc.php');
require_once('inc/class.response.php');
class producteurAction extends CI_Model
{
  public function getAllProducteurs()
  {
    $this->db->select("numero, nom");
    $this->db->from('tblproducteur');
    return $this->db->get();
  }

  // Requête type de producteur
  public function getTypeProducteur()
  {
    return $this->db->get('tbltypeproducteur');
  }

  // Requête table canton
  public function getCanton()
  {
    return $this->db->get('tblcanton');
  }

  // Requête table pays
  public function getPays()
  {
    return $this->db->get('tblpays');
  }

   // Ajout d'un producteur
  public function addFromage($post,$file)
  {
    // Remplacement des valeurs vide par des valeurs NULL
    foreach ($post as $key => $value) {
          if ($value == '') {
               $post[$key] = NULL;
          }
      }

    // Vérification si un fichier à été envoyé
    if($file['fichier']['name']!='')
    {
      $image = uploadImage($file,'fromage/'); // Upload de l'image du fromage
      $post['photo_fromage'] = $image['nomFichier'];

    } else {
      $post['photo_fromage'] = 'default.png';
    }
    $this->db->insert('tblfromage', $post);
  }
}
