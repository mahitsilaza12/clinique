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

<body style="background-image:url(<?= base_url() ?>assets/img/car3.jpg);background-size:100%;background-repeat: no-repeat; ">
	
	<!-- Modal -->
	<div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
		style="margin-top:8%;opacity: .75">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style='text-align:center'>
					<h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
					
				</div>
				<div class="modal-body" style="background-color:rgba(10,10,200,0.172)">
					<form method="POST" action="<?= base_url()?>index.php/welcome/enregistrement">
						<div class="form-group">
							<label for="pseudo"><strong>Nom d'utilisateur</strong></label>
							<input min="4" required type="text" class="form-control" id="pseudo" name="nomUser">
						</div>
						<div class="form-group">
							<label for="mdp"><strong>Mot de passe</strong></label>
							<input type="password" name="mdp" class="form-control" id="mdp" min="4" required>
						</div>
                        <div class="form-group">
						<label ><strong>Privilège</strong></label>
						<select class="form-control" name="type">
							<option value="administrateur">Administrateur</option>
							<option value="simple">Simple utilisateur</option>
						</select>
				</div>
				
                </div>
                <div class="modal-footer">
                <a href="<?=base_url()?>index.php/welcome/login" class="btn btn-sm btn-primary">Se connecter</a>
					<button type="submit" class="btn btn-sm btn-success">S'enregistrer</button>
					
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
