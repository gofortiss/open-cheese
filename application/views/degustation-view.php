<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 titre-fromage"></h1>
    <img class="headerPhoto" src="" alt="photo du fromage">
  </div>
</div>
<div class="form-row degustation">
  <div class="form-group col-lg-4 border">
    <h2 class="titre">Le produit</h2>
    <h4>Description :</h4>
    <p class="description-fromage"></p>
    <h4>Type de lait</h4>
    <p class="type-de-lait-fromage"></p>
    <h4>Type de pâte</h4>
    <p class="type-de-pate-fromage"></p>
    <h4>Est pasteurisé</h4>
    <p class="pasteurise-fromage"></p>
  </div>
  <div class="form-group col-lg-4 border">
    <h2 class="titre">Valeur énergetique</h2>
  <table class="table">
    <thead>
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
  </div>
  <div class="form-group col-lg-4 border">
    <h2 class="titre">Note des utilisateurs</h2>
    <h2 class="titre">4/5</h2>
    <h2 class="titre">Nombre d'avis</h2>
    <h2 class="titre">18</h2>
  </div>
</div>
<div class="form-row degustation">
  <div class="form-group col-lg-12 border">
      <h2 class="titre">Commentaires</h2>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>index.php/fromage/api?id=<?php echo $id; ?>",
          dataType: "json",
          success: function (data) {
            console.log(data);
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
          }
      });

  });
</script>
