<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Ajout d'une dégustation</h1>
  </div>
</div>
<form class="form" action="appelAjoutDegustation" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label>Votre note</label>
    <select class="custom-select mr-sm-2" name="note" id="inlineFormCustomSelect">
      <option value="1" selected>1</option>
      <option value="2">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Description de la dégustation</label>
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
