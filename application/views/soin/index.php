<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">

	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header pb-0 pt-0" id="headingOne" style="text-align:center">
				<button class="btn btn-default mb-2 btn-sm" type="button" data-toggle="collapse"
					data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					SOIN POUR UN PATIENT
				</button>

			</div>

			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="background-color:rgba(144,120,150,0.45)">
					<form id="soin_passe" action="<?= base_url()?>soin/soigner" method="POST">
						<div class="form-group row">
							<label for="Patient" class="col-sm-2 col-form-label">Patient :</label>
							<div class="col-sm-10">
								<select type="text" name="codePatient" class="form-control" id="Patient">

									</select>
										<!-- Button trigger modal -->
										<button type="button" class="btn mt-1 btn-sm btn-secondary" data-toggle="modal"
											data-target="#newPatient">
											Nouveau patient
										</button>
							</div>
						</div>
						Soin à faire :

						<div class="form-group" id="traitement">
							<table class="table table-hover" style="text-align:center;">
								<thead>
									<th>Traitement</th>
									<th>Médicament</th>
								</thead>
								<tbody id="byTraitement" style="height:250px;overflow-y:scroll">
								</tbody>
							</table>
						</div>
						<div class="contenu">
							<div id="checkBoxes"
								style="display:inline-block;height:200px;overflow-y:scroll;border:0.5px dashed black;padding:5px;"
								class="w-50 mb-4"></div>
						
							<div id="produit-utiliser"
								style="display:inline-block;height:200px;overflow-y:scroll;border:0.5px dashed black;padding:5px;"
								class="w-40 mb-4"></div>
						</div>
						<div class="form-group" style="display:none" id="traitement">
							<table class="table table-hover" style="text-align:center;">
								<thead>
									<th>Traitement</th>
									<th>Médicament</th>
									<th>Dose</th>
								</thead>
								<tbody id="byTraitement" style="height:250px;overflow-y:scroll">
								</tbody>
							</table>
						</div>
						Rémise :<input type="text" class="form-control col-2 mb-2 mt-2  form-control-sm" name="remise">
						<button type="submit" class="btn btn-sm btn-outline-info" id="soigner">SOIN POUR LE
							PATIENT</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='facture-soin' style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(255,255,255,0.72)">
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
				<form id="form_patient" enctype="multipart/form-data">
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
					<div class="form-group" id="esp">
					</div>
						<div class="accordion" id="accord">
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
										data-parent="#accord">
										<div class="card-body"
											style="background-color:rgba(150,120,120,0.75);">
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
											<select class="form-control form-control-sm mb-2" id="newRace"	name="newRace" required>
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
							<input type="file" name="file_img" class="form-control-file form-control-sm" id="exampleFormControlFile1">
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
