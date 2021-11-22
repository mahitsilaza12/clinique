<div id="fournisseur"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">
	<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Fournisseur </h1>
			<div class="progress" style="height: 1px;">
				<div class="progress-bar" role="progressbar" style="width: 25%;background-color: black"
					aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn-sm mt-2 mb-4 btn btn-primary" data-toggle="modal"
				data-target="#exampleModal">
				Ajouter un nouveau fournisseur
			</button>
			<div class="accordion" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="mb-0">
							<button class="btn btn-sm mb-4 btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne"
								aria-expanded="true" aria-controls="collapseOne">
								LISTE DES FOURNISSEURS
							</button>
							<div class="input-group mb-3 col-md-4 input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3"><i class="fa fa-search"></i></span>
								</div>
								<input type="text" class="form-control" id="basic-search" placeholder='Recherche'
									aria-describedby="basic-addon3">	
							</div>
						</h2>
						<span id='search-result'></span>
					</div>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
						data-parent="#accordionExample">
						<div class="card-body">
							<div class="content" style='height:400px;overflow-y:scroll'>
								<table class="table table-hover table-dark">
									<thead>
										<tr>
											<th>Nom du fournisseur</th>
											<th>Responsable</th>
											<th>Contact</th>
											<th>Adresse</th>
											<th>Email</th>
											<th></th>
										<tr>
									</thead>
									<tbody id="fournisseur_list">
									</tbody>
								</table>
								<a href="<?=base_url()?>fournisseur/download" class='btn btn-sm btn-outline-success m-2'>EXPORTER <i class="fa fa-download"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>

</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style='background-color:rgba(120,120,120,0.5)'>
					<h5 class="modal-title" id="exampleModalLabel">Fournisseur</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style='background-color:rgba(120,120,220,0.2)'>
					<form id="fournisseurs" name="fournisseurs" method="POST" action='<?= base_url() ?>fournisseur/add'>
						<div class="form-group">
							<label for="nom">Nom de l'entreprise</label>
							<input type="text" class="form-control" id="nom" name="nomFrs" placeholder="">
						</div>
						<div class="form-group">
							<label for="responsable">Responsable</label>
							<input type="text" class="form-control" id="responsable" name="responsable" placeholder="">
						</div>
						<div class="form-group">
							<label for="contact">Contact</label>
							<input type="text" class="form-control" id="contact" name="contact_frs"
								placeholder="0346845216">
						</div>
						<div class="form-group">
							<label for="adresse">Adresse</label>
							<input type="text" class="form-control" id="adresse" name="adresse_frs" placeholder="">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email_frs"
								placeholder="name@example.com">
						</div>

					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" id='clore' data-dismiss="modal">Annuler</button>
					<button type="submit" id="send" class="btn btn-sm btn-primary">Sauvegarder <div
							class="spinner-border spinner-border-sm" id="spinner" role="status" style='visibility:hidden'>
							<span class="sr-only">Loading...</span>
						</div></button>
				</div>
			</div>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="editFournisseur" tabindex="-1" role="dialog" aria-labelledby="editFournisseurLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editFournisseurLabel">Editer un fournisseur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style='background-color:rgba(120,120,220,0.2)'>
				<form method="POST" id="form-edit" action='<?= base_url()?>fournisseur/update'>
				<input type='hidden' id='codeFrs' name='codeFrs'>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Nom du fournisseur</span>
						</div>
						<input type="text" class="form-control" id='nomFrs' placeholder="Nom de la société"
							aria-label="Username" aria-describedby="basic-addon1" name="nomFrs">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Responsable</span>
						</div>
						<input type="text" class="form-control" id='responsable_frs' aria-label="Username"
							aria-describedby="basic-addon1" name="responsable">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Contact</span>
						</div>
						<input type="text" class="form-control" id='contact_frs' aria-label="Username"
							aria-describedby="basic-addon1" name="contact_frs">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Adresse</span>
						</div>
						<input type="text" class="form-control" id='adresse_frs' aria-label="Username"
							aria-describedby="basic-addon1" name="adresse_frs">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Email</span>
						</div>
						<input type="text" class="form-control" id='email_frs' aria-label="Username"
							aria-describedby="basic-addon1" name="email_frs">
					</div>
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" id='closure' data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-sm btn-primary" id="editThisFrs">Modifier</button>
			</div>
		</div>
	</div>
</div>
