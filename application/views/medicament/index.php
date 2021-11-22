<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-size:100% 100%;background-color:rgba(0,0,0,0.2)">
	<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Médicament et Article</h1>
			<div class="progress" style="height: 1px;">
				<div class="progress-bar" role="progressbar" style="width: 48%;background-color: black"
					aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-sm mt-4 btn-primary" data-toggle="modal"
				data-target="#exampleModalScrollable">
				Ajouter un nouveau medicament
			</button>
			<!-- Button trigger modal -->
			<button type="button" class="btn-sm btn btn-dark mt-4" data-toggle="modal" data-target="#modalTrait">
				Ajouter une catégorie
			</button>
		</div>
		<?php if(($this->session->flashdata("message")) != null && !empty($this->session->flashdata("message"))){ ?>
	<!-- Button trigger modal -->
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<?= $this->session->flashdata("message")?>
	</div>
	<?php }?>
	</div>
	
	<?php if(isset($data) && !empty($data)){ ?>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#scrolling">
		Médicament en rupture de stock
	</button>
	<?php }?>
	<?php if(isset($peremption) && !empty($peremption)){ ?>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#scroll">
		Médicament perimé ulterierement
	</button>
	<?php }?>


	<div class="input-group input-group-sm mt-3 mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
		</div>
		<input type="text" class="form-control col-md-2 mr-4" placeholder="Rechercher" aria-label="Rechercher"
			aria-describedby="basic-addon1" id="search-engine">
		<select class="custom-select col-md-4 sm" id="traitement" onchange="getByTraitement(this.value)">
		</select>
		<a href="<?=base_url()?>medicament/listeMed" class="btn btn-success btn-sm ml-4">Exptorter en excel <i
				class="fa fa-download"></i></a>
	</div>

	<div class="liste mt-4"
		style="box-shadow:0 0 10px rgba(100 , 10 , 150 , 0.4);padding:5px;height:480px;overflow-y:scroll">
		<table class="table table-hover table-light" id="liste">
		</table>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-align:center" id="exampleModalScrollableTitle">Nouveau médicament
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-medicament">
					<div class="form-row">
						<div class="col-md-6">
							<label><strong>Libellé :</strong></label>
							<input type="text" class="form-control" name="libelle">
						</div>

						<div class="col-md-6">
							<label><strong>Type :</strong></label>
							<select type="text" class="form-control" name="codeTrait" id="traitements"></select>
						</div>
					</div>
					<div class="form-row mt-4">
						<div class="col-md-4">
							<label><strong>Prix unitaire :</strong></label>
							<input type="number" class="form-control" name="pu" min="0">
						</div>
						<div class="col-md-4">
							<label><strong>Unité :</strong></label>
							<input type="text" placeholder="kg , 100g , cc" class="form-control" name="unite">
						</div>
					</div>
					<div class="form-row mt-4">
						<div class="col-md-4">
							<label><strong>Présentation :</strong></label>
							<input type="text" placeholder="Sachet , flacon" class="form-control" name="presentation">
						</div>
						<div class="col-md-6">
							<label><strong>Conditionnement en gros : </strong>(unité par présentation)</label>
							<input type="number" class="form-control" name="parPresentation" min="1">
						</div>
						<div class="col-md-6">
							<label><strong>Présentation en gros :</strong></label>
							<input type="text" class="form-control" name="presentationGros"
								placeholder="Boîte , sac , plaquette...">
						</div>
						<div class="col-md-6">
							<label><strong>Prix d'achat par présentation :</strong></label>
							<input type="number" min="1" class="form-control" name="prixPresentation">
						</div>
					</div>
					<div class="form-row mt-4">
						<div class="col-md-8">
							<label><strong>Déscription</strong> <small>(avertissement , notice etc)</small> :</label>
							<textarea class="form-control" rows="3" name="description"
								placeholder="Medicament déconseillé aux animaux de moins de 10 kg"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-sm btn-primary" id="saveMed">Enregistrer</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editLabel">Editer ce medicament</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" id="edit-med">
					<div class="form-group">
						<label for="puEdit">Libellé :</label>
						<input type="text" name='newLibelle' class="form-control" id="libNew">
					</div>
					<div class="form-group">
						<label for="puEdit">Prix unitaire :</label>
						<input type="number" name='puEdit' class="form-control" id="puEdit">
					</div>
					<div class="form-group">
						<label for="puEdit">Stock actuel :</label>
						<input type="text" name='qteEdit' class="form-control" id="qteEdit">
					</div>
					<div class="form-group">
						<label for="">Date de péremption :</label>
						<input type="date" name='newDate' class="form-control" id="dateEdit">
					</div>
					<div class="form-group">
						<label for="puPres">Prix d'achat par présentation :</label>
						<input type="number" class="form-control" name="puPres" id="puPres">
					</div>
					<input type="hidden" value='' id="codeMedEdit" name="codeMedEdit">
			</div>
			</form>
			<div class="modal-footer">
				<button type="button" id='close-edit' class="btn btn-sm btn-secondary"
					data-dismiss="modal">Fermer</button>
				<button type="button" id='do-edit' class="btn btn-sm btn-success">Enregistrer</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="scrolling" tabindex="-1" role="dialog" aria-labelledby="scrollingTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollingTitle">Stock</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
					<thead>
						<th>Libellé</th>
						<th>Type</th>
						<th>Stock restant</th>

					</thead>
					<tbody>
						<?php foreach($data as $d): ?>
						<tr>
							<td><?= $d->libelleMed ?></td>
							<td><?= $d->libelleTrait ?></td>
							<td><span class="badge badge-danger"><?= $d->stock." ".$d->unite ?></span></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="scroll" tabindex="-1" role="dialog" aria-labelledby="scrollTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Date de péremption</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
					<thead>
						<th>Libellé</th>
						<th>Type</th>
						<th>Date de péremption</th>

					</thead>
					<tbody>
						<?php foreach($peremption as $d): ?>
						<tr>
							<td><?= $d->libelleMed ?></td>
							<td><?= $d->libelleTrait ?></td>
							<td><span class="badge badge-danger"><?= $d->datePeremption ?></span></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTrait" tabindex="-1" role="dialog" aria-labelledby="modalTraitTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTraitTitle">Catégorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="POST" action='<?= base_url() ?>traitement/store'>
  <div class="form-group">
    <label >Nom de la catégorie</label>
    <input type="text" required class="form-control" name="categorie" aria-describedby="emailHelp">
  </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
		
      </div>
	  </form>
    </div>
  </div>
</div>