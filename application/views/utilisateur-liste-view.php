<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Liste des utilisateurs</h1>
  </div>
</div>
<div style="max-width: 1500px!important;margin:auto">
  <table id="table" ></table>
</div>
<script type="text/javascript">
$(document).ready(function(){
      // Affichage des dégustations
      $('#table').bootstrapTable({
        search : true,
        visible : false,
        url:"<?php echo base_url(); ?>index.php/community/apiUtilisateur",
        searchAlign: 'center',
        columns: [{
          visible: false,
          field: 'numero',
          title: "Identifiant unique"
        },
        {
          sortable: true,
          sortOrder: 'ASC',
          field: 'pseudo',
          title: "Utilisateur"
        }],
        // Si une ligne est cliquée redirection sur la page de la dégustation
        onClickRow: function (row, element, field) {
          window.location.href = "<?php echo base_url(); ?>index.php/community/afficherProfil?id="+row['numero'];
        }
      })

});
</script>
