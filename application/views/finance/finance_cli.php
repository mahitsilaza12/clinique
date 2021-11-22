<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="Finance_client.xls"');
?>
<table class="table table-bordered table-dark">
			<thead>
				<tr>
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Numéro de la facture")?></td>
					<td style="border:1px solid black;text-align:center">Client</td>
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Total")?></td>
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Payée")?></td>
					<td style="border:1px solid black;text-align:center"><?= utf8_decode("Reste à payer")?></td>
					<td style="border:1px solid black;text-align:center">Type</td>
				</tr>
			</thead>
			<tbody>
            <?php
		$montant = 0;
		$last = 0;	
		$total = 0;	
		$payee = 0;
		$reste = 0;
				foreach($soin as $d):
						
						$code = $d->numFact;
						
						if($code == $last)
						{
							$last = $code;	
						}
					else{
						$last = $code;
						
				?>
					<tr>
						<td style="border:1px solid black;text-align:center"><?=$d->numFact?></td>
						<td style="border:1px solid black;text-align:center"><?=$d->nomProprio?></td>
						<td style="border:1px solid black;text-align:center"><?= splitChiffre($d->net)?> Ar</td>
						<td style="border:1px solid black;text-align:center"><?=splitChiffre($d->payee)?> Ar</td>
						<td style="border:1px solid black;text-align:center"><?=splitChiffre($d->net - $d->payee)?> Ar</td>
						<td style="border:1px solid black;text-align:center"><?= $d->type?></td>
					</tr>
				<?php
				$total += $d->net;
				$reste += ($d->net - $d->payee);
				$payee += $d->payee;
			}
			 endforeach; ?>
			 <tr>
			 	<td style="border:1px solid black;text-align:center"><?=utf8_decode("Net à payer : ").$total?></td>
			 	<td style="border:1px solid black;text-align:center"><?=utf8_decode("Payée : ").$payee?></td>
			 	<td style="border:1px solid black;text-align:center"><?= utf8_decode("Reste à payer : ").$reste?></td>
			 </tr>
			</tbody>
		</table>