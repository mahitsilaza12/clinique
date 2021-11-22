<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="Client.xls"');
?>
<table>

<thead>
<tr>
    <th style="border:1px solid black;text-align:center"><?= utf8_decode("Identifiant")?></th>
    <th style="border:1px solid black;text-align:center"><?= utf8_decode("Nom") ?></th>
    <th style="border:1px solid black;text-align:center">Contact</th>
    <th style="border:1px solid black;text-align:center">Email</th>
    <th style="border:1px solid black;text-align:center"><?= utf8_decode("Adresse")?></th>
    <th style="border:1px solid black;text-align:center">Status</th>
    <th style="border:1px solid black;text-align:center">Organisation</th>
</tr>
</thead>
<tbody>
<?php foreach($clients as $m){
    if(!($m->organisation))
    $m->organisation = "";
    ?>
<tr>
                    <td  style="border:1px solid black;text-align:center"><?= $m->codeProprio ?></td>
					<td  style="border:1px solid black;text-align:center"><?= utf8_decode($m->nomProprio) ?></td>
					<td  style="border:1px solid black;text-align:center"><?= utf8_decode($m->contactProprio) ?></td>
					<td  style="border:1px solid black;text-align:center"><?= $m->emailProprio?></td>
                    <td  style="border:1px solid black;text-align:center"><?= utf8_decode($m->adresseProprio)?></td>
					<td  style="border:1px solid black;text-align:center"><?= utf8_decode($m->status)?></td>
					<td  style="border:1px solid black;text-align:center"><?= $m->organisation ?></td>
					</tr>
<?php } ?>
</tbody>
</table>