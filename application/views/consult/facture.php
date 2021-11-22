<?php
    if(!isset($donnee))
    {
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
<style>
.facture{
    font-family:Arial;
    background-color:rgba(150,120,130,0.25)
}
</style>
<div class="facture">
<table style="width:100%;margin-top: 35px;">
    <tr>
            <th style="width:50%;text-align:left">Client : <span style="font-weight: normal"><?=$facture[0]->nomProprio?></span></th>
            <th style="text-align:right">Facture N° : <?=$facture[0]->numfact?></th>
    </tr>
       <tr>
     <th  style="text-align:left"> Code du client : <span style="font-weight: normal;"><?=$facture[0]->codeProprio?></span></th>   
    </tr>
    <tr>

    <th style="text-align:left">Patient : <span style="font-weight: normal;"><?=$facture[0]->nomPatient?></span></th>
    <th style="text-align:right">Date : <span style="font-weight: normal;"><?=$facture[0]->dates?></span></th>
    </tr>

    <tr>
        <td><strong>Adresse</strong> : <?=$facture[0]->adresseProprio?></td>
    </tr>

</table>
<table style="margin:50px auto 10px auto;height: 400px;border-collapse: collapse;text-align: center">
    <tr>
        <td  style="border-bottom:1px solid black;padding-bottom: 10px" colspan="5"><strong>Déscription :</strong></td>
    </tr>
    <tr>
        <td style="width: 25%;border:1px solid black"><strong>Traitement</strong></td>
        <td style="width: 15%;border:1px solid black"><strong>Quantité</strong></td>
        <td style="border:1px solid black"><strong>Unité</strong></td>
        <td style="border:1px solid black"><strong>Prix unitaire</strong></td>
        <td style="width: 15%;border:1px solid black"><strong>Total</strong></td>
    </tr>
<?php 


$Montant = 0;
     
    foreach ($facture as $key) {
    
    $t = $key->total;
    $m = ((double)($key->qte));
    $round = round($m);

    if($round != $m) 
        {
            $n = $round - $m;
            switch ($n) {
                case $n < 0:
            $round += 1;
            $t = $key->puDetail * ($round);
                    break;
                
                case $n > 0:
            $t = $key->puDetail * ($round);
                    break;
            }

        }
        
    ?>
    
    <tr>
        <td style="width: 23%;border:1px solid black"><?= $key->libelleTrait?></td>
        <td style="width: 15%;border:1px solid black"><?= ($round)?></td>
        <td style="width:3%;border:1px solid black"><?= $key->unite?></td>
        <td style="width:10%;border:1px solid black"><?= ($key->puDetail)?></td>
        <td style="width: 15%;border:1px solid black"><?= ($t)?></td>
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
        <td style="border:1px solid black"><?=(int) ($Montant)?> Ar</td>
    </tr>
    <?php if($remise != 0) {?>

        <tr>

<td  colspan="4" style="border:1px solid black">Remise</td>
<td style="border:1px solid black"><?=($remise)?> %</td>
</tr>
<?php $Montant -= ($Montant * $remise) / 100; ?>
<tr>

<td  colspan="4" style="border:1px solid black">Net à payer</td>
<td style="border:1px solid black"><?=($Montant)?> Ar</td>
</tr>
    <?php } ?>
</table>

<form method="POST" action="<?= base_url()?>consultation/facture/<?= $facture[0]->numfact?>">
<input type="hidden" name="net" value="<?= $Montant ?>">

<input type="hidden" name="remise" value="<?= $remise?>">
<?php 
if($day)
{
    ?>
    <input type="hidden" name="day" value="<?= $day?>">
    <?php
}
?>
<input type="hidden" name="codeProprio" value="<?= $codeProprio?>">
<div class="input-group mb-3" style="text-align:center">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">A payer maintenant</span>
                    </div>
                    <input type="number" class="form-control" name="payee">
                </div>

<button type="submit" class='btn btn-sm btn-secondary' id='chez-nous'>Facturer chez nous <i class="fa fa-book"></i></button>
</form>



</div>
<?php
}


else{

?>

<div style='text-align: center'>
    <span>Veuillez facturer au moins un médicament pour pouvoir insérer une consultation.</span> 
</div>



<?php

}


?>