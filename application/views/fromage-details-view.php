<!-- Modal afficher les like -->
<div class="modal fade" id="modal-like" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Qui à aimé ?</h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-like-close" class="btn btn-secondary">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Partie visible -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 titre-fromage"></h1>
    <img class="photo-fromage" id="image-fromage" src="" alt="photo du fromage">
  </div>
</div>
<div class="form-row degustation">
  <!-- Fromage -->
  <div class="form-group col-lg-3 border">
    <h2 class="titre">Le produit</h2>
    <h3>Description</h4>
    <h5 class="description-fromage" style="max-width: 400px;margin-left:auto;margin-right:auto"></h5>
    <h3>Type de lait</h3>
    <h5 class="type-de-lait-fromage"></h5>
    <h3>Type de pâte</h3>
    <h5 class="type-de-pate-fromage"></h5>
    <h3>Est pasteurisé</h3>
    <h5 class="pasteurise-fromage"></h5>
  </div>
  <!-- Producteur -->
  <div class="form-group col-lg-3 border">
    <h2 class="titre">Le producteur</h2>
    <h3>Description</h3>
    <h5 class="description-producteur" style="max-width: 400px;margin-left:auto;margin-right:auto"></h5>
    <h3>Pays du producteur</h3>
    <h5 class="pays-producteur"></h5>
    <h3>Localité du producteur</h3>
    <h5 class="localite-producteur"></h5>
    <h3>Canton du producteur</h3>
    <h5 class="canton-producteur"></h5>
    <h3>Type de producteur</h3>
    <h5 class="type-producteur"></h5>
  </div>
  <!-- Valeur énergetique -->
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
          <th class="calories-fromage"></th>
          <th class="proteines-fromage"></th>
          <th class="lipides-fromage"></th>
          <th class="sodium-fromage"></th>
        </tr>
      </tbody>
    </table>
    <?php
    // Affichage des actions sur le fromage si l'utilisateur est connecté
        if(isset($_SESSION['idUser']))
        {
          ?>
          <h2 class="titre">Dégustation</h2>
          <a class="btn btn-primary btn-lg ajouterDegustation" href="" class="btn btn-primary btn-lg">Ajouter une dégustation</a>
          <?php
        }
     ?>
  </div>
</div>
  <!-- Affichage du message par défaut -->
<h2 class="degustation-titre" style="text-align:center">Ce fromage n'a pas encore été dégusté.</h2>
<div class="container-fluid degustation">
    	<div class="row degustation-header">
    		<div class="col-sm-2">
    			<h2>Utilisateur</h2>
    		</div>
        <div class="col-sm-2">
          <h2>Note</h2>
        </div>
    		<div class="col-sm-4">
    			<h2>Description</h2>
    		</div>
        <div class="col-sm-2">
          <h2>Image</h2>
        </div>
        <div class="col-sm-2">
          <h2>Like</h2>
        </div>
    	</div>
      <?php
    // Affichage des dégustations
    foreach ($degustation as $value) {
      echo '<div class="row">
              <div class="col-md-2">
                <div class="degustation-info-block">
                  <a href="'.base_url().'index.php/profil?id='.$value->num_tblutilisateur.'">
                    <img class="degustation-utilisateur-image photo-fromage"  style="width:50px!important;height:50px" src="'.base_url().'assets/images/profile-picture/'.$value->photo_profil.'" alt="photo"/>
                  </a>
                  <h4 class="degustation-utilisateur-pseudo">'.$value->pseudo.'</h4>
                  <h6 class="degustation-utilisateur-date">'.$value->dateAjout.'</h6>
                </div>
              </div>
              <div class="col-md-2">
                <div class="degustation-info-block">
                <h1 class="degustation-utilisateur-note">'.$value->note.'</h1>
                </div>
              </div>

              <div class="col-md-4">
                <div class="degustation-info-block">
                  <h5 class="degustation-utilisateur-description">'.$value->description_degustation.'</h5>
                </div>
              </div>

              <div class="col-md-2">
                <div class="degustation-info-block">';
                // Vérification afficher image de la dégustation
                if($value->photo_degustation != '')
                {
                  echo '<a href="'.base_url().'assets/images/degustation/'.$value->photo_degustation.'" target="_blank">
                  <img class="degustation-utilisateur-image"  style="width:100px!important;height:100px" src="'.base_url().'assets/images/degustation/'.$value->photo_degustation.'" alt="Aucune photo"/>
                  </a>';
                } else {
                  echo '<h2>Aucune photo</h2>';
                }
                echo '
                </div>
              </div>
              <div class="col-md-2 degustation-like">';
                if(isset($_SESSION['idUser']))
                  {
                    // Le bouton est activé
                    echo '<a class="btn btn-primary " href="'.base_url('index.php/fromage/appelLike?fromage='.$_GET['id'].'&degustation='.$value->degustation_numero).'" role="button"><i class="material-icons">thumb_up_alt</i></a>';
                    echo '<a class="degustation-get-like" id="'.$value->degustation_numero.'" href="#voir" role="button">Voir</a>';

                  }
                  else {
                    // Le bouton est desactivé
                    echo '<a class="btn btn-primary disabled degustation-like" href="#" role="button"><i class="material-icons">thumb_up_alt</i></a>';
                  }
              echo '
              </div>
              </div>';
        } ?>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    // Récupération des données du fromage et ajout des données dans les champs
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

      // Récupération des données du produceur et ajout des données dans les champs
      $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/fromage/apiProducteur?id=<?php echo $id; ?>",
            dataType: "json",
            success: function (data) {
              $('#image-producteur').attr("src","<?php echo base_url(); ?>assets/images/fromage/"+data[0]['photo_fromage']);
              $('.description-producteur').text(data[0]['description_producteur']);
              $('.pays-producteur').text(data[0]['pays']);
              $('.localite-producteur').text(data[0]['localite']);
              $('.canton-producteur').text(data[0]['canton']);
              $('.type-producteur').text(data[0]['type_producteur']);
            }
        });

      // Supprimer les colonnes de dégustation si il y a aucune dégustation
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

      // Bouton (Voir) à été cliqué
      $('a[href="#voir"]').click(function(){
        // Récupération des like
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>index.php/fromage/apiGetLike?degustation="+this.id,
          dataType: "json",
          success: function (data) {
            // Ajout des utilisateurs dans la modal
            for (var i = 0; i < data.length; i++) {
              $('.modal-body').append('<p>'+data[i]['pseudo']+'</p>');
            }
            // Ouverture de la modal
            $('#modal-like').modal('show');
          }
        });
      });

      // Fermeture de la modal
      $("#modal-like-close").click(function(){
        $('#modal-like').modal('hide');
        $(".modal-body").empty();
      });
  });
</script>
