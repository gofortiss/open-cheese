<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Historique des dégustations globale</h1>
  </div>
</div>
<table
data-mobile-responsive="true"
data-cookie="true"
data-cookie-id-table="saveId"
data-auto-refresh="true"
data-advanced-search="true"
data-id-table="advancedTable"
data-mobile-responsive="true"
data-show-columns="true"
id="table"></table>
<script type="text/javascript">
$(document).ready(function(){
      // Affichage des dégustations
      $('#table').bootstrapTable({
        search : true,
        url:"<?php echo base_url(); ?>index.php/Liste_historique/apiHistorique",
        pagination: true,

        columns: [{
          visible : false,
          field: 'num_tblfromage',
          title: "Identifiant unique"
        },
        {
          sortable: true,
          sortOrder: 'ASC',
          field: 'pseudo',
          title: "Utilisateur"
        },{
          sortable: true,
          sortOrder: 'ASC',
          field: 'dateAjout',
          title: "Date de l'ajout"
        }, {
          sortable: true,
          sortOrder: 'ASC',
          field: 'nom',
          title: 'Fromage'
        },
        {
          sortable: true,
          sortOrder: 'ASC',
          field: 'type',
          title: 'Type de pâte'
        },
        {
          sortable: true,
          sortOrder: 'ASC',
          field: 'typeLait',
          title: 'Type de lait'
        },
        {
          sortable: true,
          sortOrder: 'ASC',
          field: 'pasteurise',
          title: 'pasteurisé'
        }, {
          sortable: true,
          sortOrder: 'ASC',
          field: 'note',
          title: 'Note de la dégustation'

        }],
        // Si une ligne est cliquée redirection sur la page de la dégustation
        onClickRow: function (row, element, field) {
          window.location.href = "<?php echo base_url(); ?>index.php/fromage?id="+row['num_tblfromage'];
        }
      })

});
</script>
