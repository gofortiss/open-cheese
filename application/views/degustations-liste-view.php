<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Liste des dégustations</h1>
  </div>
</div>
<table id="table"></table>
<script type="text/javascript">
$(document).ready(function(){
      // Affichage des dégustations
      $('#table').bootstrapTable({
        search : true,
        url:"<?php echo base_url(); ?>index.php/listeDegustations/api",
        pagination: true,
        columns: [{
          visible : false,
          field: '0',
          title: "Identifiant unique"
        },{
          field: 'dateAjout',
          title: "Date de l'ajout"
        }, {
          field: 'nom',
          title: 'Fromage'
        },
        {
          field: 'type',
          title: 'Type de pâte'
        },
        {
          field: 'typeLait',
          title: 'Type de lait'
        },
        {
          field: 'pasteurise',
          title: 'pasteurisé'
        }, {
          field: 'note',
          title: 'Note de la dégustation'
        }],
        // Si une ligne est cliquée redirection sur la page de la dégustation
        onClickRow: function (row, element, field) {
          window.location.href = "<?php echo base_url(); ?>index.php/degustation?id="+row['0'];
        }
      })
});
</script>
