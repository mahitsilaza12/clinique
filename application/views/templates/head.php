<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>CVB</title>
	<link rel="stylesheet" href="<?= base_url()?>assets\css\bootstrap\bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets\css\style.css">
	<link rel="stylesheet" href="<?= base_url()?>assets\font\all.css">
	<link rel="stylesheet" href="<?= base_url()?>assets\font\fontawesome.css">
	<link rel="stylesheet" href="<?= base_url()?>assets\chart\Chart.css"/>
	<link rel="stylesheet" href="<?= base_url()?>assets\DataTables\datatables.css"/>

</head>

<body>
	<nav class="navigation-bar">
		<div class="declencheur">
			<ul class="declencher">
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		<ul class="menu-list">
			<li class="menu"><i class="fas fa-home"></i> <a href="<?= base_url()?>">Acceuil</a></li>
			<li class="menu"><i class="far fa-user"></i> <a href="<?= base_url()?>proprietaire">Client <span class="badge badge-light" id="client"></span></a></li>
			<li class="menu"><i class="fa fa-book"></i> <a href="<?= base_url()?>consultation">Clinique</a></li>
<?php if($this->session->pseudo == "administrateur") {?> <li class="menu" id='finance'><i class="fas fa-euro-sign"></i> <a href="<?= base_url()?>finance">Finance</a></li><?php } ?>
<?php if($this->session->pseudo == "administrateur") {?> <li class="menu"><i class="fas fa-phone"></i> <a href="<?= base_url()?>fournisseur">Fournisseur</a></li><?php } ?>
<?php if($this->session->pseudo == "administrateur") {?> <li class="menu"><i class="fas fa-book-open"></i> <a href="<?= base_url()?>history">Historique</a></li><?php } ?>

<?php if($this->session->pseudo == "administrateur") {?> <li class="menu" id='finance'><i class="fas fa-hospital"></i> <a href="<?= base_url()?>hospitalisation">Hospitalisation</a></li><?php } ?>
			<li class="menu" id="med"><i class="fa fa-syringe"></i> <a href="<?= base_url()?>medicament">Médicament</a></li>
			<li class="menu"><i class="fa fa-paw"></i> <a href="<?= base_url()?>patient">Patient <span class="badge badge-light" id="pat"></span></a></li>
			<li class="menu" id="rappel"><i class="fa fa-bell"></i> <a href="<?= base_url()?>rappel">Rappel</a></li>
<?php if($this->session->pseudo == "administrateur") {?><li class="menu"><i class="fas fa-users"></i> <a href="<?= base_url()?>reapprovisionnement">Réappro.</a></li><?php } ?>
			<li class="menu"><i class="fas fa-ambulance"></i> <a href="<?= base_url()?>soin">Soin</a></li>
<?php if($this->session->pseudo == "administrateur") {?><li class="menu"><i class="fas fa-chart-bar"></i> <a href="<?= base_url()?>statistique">Statistique</a></li><?php } ?>
			<li class="menu"><i class="fa fa-folder"></i> <a href="<?= base_url()?>tarif">Tarif</a></li>
			<?php if($this->session->pseudo == "administrateur") {?><li class="menu"><i class="fas fa-user"></i> <a href="<?= base_url()?>user">Utilisateur</a></li><?php } ?>
			<li class="menu"><i class="fas fa-dog"></i> <a href="<?= base_url()?>vaccin">Vaccination</a></li>
		</ul>
		
	</nav>
	<div class="container-fluid slide-content" >
	<div class="header navbar sticky-top navbar-light">
	<a class="btn btn-sm btn-outline-warning ml-2 mr-2" id="logout" href="<?=base_url()?>welcome/logout"><i class="fa fa-power-off"></i> <?= $this->session->nomUser?></a>
	<button class="btn btn-sm btn-info" id="timer">
		</button >
	<button class="btn btn-dark ml-4" id="logo">Do All TAsk <span class="badge badge-success">v1.2</span>
</button>
<button class="btn btn-secondary" data-toggle="modal" data-target="#about">About me <i class="fa fa-exclamation"></i>
</button>
<button class="btn btn-sm btn-light ml-4" id="notif">Notification <i class="fa fa-sms"></i>
</button>

<nav aria-label="breadcrumb m-0 p-0">
  <ol class="breadcrumb m-0 p-1">
    <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
<?php if(isset($titre)){?>
    <li class="breadcrumb-item active" aria-current="page"><?= $titre?></li>
<?php }?>
<?php if(isset($second)){?>
    <li class="breadcrumb-item active" aria-current="page"><?= $second?></li>
<?php }?>
  </ol>
</nav>

</div>

<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">

	<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">About me</i></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closer">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<p>Do All TAsk est une application de gestion de clinique véterinaire réalisé en PHP 7 et le Framework Codeigniter 3.<br><br>
			Cette application a l'avantage de bien gérer les tâches au sein de la clinique, ce qui est très important pour ses utilisateurs puisque ceux-ci n'aurons pas besoin de s'attarder	sur les calculs et les gestions à faire mais seulement de se concentrer sur leur traitements et soins.<br>
			Elle a une gestion des stocks integrés, gestion des clients avec leurs historiques sur un système de profil par client. Le PDG, ou assistant pourra donc voir et savoir qui , quand et quoi sur un évènement fait.<br><br>
			Avec une interface bien garnie et un système de navigation très intuitif, cet application va donc dévenir incontournable dans les années à venir sur le plan professionnel.<br><br>
				<em>
						Dévéloppeur : <strong>@R_Clairmont</strong><br>
						Contact : <strong>0346804717</strong><br>
						Mail : <strong>clairmont.rajaonarison@gmail.com</strong><br>
						Facebook : <strong>Klay'rmont Thompson</strong>
					</em>
			</p>
			</div>
		</div>
	</div>

	
</div>