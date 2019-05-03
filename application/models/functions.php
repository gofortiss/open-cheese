<?php
require_once('inc/connexion.inc.php');
require_once('inc/class.response.php');
class functions extends CI_Model
{
  // fonction pour la connexion
  public function connexion($pseudo, $password)
  {
    // initialisation des variables nécessaire à la fonction
    $response = new Response();

    // vérifie que l'email et le mot de passe existe
    if(isset($pseudo) && isset($password))
    {
      $passwordCrypt = md5($password);
      echo $passwordCrypt;
      // connexion à la base de donnée et requête SQL
      $cnn = getConnexion('open-cheese');
      $stmt = $cnn->prepare('SELECT * FROM tblutilisateur WHERE tblutilisateur.pseudo LIKE :pseudo');
      $stmt->bindParam(':pseudo', $pseudo);
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
}
