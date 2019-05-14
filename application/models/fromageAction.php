<?php
require_once('inc/connexion.inc.php');
require_once('inc/image.inc.php');
class fromageAction extends CI_Model
{
  public function getAllFromages()
  {
    $this->db->select("tblfromage.numero as fromage_numero, nom,description_fromage,calories,proteines,lipides,sodium,type,typeLait,pasteurise,photo_fromage");
    $this->db->from('tblfromage');
    $this->db->join('tbltypepate','tblfromage.num_tbltypePate=tbltypepate.numero');
    $this->db->join('tbllait','tblfromage.num_tbllait=tbllait.numero');
    $this->db->join('tblpasteurise','tblfromage.num_tblpasteurise=tblpasteurise.numero');
    $query=$this->db->get();
    $data=$query->result();
    return $data;
  }

  public function getFromage($id)
  {
    $this->db->select("tblfromage.numero as fromage_numero, nom,description_fromage,calories,proteines,lipides,sodium,type,typeLait,pasteurise,photo_fromage");
    $this->db->from('tblfromage');
    $this->db->join('tbltypepate','tblfromage.num_tbltypePate=tbltypepate.numero');
    $this->db->join('tbllait','tblfromage.num_tbllait=tbllait.numero');
    $this->db->join('tblpasteurise','tblfromage.num_tblpasteurise=tblpasteurise.numero');
    $this->db->where('tblfromage.numero', $id);
    $query=$this->db->get();
    $data=$query->result();
    return $data;
  }

  // Requête table type de pate
  public function getTypePate()
  {
    return $this->db->get('tbltypepate');
  }

  // Requête table lait
  public function getLait()
  {
    return $this->db->get('tbllait');
  }

  // Reuqête table pasteurise
  public function getPasteurise()
  {
    return $this->db->get('tblpasteurise');
  }

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
