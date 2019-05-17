<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Ajout d'un producteur</h1>
  </div>
</div>
<form class="form" action="appelAjoutProducteur" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label>Nom du producteur</label>
    <input type="text" class="form-control" name="nom_producteur" maxlength="50" id="nom" placeholder="Exemple : Greber" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Type de producteur</label>
      <select class="custom-select mr-sm-2" name="num_tbltypeProducteur">
        <?php
            foreach ($typeproducteur->result() as $value) {
              echo '<option value="'.$value->numero.'" selected>'.$value->type.'</option>';
            }
         ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Pays du producteur</label>
      <select class="custom-select mr-sm-2" name="num_tblpays">
        <?php
            foreach ($pays->result() as $value) {
              echo '<option value="'.$value->numero.'">'.$value->pays.'</option>';
            }
         ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label>Localite</label>
    <input type="text" class="form-control" name="localite" maxlength="50" placeholder="Exemple : Neuchâtel" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Canton *Uniquement si le producteur est suisse !</label>
      <select class="custom-select mr-sm-2" name="num_tblcanton" id="inlineFormCustomSelect">
        <?php
            foreach ($canton->result() as $value) {
              echo '<option value="'.$value->numero.'">'.$value->canton.'</option>';
            }
         ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Description du producteur</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Description</span>
        </div>
        <textarea class="form-control" name="description_producteur" aria-label="With textarea" maxlength="255"></textarea>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Photo du producteur ou logo</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="fichier" aria-describedby="inputGroupFileAddon01">
        <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-outline-primary btn-lg btn-block" >Ajouter</button>
</form>
