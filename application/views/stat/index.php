<style>
	#proprietaire .card-body {
		display: inline-block;
		width: 35rem;margin:5px;height:30rem;padding:0rem;
	}

	#proprietaire .card
{
	width:38.5em;height: auto;display: inline-block;
	margin:0.4em;
	overflow-y:scroll;
}

</style>
<div id="proprietaire" style="box-shadow:0 0 30px rgba(0,0,0,0.9);background-color:rgba(0,0,0,0.3512);margin-top:20px;padding:10px">
	<div class="card">
		<div class="card-body" style="text-align:center">
			<h3 class="card-title" style='text-align:center;color:rgb(150,20,20)'><em>Tarif</em></h3>
			<p class="card-text">Augmenter ou dimunier les tarifs.
				<div class="input-group mb-3" style="text-align:center">

					<input type="number" class="form-control" id="taux">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">%</span>
					</div>
				</div>
				<button class="btn btn-sm btn-outline-warning mb-2" data-toggle="modal"
					data-target="#exampleModal">MODIFIER
					TOUT <i class="fa fa-death"></i></button>
				
			</p>
			
			<!-- <p class="card-text">Réduction pour les membres d'une association oeuvrant pour les animaux.
				
				<form action="<?= base_url()?>finance/remiser" method="POST" id="taux_remise">
				<div class="input-group mb-3" style="text-align:center">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addonRemise"></span>
					</div>
					<input type="number" class="form-control" name="remise">
				</div>
				<button class="btn btn-sm btn-outline-danger mb-2" id="modifier_taux" >MODIFIER<i class="fa fa-death"></i></button>
				</form>
			</p> -->
			<div>
					<a href="<?= base_url()?>soin/" class="btn btn-sm btn-primary">Les tarifs
						chez nous</a>
				</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h3 class="card-title" style="text-align:center;color:rgb(150,20,20)">Statistique des enregistrements de
				patient
			</h3>
			<p class="card-text">Comparer les <strong><em>entrées</em></strong> de patient au sein de la clinique
				<div class="input-group mb-3">
					<select id='annee1' class="form-control form-control-sm col-6 mr-2">
						<option>Choisir une option</option>
						<option value='<?= date("Y") ?>'>Cette année</option>
						<option value='<?= date("Y") - 1 ?>'>L'année dernière</option>
						<option value='<?= date("Y") - 2?>'>Les deux années précedentes</option>
					</select>
					<select id='annee2' class="form-control form-control-sm col-6">
						<option>Choisir une option</option>
						<option value='<?= date("Y") ?>'>Cette année</option>
						<option value='<?= date("Y") - 1 ?>'>L'année dernière</option>
						<option value='<?= date("Y") - 2?>'>Les deux années précedentes</option>
					</select>
					<div class="input-group-prepend">
						<span class="input-group-text" style='cursor:pointer' id="compare"><i
								class="fas fa-search"></i></span>
					</div>
					<div class="input-group mt-4">
						<div class="input-group-prepend">
							<span class="input-group-text" style='cursor:pointer' id='text-comparer'>Année à
								comparer</span>
						</div>
						<input type="number" id="first" class="form-control">
						<input type="number" id="second" class="form-control">
					</div>
				</div>
				<table class='table table-hover'>
					<thead style='text-align:center'>
						<th colspan=2>Tableau comparatif des entrées</th>
					</thead>
					<tbody style='text-align:center'>

						<tr>
							<td id='year1'></td>
							<td id='year2'></td>
						</tr>
						<tr>
							<td id='years1'></td>
							<td id='years2'></td>
						</tr>
					</tbody>
				</table>
			</p>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h3 class="card-title" style="text-align:center">Comparaison par mois des patient enregistrés</h3>
			<p>Cette statistique montre en quelle mois la clinique enregistre plus/moins de patient.</p>
			<div>
				<canvas id="chart1"></canvas>
			</div>
			<a href="<?= base_url()?>patient" class="btn btn-primary btn-sm">Liste des patients</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h3 class="card-title" style="text-align:center">Consultation par mois</h3>
			<div class="input-group mb-3">
				<div class="input-group mt-4">
					<div class="input-group-prepend">
					<span class="input-group-text" style='cursor:pointer' id="getStat"><i
							class="fas fa-book-open"></i></span>
				</div>
					<select onchange='statMonthConsult(this.value)' class="form-control form-control-sm col-6">
					<option>Choisir une option</option>
					<option value='<?= date("Y") ?>'>Cette année</option>
					<option value='<?= date("Y") - 1 ?>'>L'année dernière</option>
					<option value='<?= date("Y") - 2?>'>Les deux années précedentes</option>
				</select>
					<input type="number" id="yearStatConsult" class="form-control form-control-sm">
				</div>
			</div>
			<div>
				<canvas id="chart2"></canvas>
			</div>
			<a href="<?= base_url()?>consultation" class="btn btn-primary btn-sm">Liste des consultations</a>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<h3 class="card-title" style="text-align:center">Répartition par jour des consultations	</h3>
			<div>
				<canvas id="chart3"></canvas>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h3 class="card-title" style="text-align:center">Répartition par espèce des patients</h3>
			<div>
				<canvas id="chart8"></canvas>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<h3 class="card-title" style="text-align:center">Répartition par jour des soins</h3>
			<div>
				<canvas id="chart4"></canvas>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h3 class="card-title" style="text-align:center;">Entrée / Sortie</h3>
			<div>
			<div class="input-group mb-3">
				<div class="input-group mt-4">
					<div class="input-group-prepend">
					<span class="input-group-text" style='cursor:pointer' id="statusStat"><i
							class="fas fa-book-open"></i></span>
				</div>
					<select onchange='echange(this.value)' class="form-control form-control-sm col-6">
					<option>Choisir une option</option>
					<option value='<?= date("Y") ?>'>Cette année</option>
					<option value='<?= date("Y") - 1 ?>'>L'année dernière</option>
					<option value='<?= date("Y") - 2?>'>Les deux années précedentes</option>
				</select>
					<input type="number" id="yearExchange" class="form-control form-control-sm">
				</div>
			</div>
			<div>
				<canvas id="chart6"></canvas>
			</div>
			<div>
				<canvas id="chart7"></canvas>
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
				<h5 class="modal-title" id="exampleModalLabel">Avertissement</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="background-color:rgba(150,10,10,0.2)">
				En acceptant, vous allez modifier tous les prix concernant nos soins et nos consultations. Vous pouvez
				les
				modifier une à une dans la section soin.
			</div>
			<div class="modal-footer">
				<button type="button" id="close_change" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" id='changer'>Accepter</button>
			</div>
		</div>
	</div>
</div>
