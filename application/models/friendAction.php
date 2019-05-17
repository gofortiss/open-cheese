<?php
require_once('inc/connexion.inc.php');
require_once('inc/image.inc.php');
class friendAction extends CI_Model
{
  public function newRelation($userSelected,$relation)
  {
     // EN COURS DE DEV
     
    // foreach ($relation as $value) {
    //   var_dump($value);
    //   var_dump($userSelected);
    //   if($value != $userSelected) {
    //
    //     $data = array(
    //       'numero' => null,
    //       'num_tblutilisateur1' => $_SESSION['idUser'],
    //       'num_tblutilisateur2' => $userSelected
    //     );
    //     $this->db->insert('tblrelationutilisateur', $data); // Insertion dans la base de donnée
    //     echo "peut être ajouté";
    //   } else {
    //     echo "ne peut pas être ajouté";
    //   }
    // }
  }

  public function getAllRelation()
  {
    // // SELECT * FROM tblrelationutilisateur
    $query = $this->db->get('tblrelationutilisateur');
    $data = $query->result();
    return $data;
  }

  public function getRelation($relation)
  {
    $isFriendWith = array();
    // Parcours du tableau des relations
    foreach ($relation as $value => $key) {
      // Recherche dans la colonne 1
      if($_SESSION['idUser'] == $key->num_tblutilisateur1) {
        // Ajout de la relation
        array_push($isFriendWith,$key->num_tblutilisateur2);
      }
      // Recherche dans la colonne 2
      if($_SESSION['idUser'] == $key->num_tblutilisateur2) {
        // Ajout de la relation
        array_push($isFriendWith,$key->num_tblutilisateur1);
      }
    }
    // Retour
    return $isFriendWith;
  }
}
