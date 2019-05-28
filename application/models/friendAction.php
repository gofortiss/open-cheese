<?php
require_once('inc/connexion.inc.php');
require_once('inc/image.inc.php');
class friendAction extends CI_Model
{

  // Nouvelle relation
  public function newRelation($id)
  {
      $data = array(
        'num_tblutilisateur1' => $_SESSION['idUser'],
        'num_tblutilisateur2' => $id
      );

      $this->db->insert('tblrelationutilisateur', $data); // Insertion dans la base de donnée
  }

  // Supprimer relation
  public function deleteRelation($id)
  {
    $this->db->where('num_tblutilisateur1', $_SESSION['idUser']);
    $this->db->where('num_tblutilisateur2',$id);
    $this->db->delete('tblrelationutilisateur');
  }

  public function getAllRelation()
  {
    // SELECT * FROM tblrelationutilisateur
    $query = $this->db->get('tblrelationutilisateur');
    $data = $query->result();
    return $data;
  }

  public function getRelation($id)
  {
    $q =  $this->db->select('*')
      ->from('tblrelationutilisateur')
      ->where('num_tblutilisateur1',$_SESSION['idUser'])
      ->where('num_tblutilisateur2',$id)
      ->get();
      // Si aucune ligne est entrée
      if($q->num_rows() == 0){
          return true; // Aucune relation
      } else {
        return false; // Relaton existante
      }
  }
}
