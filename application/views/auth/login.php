<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>CVB</title>
	<link rel="stylesheet" href="<?= base_url()?>assets\css\bootstrap\bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets\font\all.css">
	<link rel="stylesheet" href="<?= base_url()?>assets\font\fontawesome.css">


</head>
<style type="text/css">
	
</style>
<body style="background-image:url(<?= base_url() ?>assets/img/car1.jpg);background-size:100%;background-repeat: no-repeat; ">
<!-- 	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleControls" data-slide-to="1"></li>
    <li data-target="#carouselExampleControls" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" style="height: 500px;" src="<?= base_url() ?>assets/img/car1.jpg" alt="First slide">
    <div class="carousel-caption d-none d-md-block">
    <h1>Welcome</h1>
    <p>DATA est un outil de gestion de clinique vétérinaire qui falicitera votre quotidien.</p>
  </div>
    </div>
     
    <div class="carousel-item">
      <img class="d-block w-100" style="height: 500px;" src="<?= base_url() ?>assets/img/car3.jpg" alt="Second slide">
     <div class="carousel-caption d-none d-md-block">
    <h1>Do All TAsk</h1>
    <p>Il remplacera tous les travaux manuelles redondants qui vous fatigaient, en un click</p>
  </div>
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" style="height: 500px;" src="<?= base_url() ?>assets/img/car2.jpg" alt="Third slide">
     <div class="carousel-caption d-none d-md-block">
    <h1>...</h1>
    <p>...</p>
  </div>
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->
	<!-- Modal -->
	<div id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
		style="margin-top:8%;opacity: .75">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style='text-align:center'>
					<h5 class="modal-title" id="exampleModalLabel">Connection</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					-->
				</div>
				<div class="modal-body" style="background-color:rgba(10,10,200,0.172)">
					<?php if($this->session->login){?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Desolé
							!!!</strong>
						<?= $this->session->login;?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form method="POST" action="<?= base_url()?>index.php/welcome/log_in">
						<div class="form-group">
							<label for="pseudo"><strong>Nom d'utilisateur</strong></label>
							<input min="4" required type="text" class="form-control" id="pseudo" name="nomUser">
						</div>
						<div class="form-group">
							<label for="mdp"><strong>Mot de passe</strong></label>
							<input type="password" name="mdp" class="form-control" id="mdp" min="4" required>
						</div>
				</div>
				<div class="modal-footer">
					<a href="<?=base_url()?>index.php/welcome/register" class="btn btn-sm btn-success">S'enregistrer</a>
					<button type="submit" class="btn btn-sm btn-primary">Se connecter</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url()?>assets/js/bootstrap/jQuery.js"></script>
	<script src="<?= base_url()?>assets/js/bootstrap/bootstrap.bundle.js"></script>
	<script src="<?= base_url()?>assets/js/bootstrap/bootstrap.js"></script>

</body>

</html>
