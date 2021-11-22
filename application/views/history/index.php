<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">




	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#colla"
						aria-expanded="true" aria-controls="colla">
						Historique des approvisionnements
					</button>
				</h2>
			</div>

			<div id="colla" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="height:500px;overflow-y:scroll">
					<form action="<?= base_url()?>history/" method="post">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="submit">COMPARER</button>
							</div>
							<input type="date" class="form-control form-control-sm col-2" name="date1"
								aria-label="Username" aria-describedby="basic-addon1">
							<input type="date" class="form-control form-control-sm col-2" name="date2"
								aria-label="Username" aria-describedby="basic-addon1">
							<div class="input-group-prepend">
								<a class='ml-2' href="<?= base_url()?>history"><i class="fa fa-sync"></i></a>
							</div>

						</div>

					</form>
					<?php if(isset($liste)):?>
					<table class="table table-hover" id="test">
						<thead>
							<tr>
								<th>Numéro de la facture</th>
								<th>Medicament</th>
								<th>Quantité</th>
								<th>Prix par présentation</th>
								<th>Total</th>
								<th>Nom du fournisseur</th>

							</tr>
						<tbody>
							<?php $somme = 0; foreach($liste as $appro): 
                            $somme += $appro->qte * $appro->prixPresentation;    
                            ?>

							<tr>
								<td><?= $appro->numcom?></td>
								<td><?= $appro->libelleMed?></td>
								<td> + <?= ($appro->qte." ".$appro->presentation)."(s)"?></td>
								<td><?= splitChiffre($appro->prixPresentation)."  Ar / ".$appro->presentation?></td>
								<td><?= splitChiffre($appro->qte * $appro->prixPresentation)?> Ar</td>
								<td><?=$appro->nomFrs?></td>
							</tr>

							<?php endforeach;?>

						</tbody>
						</thead>


					</table>
					<hr>
					Somme total depensé : <span style='color:blue'><?=splitChiffre($somme)?> Ar</span>
					<?php endif;
                    ?>
				</div>

				<?php if($date1){ ?>
					<a href="<?= base_url()?>reapprovisionnement/liste/<?=$date1.'/'.$date2?>" class="m-2 btn btn-sm btn-outline-success">Exporter
					en excel <i class="fa fa-download"></i></a>

				<?php }else{ ?>
					<a href="<?= base_url()?>reapprovisionnement/liste" class="m-2 btn btn-sm btn-outline-success">Exporter
					en excel <i class="fa fa-download"></i></a>
				<?php } ?>
			</div>
			<div class="card">
				<div class="card-header" id="headingOne">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsed"
							aria-expanded="true" aria-controls="colla">
							Historique des consultations
						</button>
					</h2>
				</div>

				<div id="collapsed" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<div style="height:300px;overflow-y:scroll">
							<?php		if(isset($listeConsult) && !empty($listeConsult)){
                                ?>

							<table class="table table-bordered" style="text-align:center;font-size:14px;" id="test2">
								<thead style="padding:3px">
									<tr>

										<th>Patient</th>
										<th>Motif de consultation</th>
										<th>Anamnèse</th>
										<th>Suspicion</th>
										<th>Examen complementaire</th>
										<th>Décision prise</th>
										<th>Date de consultation</th>
									</tr>
								</thead>
								<tbody id="table-consult" style="padding:3px">

									<?php foreach($listeConsult as $consultation)
                                {

?>
									<tr>
										<td><a
												href='<?= base_url()?>patient/profil/<?=$consultation->codePatient?>'><?= $consultation->nomPatient?></a>
										</td>
										<td><?= $consultation->motif?></td>
										<td><?= $consultation->anamnese?></td>
										<td><?= $consultation->suspicion?></td>
										<td><?= $consultation->examComplem?></td>
										<td><?= $consultation->decisionDoc?></td>
										<td><?= $consultation->dateCons?></td>
									</tr>
									<?php                                }

									?>

								</tbody>
							</table>

							<a href="<?= base_url()?>consultation/download"
								class="m-2 btn btn-sm btn-outline-success">Exporter
								en excel <i class="fa fa-download"></i></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
