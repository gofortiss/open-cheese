<?php
require_once('inc/image.inc.php');
require_once('inc/class.response.php');
class Fromage_action extends CI_Model
{
  public function getAllFromageAndProducteur()
  {
    $this->db->select("tblfromage.numero as fromage_numero, tblfromage.nom as nom_du_fromage ,description_fromage,
    calories,proteines,lipides,sodium,tbltypepate.type as type_pate,typeLait,pasteurise,photo_fromage,
    tblproducteur.nom_producteur as nom_du_producteur, tblpays.pays, tblcanton.canton, tbltypeproducteur.type");
    $this->db->from('tblfromage');
    $this->db->join('tbltypepate','tblfromage.num_tbltypePate=tbltypepate.numero');
    $this->db->join('tbllait','tblfromage.num_tbllait=tbllait.numero');
    $this->db->join('tblpasteurise','tblfromage.num_tblpasteurise=tblpasteurise.numero');
    $this->db->join('tblproducteur','tblfromage.num_tblproducteur=tblproducteur.numero');
    $this->db->join('tblcanton','tblproducteur.num_tblcanton=tblcanton.numero');
    $this->db->join('tblpays','tblproducteur.num_tblpays=tblpays.numero');
    $this->db->join('tbltypeproducteur','tblproducteur.num_tbltypeProducteur=tbltypeproducteur.numero');
    $query=$this->db->get();
    $data=$query->result();
    return $data;
  }

  // Retourne un fromage selon l'id
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

  // Retourne un producteur de fromage selon l'id du fromage
  public function getProducteur($id)
  {
    $this->db->select("tblfromage.numero, num_tblproducteur, nom_producteur, localite, description_producteur, photo_producteur, pays, canton, tbltypeproducteur.type as type_producteur");
    $this->db->from('tblfromage');
    $this->db->join('tblproducteur', 'tblfromage.num_tblproducteur = tblproducteur.numero');
    $this->db->join('tblpays', 'tblproducteur.num_tblpays = tblpays.numero');
    $this->db->join('tblcanton', 'tblproducteur.num_tblcanton = tblcanton.numero');
    $this->db->join('tbltypeproducteur', 'tblproducteur.num_tbltypeProducteur = tbltypeproducteur.numero');
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

  public function insertFromage($post,$file)
  {
    // Nouvelle réponse
    $response = new Response();
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
      // Vérification du status du téléchargement
      if($image['type'] != 'success') {
        $response->addMessage('photo');
      }
    } else {
      $post['photo_fromage'] = 'default.png';
    }


    // Si aucune erreur n'est survenue jusque là
    if (empty($response->info()->message[0])) {
      $this->db->db_debug = FALSE; // Désactivation des messages d'erreurs
      $this->db->insert('tblfromage', $post); // Insertion des données

      // Si le nom du fromage existe déjà (duplicata de donnée unique)
      if ($this->db->insert_id()) {
          $response->addMessage('success'); // Envoi succès
          setcookie("fromage", "", time() - 3600); // Suppression du cookie
        } else {
          $response->addMessage('exist'); // Envoi erreur
        }
    }
    return $response->info();
  }

  public function insertDegustation($post,$file,$id)
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

    $this->db->insert('tbldegustation', $post); // Insertion de la dégustation dans la base de donnée
  }


  // Ajoute un "J'aime" sur une dégustation
  public function insertLikeDegustation($id)
  {
    $data = array(
      'numero' => NULL,
      'numero_tblutilisateur' => $_SESSION['idUser'],
      'numero_tbldegustation' => $id
    );

    $this->db->db_debug = FALSE; // Désactivation des erreurs Codeigniter si le like existe déjà
    $this->db->insert('tblaime',$data); // Insertion du like
  }

  // Retourne la note moyenne d'une dégustation
  public function getMoyenneNoteFromage($degustation)
  {
    $total = 0; // Initialisation de la variable contenant l'addition de toutes les notes
    foreach ($degustation as $value) {
      $total += $value->note;
    }
    if(!empty($degustation)){
      return $total / count($degustation); // Calcul de la note
    }
  }

  // Retourne les dégustations selon le fromage
  public function getDegustation($id)
  {
    $this->db->select("tbldegustation.numero as degustation_numero, dateAjout,description_degustation,note,photo_degustation,num_tblfromage,pseudo,num_tblutilisateur,photo_profil");
    $this->db->from('tbldegustation');
    $this->db->join('tblfromage','tbldegustation.num_tblfromage=tblfromage.numero');
    $this->db->join('tblutilisateur','tbldegustation.num_tblutilisateur=tblutilisateur.numero');
    $this->db->where('tbldegustation.num_tblfromage', $id);
    $query=$this->db->get();
    $data=$query->result();
    return $data;
  }

  // Retourne les dégustations d'un utilisateur
  public function getDegustationUtilisateur($id)
  {
    $this->db->select("tbldegustation.numero as degustation_numero, dateAjout,description_degustation,note,photo_degustation,nom,pseudo,num_tblutilisateur, tblfromage.numero as fromage_numero, photo_profil");
    $this->db->from('tbldegustation');
    $this->db->join('tblfromage','tbldegustation.num_tblfromage=tblfromage.numero');
    $this->db->join('tblutilisateur','tbldegustation.num_tblutilisateur =tblutilisateur.numero');
    $this->db->where('tbldegustation.num_tblutilisateur', $id);
    $query=$this->db->get();
    $data=$query->result();
    return $data;
  }

  // Retourne les like d'une dégustations selon le fromage
  public function getLikeDegustation($id)
  {
    $this->db->select("tblaime.numero, pseudo, numero_tbldegustation");
    $this->db->from('tblaime');
    $this->db->join('tblutilisateur','tblaime.numero_tblutilisateur=tblutilisateur.numero');
    $this->db->join('tbldegustation','tblaime.numero_tbldegustation=tbldegustation.numero');
    $this->db->where('tblaime.numero_tbldegustation', $id);
    $query=$this->db->get();
    $data=$query->result();
    return $data;
    // var_dump($data);
  }
}
