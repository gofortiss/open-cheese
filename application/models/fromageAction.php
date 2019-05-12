<?php
require_once('inc/connexion.inc.php');
class fromageAction extends CI_Model
{
  public function getAllFromages()
  {
    $cnn = getConnexion('open-cheese');
    $stmt = $cnn->prepare('SELECT * FROM `tblfromage` INNER JOIN tbltypepate ON tblfromage.num_tbltypePate = tbltypepate.numero
    INNER JOIN tbllait ON tblfromage.num_tblLait = tbllait.numero
    INNER JOIN tblpasteurise ON tblfromage.num_tblpasteurise = tblpasteurise.numero');
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
