<div class="content"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">

	
    <div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header pb-0 pt-0" id="headingOne">

				<h2 class="mb-1" style="text-align:center;">
					<button class="btn" type="button" data-toggle="collapse" data-target="#coll-one"
						aria-expanded="true" aria-controls="coll-one" style="background-color:rgba(10,15,120,0.45)">
						PASSER UNE NOUVELLE CONSULTATION
					</button>
				</h2>
			</div>

			<div id="coll-one" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="background-color:rgba(145 , 125 , 120 , 0.5)">
					
					<form id="patientConsultation" action="<?=base_url()?>consultation/store" method="POST">
					<div class="form-group">
		<label for="task">Qu'est ce-que vous voulez faire :</label>
		<div class="col-4" id="task" style='background-color:rgba(10,120,200,0.12)'>
			
		</div>
	</div>
						<div class="form-group row">
							<label for="Patient" class="col-sm-2 col-form-label">Patient :</label>
							<div class="col-sm-10">
								<select type="text" name="codePatient" class="form-control" id="Patient">

									<select>
										<!-- Button trigger modal -->
										<button type="button" class="btn mt-1 btn-sm btn-secondary" data-toggle="modal"
											data-target="#exampleModalScrollable">
											Nouveau patient
										</button>
							</div>

						</div>
						<div class="form-group row">
							<label for="motif" class="col-sm-2 col-form-label">Motif :</label>
							<div class="col-sm-10">
								<input type="text" name="motif" class="form-control" id="motif">
							</div>
						</div>
						<div class="form-group row">
							<label for="suspicion" class="col-sm-2 col-form-label">Suspicion :</label>
							<div class="col-sm-10">
								<input type="text" name="suspicion" class="form-control" id="suspicion">
							</div>
						</div>
						<div class="form-group row">
							<label for="anamnese" class="col-sm-2 col-form-label">Anamn??se :</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="anamnese" name="anamnese"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="examComplem" class="col-sm-2 col-form-label">Examen compl??mentaire</label>
							<div class="col-sm-10">
								<input type="text" name="examComplem" class="form-control" id="examComplem">
							</div>
						</div>
						<select class="form-control form-control-sm col-md-2" onchange="traiter(this.value)"
							name="codeDecision">
							<option value="1">D??cision ?? prendre</option>
							<option value="2">Hospitalis??</option>
							<option value="3">Rappel??</option>
							<option value="4">Trait??</option>
						</select>
						<div id="rappeler-vaccin" style="display:none">
							<label class='mt-4'>Date du prochain rappel</label>
							<input type='date' name='dateRappel' class='form-control form-control-sm col-2'>
						</div>
						<div id="date-debut" style="display:none">
							<label class='mt-4'>Date de d??but</label>
							<input type='date' name='dateDebut' class='form-control form-control-sm col-2'>
						</div>
						<div id="date-fin" style="display:none">
							<label class='mt-4'>Date de fin d'hospitalisation</label>
							<input type='date' name='dateFin' class='form-control form-control-sm col-2'>
						</div>
						<input type="hidden" name="codeParam" value="" id="fichePatient">
						<div class="form-group row" style="display:none" id="traitement">
							<table class="table table-hover" style="text-align:center;">
								<thead>
									<th>Traitement</th>
									<th>M??dicament</th>
									<th>Dose</th>
								</thead>
								<tbody id="byTraitement" style="height:250px;overflow-y:scroll">
								</tbody>
							</table>
						</div>
						<div class="input-group mb-3" style="text-align:center">

						<div class="modal-footer">
							<button type="button" class="mb-2 mt-2 btn btn-sm btn-outline-dark" data-toggle="modal"
								data-target="#exampleModalCenter">
								Remplir la fiche du patient
							</button>
<span>Remise</span>
<input type="number" name="remise">
							<button type="submit" class="btn btn-sm btn-primary" id="consulter" >CONSULTER</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="facture">
</div>

<!-- Modal -->
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content p-2">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Param??tre</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="background-color:rgba(150,150,20,0.12)">
				<form id="parametreNew">
					<div class="form-group row">
						<label for="freqCard" class="col-sm-0 col-form-label">Fr??quence
							cardiaque :
						</label>
						<div class="col-sm-8">
							<input type="number" min="0" name="freqCard" class="form-control" id="freqCard">
						</div>
					</div>
					<div class="form-group row">
						<label for="freqResp" class="col-sm-0 col-form-label">Fr??quence
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
						<label for="temperature" class="col-sm-0 col-form-label">T??mperature
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


<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
						<label >Nom :</label>
						<input type="text" class="form-control form-control-sm" 
							placeholder="Snoopy" name="nomPatient" required>
					</div>
					<div class="form-group">
						<label for="proprio">Propri??taire :</label>
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
											<label style="font-weight : bold" for="phone">T??l??phone :</label>
											<input type="text" class="form-control " id="phone" required
												placeholder="Num??ro de t??l??phone" name="phone">
										</div>
										<div class="form-group">
											<label style="font-weight : bold" for="email">Email :</label>
											<input type="email" class="form-control " id="email"
												aria-describedby="emailHelp" placeholder="exemple@gmail.com"
												name="email">
											<small id="emailHelp" class="form-text text-muted">Entrer un email
												valide s'il vous
												pla??t.</small>
										</div>
										<label style="font-weight : bold" class="form-check-label">
											Status du client au sein du clinique :
										</label>
										<select class="form-control" required name="status" id="status">
											<option value="Remis??">Remis??</option>
											<option value="Non remis??" selected>Non remis??</option>
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

					<div class="form-group" id="esp">
						
						</div>
						<div class="accordion" id="accordionExample">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-sm btn-secondary" type="button"
												data-toggle="collapse" data-target="#especeCollapse" aria-expanded="true"
												aria-controls="especeCollapse">
												Nouvelle esp??ce
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
							<label >Age : <cite class="small">(mois)</cite></label>
							<input type="number" min="0" class="form-control form-control-sm"
								 placeholder="12" name="age">
						</div>
						<div class="form-group">
							<label >Date de naissance : <cite class="small">(?? laisser
									vide
									si le propri??taire ne se souvient pas de la date exacte )</cite></label>
							<input type="date" class="form-control form-control-sm" 
								placeholder="12" name="dateNais">
						</div>
						<div class="form-group">
							<label >Vari??t?? :</label>
							<select class="form-control form-control-sm" name="variete">
								<option value="g??ant">G??ant</option>
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
									M??le
								</label>
								<select class="form-control form-control-sm" id="selectMale" name="sexe">
									<option value="1">Castr??</option>
									<option value="3">Non castr??</option>
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
									<option value="2">Sterilis??</option>
									<option value="4">Non sterilis??</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label >Couleur :</label>
							<input class="form-control form-control-sm" name="couleur">
						</div>
						<div class="form-group">
							<label for="exampleFormControlFile1">Image associ?? aux patient</label>
							<input type="file" name="file_img" class="form-control-file form-control-sm" id="exampleFormControlFile1">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">D??scription de l'animal</label>
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
</div>
