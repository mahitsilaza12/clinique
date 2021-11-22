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
<h3 style='text-align:center'>Déscription des dépenses :</h3>
<table style="margin:50px auto 10px auto;border-collapse: collapse;border:1px solid black;text-align: center;width:100%">
	<tr>
		<td style="border:1px solid black"><strong>Médicament</strong></td>
		<td style="border:1px solid black"><strong>Traitement</strong></td>
		<td style="border:1px solid black"><strong>Quantité</strong></td>
        <td style="border:1px solid black"><strong>Unité</strong></td>
		<td style="border:1px solid black"><strong>Prix unitaire</strong></td>
	</tr>

<?php
     
    foreach ($fact as $key) {
		
		$Montant = 0;?>
    
	<tr>
		<td style="border:1px solid black"><?= $key->libelleMed ?></td>
		<td style="border:1px solid black"><?= $key->libelleTrait?></td>
		<td style="border:1px solid black"><?= $key->qte?></td>
        <td style="border:1px solid black"><?= $key->unite?></td>
		<td style="width:10%;border:1px solid black"><?=splitter($key->puDetail) ?></td>
	</tr>
    <?php }?>
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
		<td style="border:1px solid black"></td>
	</tr>
	
</table>