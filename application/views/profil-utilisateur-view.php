<div class="MonCompte">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <img class="rounded-photo" src="<?php echo base_url('assets/images/profile-picture/'.$user[0]->photo_profil); ?>">
      <h1 class="display-4" id="titre-prfil"><?php echo $user[0]->pseudo; ?></h1>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group profil col-lg-12">
       <h2 class="">Utilisateur</h2>
          <div class="form-group">
            <label>Pseudo</label>
            <input type="text" class="form-control pattern" name="pseudo" id="pseudo" disabled value='<?php echo $user[0]->pseudo;?>' required>
            <label>Bio personnelle</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Présentation</span>
              </div>
              <textarea class="form-control" name="bio" disabled aria-label="With textarea"><?php echo $user[0]->bio;?></textarea>
            </div>
          </div>
          <p>
            <button class="btn btn-outline-primary btn-lg btn-block hidden" id="ajouter_ami" type="button">Suivre</button>
            <button class="btn btn-outline-danger btn-lg btn-block hidden" id="retirer_ami" type="button">Ne plus suivre</button>
          </p>
      </div>
    </div>
    <div class="form-group col-lg-12">
      <h2 class="moncompte-titre">Badges obtenus</h2>
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
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){    // Récupération de la relation
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>index.php/profil/appelRelation?id=<?php echo $_GET['id']; ?>",
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
        url: "<?php echo base_url(); ?>index.php/profil/appelNouvelAmi?id=<?php echo $_GET['id']; ?>",
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
        url: "<?php echo base_url(); ?>index.php/profil/appelRetirerAmi?id=<?php echo $_GET['id']; ?>",
        dataType: "json",
        success: function (success) {
          // Modification du bouton
          $("#ajouter_ami").removeClass("hidden");
          $("#retirer_ami").addClass("hidden");
        }
      });
    });
  });
</script>
