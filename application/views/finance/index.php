<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">

	<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Finance</h1>
			<div class="progress" style="height: 1px;">
				<div class="progress-bar" role="progressbar" style="width: 18%;background-color: black"
					aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	<div class="content">
		<div style="height:450px;overflow-y:scroll">
			<h3 class="">Côté fournisseur :</h3>

			<table class="table table-bordered table-dark">

				<thead>
					<tr>
						<td style="text-align:center">Date limite de payement</td>
						<td style="text-align:center">Numéro de la facture</td>
						<td style="text-align:center">Fournisseur</td>
						<td style="text-align:center">Net à payer</td>
						<td style="text-align:center">Payée</td>
						<td style="text-align:center">Reste à payer</td>
						<td style="text-align:center">Régler</td>
					</tr>
				</thead>
				<tbody>
					<?php
				$montant = 0;
				$paye = 0;
				$last = 0;		
				foreach($data as $d):
						
						$code = $d->numcom;
						$paye += $d->payee;
						$montant += $d->net;

					// 	if($code == $last)
					// 	{
					// 		$last = $code;	
					// 	}
					// else{
					// 	$last = $code;
	
						
				?>
					<tr>
						<td style="text-align:center"><?=$d->dateFin?></td>
						<td style="text-align:center"><?=$d->codeCom?></td>
						<td style="text-align:center"><?=$d->nomFrs?></td>
						<td style="text-align:center"><?= splitChiffre($d->net)?> Ar</td>
						<td style="text-align:center"><?= splitChiffre($d->payee)?> Ar</td>
						<td style="text-align:center"><?=splitChiffre($d->net - $d->payee)?> Ar</td>
						<?php if($d->net - $d->payee != 0)   {
					?>
						<td style="text-align:center"><a href='<?=base_url()?>finance/regler/<?= $d->codeComCli?>'><i
									class="fa fa-phone"></i></a></td>
						<?php }
						else{ ?>
						<td style="text-align:center"><i class='fa fa-phone'></i></td>
						<?php }?>

					</tr>
					<?php
				
					//}
			 endforeach; ?>
				</tbody>
			</table>
			<?php if(!empty($data)){?>
			<a href="<?=base_url()?>finance/download/fournisseur" class='btn btn-sm btn-success m-2'>EXPORTER <i
					class="fa fa-download"></i></a><br>
			<strong>TOTAL DES DEPENSES : <?= splitChiffre($montant)?> Ar</strong><br>
			<strong>TOTAL DES RESTES A PAYER : <?= splitChiffre($montant - $paye)?> Ar</strong>
		<?php } ?>
		</div>
		<h3 class="">Côté client :</h3>
		<form action="<?= base_url()?>finance/" method="post">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="submit">COMPARER</button>
							</div>
							<input type="date" class="form-control form-control-sm col-2" name="date1"
								aria-label="Username" aria-describedby="basic-addon1">
							<input type="date" class="form-control form-control-sm col-2" name="date2"
								aria-label="Username" aria-describedby="basic-addon1">
							<div class="input-group-prepend">
								<a class='ml-2' href="<?= base_url()?>finance"><i class="fa fa-sync"></i></a>
							</div>

						</div>

			</form>
		<div style="height:400px;overflow-y:scroll">
		
			<table class="table table-bordered table-dark">
				<thead>
					<tr>
						<td style="text-align:center">Numéro de la facture</td>
						<td style="text-align:center">Client</td>
						<td style="text-align:center">Total</td>
						<td style="text-align:center">Payée</td>
						<td style="text-align:center">Reste à payer</td>
						<td style="text-align:center">Type</td>
						<td style="text-align:center">Date de payement</td>
						<td style="text-align:center">Régler</td>
						<td style="text-align:center">Regénerer la facture</td>
					</tr>
				</thead>
				<tbody>
					<?php
		
		$last = 0;
		$montant = 0;
		$paye = 0;	
				foreach($soin as $d):
						$montant += $d->net;
						$paye += $d->payee;
						$code = $d->numFact;
						
						if($code == $last)
						{
							$last = $code;	
						}
					else{
						$last = $code;
						
				?>
					<tr>
						<td style="text-align:center"><?=$d->numFact?></td>
						<td style="text-align:center"><?=$d->nomProprio?></td>
						<td style="text-align:center"><?= splitChiffre($d->net)?> Ar</td>
						<td style="text-align:center"><?=splitChiffre($d->payee)?> Ar</td>
						<td style="text-align:center"><?=splitChiffre($d->net - $d->payee)?> Ar</td>
						<td style="text-align:center"><?= $d->type?></td>
						<td style="text-align:center"><?= $d->date?></td>
						<?php if($d->net - $d->payee != 0)   {
					?> <td style="text-align:center"><a href='<?=base_url()?>finance/regler_cli/<?= $d->codeComCli?>'><i
									class="fa fa-phone"></i></a></td>
						<?php }
						else{ ?>
						<td style="text-align:center"><i class='fa fa-phone'></i></td>
						<?php }
						
						?>
						<td style="text-align:center"><a href='<?= base_url().$d->url ?>'><i class='fa fa-upload'></i></a></td>
					</tr>
					<?php
			}
			 endforeach; ?>
				</tbody>
			</table>
			
		</div>
		<?php if(!empty($soin) && $date1){?>
			<a href="<?=base_url()?>finance/download/proprio/<?=$date1.'/'.$date2?>" class='btn btn-sm btn-success m-2'>EXPORTER <i
					class="fa fa-download"></i></a><br>
			<strong>TOTAL DES RECETTES : <?= splitChiffre($montant)?> Ar</strong><br>
			<strong>TOTAL DES RESTES A PAYER : <?= splitChiffre($montant - $paye)?> Ar</strong>

			<?php }
		 else{
					?>
			<a href="<?=base_url()?>finance/download/proprio/" class='btn btn-sm btn-success m-2'>EXPORTER <i
					class="fa fa-download"></i></a><br>
			<strong>TOTAL DES RECETTES : <?= splitChiffre($montant)?> Ar</strong><br>
			<strong>TOTAL DES RESTES A PAYER : <?= splitChiffre($montant - $paye)?> Ar</strong>

			<?php }?>
		
	</div>
</div>
