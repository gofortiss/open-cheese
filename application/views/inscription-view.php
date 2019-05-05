<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Inscription</h1>
  </div>
</div>
<form class="inscription" action="Inscription" class="inscription" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label>Pseudo</label>
    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Nom</label>
      <input type="text" class="form-control" name="nom" id="nom" placeholder="Dubuis">
    </div>
    <div class="form-group col-md-4">
      <label>prénom</label>
      <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Guillaume">
    </div>
    <div class="form-group col-md-4">
      <label>Date de naissance</label>
      <input type="date" class="form-control" name="naissance" id="date">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Genre</label>
      <select class="custom-select mr-sm-2" name="genre" id="inlineFormCustomSelect">
        <option value="1">Homme</option>
        <option value="2">Femme</option>
        <option value="3" selected>Non spécifié</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Pays</label>
      <select class="custom-select mr-sm-2" name="pays" id="inlineFormCustomSelect">
        <option value="1">Suisse</option>
        <option value="2">France</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Photo de profil</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="fichier" aria-describedby="inputGroupFileAddon01">
        <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Mot de passe</label>
      <input type="password" class="form-control" name="password1" id="password1" required>
    </div>
    <div class="form-group col-md-6">
      <label>Confirmer mot de passe</label>
      <input type="password" class="form-control" name="password2" id="password2" required>
    </div>
  </div>
  <button type="submit" class="btn btn-outline-primary btn-lg btn-block" >S'inscrire</button>
</form>
