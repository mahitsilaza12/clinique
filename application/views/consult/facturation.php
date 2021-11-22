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

//$facture;
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



<table style="width:100%;margin-top: 50px;">
	<tr>
			<th style="width:70%;text-align:left">Client : <span style="font-weight: normal"><?=$facture[0]->nomProprio?></span></th>
            
	</tr>
	<tr>
     <th  style="text-align:left">Code du client : C<span style="font-weight: normal;"><?=$facture[0]->codeProprio?></span></th>   
    </tr>
    <tr>

    <th style="width:70%;text-align:left">Patient : <span style="font-weight: normal;"><?=$facture[0]->nomPatient?></span></th>
    <th style="text-align:right">Date : <span style="font-weight: normal;"><?=$facture[0]->dates?></span></th>
    </tr>

    <tr>
		<td>Adresse : <?=$facture[0]->adresseProprio?></td>
	</tr>
</table>
<table style="margin:50px 0 10px 0;height: 400px;border-collapse: collapse;border:1px solid black;text-align: center">
	<tr>
		<th  style="font-size:26px;width:100%;border-bottom:1px solid black;padding-bottom: 10px" colspan="5">FACTURE N°: <?=$facture[0]->numfact?></th>
	</tr>
	<tr>
		<td style="width: 15%;border:1px solid black">Traitement</td>
		<td style="width: 15%;border:1px solid black">Quantité</td>
        <td style="border:1px solid black">Unité</td>
        <td style="border:1px solid black">Prix unitaire</td>
		<td style="width: 15%;border:1px solid black">Total</td>
	</tr>
<?php 
$Montant = 0;
     
    foreach ($facture as $key) { 
            $t = $key->total;
    $m = ((double)($key->qte));
    $round = round($m);

    if($round != $m) 
        {
            $round += 1;
            $t = $key->puDetail * ($round);
        }

        
    ?>
	<tr>
		<td style="width: 18%;border:1px solid black"><?= $key->libelleTrait?></td>
		<td style="width: 15%;border:1px solid black"><?= $round ?></td>
        <td style="width:5%;border:1px solid black"><?= $key->unite?></td>
        <td style="width:20%;border:1px solid black"><?= ($key->puDetail)?></td>
		<td style="width: 15%;border:1px solid black"><?= (int)($t)?></td>
	</tr>
    <?php

$Montant += $t;
}

foreach ($soinFaite as $soin) {
    if($soin->rubrique == "Hospitalisation"){
        $day = ($day == 0) ? 1 : $day;
?>
    <tr>
        <td colspan="4" style="border:1px solid black"><?= $soin->rubrique." de ".$day." jour(s)";
         ?></td>
        <td style="border:1px solid black"><?php  $soin->prix *= $day; echo $soin->prix ?>Ar</td>
    </tr>
<?php

    }
    else{
?>
    <tr>
        <td colspan="4" style="border:1px solid black"><?= str_replace("_", " ", $soin->rubrique)
         ?></td>
        <td style="border:1px solid black"><?= $soin->prix ?>Ar</td>
    </tr>
<?php
}

$Montant += $soin->prix;
}
    $lettre = new Lettre();
    $m = $lettre->nombre($Montant);


?>
    <tr>

		<td  colspan="4"  style="border:1px solid black">Somme</td>
		<td style="border:1px solid black"><?=(int)($Montant)?> Ar</td>
	</tr>

    <?php if($remise != 0) {?>

<tr>

<td  colspan="4" style="border:1px solid black">Remise</td>
<td style="border:1px solid black"><?=($remise)?> %</td>
</tr>
<?php $Montant -= ($Montant * $remise) / 100; } ?>

<?php 
        $lettre = new Lettre();
        $m = $lettre->nombre($Montant);
        $rap = $Montant - $payee;
        $r = new Lettre();
        $ra = $r->nombre($rap); 
?>
        <tr>
        <td colspan="4" style="border:1px solid black">Net à payer</td>
        <td style="border:1px solid black"><?= (int)($Montant)?> Ar</td>
    </tr>
</table>

<div style="margin-top: 25px">Arrêté à la somme de : <strong> ********* <em><?= strtoupper($m)?></em> ********* </strong></div>
<div style="margin-top: 25px">Payée à ce jour : <strong> ********* <em><?= strtoupper($r->nombre($payee))?></em> ********* </strong></div>
<div style="margin-top: 25px">Reste à payer : <strong> ********* <em><?= strtoupper($ra)?></em> ********* </strong></div>

<hr>
		<p style="margin-left:450px">Le Vétérinaire traitant :<br><br><br><br><br><br><br></p>
        
        
<?php
$content = ob_get_clean();

//Mettre le nom de la facture dynamiquement
$nom = "consultation".$facture[0]->numfact.".pdf";
try{
	$pdf = new HTML2PDF('P' , '300*600' , 'fr');
	$pdf->pdf->setDisplayMode('fullpage');
	$pdf->writeHTML($content);
	$pdf->Output($nom , "D");
}
catch(HTML2PDF_exception $e){
	die($e);
}
