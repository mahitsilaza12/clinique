<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="Reapprovisionnement.xls"');
?>

<table class="table">
	<thead>
		<tr>
			<th style="width:20%;color:blue"><?=utf8_decode("Numéro de la facture");?></th>
			<th style="width:20%;color:blue"><?=utf8_decode("Medicament");?></th>
			<th style="width:20%;color:blue"><?=utf8_decode("Quantité");?></th>
			<th style="width:20%;color:blue"><?=utf8_decode("Prix par présentation");?></th>
			<th style="width:20%;color:blue"><?=utf8_decode("Total");?></th>

		</tr>
		</thead>
	<tbody>
		<?php $somme = 0;
		 foreach($liste as $appro){ 
                            $somme += $appro->qte * $appro->prixPresentation;    
                            ?>

		<tr>
			<td style="width:20%"><?= $appro->numcom?></td>
			<td style="width:20%"><?= $appro->libelleMed?></td>
			<td style="width:20%"><?= ($appro->qte." ".$appro->presentation)."(s)"?></td>
			<td style="width:20%"><?= splitChiffre($appro->prixPresentation)."  Ar / ".$appro->presentation?></td>
			<td style="width:20%"><?= splitChiffre($appro->qte * $appro->prixPresentation)?> Ar</td>
		</tr>

		 <?php }?>
		</tbody>
    <table>