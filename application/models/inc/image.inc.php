<?php
require_once('connexion.inc.php');
function uploadImage($file,$target)
{
    $target_dir = "C:/wamp/www/open-cheese/assets/images/".$target;
    $filename = $file["fichier"]["name"];
  	$file_basename = substr($filename,  strripos($filename, '.')); // get file extention
  	$file_ext = substr($filename, strripos($filename, '.')); // get file name
  	$filesize = $file["fichier"]["size"];
  	$allowed_file_types = array('.jpg','.jpeg','.JPEG','.png');

  	if (in_array($file_ext,$allowed_file_types))
  	{
      $time = time();
  		$newfilename = time().md5($file_basename).$file_ext; // Timestamp + md5 + extention(.jpg etc...)
  		if (file_exists($target_dir.$newfilename))
  		{
  			// Le fichier existe déjà
        return array('nomFichier'=>$newfilename,'message'=>'Vous avez déjà uploader cette image','type'=>'error');
  		}
  		else
  		{
        // Upload du fichier
        move_uploaded_file($file["fichier"]["tmp_name"], $target_dir . $newfilename);

        // Retour du résultat
  			return array('numero'=>$newfilename,'nomFichier'=>$newfilename,'message'=>'','type'=>'success');
  		}
  	}
  	elseif (empty($file_basename))
  	{
  		// Fichier vide
  		return array('nomFichier'=>$filename,'message'=>'Veuillez sélectionner un fichier','type'=>'error');
  	}
  	elseif ($filesize > 5000000)
  	{
  		// Taille de fichier trop grand
      return array('nomFichier'=>$filename,'message'=>'Désolé le fichier est trop large','type'=>'error');
  	}
  	else
  	{
  		// Erreur type de fichier
  		unlink($file["fichier"]["tmp_name"]);
      return array('nomFichier'=>$filename,'message'=>'Seulement ces types de fichier sont autorisés :'.implode(', ',$allowed_file_types),'type'=>'error');
  	}
}

function apiImage($pseudo)
{
  // Récupération de l'image
  $api = 'https://api.adorable.io/avatars/285/'.$pseudo.'.png';
  $path = 'C:/wamp/www/open-cheese/assets/images/profile-picture/'.$pseudo.'.png';
  $extention = ".png";
  $filename = $pseudo.$extention;
  file_put_contents($path, file_get_contents($api));

  // Retour du résultat
  return array('numero'=>$filename,'nomFichier'=>$filename,'message'=>'','type'=>'success');
}
