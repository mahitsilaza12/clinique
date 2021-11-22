<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">

	<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Tarifs</h1>
			<div class="progress" style="height: 1px;">
				<div class="progress-bar" role="progressbar" style="width: 12%;background-color: black"
					aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-sm mt-4 btn-primary" data-toggle="modal"
				data-target="#exampleModalScrollable">
				Ajouter une nouvelle activité
			</button>
		</div>
	</div>
	<div class="input-group input-group-sm mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
		</div>
		<input type="text" class="form-control col-md-2 mr-4" placeholder="Rechercher" aria-label="Rechercher"
			aria-describedby="basic-addon1" id="search-engine">

	</div>
	<div id="search-result" class="mb-4" style="height:200px;overflow-y:scroll;display:none;">
	</div>

	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header pb-0 pt-0" id="headingOne" style="text-align:center">
				<button class="btn btn-default mb-2 btn-sm" type="button" data-toggle="collapse" data-target="#coll-one"
					aria-expanded="true" aria-controls="coll-one">
					NOS TARIFS POUR LES CLIENTS
				</button>

			</div>
			<div id="coll-one" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body">
					<div class="liste mt-4"
						style="box-shadow:0 0 10px rgba(100 , 10 , 150 , 0.4);padding:5px;height:480px;overflow-y:scroll">
						<table class="table table-hover table-dark" id="liste">
							<thead>
								<th>Rubrique :</th>
								<th>Déscription :</th>
								<th>Espece concerné :</th>
								<th>Type :</th>
								<th>Prix :</th>
								<th></th>
							</thead>
							<tbody id="listening">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Ajouter une activité</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="soin-add" method="POST" action="<?= base_url()?>soin/store">
				
					<div class="form-group">
						<label for="rubrique">Rubrique</label>
						<input type="text" class="form-control" name="rubrique" id="rubrique">
					</div>
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
						<label for="prix">Prix :</label>
						<input type="number" name="prix" min="0" class="form-control" id="prix">
					</div>
					<div class="form-group">
						<select class="form-control" name="type">
							<option>Sélectionner le type de traitement</option>
							<option value="Soin">Soin</option>
							<option value="Traitement">Traitement</option>
							<option value="Vaccination">Vaccination</option>
						</select>
					</div>					
					<div class="form-group">
						<label for="description">Déscription</label>
						<textarea class="form-control" id="description" name="description" rows="3"></textarea>
					</div>
					
					<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-sm btn-success" id="submit">Save changes</button>
			</div>
				</form>
			</div>
			
		</div>
	</div>
</div>


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="soin-edit">
					<div class="form-group">
						<input type='hidden' id='codeSoin' name='codeSoin' value=''>
						<label for="rubrique">Rubrique</label>
						<input type="text" class="form-control" name="rubrique" id="rubrique-edit">
					</div>
					<div class="form-group" id="esp">
					
					</div>
					<div class="form-group">
						<label for="prix">Prix :</label>
						<input type="number" name="prix" min="0" class="form-control" id="prix-edit">
					</div>
					<div class="form-group">
						<label for="description">Déscription</label>
						<textarea class="form-control" id="description-edit" name="description" rows="3"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" id='close-editor'
					data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-sm btn-primary" id='editer_soin'>Modifier</button>
			</div>
		</div>
	</div>
</div>
