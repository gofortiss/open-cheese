<div class="MonCompte">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4"><?php if(isset($userInfo)){echo $userInfo[0]['pseudo'];}?></h1>
      <img class="photoProfil" src="<?php echo base_url('assets/images/profile-picture/'.$userInfo[0]['photo']); ?>">
    </div>
  </div>
  <div class="form-row" style="margin-bottom: 50px;">
    <div class="form-group col-md-6">
       <h2 class="moncompte-titre">Mes informations</h2>
      <div class="moncompte-block1">
        <form action="updateAccount" method="post"  enctype="multipart/form-data">
          <div class="form-group">
            <label>Pseudo</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value='<?php echo $userInfo[0]['pseudo'];?>' required>
            <label>Bio personnelle</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">ceci sera publique</span>
              </div>
              <textarea class="form-control" name="bio" aria-label="With textarea"><?php echo $userInfo[0]['bio'];?></textarea>
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
    <div class="form-group col-md-6">
      <h2 class="moncompte-titre">Amis</h2>
      <div class="moncompte-block2">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Handle</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
