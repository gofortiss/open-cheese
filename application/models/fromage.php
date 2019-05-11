<?php
require_once('inc/connexion.inc.php');
class fromage extends CI_Model
{
  public function getAllFromages()
  {
    $cnn = getConnexion('open-cheese');
    $stmt = $cnn->prepare('SELECT DISTINCT * FROM tblfromage
    INNER JOIN tbltypepate ON tblfromage.num_tbltypePate
    INNER JOIN tbllait ON tblfromage.num_tblLait
    INNER JOIN tblpasteurise ON tblfromage.num_tblpasteurise
    INNER JOIN tblvaleurenergetique ON tblfromage.num_tblvaleurenergetique');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function getFromage($id)
  {
    $cnn = getConnexion('open-cheese');
    $stmt = $cnn->prepare('SELECT * FROM tbldegustation
    INNER JOIN tblfromage ON tbldegustation.num_tblfromage = tblfromage.numero
    INNER JOIN tbltypepate ON tblfromage.num_tbltypePate
    INNER JOIN tbllait ON tblfromage.num_tblLait
    LEFT JOIN tblpasteurise ON tblfromage.num_tblpasteurise WHERE tbldegustation.numero = :numero');
    $stmt->bindValue(':numero',$id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
}
