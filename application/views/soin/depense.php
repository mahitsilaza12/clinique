<?php
            function splitter($ds)
            {
                $chiffre = '';
                $count = strlen($ds);
                $i = 0;
                    if($count % 3 == 0)
                        do{
                                $chiffre .= substr($ds, $i , 3).".";
                                $count -= 3;
                                $i += 3;
                            }
                            while($count > 0);
                    
                    else if($count % 3 == 2)
                        {
                            $chiffre .= substr($ds, $i , 2).".";
                            $i+= 2;
                            do{
                                $chiffre .= substr($ds, $i , 3).".";
                                $count -= 3;
                                $i += 3;
                            }
                            while($count > 0);
                        }
                    else if($count % 3 == 1)
                        {
                            $chiffre .= substr($ds, $i , 1).".";
                            $i = 1;
                            do{
                                $chiffre .= substr($ds, $i , 3).".";
                                $count -= 3;
                                $i += 3;
                            }
                            while($count > 0);
                                
            }
        echo rtrim($chiffre , ".");
    }

ob_start();

?>
<page>
	<page_footer>
    <hr>
         <p style="text-align: center">Consultation / Diagnostique / Traitement / Vaccination / Chirurgies animales / Transfert d'animaux à l'étranger.<br>
        Coupe et toilettage / Produits, alimentation et accessoires Vétérianires<br>
        Tél : +261 33 64 639 12 / +261 34 04 374 74<br>
        mail : vetboulevard@yahoo.fr fb: cabinet vétérinaire boulevard</p>
<hr>
<p style='text-align: center'>CABINET VETERINAIRE BOULEVARD vous remercie de votre visite.<br><em>Bon rétablissement à votre compagnon.</em></p>

</page_footer>
</page>
<style>
body{
    font-family:Arial;
    background-color:rgba(150,120,130,0.25)
}
</style>
<img src="<?=base_url()?>assets/img/facture.png" alt="" style="margin-right: 100px;height:150px;">
<img style="height:150px;" src="<?=base_url()?>assets/img/log.jpg">

<table style="width:100%;margin-top: 35px;">
	<tr>
			<th style="width:70%;text-align:left">Client : <span style="font-weight: normal"><?=$facture[0]->nomProprio?></span></th>
            
	</tr>
    <tr>
     <th  style="text-align:left"> Code du client : C<span style="font-weight: normal;"><?=$facture[0]->codeProprio?></span></th>   
    </tr>
    <tr>
		<td>Adresse : <?=$facture[0]->adresseProprio?></td>
	</tr>

    <tr>
    <th style="width:80%;text-align:left">Patient : <span style="font-weight: normal;"><?=$facture[0]->nomPatient?></span></th>
    <th style="text-align:right">Date : <span style="font-weight: normal;"><?=$facture[0]->dateSoin?></span></th>
    </tr>

</table>
<table style="width:90%;margin:50px auto 10px auto;height: 400px;border-collapse: collapse;border:1px solid black;text-align: center">
	<tr>
		<td style="font-size:26px;border-bottom:1px solid black;padding-bottom: 10px" colspan="3">FACTURE N°: <?=$facture[0]->numfact?></td>
	</tr>
	<tr>
		<th style="width: 50%;border:1px solid black">Designation</th>
		<th style="width: 50%;border:1px solid black">Prix</th>
        <th style="width: 10%;border:1px solid black">Total</th>
	</tr>
<?php 
$Montant = 0;

    foreach ($facture as $key) { ?>
    
	<tr>
        <td style="border:1px solid black"><?= str_replace("_", " ", $key->rubrique) ?></td>
		<td style="border:1px solid black"><?= splitter($key->prix)?></td>
        <td style="border:1px solid black"><?= splitter($key->prix)?></td>
	</tr>
    <?php

$Montant += $key->prix;
}
$Montant = (int)($Montant);//- (($Montant * $remise) / 100));
    $lettre = new Lettre();
    
?>
	<tr>
        <td style="border:1px solid black"></td>	
		<td style="border:1px solid black"><strong><?php echo (($remise == 0) ? "Net à payer" : "Somme"); ?></strong></td>
		<td style="border:1px solid black"><?=splitter($Montant)?> Ar</td>
	</tr>
    <?php
    

    if($remise != 0){
        $Montant -= ($Montant * $remise) / 100;
    
?>
	<tr>
        <td style="border:1px solid black"></td>	
		<td style="border:1px solid black"><strong>Remise</strong></td>
		<td style="border:1px solid black"><?=splitter($remise)?> %</td>
	</tr>
    <tr>
        <td style="border:1px solid black"></td>	
		<td style="border:1px solid black"><strong>Net à payer</strong></td>
		<td style="border:1px solid black"><?=splitter($Montant)?> Ar</td>
	</tr>


    <?php
    }
    $m = $lettre->nombre($Montant);
    $reste = $lettre->nombre($Montant - $payee);
    $payee = $lettre->nombre($payee);

    ?>
</table>

<div style="margin-top: 25px">Arrêté à la somme de : <strong> ********* <em><?= strtoupper($m)?></em> ********* </strong></div>

<div style="margin-top: 25px">Payée à ce jour: <strong> ********* <em><?= strtoupper($payee)?></em> ********* </strong></div>

<div style="margin-top: 25px">Reste à payer: <strong> ********* <em><?= strtoupper($reste)?></em> ********* </strong></div>

<hr>
		<p style="margin-left:450px;">Le Vétérinaire traitant :<br><br><br><br><br><br><br></p>
    
        
<?php
$content = ob_get_clean();

//Mettre le nom de la facture dynamiquement
$nom = $facture[0]->numfact.".pdf";
try{
	$pdf = new HTML2PDF('P' , '300*600' , 'fr');
	$pdf->pdf->setDisplayMode('fullpage');
	$pdf->writeHTML($content);
	$pdf->Output($nom , "D");
}
catch(HTML2PDF_exception $e){
	die($e);
}
