<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<!-- <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/fluent.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css');?>">
		<script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">
		<title><?php echo $title; ?></title>
		<!-- Afficher message javascript -->
		<script type="text/javascript">
		$(document).ready(function() {
			<?php if(isset($js)){echo $js;} ?>
			})
		</script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #F9CF48!important;">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url('index.php/home');?>">Accueil<span class="sr-only"></span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url('index.php/fromage/listeFromage');?>">Liste des fromages</a>
		      </li>
					<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('index.php/fromage/listeDegustation');?>">Liste des dégustations</a>
					</li>
					<!-- Élément dynamique HTML connecté/déconnecté-->
					<?php
						if (!isset($_SESSION['idUser'])) {
							?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('index.php/Connexion');?>">Connexion</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('index.php/Inscription');?>">Inscription</a>
							</li>
							<?php
						}
						else {
							?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('index.php/moncompte');?>">Mon compte</a>
							</li>
							<li class="nav-item">
								<?php echo '<a href='.base_url('index.php/Deconnexion').' class="nav-link">Déconnexion</a>';?>
							</li>
							<?php
						}
					 ?>
		    </ul>
		  </div>
		</nav>
