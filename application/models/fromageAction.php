<?php
require_once('inc/connexion.inc.php');
require_once('inc/image.inc.php');
class fromageAction extends CI_Model
{
  public function getAllFromageAndProducteur()
  {
    $this->db->get_compiled_select("tblfromage.numero as fromage_numero, tblfromage.nom as nom_du_fromage ,description_fromage,
    calories,proteines,lipides,sodium,tbltypepate.type,typeLait,pasteurise,photo_fromage,
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
    $this->db->select("tbldegustation.numero as degustation_numero, dateAjout,description_degustation,note,photo_degustation,num_tblfromage,pseudo,num_tblutilisateur,photo_profil");
    $this->db->from('tbldegustation');
    $this->db->join('tblfromage','tbldegustation.num_tblfromage=tblfromage.numero');
    $this->db->join('tblutilisateur','tbldegustation.num_tblutilisateur=tblutilisateur.numero');
    $this->db->where('tbldegustation.num_tblfromage', $id);
    $query=$this->db->get();
    $data=$query->result();
    return $data;
  }

  public function addLikeDegustation($id)
  {
    $data = array(
      'numero' => NULL,
      'numero_tblutilisateur' => $_SESSION['idUser'],
      'numero_tbldegustation' => $id
    );

    $this->db->db_debug = FALSE; // Désactivation des erreurs Codeigniter si le like existe déjà
    $this->db->insert('tblaime',$data); // Insertion du like

  }

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
