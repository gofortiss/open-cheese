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

       return uploadImage($file,'profile-picture/');

       // // connexion à la base de donnée et requête SQL
       // $cnn = getConnexion('open-cheese');
       // $stmt = $cnn->prepare('INSERT INTO `tblutilisateur` (`numero`, `pseudo`, `dateNaissance`, `bio`, `motdepasse`, `num_tblgenre`, `num_tblpays`, `num_tblphoto`) VALUES (NULL, :pseudo, :dateNaissance, NULL,:password,:genre, :pays,:photo)');
       // $stmt->bindParam(':pseudo', $post['pseudo']);
       // $stmt->bindParam(':dateNaissance', $post['naissance']);
       // $stmt->bindParam(':password', md5($post['password1'])); // Cryptage
       // $stmt->bindParam(':genre', $post['genre']);
       // $stmt->bindParam(':pays', $post['pays']);
       // $stmt->bindParam(':photo', $path);
       // $stmt->execute();
       // $response->setSuccess(true);
       // return $response->info();
     }
     else
     {
       $response->setSuccess(false);
       return $response->info();
     }
   }
   else {

   }
 }


 public function recupererImage($id)
 {

 }

}
