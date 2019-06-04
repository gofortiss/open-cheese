<div class="jumbotron">
  <h1 class="display-4">OPEN CHEESE</h1>
  <p class="lead">Le plus grand réseau de fromage</p>
</div>

<div class="container">
  <div class="form-row home-card-container">
      <div class="form-group col-lg-4">
        <div class="home-card">
          <img src="<?php echo base_url('assets/images/logo/fromage.png') ?>" class="card-img-top" alt="frromage">
          <h5 class="card-title">Les fromages</h5>
          <p class="card-text">Venez découvrir les fromages du monde entier !</p>
          <a href="<?php echo base_url('index.php/fromage/listeFromage')?>" class="btn btn-outline-primary btn-block">Voir les fromages</a>
        </div>
      </div>
      <div class="form-group col-lg-4">
        <div class="home-card">
          <img src="<?php echo base_url('assets/images/logo/fromages.png') ?>" class="card-img-top" alt="dégustation">
          <h5 class="card-title">Les dégustations</h5>
          <p class="card-text">Visualisez les dégustations de la communautés</p>
          <a href="<?php echo base_url('index.php/listeHistorique')?>" class="btn btn-outline-primary btn-block">Voir les dégustations</a>
        </div>
      </div>
      <div class="form-group col-lg-4">
        <div class="home-card">
          <img src="<?php echo base_url('assets/images/logo/worker.png') ?>" class="card-img-top" alt="dégustation">
          <h5 class="card-title">Vous êtes producteur ?</h5>
          <p class="card-text">Ajouter votre entreprise au site web, pour avoir une meilleure visibilité</p>
          <a href="<?php echo base_url('index.php/fromage/ajouterProducteur')?>" class="btn btn-outline-primary btn-block">Ajouter un producteur</a>
        </div>
      </div>
      <div class="form-group col-lg-4">
        <div class="home-card">
        </div>
      </div>
  </div>
</div>
<?php
if(isset($_SESSION['idUser']))
{
  ?>
  <div class="jumbotron" style="margin-bottom: 0px;">
    <h1 class="display-4">Flux d'activité</h1>
    <hr class="my-4">
     <p class="lead"><?php if(!isset($degustation[1])){echo "Suivez donc plus de monde pour voir leurs activités sur le site !";} ?></p>
  </div>
  <?php
  if(isset($degustation[1])){
    foreach ($degustation as $key => $value) {
      // // skip first
      if (!$key == 0) {
          foreach ($value as $key) {
            echo
            '<div class="feed">
              <h3>'.$key->pseudo.' à ajouter une dégustation le '.$key->dateAjout.'</h3>';
              if($key->photo_degustation != '')
              {
                echo '<a href="'.base_url().'assets/images/degustation/'.$key->photo_degustation.'" target="_blank">
                <img class="feed-degustation-image"  style="width:100px!important;height:100px" src="'.base_url().'assets/images/degustation/'.$key->photo_degustation.'" alt="Aucune photo"/>
                </a>';
              }else {
                echo '<h3>La dégustation ne contient aucune photo</h3>';
              }
          }
      }
    }
  }
} else {
  ?>
  <div class="jumbotron" style="margin-bottom: 0px;">
    <h1 class="display-4">Notez les meilleurs formages du monde</h1>
    <hr class="my-4">
     <p class="lead">Open-cheese offre la possibilitée à n'importe qui de pouvoir noter les fromages les plus préstigieux</p>
  </div>

  <div class="jumbotron" style="background-color:#ffc1073d;margin-bottom: 0px;">
    <h1 class="display-4">Pourquoi open cheese ?</h1>
      <div class="container" style="margin-top:25px;">
        <div class="form-row">
            <div class="form-group col-lg-4">
              <div class="home-card">
                <img src="<?php echo base_url('assets/images/logo/group.png') ?>" class="card-img-top" alt="frromage">
                <h5 class="card-title">Grande communauté</h5>
              </div>
            </div>
            <div class="form-group col-lg-4">
              <div class="home-card">
                <img src="<?php echo base_url('assets/images/logo/site.png') ?>" class="card-img-top" alt="dégustation">
                <h5 class="card-title">Site web professionel</h5>
              </div>
            </div>
            <div class="form-group col-lg-4">
              <div class="home-card">
                <img src="<?php echo base_url('assets/images/logo/diploma.png') ?>" class="card-img-top" alt="dégustation">
                <h5 class="card-title">Producteur certifé</h5>
              </div>
            </div>
            <div class="form-group col-lg-4">
              <div class="home-card">
              </div>
            </div>
        </div>
      </div>
  </div>

  <?php
}
?>
