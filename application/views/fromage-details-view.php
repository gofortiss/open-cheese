<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 titre-fromage"></h1>
    <img class="rounded-photo" id="image-fromage" src="" alt="photo du fromage">
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
<h2 class="degustation-titre" style="text-align:center">Ce fromage n'a pas encore été dégusté.</h2>
<div class="container-fluid degustation">
    	<div class="row degustation-header">
    		<div class="col-sm-4">
    			<h2>Utilisateur</h2>
    		</div>
    		<div class="col-sm-4">
    			<h2>Description</h2>
    		</div>
    		<div class="col-sm-2">
    			<h2>Note</h2>
    		</div>
        <div class="col-sm-2">
          <h2>Image</h2>
        </div>
    	</div>
      <?php
    foreach ($degustation as $value) {
      echo '<div class="row">
              <div class="col-md-4">
                <div class="degustation-info-block" style="width:300px!important">
                  <img class="degustation-utilisateur-image rounded-photo"  style="width:100px!important;height:100px" src="'.base_url().'assets/images/profile-picture/'.$value->photo_profil.'" alt="photo"/>
                  <h4 class="degustation-utilisateur-pseudo">'.$value->pseudo.'</h4>
                </div>
              </div>

              <div class="col-md-4">
                <div class="degustation-info-block">
                  <h5 class="degustation-utilisateur-description">'.$value->description_degustation.'</h5>
                </div>
              </div>

              <div class="col-md-2">
                <div class="degustation-info-block">
                  <h1 class="degustation-utilisateur-note">'.$value->note.'</h1>
                </div>
              </div>

              <div class="col-md-2">
                <div class="degustation-info-block">';
                // Vérification afficher image de la dégustation
                if($value->photo_degustation != '')
                {
                      echo '<img class="degustation-utilisateur-image"  style="width:100px!important;height:100px" src="'.base_url().'assets/images/degustation/'.$value->photo_degustation.'" alt="Aucune photo"/>
                            <a class="degustation-utilisateur-image"   href="'.base_url().'assets/images/degustation/'.$value->photo_degustation.'">Agrandir</a>';
                } else {
                      echo '<h2>Aucune photo</h2>';
                }
                echo '
                </div>
              </div>
              </div>';
        } ?>
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
            $('#image-fromage').attr("src","<?php echo base_url(); ?>assets/images/fromage/"+data[0]['photo_fromage']);
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
