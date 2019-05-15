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

  public function addDegustation($post,$file,$id)
  {
    // Vérification si un fichier à été envoyé
    if($file['fichier']['name']!='')
    {
      $image = uploadImage($file,'degustation/'); // Upload de l'image du fromage
      $post['photo_degustation'] = $image['nomFichier'];

    } else {
      $post['photo_degustation'] = '';
    }

    $post['dateAjout'] = date('Y-m-d'); // Ajout de la date actuelle dans le POST
    $post['num_tblutilisateur'] = $_SESSION['idUser']; // Ajout de l'utilisateur connecté dans le POST
    $post['num_tblfromage'] = $id; // Ajout du numero du fromage

    $this->db->insert('tbldegustation', $post); // Insertion dans la base de donnée
  }

  public function getDegustation($id)
  {
    $this->db->select("tbldegustation.numero as degustation_numero, dateAjout,description_degustation,note,photo_degustation,num_tblfromage,pseudo,num_tblutilisateur");
    $this->db->from('tbldegustation');
    $this->db->join('tblfromage','tbldegustation.num_tblfromage=tblfromage.numero');
    $this->db->join('tblutilisateur','tbldegustation.num_tblutilisateur=tblutilisateur.numero');
    $this->db->where('tbldegustation.num_tblfromage', $id);
    $query=$this->db->get();
    $data=$query->result();
    return $data;
  }
}
