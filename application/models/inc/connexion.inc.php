<?php
function getConnexion($nom){
  $dsn = 'mysql:dbname=open-cheese;host=localhost';
  $user = 'root';
  $password = '';
  try {
    $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,
                         PDO::ERRMODE_EXCEPTION);
      $dbh->exec("SET CHARACTER SET utf8");
      return $dbh;
  } catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
  }
}
