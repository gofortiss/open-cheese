<?php
require_once('inc/image.inc.php');
require_once('inc/class.response.php');
class producteurAction extends CI_Model
{
  public function getAllProducteurs()
  {
    $this->db->select("numero, nom_producteur");
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
  public function insertProducteur($post, $file)
  {
    // Initialisation du message
    $response = new Response();

    // Vérification si un fichier à été envoyé
    if($file['fichier']['name']!='')
    {
      $image = uploadImage($file,'producteur/'); // Upload de l'image du fromage
      $post['photo_producteur'] = $image['nomFichier'];
        // Vérification du status du téléchargement
        if($image['type'] != 'success') {
          $response->addMessage('photo');
        }
    } else {
      $post['photo_producteur'] = 'default.png';
    }

    // Vérification du canton
    if($post['num_tblpays'] != '1') {  // Si le pays n'est pas Suisse
        $post['num_tblcanton'] = '1'; // Ne pas assigner de canton
    }


    // Si aucune erreur n'est survenue jusque là
    if (empty($response->message)) {
      // Si le nom du producteur existe déjà (duplicata de donnée unique)
      if ( $this->db->insert('tblproducteur', $post)) {
          $response->addMessage('success'); // Envoi succès
          setcookie("producteur", "", time() - 3600); // Suppression du cookie
        } else {
          $response->addMessage('exist'); // Envoi erreur
        }
    }
    return $response->info(); // Envoi du message au controlleur
  }
}
