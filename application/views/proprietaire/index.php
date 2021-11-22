<div id="proprietaire" style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;padding:10px;background-color:rgba(0,0,0,0.2)">
<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Client </h1>
			<div class="progress" style="height: 1px;">
				<div class="progress-bar" role="progressbar" style="width: 15%;background-color: black"
					aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<div style="background-color:white;height:300px;overflow-y:scroll">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nom du proprietaire : </th>
					<th>Adresse :</th>
					<th>Contact :</th>
					<th>Email :</th>
					<th>Status :</th>
					<th>Organisation :</th>

				</tr>
			</thead>
			<tbody id="tbody">
			</tbody>
		</table>
		
		<div>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="text-align:justify">
							En acceptant de supprimer ce proprietaire, vous allez également supprimer avec lui tous ses
							patients.<br>
							Voulez-vous continuer ?
						</div>
						<input type="hidden" id="hide_delete">
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"
								id="close">ANNULER</button>
							<button type="button" class="btn btn-sm btn-primary" id="delete_proprio">CONTINUER <div
									id="spin" style="display:none">
									<div class="spinner-border spinner-border-sm" role="status">
										<span class="sr-only">Loading...</span>
									</div>
								</div></button>
								
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="input-group input-group-sm mt-3">
		<input type="text" class="form-control col-md-3" placeholder="Rechercher" name="serach-engine"
			aria-describedby="basic-addon1" id="serach-engine" style="text-weight:bold;color:red">

		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i><span
					class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
				<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
				<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></span>
		</div>
		<button type="button" class="btn btn-sm btn-primary ml-4" data-toggle="modal" data-target="#addPatient">
			Ajouter un nouveau client
		</button>
		<a class="ml-2 btn btn-sm btn-outline-dark" href="<?= base_url()?>proprietaire/export/pdf">Exporter en pdf <i class="fa fa-download"></i></a>
		<a class="ml-2 btn btn-sm btn-outline-success" href="<?= base_url()?>proprietaire/export/excel">Exporter en excel <i class="fa fa-download"></i></a>
	</div>
</div>
<div id="search-result" class="mb-6" style="height:200px;overflow-y:scroll;display:none;">
</div>

<!-- Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="addPatientLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addPatientLabel">Ajout de nouvel client : </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_proprio" style="text-align:center">
					<div class="form-group">
						<label style="font-weight : bold" for="nom">Nom du client :</label>
						<input type="text" class="form-control " id="nom" required placeholder="Nom du client"
							name="nom">
					</div>
					<div class="form-group">
						<label style="font-weight : bold" for="adresse">Adresse :</label>
						<input type="text" class="form-control " required id="adresse"
							placeholder="Lot PK 101 Ivato Antananarivo 101" name="adresse">
					</div>
					<div class="form-group">
						<label style="font-weight : bold" for="phone">Téléphone :</label>
						<input type="text" class="form-control " id="phone" required placeholder="Numéro de téléphone"
							name="phone">
					</div>
					<div class="form-group">
						<label style="font-weight : bold" for="email">Email :</label>
						<input type="email" class="form-control " id="email" aria-describedby="emailHelp"
							placeholder="exemple@gmail.com" name="email">
						<small id="emailHelp" class="form-text text-muted">Entrer un email valide s'il vous
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
						<input type="text" class="form-control " name="organisation" id="organisation"
							placeholder="Organisation oeuvrant pour les animaux">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="closer">Close</button>
				<button type="button" id="sendClient" class="btn btn-success btn-sm col-md-3">Save changes</button>
			</div>
		</div>
	</div>
</div>
