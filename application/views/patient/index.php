<div class="container-fluid slide-content"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;padding:10px;;background-color:rgba(0,0,0,0.2)">
	<h2 class="display-6" style="font-weight:lighter"><em>Dérnier patient enregistré :<em></h2>
	<div class="jumbotron" id="last_patient">

	</div>

	<div class="mt-3">
		<h2 class="display-10" style="font-weight:lighter"><em>Patient(s) enregistré(s)</em> <em><span class="badge pat"
					style="color:rgba(255,20,20,0.5)"></span><em>:
		</h2>
		<div class="input-group input-group-sm mb-3">
			<input type="text" class="form-control col-md-3" placeholder="Rechercher" name="serach-engine"
				aria-describedby="basic-addon1" id="serach-engine" style="text-weight:bold;color:red">

			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i><span
						class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
					<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
					<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></span>
			</div>
			<a href='http://clinique.test/' class='btn btn-info ml-4' style='font-size:12px' data-toggle='modal'
				data-target='#exampleModalLong'>Ajouter un nouveau patient</a>
		</div>
		<div id="search-result" class="mb-6" style="height:200px;overflow-y:scroll;display:none;">
		</div>
	</div>

	<div class="accordion mt-4" id="accordionExample">
		<div class="card-dark">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					<button class="btn btn-sm btn-outline-light" type="button" data-toggle="collapse" data-target="#col"
						aria-expanded="true" aria-controls="col">
						Liste des patients  : </button>
				</h2>
			</div>

			<div id="col" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body">
					<table class="table table-light table-bordered table-hover" style="height:250px;overflow-y:scroll">
						<thead>
							<tr>
								<th style='text-align: center'>Nom</th>
								<th style='text-align: center'>Espece</th>
								<th style='text-align: center'>Date d'enregistrement</th>
								<th>
							</tr>
						</thead>
						<tbody id="liste_patient">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Nouveau patient</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closer">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?=base_url()?>patient/storepatient" method="POST" id="form_patient" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nom :</label>
						<input type="text" class="form-control form-control-sm"




							placeholder="Snoopy" name="nomPatient" required>
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
										<button class="btn btn-sm btn-secondary" type="button" data-toggle="collapse"
											data-target="#coll" aria-expanded="true" aria-controls="coll">
											Ajouter une nouvelle race
										</button>
									</h2>
								</div>

								<div id="coll" class="collapse" aria-labelledby="headingOne"
									data-parent="#accordionExample">
									<div class="card-body"
										style="background-color:rgba(150,120,120,0.75);height:200px;overflow-y:scroll">
										<select class="form-control form-control-sm mb-2" id="newRace" name="newRace" required>
											
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
						<label>Age : <cite class="small">(mois)</cite></label>
						<input type="number" min="0" class="form-control form-control-sm" placeholder="12" name="age">
					</div>
					<div class="form-group">
						<label>Date de naissance : <cite class="small">(à laisser vide si le propriétaire ne se souvient pas de la date exacte )</cite></label>
						<input type="date" class="form-control form-control-sm"	placeholder="12" name="dateNais">
					</div>
					<div class="form-group">
						<label >Variété :</label>
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
							<input class="form-check-input" type="radio" id="femelle" value="option2" name="labe_check">
							<label class="form-check-label" for="femelle">
								Femelle
							</label>
							<select class="form-control form-control-sm" id="selectFemelle"
								style="display:none">
								<option value="2">Sterilisé</option>
								<option value="4">Non sterilisé</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label >Couleur :</label>
						<input class="form-control form-control-sm" name="couleur">
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Image associé aux patient</label>
						<input type="file" id="file" class="form-control-file form-control-sm" name="file_img" id="exampleFormControlFile1">
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Déscription de l'animal</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descript"
							placeholder="Animal aggressif"></textarea>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-outline-success" id="sendPatient">Enregistrer</button>
			</div>
			</form>
		</div>
	</div>
</div>
