<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Connexion</h1>
  </div>
</div>
<form class="connexion" action="Connexion/appelConnexion" method="post">
  <div class="form-group">
    <label>Pseudo</label>
    <input type="text" class="form-control pattern" name="pseudo" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" placeholder="Nom d'utilisateur" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control pattern" aria-describedby="passwordHelp"  pattern"^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" name="password" placeholder="Mot de passe" required>
    <small id="passwordHelp" class="form-text text-muted">Ne donner votre mot de passe à personne !</small>
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
  <a href="<?php echo base_url('index.php/Inscription');?>"<small id="passwordHelp" class="form-text text-muted">Je n'ai pas de compte</small></a>
</form>
