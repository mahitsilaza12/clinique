<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="Consultation.xls"');
?>
<table class="table table-bordered" style="text-align:center;font-size:14px;">
    <thead style="padding:3px">
        <tr>
            
            <th>Patient</th>
            <th>Motif de consultation</th>
            <th><?=utf8_decode("Anamnèse")?></th>
            <th>Suspicion</th>
            <th>Examen complementaire</th>
            <th><?= utf8_decode("Décision prise")?></th>
            <th>Date de consultation</th>
        </tr>
    </thead>
    <tbody id="table-consult" style="padding:3px">

        <?php foreach($listeConsult as $consultation)
    {

?>
        <tr>
            <td><?= utf8_decode($consultation->nomPatient)?></td>
            <td><?= utf8_decode($consultation->motif)?></td>
            <td><?= utf8_decode($consultation->anamnese)?></td>
            <td><?= utf8_decode($consultation->suspicion)?></td>
            <td><?= utf8_decode($consultation->examComplem)?></td>
            <td><?= utf8_decode($consultation->decisionDoc)?></td>
            <td><?= utf8_decode($consultation->dateCons)?></td>
        </tr>
        <?php                                }

        ?>

    </tbody>
</table>