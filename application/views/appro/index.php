<div id="commande"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">
	<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Réapprovisionnement </h1>
			<div class="progress" style="height:1px;">
				<div class="progress-bar" role="progressbar" style="width: 43%;background-color: black"
					aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<form action="<?=base_url()?>reapprovisionnement/store" method="POST">
		<div class="form-group">
			<label for="fournisseur">Fournisseur</label>
			<select class="form-control form-control-sm col-4" id="fournisseurs" name='codeFrs'>
			</select><button type="button" class="btn-sm mt-2 mb-4 btn btn-primary" data-toggle="modal"
				data-target="#exampleModal">
				Ajouter un nouveau fournisseur
			</button>
		</div>
		<div class="accordion" id="accordionExample">
			<div class="card">
				<div class="card-header" id="headingOne">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
							aria-expanded="true" aria-controls="collapseOne">
							Article et médicament
						</button>
					</h2>
				</div>

				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
					data-parent="#accordionExample">
					<div class="card-body" style='height:250px;overflow-y:scroll'>
						<table class='table table-hover table-dark'>
							<thead>
								<tr>
									<th>Médicament / Article</th>
									<th>Quantité</th>
									<th>Date de peremption pour ce lot</th>
									<th>Stock actuel</th>
								</tr>
							</thead>
							<tbody id="medoc">
							</tbody>
						</table>
					</div>
					<button type="submit" class="btn mb-2 mt-2 btn-sm btn-secondary">
			S'approvisionner
		</button>
				</div>
			</div>
		
		</div>
		
	</form>
	

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
				<form id="fournisseurses" name="fournisseurs" method="POST" action='<?= base_url() ?>fournisseur/add'>
					<div class="form-group">
						<label for="nom">Nom de l'entreprise</label>
						<input type="text" class="form-control" id="nom" name="nomFrs" placeholder="Companie S.A">
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
