<div class="container-fluid slide-content"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;padding:10px;background-color:rgba(0,0,0,0.2)">
	<div class="jumbotron pt-1" style="background-color:rgba(0,0,0,0.2)">
		<h3 class="display-3 mt-1"><?php foreach($data as $patient):
			if($patient->img_patient == null || $patient->img_patient == " ")
				$patient->img_patient == "ads.jpg";
			echo $patient->NomPatient;?></h3>
		<input type="hidden" id="codePatient" value="<?= $codePatient;?>">
		<hr class="my-4">
		<img src="<?= base_url()?>assets/img/<?= $patient->img_patient ?>" alt="Aucun image correspondant au patient" 
			style="width:200px;height:250px;float:left">
		<ul class="list-group list-group-flush" style="margin-left:210px;">
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Proprietaire : <em><a
							href='<?= base_url()?>proprietaire/profil/<?= $patient->codeProprio?>'><?=$patient->nomProprio."</a>"?></em></span>
			</li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Espece :
					<em><?= $patient->libelle_espece?></em></span></li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Sexe : <em><?= $patient->libelle_sexe?></span>
			</li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Age (ou date de
					naissance)
					: <?php if($patient->age) echo $patient->age." mois"; else echo $patient->dateNais;?></span></li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Race :
					<em><?= $patient->nom_race?></span></li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Couleur :
					<?= $patient->couleur ?></span></li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Variété :
					<?= $patient->variete?></span></li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Description :
					<em><?= $patient->description?></span></li>
			<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
					class="">Ajouté le :
					<em><?= $patient->created_at?></span></li>
		</ul>

		<?php endforeach?>
		<hr>
<a href='http://clinique.test/' class='btn btn-info ml-4' style='font-size:12px' data-toggle='modal'
				data-target='#exampleModalLong'>Editer ce paatient</a>

	</div>
	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header pb-0 pt-0" id="headingOne">

				<h2 class="mb-1" style="text-align:center;">
					<button class="btn" type="button" data-toggle="collapse" data-target="#coll-three"
						aria-expanded="true" aria-controls="coll-three" style="background-color:rgba(10,15,120,0.45)">
						Ses historiques en clinique </button>
				</h2>
			</div>
			<div id="coll-three" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="background-color:rgba(145 , 125 , 120 , 0.5);padding:0">
					<div style="height:300px;overflow-y:scroll">
						<table class="table table-bordered" style="text-align:center;font-size:14px;">
							<thead style="padding:3px">
								<tr>
									<th>Numéro de consultation</th>
									<th>Patient</th>
									<th>Motif de consultation</th>
									<th>Anamnèse</th>
									<th>Suspicion</th>
									<th>Examen complementaire</th>
									<th>Paramètre du patient</th>
									<th>Décision prise</th>
									<th>Traitement réçu</th>
									<th>Date de consultation</th>
								</tr>
							</thead>
							<tbody id="table-consult" style="padding:3px">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header pb-0 pt-0" id="headingOne">

				<h2 class="mb-1" style="text-align:center;">
					<button class="btn" type="button" data-toggle="collapse" data-target="#coll-two"
						aria-expanded="true" aria-controls="coll-two" style="background-color:rgba(10,15,120,0.45)">
						Ses historiques de soin </button>
				</h2>
			</div>
			<div id="coll-two" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="background-color:rgba(145 , 125 , 120 , 0.5);padding:0">
					<div style="height:300px;overflow-y:scroll">
						<table class="table table-bordered" style="text-align:center;font-size:14px;">
							<thead style="padding:3px">
								<tr>
									<th>Numéro de soin</th>
									<th>Soin faite</th>
									<th>Date de soin</th>
								</tr>
							</thead>
							<tbody id="table-soin" style="padding:3px">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Fiche patient :</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul id="parametre-fiche">

				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="mod" tabindex="-1" role="dialog" aria-labelledby="modLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modLabel">Traitement réçu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
			<thead>
				<th>Médicament</th>
				<th>Dose</th>
			</thead>
			<tbody id="trait_for">

			</tbody>
		</table>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Editer ce patient</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closer">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?=base_url()?>patient/edit/<?=$codePatient;?>" method="POST" id="form_patient" enctype="multipart/form-data">
					<?php foreach ($data as $patient) {
						
					?>

					<div class="form-group">
						<label>Nom :</label>
						<input type="text" class="form-control form-control-sm" value="<?= $patient->NomPatient?>" name="nomPatient" required>
					</div>
					<div class="form-group">
						<label>Date de naissance : <cite class="small">(à laisser vide si le propriétaire ne se souvient pas de la date exacte )</cite></label>
						<input type="date" class="form-control form-control-sm"	placeholder="12" name="dateNais">
					</div>
						
					<div class="form-group">
						<label>Sexe :</label>
						<?php if($patient->codeSexe == 1 || $patient->codeSexe == 3){?>


						<div class="form-check">
							<input class="form-check-input" type="radio" id="male" value="option1" checked
								name="labe_check">
							<label class="form-check-label" for="male">
								Mâle
							</label>
							<select class="form-control form-control-sm" name="sexe">
								<option value="1">Castré</option>
								<option value="3">Non castré</option>
							</select>
						</div>
					<?php } else { ?>
						<div class="form-check">
							<input class="form-check-input" type="radio" id="femelle" value="option2" name="labe_check">
							<label class="form-check-label" for="femelle">
								Femelle
							</label>
							<select class="form-control form-control-sm" 
								style="display:none">
								<option value="2">Sterilisé</option>
								<option value="4">Non sterilisé</option>
							</select>
						</div>
					</div>

				<?php } ?>
					<div class="form-group">
						<label >Couleur :</label>
						<input value='<?= $patient->couleur?>' class="form-control form-control-sm" name="couleur">
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Image associé aux patient</label>
						<input type="file" id="file" class="form-control-file form-control-sm" name="file_img" id="exampleFormControlFile1">
					</div>
					<div class="form-group">
						<label for="exampleFormCTextarea1">Description de l'animal</label>
						<textarea class="form-control" id="exampleFormCTextarea1" rows="3" name="descript"
							><?= $patient->description ?></textarea>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-outline-success" id="sendPatient">Enregistrer</button>
			</div>
		<?php } ?>
			</form>
		</div>
	</div>
</div>
