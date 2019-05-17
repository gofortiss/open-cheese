<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Ajout d'une dégustation</h1>
  </div>
</div>
<!-- Formulaire d'ajout d'une dégustation -->
<form class="form" action="<?php echo base_url(); ?>index.php/fromage/appelAjoutDegustation?id=<?php echo $_GET['id']; ?>" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label>Votre note</label>
    <select class="custom-select mr-sm-2" name="note" id="inlineFormCustomSelect">
      <option value="1">1</option>
      <option value="2">1.5</option>
      <option value="3">2</option>
      <option value="4">2.5</option>
      <option value="5">3</option>
      <option value="6">3.5</option>
      <option value="7">4</option>
      <option value="8">4.5</option>
      <option value="9">5</option>
    </select>
  </div>
  <!-- Ligne de description -->
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Description de la dégustation</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Description</span>
        </div>
        <textarea class="form-control" name="description_degustation" maxlength="255" aria-label="With textarea"></textarea>
      </div>
    </div>
  </div>
  <!-- Ligne d'ajout de photo -->
  <div class="form-row">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Photo de la dégustation</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="fichier">
        <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-outline-primary btn-lg btn-block" >Ajouter ma dégustation</button>
</form>
