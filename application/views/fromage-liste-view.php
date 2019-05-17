<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Liste des fromages</h1>
  </div>
</div>
<?php
if(isset($_SESSION['idUser']))
{
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 list-button">
        <a href="<?php echo base_url('/index.php/fromage/ajouterFromage');?>" class="btn btn-primary btn-lg btn-block">Ajouter un fromage</a>
      </div>
      <div class="col-md-6 list-button">
        <a href="<?php echo base_url('/index.php/fromage/ajouterProducteur');?>" class="btn btn-primary btn-lg btn-block">Ajouter un producteur</a>
      </div>
    </div>
  </div>
  <?php
}
?>
<table id="table"></table>
<script type="text/javascript">
$(document).ready(function(){
      // Affichage des dégustations
      $('#table').bootstrapTable({
        search : true,
        url:"<?php echo base_url(); ?>index.php/fromage/apiAllFromages",
        pagination: true,
        showLoading: true,
        columns: [{
          visible : false,
          field: 'numero',
          title: "Identifiant unique"
        },
        {
          sortable: true,
          sortOrder: 'ASC',
          field: 'nom',
          title: "Nom du fromage"
        },{
          sortable: true,
          sortOrder: 'ASC',
          field: 'type',
          title: "Type de pâte"
        }, {
          sortable: true,
          sortOrder: 'ASC',
          field: 'typeLait',
          title: 'Type de lait'
        },
        {
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
