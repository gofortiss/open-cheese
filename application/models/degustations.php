<?php
require_once('inc/connexion.inc.php');
class degustations extends CI_Model
{
  public function getDegustations()
  {
    $cnn = getConnexion('open-cheese');
    $stmt = $cnn->prepare('SELECT * FROM tbldegustation
    INNER JOIN tblfromage ON tbldegustation.num_tblfromage = tblfromage.numero
    INNER JOIN tbltypepate ON tblfromage.num_tbltypePate
    INNER JOIN tbllait ON tblfromage.num_tblLait
    LEFT JOIN tblpasteurise ON tblfromage.num_tblpasteurise');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
}
