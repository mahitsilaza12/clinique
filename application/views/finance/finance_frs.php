<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="Finance.xls"');
?>
<table class="table table-bordered table-dark">
			<thead>
				<tr>
					<td style="border:1px solid black;text-align:center">Date limite de payement</td>	
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Numéro de la facture")?></td>
					<td style="border:1px solid black;text-align:center">Fournisseur</td>
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Net à payer")?></td>
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Payée")?></td>
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Reste à payer")?></td>
				</tr>
			</thead>
			<tbody>
				<?php
				$montant = 0;
				$last = 0;
				$total = 0;	
				$payee = 0;
				$reste = 0;		
				foreach($data as $d):
						
						$code = $d->numcom;
						
						$montant += $d->prix;

						if($code == $last)
						{
							$last = $code;	
						}
					else{
						$last = $code;
	
						
				?>
					<tr>
						<td style="border:1px solid black;text-align:center"><?=$d->dateFin?></td>
						<td style="border:1px solid black;text-align:center"><?=$d->codeCom?></td>
						<td style="border:1px solid black;text-align:center"><?=$d->nomFrs?></td>
						<td style="border:1px solid black;text-align:center"><?= splitChiffre($d->net)?> Ar</td>
						<td style="border:1px solid black;text-align:center"><?= splitChiffre($d->payee)?> Ar</td>
						<td style="border:1px solid black;text-align:center"><?=splitChiffre($d->net - $d->payee)?> Ar</td>
						<td style="border:1px solid black;text-align:center"><a href='<?=base_url()?>finance/regler/<?= $d->codeComCli?>'><i class="fa fa-phone"></i></a></td>
					</tr>
				<?php
				$total += $d->net;
				$reste += ($d->net - $d->payee);
				$payee += $d->payee;
					}
			 endforeach; ?>
			</tbody>
		</table>