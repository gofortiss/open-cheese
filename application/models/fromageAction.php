<?php
require_once('inc/connexion.inc.php');
require_once('inc/image.inc.php');
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
    $stmt = $cnn->prepare('SELECT * FROM `tblfromage` INNER JOIN tbltypepate ON num_tbltypePate = tbltypepate.numero
    INNER JOIN tbllait ON num_tblLait = tbllait.numero
    INNER JOIN tblpasteurise ON num_tblpasteurise = tblpasteurise.numero
    WHERE tblfromage.numero = :numero');
    $stmt->bindValue(':numero',$id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
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
