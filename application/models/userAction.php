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
     // connexion à la base de donnée et requête SQL pour vérifier si l'utilisateur existe
     $cnn = getConnexion('open-cheese');
     $stmt = $cnn->prepare('SELECT * FROM tblutilisateur WHERE tblutilisateur.pseudo LIKE :pseudo');
     $stmt->bindParam(':pseudo', $post['pseudo']);
     $stmt->execute();
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
         if (empty($response->message)) {
             $password = md5($post['password1']); // Cryptage du mot de passe
             // Insértion de l'utilisateur dans la base de donnée
             $cnn = getConnexion('open-cheese');
             $stmt = $cnn->prepare('INSERT INTO `tblutilisateur` (`numero`, `pseudo`,`dateNaissance`,`bio`,`motdepasse`,`num_tblgenre`,`num_tblpays`,`photo_profil`) VALUES (NULL, :pseudo,:dateNaissance,NULL,:motdepasse,:genre,:pays,:photo)');
             $stmt->bindParam(':pseudo', $post['pseudo']);
             $stmt->bindParam(':dateNaissance', $post['naissance']);
             $stmt->bindParam(':motdepasse', $password);
             $stmt->bindParam(':genre', $post['genre']);
             $stmt->bindParam(':pays', $post['pays']);
             $stmt->bindParam(':photo', $image['numero']);
             $stmt->execute();
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
     echo $passwordCrypt;
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
         $_SESSION['photo'] =  $row['photo'];
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
   return $response->info();
 }

 public function getInformationsUtilisateur($numero)
 {
   $cnn = getConnexion('open-cheese');
   $stmt = $cnn->prepare('SELECT * FROM `tblutilisateur` WHERE numero = :numero');
   $stmt->bindValue(':numero', $numero);
   $stmt->execute();
   $userInfo = $stmt->fetchAll();
   return $userInfo;
 }

 // Fonction de mise à jour des informations d'un utilisateur
 public function updateInformationsUtilisateur($user ,$post, $file) // Information de l'utilisateur par défaut, nouvelles informations, fichier si existant
 {
   $response = new Response();
   var_dump($user);
   // connexion à la base de donnée et requête SQL pour vérifier si l'utilisateur existe
   $cnn = getConnexion('open-cheese');
   $stmt = $cnn->prepare('SELECT tblutilisateur.numero, tblutilisateur.pseudo FROM `tblutilisateur` WHERE tblutilisateur.pseudo = :pseudo');
   $stmt->bindValue(':pseudo',$_POST['pseudo']);
   $stmt->execute();
   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

   var_dump($row);

   // Vérification du pseudo
   if(empty($row)) { // Si la ligne est vide
     $pseudo = $_POST['pseudo'];
   } elseif($row[0]['numero'] != $_SESSION['idUser']) { // Si le numéro de la ligne est pas égale a l'utilisateur connecté (Est déjà utilisé)
     $pseudo = $user[0]['pseudo'];
     $response->addMessage('pseudo');
   }
   else { // Si l'input du pseudo est le même que l'actuelle
     $pseudo = $user[0]['pseudo']; // Le pseudo ne change pas
   }

   // Vérification du mot de passe
   $password = $user[0]['motdepasse']; //Mot de passe par défaut
   var_dump($file);
   if ($post['password1'] != "" && $post['password2'] != "") {
        // Si les mots de passe correspondent
       if($post['password1'] == $post['password2']) {
         $password = md5($post['password1']); // Chiffrement du mot de passe
       }
       // Envoie message d'erreur
       else{
         $response->addMessage('motdepasse');
         $password = $user[0]['motdepasse'];
       }
   }

   //Vérification si une nouvelle photo de profile est existante
   $photo = $user[0]['photo_profil'];
   if($file['fichier']['name']!=''){
     $photo = uploadImage($file,'profile-picture/'); // Upload de la photo de profil
     if($file['fichier']['name'] != '' && $photo['type'] == "success")
     {
       $photo = $photo['nomFichier'];
     }
     else {
       $photo = $user[0]['photo_profil'];
       $response->addMessage('photo');
     }
   }

   // Requête mise à jour des informations de l'utilisateur
   $cnn = getConnexion('open-cheese');
   $stmt = $cnn->prepare('UPDATE tblutilisateur SET pseudo = :pseudo, bio = :bio, photo_profil = :photo, motdepasse = :motdepasse WHERE tblutilisateur.numero = :numero');
   $stmt->bindValue(':numero', $_SESSION['idUser']);
   $stmt->bindValue(':pseudo', $pseudo);
   $stmt->bindValue(':bio', $post['bio']);
   $stmt->bindValue(':photo', $photo);
   $stmt->bindValue(':motdepasse', $password);
   $stmt->execute();
   $response->addMessage('success');
   return $response->info();
 }

 public function deconnect()
 {
   unset($_SESSION['idUser']);
   header('Location:'.base_url('index.php/Connexion'));
 }
}
