<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

?>
<DIV class="container"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(250,250,250,0.92)">
	<table class='table table-hover'>
		<thead>
			<tr>
				<th style='border:1px solid black'>Facture numéro :</th>
				<th style='border:1px solid black'>Médicament :</th>
				<th style='border:1px solid black'>Quantité :</th>
				<th style='border:1px solid black'>Prix par présentation :</th>
				<th style='border:1px solid black'>Total :</th>
				<th style='border:1px solid black'>Date de commande :</th>
			</tr>
		</thead>
		<tbody>
			<?php
$montant = 0;
foreach($appro as $data){
    $montant += $data->somme;
?>

			<tr>
				<td style='border:1px solid black'><?= $data->numfact?></td>
				<td style='border:1px solid black'><?= $data->libelleMed?></td>
				<td style='border:1px solid black'><?= splitter($data->qte)." ".$data->presentation?></td>
				<td style='border:1px solid black'><?= splitter($data->prixPresentation)?> Ar</td>
				<td style='border:1px solid black'><?=splitter($data->somme)?> Ar</td>
				<td style='border:1px solid black'><?= ($data->dateCom) ?></td>
			</tr>

			<?php
}
?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style='border:1px solid black'>Net à payer :</td>
				<td style='border:1px solid black'><?= splitter($montant)?> Ar</td>


			</tr>
		</tbody>
	</table>
	<form id='form-data' method="POST" action="<?= base_url()?>reapprovisionnement/update/<?= $appro[0]->numfact?>">
    <input type='hidden' name='numfact' value='<?= $appro[0]->numfact?>'>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">A payer maintenant</span>
			</div>
			<input type="number"  name='payee' class="form-control col-4">
		</div>
        <div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Date limite de payement</span>
			</div>
			<input type="date"  name='dateFin' class="form-control col-4">
		</div>
		<button class="btn btn-sm btn-outline-success" type="submit"><i class="fa fa-save"></i> SAUVEGARDER</button>
    </form>
</div>
</DIV>