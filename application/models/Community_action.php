<?php
require_once('inc/connexion.inc.php');
require_once('inc/image.inc.php');
class Community_action extends CI_Model
{

  // Nouvelle relation
  public function newRelation($id)
  {
      $data = array(
        'num_tblutilisateur1' => $_SESSION['idUser'],
        'num_tblutilisateur2' => $id
      );

      $q =  $this->db->select('*')
        ->from('tblrelationutilisateur')
        ->where('num_tblutilisateur1',$_SESSION['idUser'])
        ->where('num_tblutilisateur2',$id)
        ->get();
        // Si aucune ligne est entrée
        if($q->num_rows() == 0){
            $this->db->insert('tblrelationutilisateur', $data); // Insertion dans la base de donnée
            return true;
        } else {
          return false;
        }

  }

  // Supprimer relation
  public function deleteRelation($id)
  {
    $this->db->where('num_tblutilisateur1', $_SESSION['idUser'])
    ->where('num_tblutilisateur2',$id)
    ->delete('tblrelationutilisateur');
  }

  public function getAllRelation()
  {
    // SELECT * FROM tblrelationutilisateur
    $query = $this->db->get('tblrelationutilisateur');
    $data = $query->result();
    return $data;
  }

  // Récupère la relation de l'utilisateur
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

  // Récupère la liste d'amis
  public function getFriendsList()
  {
      $query = $this->db->select("tblutilisateur.numero, tblutilisateur.pseudo, tblrelationutilisateur.num_tblutilisateur1, tblrelationutilisateur.num_tblutilisateur2")
      ->from('tblrelationutilisateur')
      ->join('tblutilisateur','tblrelationutilisateur.num_tblutilisateur2=tblutilisateur.numero')
      ->where('num_tblutilisateur1',$_SESSION['idUser'])
      ->get()
      ->result();
      return $query;
  }

  // Récupère tout les utilisateurs
  public function getAllUtilisateur()
  {
    $query = $this->db->select("numero, pseudo, bio")
    ->from("tblutilisateur")
    ->get()
    ->result();
    return $query;
  }

}
