<?php
require_once('inc/connexion.inc.php');
require_once('inc/class.response.php');
require_once('inc/image.inc.php');
class userAction extends CI_Model
{
// fonction pour l'inscription
 public function inscription($post,$file)
 {
   // initialisation des variable nécessaire à la fonction
   $response = new Response();
   // Vérification si les deux mots de passe correspondent
   if($post['password1']==$post['password2']) {
     // Requête SQL pour vérifier si l'utilisateur existe
     $this->db->select("*");
     $this->db->from('tblutilisateur');
     $this->db->where('tblutilisateur.pseudo', $post['pseudo']);
     $query=$this->db->get();
     $row=$query->result();

     // Si aucun utilisateur avec ce pseudo existe
     if(empty($row))
     {
         // Contrôle de la date de naissance
         $date_now = date("Y-m-d"); // Date actuelle
         if($date_now < $post['naissance']){
              // Retour message d'erreur
             $response->addMessage("date");
         }
         // Assignation de la valeur à null si elle est vide
         if($post['naissance'] == ''){
           $post['naissance'] = null;
         }

         // Upload de l'image choisie par l'utilisateur
         if($file['fichier']['name'] !=''){
           $image = uploadImage($file,'profile-picture/'); // Upload de la photo de profil
         } else { // Génération d'une image par rappot au pseudo
           $image = apiImage($post['pseudo']);
         }

         if($image['type'] != 'success')
         {
           $response->addMessage('fichier'); // Problème avec le fichier
         }

         // Si aucune erreur n'est survenue
         if (empty($response->info()->message[0])) {
            // Création du tableau de donnée
             $data = array(
               'numero' => NULL,
               'pseudo' => $post['pseudo'],
               'dateNaissance' => $post['naissance'],
               'bio' => null,
               'motdepasse' => md5($post['password1']),
               'num_tblgenre' => $post['genre'],
               'num_tblpays' => $post['pays'],
               'photo_profil' => $image['numero']
             );
             $this->db->insert('tblutilisateur', $data); // Insertion des données
             $response->addMessage('success'); // Envoi du message de succes
           }
       } else {
         $response->addMessage('pseudo'); // Problème avec le pseudo
       }
     } else {
       $response->addMessage("motdepasse"); // Problème avec le mot de passe
   }
   return $response->info();
 }

 // fonction pour la connexion
 public function connexion($post)
 {
   // initialisation des variables nécessaire à la fonction
   $response = new Response();

   // vérifie que l'email et le mot de passe existe
   if(isset($post['pseudo']) && isset($post['password']))
   {
     $passwordCrypt = md5($post['password']);
     // connexion à la base de donnée et requête SQL
     $cnn = getConnexion('open-cheese');
     $stmt = $cnn->prepare('SELECT * FROM tblutilisateur WHERE tblutilisateur.pseudo LIKE :pseudo');
     $stmt->bindParam(':pseudo', $post['pseudo']);
     $stmt->execute();
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     if(!empty($row))
     {
       // vérifie que le mot de passe entré et celui de la base de donnée correspondent
       if($row['motdepasse'] == $passwordCrypt)
       {
         // Création de la session
         $_SESSION['idUser'] = $row['numero'];
         $_SESSION['pseudo'] = $row['pseudo'];
         $response->setSuccess(true);
       }
       else {
         $response->setSuccess(false);
       }
     }
     else
     {
       $response->setSuccess(false);
     }
   }
   // var_dump($_SESSION);
   // die();
   return $response->info();
 }

 public function getInformationsUtilisateur($id)
 {
   $this->db->select("*");
   $this->db->from('tblutilisateur');
   $this->db->where('tblutilisateur.numero', $id);
   $query=$this->db->get();
   return $query->result();
 }

 // Fonction de mise à jour des informations d'un utilisateur
 public function updateInformationsUtilisateur($user ,$post, $file) // Information de l'utilisateur par défaut, nouvelles informations, fichier si existant
 {
   $response = new Response();
   // connexion à la base de donnée et requête SQL pour vérifier si l'utilisateur existe
   $this->db->select("*");
   $this->db->from('tblutilisateur');
   $this->db->where('tblutilisateur.pseudo', $post['pseudo']);
   $query=$this->db->get();
   $row=$query->result();

   // Vérification du pseudo
   if(empty($row)) { // Si la ligne est vide
     $pseudo = $post['pseudo'];
   } elseif($row[0]->numero != $_SESSION['idUser']) { // Si le numéro de la ligne est pas égale a l'utilisateur connecté (Est déjà utilisé)
     $pseudo = $user[0]->pseudo;
     $response->addMessage('pseudo');
   }
   else { // Si l'input du pseudo est le même que l'actuelle
     $pseudo = $user[0]->pseudo; // Le pseudo ne change pas
   }

   // Vérification du mot de passe
   $password = $user[0]->motdepasse; //Mot de passe par défaut
   if ($post['password1'] != "" && $post['password2'] != "") {
        // Si les mots de passe correspondent
       if($post['password1'] == $post['password2']) {
         $password = md5($post['password1']); // Chiffrement du mot de passe
       }
       // Envoie message d'erreur
       else{
         $response->addMessage('motdepasse');
         $password = $user[0]->motdepasse;
       }
   }

   // Nom de l'image actuelle
   $photo = $user[0]->photo_profil;
   //Vérification si une nouvelle photo de profile est existante
   if($file['fichier']['name']!=''){
     $return = uploadImage($file,'profile-picture/'); // Upload de la photo de profil
     // Si c'est un succes
     if($return['type'] == "success")
     {
       $photo = $return['nomFichier'];
     } else {
       $response->addMessage('photo');
     }
   }


    // Mise à jour des données dans la DB
    $data = array('pseudo' => $pseudo, 'bio' => $post['bio'], 'photo_profil' => $photo, 'motdepasse' => $password);
    $this->db->where('numero', $_SESSION['idUser']);
    $this->db->update('tblutilisateur', $data);
    $response->addMessage('success');
    return $response->info();
 }

 public function deconnect()
 {
   unset($_SESSION['idUser']);
   header('Location:'.base_url('index.php/Connexion'));
 }
}
