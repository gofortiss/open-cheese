<div class="MonCompte">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">gofortiss</h1>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <div class="moncompte-block1">
        <img class="photoProfil" src="<?php echo base_url('assets/images/profile-picture/gofortiss.png'); ?>">
        <form action="updateAccount" method="post"  enctype="multipart/form-data">
            <label>Pseudo</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value='<?php if(isset($pseudo)){echo $pseudo;}?>' required>
            <label>prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Guillaume" value='<?php if(isset($prenom)){echo $prenom;}?>'>
            <label>Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Dubuis" value='<?php if(isset($nom)){echo $nom;}?>'>
            <label>Date de naissance</label>
            <input type="date" class="form-control" name="naissance" id="date" value='<?php if(isset($date)){echo $date;}?>'>
            <label>Pays</label>
            <select class="custom-select mr-sm-2" name="pays" id="inlineFormCustomSelect">
              <option value="1">Suisse</option>
              <option value="2">France</option>
            </select>
            <label>Mot de passe</label>
            <input type="password" class="form-control" name="password1" id="password1" required>
            <label>Confirmer mot de passe</label>
            <input type="password" class="form-control" name="password2" id="password2" required>
          <button type="submit" class="btn btn-outline-primary btn-lg btn-block" >Mettre à jour</button>
        </form>
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="moncompte-block2">
        <h1>AMIS</h1>
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
