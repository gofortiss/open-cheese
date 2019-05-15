<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 titre-fromage"></h1>
    <img class="headerPhoto" src="" alt="photo du fromage">
  </div>
</div>
<div class="form-row degustation">
  <div class="form-group col-lg-6 border">
    <h2 class="titre">Le produit</h2>
    <h4>Description :</h4>
    <p class="description-fromage" style="width: 400px;text-align:left;margin:auto"></p>
    <h4>Type de lait</h4>
    <p class="type-de-lait-fromage"></p>
    <h4>Type de pâte</h4>
    <p class="type-de-pate-fromage"></p>
    <h4>Est pasteurisé</h4>
    <p class="pasteurise-fromage"></p>
  </div>
  <div class="form-group col-lg-6 border">
    <h2 class="titre">Valeur énergetique</h2>
      <table class="table">
        <thead class="">
          <tr>
            <th scope="col">Calories</th>
            <th scope="col">Proteines</th>
            <th scope="col">Lipides</th>
            <th scope="col">Sodium</th>
          </tr>
        </thead>
      <tbody>
        <tr>
          <th class="proteines-fromage"></th>
          <th class="lipides-fromage"></th>
          <th class="calories-fromage"></th>
          <th class="sodium-fromage"></th>
        </tr>
      </tbody>
    </table>
    <h2 class="titre">Dégustation</h2>
    <a class="btn btn-primary btn-lg ajouterDegustation" href="" class="btn btn-primary btn-lg">Ajouter une dégustation</a>
  </div>
</div>
  <!-- Affichage du message par défaut -->
<div class="container title degustation">
  <p class="lead degustation-titre">Ce fromage n'a pas encore été dégusté.</p>
      <div class="row">
          <div id="utilisateur" class="col-md-4">
            <h5>utilisateur</h5>
          </div>
          <div id="description" class="col-md-4">
            <h5>Description</h5>
          </div>
          <div id="note" class="col-md-4">
            <h5>Note</h5>
          </div>
      </div>
  </div>
<script type="text/javascript">
  $(document).ready(function(){

    // Récupération des données du fromage
    $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>index.php/fromage/apiFromage?id=<?php echo $id; ?>",
          dataType: "json",
          success: function (data) {
            $('.titre-fromage').text(data[0]['nom']);
            $('.description-fromage').text(data[0]['description_fromage']);
            $('.headerPhoto').attr("src","<?php echo base_url(); ?>assets/images/fromage/"+data[0]['photo_fromage']);
            $('.type-de-lait-fromage').text(data[0]['typeLait']);
            $('.type-de-pate-fromage').text(data[0]['type']);
            $('.pasteurise-fromage').text(data[0]['pasteurise']);

            $('.calories-fromage').text(data[0]['calories']);
            $('.lipides-fromage').text(data[0]['lipides']);
            $('.proteines-fromage').text(data[0]['proteines']);
            $('.sodium-fromage').text(data[0]['sodium']);

            $('.ajouterDegustation').attr("href","<?php echo base_url(); ?>index.php/fromage/ajouterDegustation/?id="+data[0]['fromage_numero']);
          }
      });

      // Récupération des dégustations liées
      $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/fromage/apiDegustation?id=<?php echo $id;?>",
            dataType: "json",
            success: function (data) {
              if(data.length != 0){
                $('.degustation-titre').text("");
              } else {
                $('.degustation-header').attr('style','display:none');
              }
            }
        });
  });
</script>
