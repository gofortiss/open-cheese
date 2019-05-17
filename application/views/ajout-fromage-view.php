<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Ajout d'un fromage</h1>
  </div>
</div>
<form class="form" action="appelAjoutFromage" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label>Nom du fromage</label>
    <input type="text" class="form-control" name="nom" id="nom" placeholder="Exemple : Gruyère" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Producteur</label>
      <small>Vous ne le trouver pas ? <a href="<?php echo base_url('index.php/fromage/ajouterProducteur') ?>">Ajouter le</a></small>
      <select class="custom-select mr-sm-2" name="num_tblproducteur">
        <?php
            foreach ($producteur->result() as $value) {
              echo '<option value="'.$value->numero.'" selected>'.$value->nom_producteur.'</option>';
            }
         ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Type de pâte</label>
      <select class="custom-select mr-sm-2" name="num_tbltypePate" id="inlineFormCustomSelect">
        <?php
            foreach ($pate->result() as $value) {
              echo '<option value="'.$value->numero.'" selected>'.$value->type.'</option>';
            }
         ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Type de lait</label>
      <select class="custom-select mr-sm-2" name="num_tblLait" id="inlineFormCustomSelect">
        <?php
          foreach ($lait->result() as $value) {
            echo '<option value="'.$value->numero.'" selected>'.$value->typeLait.'</option>';
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Pasteurisé</label>
      <select class="custom-select mr-sm-2" name="num_tblpasteurise" id="inlineFormCustomSelect">
        <?php
            foreach ($pasteurise->result() as $value) {
              echo '<option value="'.$value->numero.'" selected>'.$value->pasteurise.'</option>';
            }
         ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Informations nutritives</label>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Calories (100g)</th>
            <th scope="col">Proteines (100g)</th>
            <th scope="col">Lipides (100g)</th>
            <th scope="col">Sodium (100g)</th>
          </tr>
        </thead>
      <tbody>
        <tr>
          <th class="calories-fromage"><input type="text" class="form-control" name="calories" id="calories"></th>
          <th class="protines-fromage"><input type="text" class="form-control" name="proteines" id="proteines"></th>
          <th class="lipides-fromage"><input type="text" class="form-control" name="lipides" id="lipides"></th>
          <th class="sodium-fromage"><input type="text" class="form-control" name="sodium" id="sodium"></th>
        </tr>
      </tbody>
      <small class="form-text text-muted">Si vous ne les connaissez pas, voir les données du site : <a href="https://myfitnesspal.com/fr/food/" target="_blank">myfitnesspal</a></small>
      </table>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Description du fromage</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Description</span>
        </div>
        <textarea class="form-control" name="description_fromage" aria-label="With textarea"></textarea>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Photo du fromage</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="fichier" aria-describedby="inputGroupFileAddon01">
        <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-outline-primary btn-lg btn-block" >Ajouter</button>
</form>
