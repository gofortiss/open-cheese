<div class="MonCompte">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4"><?php if(isset($userInfo)){echo $userInfo[0]->pseudo;}?></h1>
      <img class="rounded-photo" src="<?php echo base_url('assets/images/profile-picture/'.$userInfo[0]->photo_profil); ?>">
    </div>
  </div>
  <div class="form-row" style="margin-bottom: 50px;">
    <div class="form-group col-lg-6">
       <h2 class="moncompte-titre">Mes informations</h2>
      <div class="moncompte-block1 reveal-focus">
        <form action="moncompte/appelUpdate" method="post"  enctype="multipart/form-data">
          <div class="form-group">
            <label>Pseudo</label>
            <input type="text" class="form-control" maxlength="50" name="pseudo" id="pseudo" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,50}$" placeholder="Pseudo" value='<?php echo $userInfo[0]->pseudo;?>' required>
            <label>Bio personnelle</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">ceci sera publique</span>
              </div>
              <textarea class="form-control" name="bio" aria-label="With textarea"><?php echo $userInfo[0]->bio;?></textarea>
            </div>
            <label>Changer sa photo de profil</label>
            <div class="form-row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Photo de profil</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="fichier" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                </div>
              </div>
            </div>
            <label>Mot de passe</label>
            <input type="password" class="form-control" name="password1" id="password1">
            <label>Confirmer mot de passe</label>
            <input type="password" class="form-control" name="password2" id="password2">
          </div>
          <button type="submit" class="btn btn-outline-primary btn-lg btn-block" >Mettre à jour</button>
        </form>
      </div>
    </div>
    <div class="form-group col-lg-6">
      <h2 class="moncompte-titre">Amis</h2>
      <div class="moncompte-block2 reveal-focus">
        <table id="table"></table>
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
</div>

<script type="text/javascript">
$(document).ready(function(){
      // Affichage des dégustations
      $('#table').bootstrapTable({
        url:"<?php echo base_url(); ?>index.php/profil/apiAmis",
        columns: [{
          visible : false,
          field: 'fromage_numero',
          title: "Identifiant unique"
        }, {
          sortOrder: 'ASC',
          field: 'pseudo'
        }],
        // Si une ligne est cliquée redirection sur la page de la dégustation
        onClickRow: function (row, element, field) {
          window.location.href = "<?php echo base_url(); ?>index.php/fromage?id="+row['fromage_numero'];
        }
      })
});
</script>
