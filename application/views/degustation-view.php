<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Dégustation</h1>
  </div>
</div>
<div class="form-row degustation">
  <div class="form-group col-lg-6 reveal-focus">
    <h2 class="titre titre-fromage"></h2>
    <img class="image-fromage" src="" alt="degustation"/>
    <label>Description :</label>
    <p class="description-fromage"></p>
  </div>
  <div class="form-group col-lg-6 reveal-focus">
    <h2 class="titre">Note</h2>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>index.php/degustation/api?id=<?php echo $id; ?>",
          dataType: "json",
          success: function (data) {
            console.log(data);
            $('.titre-fromage').text(data[0]['nom']);
            $('.image-fromage').attr("src","<?php echo base_url(); ?>assets/images/degustation/"+data[0]['photo_degustation']);
            $('.description-fromage').text(data[0]['description_degustation']);
          }
      });

  });
</script>
