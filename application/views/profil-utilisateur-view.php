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
        <form action="profil/appelNouvelAmi?id=<?php echo $_GET['id']?>" method="post">
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
          <!-- En développement -->
          <!-- <button type="submit" class="btn btn-outline-primary btn-lg btn-block" >Ajouter en ami</button> -->
          <p>
            <button class="btn btn-outline-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Ajouter en ami
            </button>
          </p>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                Patience... cette fonction sera bientôt disponible :)
              </div>
            </div>
        </form>
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
