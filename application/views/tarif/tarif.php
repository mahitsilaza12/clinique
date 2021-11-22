<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="tarif.xls"');
?>
<table>
	<thead>
		<th>Rubrique</th>
		<th><?= utf8_decode("Déscription")?></th>
		<th><?= utf8_decode("Espece concerné")?></th>
		<th>Prix</th>
	</thead>
	<tbody>
<?php    foreach($soin as $reponse){?>
		<tr>
			<td><?=utf8_decode($reponse->rubrique)?></td>
			<td><?=utf8_decode($reponse->description)?></td>
			<td><?=utf8_decode($reponse->libelle_espece)?></td>
			<td><?=utf8_decode($reponse->prix)?> Ar</td>
		</tr>
<?php }?>
	</tbody>
</table>
