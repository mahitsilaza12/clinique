<?php

ob_start();

?>


<page>
	<page_footer>
	<hr />
    <h1 style="font-size:13px;">Fait à .................................................... le <?= date('d/m/y')?></h1>
	<hr>
		<p>Signature de l'agent :<br><br><br><br><br><br><br></p>
	</page_footer>
</page>
<table style="width:100%;margin-top: 35px;">
	<tr>
			<th style="width:50%;text-align:left">Client : <span style="font-weight: normal"><?=$facture[0]->nomProprio?></span></th>
            <th style="text-align:right">Ordonnance N° : <?=$facture[0]->numfact?></th>
	</tr>
	
    <tr>
    <th style="text-align:left">Patient : <span style="font-weight: normal;"><?=$facture[0]->nomPatient?></span></th>
    <th style="text-align:right">Date : <span style="font-weight: normal;"><?=$facture[0]->dates?></span></th>
    </tr>

    <tr>
		<td><strong>Adresse</strong> : <?=$facture[0]->adresseProprio?></td>
	</tr>
</table>
<table style="width:750px;margin:50px auto 10px auto;border-collapse: collapse;border:1px solid black;text-align: center">
	<tr>
		<td  style="border-bottom:1px solid black;padding-bottom: 10px" colspan="4"><strong>Déscription :</strong></td>
	</tr>
	<tr>
		<td style="width: 8%;border:1px solid black"><strong>Médicament</strong></td>
		<td style="width: 8%;border:1px solid black"><strong>Traitement</strong></td>
		<td style="width: 10%;border:1px solid black"><strong>Quantité</strong></td>
        <td style="width:3%;border:1px solid black"><strong>Unité</strong></td>        
	</tr>
<?php 
     
    foreach ($facture as $key) { ?>
	<tr>
		<td style="width: 8%;border:1px solid black"><?= $key->libelleMed ?></td>
		<td style="width: 8%;border:1px solid black"><?= $key->libelleTrait?></td>
		<td style="width: 10%;border:1px solid black"><?= $key->qte?></td>
        <td style="width:3%;border:1px solid black"><?= $key->unite?></td>
	</tr>

	 <?php } ?>
	<tr>
		<td style="border:1px solid black">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</td>
		<td style="border:1px solid black"></td>
		<td style="border:1px solid black"></td>
		<td style="border:1px solid black"></td>
	</tr>
   
</table>
<?php
$content = ob_get_clean();

//Mettre le nom de la facture dynamiquement

$nom = "ordonnance.pdf";
try{
	$pdf = new HTML2PDF('P' , 'A4' , 'fr');
	$pdf->pdf->setDisplayMode('fullpage');
	$pdf->writeHTML($content);
	$pdf->Output($nom);
}
catch(HTML2PDF_exception $e){
	die($e);
}
