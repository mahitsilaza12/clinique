<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="Medicament.xls"');
?>
<table>

<thead>
<tr>
    <th><?= utf8_decode("Libellé")?></th>
    <th><?= utf8_decode("Unité") ?></th>
    <th><?= utf8_decode("Présentation")?></th>
    <th>Type</th>
    <th><?=utf8_decode("Prix unitaire") ?></th>
    <th>Stock</th>
    <th>Date de peremption</th>
</tr>
</thead>
<tbody>
<?php foreach($med as $m){
    
    ?>
<tr>
                    <td><?= utf8_decode($m->libelleMed) ?></td>
					<td><?= utf8_decode($m->unite) ?></td>
					<td><?= $m->parPresentation." ".utf8_decode($m->unite)." = ".$m->presentation ?></td>
					<td><?= utf8_decode($m->libelleTrait)?></td>
                    <td><?= $m->puDetail?>Ar</td>
                    
					<td><?= $m->stock." ".utf8_decode($m->unite)?></td>
					<td><?= $m->datePeremption ?></td>
					</tr>
<?php } ?>
</tbody>
</table>