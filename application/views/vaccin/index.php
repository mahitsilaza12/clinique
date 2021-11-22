<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">


    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="background-color:rgba(144,120,150,0.45)">
					<form id="soin_passe" action="<?= base_url()?>vaccin/vacciner" method="POST">
						<div class="form-group row">
							<label for="Patient" class="col-sm-2 col-form-label">Patient :</label>
							<div class="col-sm-10">
								<select type="text" name="codePatient" class="form-control" id="Patient">

									<select>
										<!-- Button trigger modal -->
										<button type="button" class="btn mt-1 btn-sm btn-secondary" data-toggle="modal"
											data-target="#newPatient">
											Nouveau patient
										</button>
							</div>
						</div>
						Vaccin :
						<div class="contenu">
							<div id="checkBoxes"
								style="display:inline-block;height:200px;overflow-y:scroll;border:0.5px dashed black;padding:5px;"
								class="w-50 mb-4"></div>

							<div id="produit-utiliser"
								style="display:inline-block;height:200px;overflow-y:scroll;border:0.5px dashed black;padding:5px;"
								class="w-25 mb-4"></div>
						</div>
						<select onchange="traiter(this.value)" class="form-control form-control-sm col-2" id="rappel" name="rappel" required>
						<option>Autre option</option>
						<option value="3">A rappeler</option>
						</select>
						<div id="rappeler-vaccin" style="display:none">
							<label class='mt-4'>Date du prochain rappel</label>
							<input type='date' name=
							'dateRappel' class='form-control form-control-sm col-2'>
						</div>
						<input placeholder="Remise pour cette facture" class="form-control form-control-sm mt-2 col-2" type="text" name="remise"><br>
						<button type="button" class="mb-2 btn btn-sm btn-outline-dark" data-toggle="modal"
								data-target="#exampleModalCenter">
								Remplir la fiche du patient
							</button>
						<button type="submit" class="btn btn-sm btn-info" id="soigner">VACCINER</button>
					</form>
				</div>
			</div>
		</div>
		<?php if(isset($vaccin))
{
?>

<div class="" style="background-color:rgba(255,255,255,0.72)">
<h3>FACTURATION</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Vaccin</th>
				<th>Prix</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0;
			$montant = 0;
			for($i ; $i < count($vaccin) ; $i++){
				foreach($vaccin[$i] as $vac)
				$montant += $vac->prix;
				
			?>
				<tr>
					<td><?= $vac->rubrique?></td>
					<td><?= splitChiffre($vac->prix)?> Ar</td>
					<td><?= splitChiffre($vac->prix)?> Ar</td>
				</tr>
			<?php }?>
				<tr>

					<td colspan="2">Somme</td>
					<td><?= splitChiffre($montant)?> Ar</td>
				</tr>
				
			<?php if($remise != 0){
				$montant -= ($montant * $remise) / 100;
				?>
				<tr>
					<td colspan="2">Remise</td>
					<td><?= splitChiffre($remise)?> %</td>
</tr>
<tr>

					<td colspan="2">Net à payer</td>
					<td><?= splitChiffre($montant)?> Ar</td>
				</tr>
<?php
			}
?>
			</tbody>
	</table>
	<form action="<?= base_url()?>vaccin/facturer" method="post">
	<input type="hidden" name="codeProprio" value="<?=$codeProprio?>">
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1" style='background-color:rgba(20,20,150,0.4)'>A payer maintenant</span>
  </div>
  <input type="number" name="payement" min="0" class="col-2 form-control" aria-label="Username" aria-describedby="basic-addon1">
  <input type="hidden" name="remise" value="<?= $remise; ?>">
</div>
	<button type='submit' class='btn btn-outline-success btn-sm m-2' >FACTURER <i class="fa fa-download"></i></a>
</form></div>

<?php
}
?>
</div>

	</div>


</div>
    <div class="modal fade" id="newPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Nouveau patient</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_patient">
					<div class="form-group">
						<label>Nom :</label>
						<input type="text" class="form-control form-control-sm" placeholder="Snoopy" name="nomPatient"
							required>
					</div>
					<div class="form-group">
						<label for="proprio">Propriétaire :</label>
						<select class="form-control form-control-sm" id="proprio" name="codeProprio" required>

						</select>
						<br>
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h2 class="mb-0">
										<button class="btn btn-sm btn-secondary" type="button" data-toggle="collapse"
											data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Ajouter un nouveau proprietaire
										</button>
									</h2>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne"
									data-parent="#accordionExample">
									<div class="card-body"
										style="background-color:rgba(150,120,120,0.75);height:200px;overflow-y:scroll">
										<div class="form-group">
											<label style="font-weight : bold" for="nom">Nom du client :</label>
											<input type="text" class="form-control " id="nom" required
												placeholder="Nom du client" name="nom">
										</div>
										<div class="form-group">
											<label style="font-weight : bold" for="adresse">Adresse :</label>
											<input type="text" class="form-control " required id="adresse"
												placeholder="Lot PK 101 Ivato Antananarivo 101" name="adresse">
										</div>
										<div class="form-group">
											<label style="font-weight : bold" for="phone">Téléphone :</label>
											<input type="text" class="form-control " id="phone" required
												placeholder="Numéro de téléphone" name="phone">
										</div>
										<div class="form-group">
											<label style="font-weight : bold" for="email">Email :</label>
											<input type="email" class="form-control " id="email"
												aria-describedby="emailHelp" placeholder="exemple@gmail.com"
												name="email">
											<small id="emailHelp" class="form-text text-muted">Entrer un email
												valide s'il vous
												plaît.</small>
										</div>
										<label style="font-weight : bold" class="form-check-label">
											Status du client au sein du clinique :
										</label>
										<select class="form-control" required name="status" id="status">
											<option value="Remisé">Remisé</option>
											<option value="Non remisé" selected>Non remisé</option>
										</select>
										<div class="form-group">
											<label style="font-weight : bold" for="organisation">Organisation</label>
											<input type="text" class="form-control " name="organisation"
												id="organisation" placeholder="Organisation oeuvrant pour les animaux">
										</div>

										<div>
											<button type="button" id="sendClient" class="btn btn-success btn-sm">Save
												changes</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						
						<div class="form-check" id="esp">
							
						</div>
						<div class="accordion" id="accordionExample">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-sm btn-secondary" type="button"
												data-toggle="collapse" data-target="#especeCollapse" aria-expanded="true"
												aria-controls="especeCollapse">
												Nouvelle espèce
											</button>
										</h2>
									</div>

									<div id="especeCollapse" class="collapse" aria-labelledby="headingOne"
										data-parent="#accordionExample">
										<div class="card-body"
											style="background-color:rgba(150,120,120,0.75);height:200px;overflow-y:scroll">
											
											<input type="text" class="form-control mb-2" name="" id="newEspece"
												placeholder="">
											<div>
												<button type="button" id="sendEspece" class="btn btn-dark btn-sm">ENREGISTRER</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="form-group">
							<label for="race">Race :</label>
							<select class="form-control form-control-sm" id="race" name="codeRace" required>

							</select>
							<br>
							<div class="accordion" id="accordionExample">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-sm btn-secondary" type="button"
												data-toggle="collapse" data-target="#coll" aria-expanded="true"
												aria-controls="coll">
												Ajouter une nouvelle race
											</button>
										</h2>
									</div>

									<div id="coll" class="collapse" aria-labelledby="headingOne"
										data-parent="#accordionExample">
										<div class="card-body"
											style="background-color:rgba(150,120,120,0.75);height:200px;overflow-y:scroll">
											<select class="form-control form-control-sm mb-2" id="newRace"
												name="newRace" required>
												
											</select>
											<input type="text" class="form-control mb-2" name="race_new" id="newRaceNom"
												placeholder="">
											<div>
												<button type="button" id="sendRace" class="btn btn-success btn-sm">Save
													changes</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1">Age : <cite class="small">(mois)</cite></label>
							<input type="number" min="0" class="form-control form-control-sm" placeholder="12"
								name="age">
						</div>
						<div class="form-group">
							<label>Date de naissance : <cite class="small">(à laisser
									vide
									si le propriétaire ne se souvient pas de la date exacte )</cite></label>
							<input type="date" class="form-control form-control-sm" id="exampleFormControlInput1"
								placeholder="12" name="dateNais">
						</div>
						<div class="form-group">
							<label>Variété :</label>
							<select class="form-control form-control-sm" name="variete">
								<option value="géant">Géant</option>
								<option value="moyen">Moyen</option>
								<option value="nain">Nain</option>
								<option value="large">Large</option>
							</select>
						</div>
						<div class="form-group">
							<label>Sexe :</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" id="male" value="option1" checked
									name="labe_check">
								<label class="form-check-label" for="male">
									Mâle
								</label>
								<select class="form-control form-control-sm" id="selectMale" name="sexe">
									<option value="1">Castré</option>
									<option value="3">Non castré</option>
								</select>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" id="femelle" value="option2"
									name="labe_check">
								<label class="form-check-label" for="femelle">
									Femelle
								</label>
								<select class="form-control form-control-sm" id="selectFemelle" name="sexe"
									style="display:none">
									<option value="2">Sterilisé</option>
									<option value="4">Non sterilisé</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Couleur :</label>
							<input class="form-control form-control-sm" name="couleur">
						</div>
						<div class="form-group">
							<label for="exampleFormControlFile1">Image associé aux patient</label>
							<input type="file" class="form-control-file form-control-sm" id="file" name="file_img">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Déscription de l'animal</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descript"
								placeholder="Animal aggressif"></textarea>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-dark" id="closer" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-sm btn-outline-info" id="sendPatient">Enregistrer</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content p-2">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Paramètre</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="background-color:rgba(150,150,20,0.12)">
				<form id="parametreNew">
					<div class="form-group row">
						<label for="freqCard" class="col-sm-0 col-form-label">Fréquence
							cardiaque :
						</label>
						<div class="col-sm-8">
							<input type="number" min="0" name="freqCard" class="form-control" id="freqCard">
						</div>
					</div>
					<div class="form-group row">
						<label for="freqResp" class="col-sm-0 col-form-label">Fréquence
							respiratoire
							:</label>
						<div class="col-sm-8">
							<input type="number" name="freqResp" min="0" class="form-control" id="freqResp">
						</div>
					</div>
					<div class="form-group row">
						<label for="taille" class="col-sm-0 col-form-label">Taille (cm)
							:</label>
						<div class="col-sm-10">
							<input type="number" name="taille" min="0" class="form-control" id="taille">
						</div>
					</div>
					<div class="form-group row">
						<label for="TRC" class="col-sm-0 col-form-label">TRC :</label>
						<div class="col-sm-10">
							<input type="text" name="TRC" class="form-control" id="TRC">
						</div>
					</div>
					<div class="form-group row">
						<label for="temperature" class="col-sm-0 col-form-label">Témperature
							:</label>
						<div class="col-sm-10">
							<input type="number" name="temperature" class="form-control" id="temperature">
						</div>
					</div>
					<div class="form-group row">
						<label for="poids" class="col-sm-0 col-form-label">Poids (kg)
							:</label>
						<div class="col-sm-10">
							<input type="number" min="0" name="poids" class="form-control" id="poids">
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" id="closed-param" class="btn btn-sm btn-secondary"
						data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-sm btn-primary" id="sendParametre">Save changes</button>
				</div>
			</div>

		</div>
	</div>
</div>