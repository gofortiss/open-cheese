<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Liste des fromages</h1>
  </div>
</div>
<?php
if(isset($_SESSION['idUser']))
{
  ?>
    <a href="<?php echo base_url('/index.php/fromage/Ajouter');?>" class="btn btn-primary btn-lg btn-block">Ajouter un fromage</a>
  <?php
}
?>
<table id="table"></table>
<script type="text/javascript">
$(document).ready(function(){
      // Affichage des dégustations
      $('#table').bootstrapTable({
        search : true,
        url:"<?php echo base_url(); ?>index.php/fromage/listeFromage/api",
        pagination: true,
        columns: [{
          visible : false,
          field: '0',
          title: "Identifiant unique"
        },
        {
          field: 'nom',
          title: "Nom du fromage"
        },{
          field: 'type',
          title: "Type de pâte"
        }, {
          field: 'typeLait',
          title: 'Type de lait'
        },
        {
          field: 'pasteurise',
          title: 'Pasteurisé'
        },
        {
          field: 'calories',
          title: 'Valeur énergetique (100g)'
        },
        {
          field: 'proteines',
          title: 'proteines (100g)'
        }, {
          field: 'sodium',
          title: 'Sodium (100g)'
        }, {
          field: 'lipides',
          title: 'Lipides (100g)'
        }],
        // Si une ligne est cliquée redirection sur la page de la dégustation
        onClickRow: function (row, element, field) {
          window.location.href = "<?php echo base_url(); ?>index.php/fromage?id="+row['0'];
        }
      })
});
</script>
