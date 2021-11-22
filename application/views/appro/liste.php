<?php

ob_start();

?>
<style>
	/* .table {
		/*width: 100%;
		border-collapse: collapse;
		border: 1px solid black
	}

	.table>thead,
	.table>tbody>td {
		border: 1px solid black
	} */

</style>
<page>
	<page_footer>
		<hr>
		<p>
			Clinique Véterinaire Boulevard<br>
			<small></small>
		</p>

	</page_footer>
</page>

<table class="table">
	<thead>
		<tr>
			<th style="width:20%">Numéro de la facture</th>
			<th style="width:20%">Medicament</th>
			<th style="width:20%">Quantité</th>
			<th style="width:20%">Prix par présentation</th>
			<th style="width:20%">Total</th>

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
						


					</table>


		<?php
$content = ob_get_clean();

//Mettre le nom de la facture dynamiquement
$nom = "Reapprovisionnement_".date("Y-m-j").".pdf";
try{
	$pdf = new HTML2PDF('P' , 'A4' , 'fr');
	$pdf->pdf->setDisplayMode('fullpage');
	$pdf->writeHTML($content);
	$pdf->Output($nom);
}
catch(HTML2PDF_exception $e){
	die($e);
}
