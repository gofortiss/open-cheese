<?php
require_once('inc/connexion.inc.php');
require_once('inc/class.response.php');
require_once('inc/image.inc.php');
class functions extends CI_Model
{
  // Redirection à l'accueil si l'utilisateur n'est pas connecté
  public function authVerification()
  {
    if(empty($_SESSION['idUser'])) {
      header('Location:'.base_url('index.php/FormHome'));
    }
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
      return $response->info();
    }
  }

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
     if(empty($row))
     {
       if($file['fichier']['name'] !=''){
         $image = uploadImage($file,'profile-picture/'); // Upload de la photo de profil
       }
       else {
         // Génération d'une image
         $image = apiImage($post['pseudo']);
       }
       switch ($image['type']) {
         case 'success':
               $password = md5($post['password1']); // Cryptage du mot de passe

               // Insértion de l'utilisateur dans la base de donnée
               $cnn = getConnexion('open-cheese');
               $stmt = $cnn->prepare('INSERT INTO `tblutilisateur` (`numero`, `pseudo`,`dateNaissance`,`bio`,`motdepasse`,`num_tblgenre`,`num_tblpays`,`photo`) VALUES (NULL, :pseudo,:dateNaissance,NULL,:motdepasse,:genre,:pays,:photo)');
               $stmt->bindParam(':pseudo', $post['pseudo']);
               $stmt->bindParam(':dateNaissance', $post['naissance']);
               $stmt->bindParam(':motdepasse', $password);
               $stmt->bindParam(':genre', $post['genre']);
               $stmt->bindParam(':pays', $post['pays']);
               $stmt->bindParam(':photo', $image['numero']);
               $stmt->execute();
               $response->addMessage('success');
           break;
         case 'error':
              $response->addMessage('fichier'); // Problème avec le fichier
           break;
       }
     }
     else
     {
       $response->addMessage('pseudo'); // Problème avec le pseudo
     }
   } else {
     $response->addMessage("motdepasse"); // Problème avec le mot de passe
   }
   return $response->info();
 }
}
