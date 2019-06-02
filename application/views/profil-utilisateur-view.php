<div class="MonCompte">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <img class="rounded-photo" src="<?php echo base_url('assets/images/profile-picture/'.$user[0]->photo_profil); ?>">
      <h1 class="display-4 btn btn-lg btn-secondary label-community-user" data-toggle="popover" title="Bio" data-content="<?php echo $user[0]->bio;?>"  id="titre-prfil"><?php echo $user[0]->pseudo; ?></h1>
      <p>
        <button class="btn btn-outline-primary btn-lg btn-block hidden" id="ajouter_ami" type="button">Suivre</button>
        <button class="btn btn-outline-danger btn-lg btn-block hidden" id="retirer_ami" type="button">Ne plus suivre</button>
      </p>
    </div>
  </div>
  <div class="form-row">
      <!-- <div class="form-group col-lg-12">
        <h2 class="moncompte-titre">Trophés obtenus</h2>
        <div class="moncompte-block3 reveal-focus">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
          <img src="https://previews.123rf.com/images/alexutemov/alexutemov1512/alexutemov151200347/49462014-modern-flat-design-badge-icon-vector-badges-flat-modern-style-vintage-retro-flat-badges-labels-and-r.jpg" class="img-thumbnail" alt="...">
        </div>
      </div> -->

      <div class="form-group col-lg-12">
        <table id="table"></table>
      </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){    // Récupération de la relation
    $(function () {
      $('[data-toggle="popover"]').popover()
    })

    // Affichage du bouton follow en fonction de l'état du suivi
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>index.php/community/appelRelation?id=<?php echo $_GET['id']; ?>",
      dataType: "json",
      success: function (success) {
        if(success){
          // Affiche suivre
          $("#ajouter_ami").removeClass("hidden");
        } else {
          // Affiche ne plus suivre
          $("#retirer_ami").removeClass("hidden");
        }
      }
    });


    // Si ajouter en ami est cliqué
    $('#ajouter_ami').click(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/community/appelNouvelAmi?id=<?php echo $_GET['id']; ?>",
        dataType: "json",
        success: function (success) {
          $("#retirer_ami").removeClass("hidden");
          $("#ajouter_ami").addClass("hidden");
        }
      });
    });

    // Si retirer ami est cliqué
    $('#retirer_ami').click(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/community/appelRetirerAmi?id=<?php echo $_GET['id']; ?>",
        dataType: "json",
        success: function (success) {
          // Modification du bouton
          $("#ajouter_ami").removeClass("hidden");
          $("#retirer_ami").addClass("hidden");
        }
      });
    });

    // Affichage des dégustations de l'utilisateur
    $('#table').bootstrapTable({
      search : true,
      url:"<?php echo base_url(); ?>index.php/fromage/apiDegustationUtilisateur?id="<?php echo $_GET['id'];?>,
      pagination: true,
      showLoading: true,
      columns: [{
        visible : false,
        field: 'fromage_numero',
        title: "Identifiant unique"
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'nom_du_fromage',
        title: "Nom du fromage"
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'nom_du_producteur',
        title: "Nom producteur"
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'pays',
        title: "Pays de production"
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'type',
        title: "Type de producteur"
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'canton',
        title: "Canton"
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'typeLait',
        title: 'Type de lait'
      },
      {
        sortable: true,
        sortOrder: 'ASC',
        field: 'type_pate',
        title: 'Type de pâte'
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'pasteurise',
        title: 'Pasteurisé'
      },
      {
        sortable: true,
        sortOrder: 'ASC',
        field: 'calories',
        title: 'Valeur énergetique (100g)'
      },
      {
        sortable: true,
        sortOrder: 'ASC',
        field: 'proteines',
        title: 'proteines (100g)'
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'sodium',
        title: 'Sodium (100g)'
      }, {
        sortable: true,
        sortOrder: 'ASC',
        field: 'lipides',
        title: 'Lipides (100g)'
      }],
      // Si une ligne est cliquée redirection sur la page de la dégustation
      onClickRow: function (row, element, field) {
        window.location.href = "<?php echo base_url(); ?>index.php/fromage?id="+row['fromage_numero'];
      }
    })
  });
</script>
