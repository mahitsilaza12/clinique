<?php

ob_start();

?>
<style type="text/css">
    .table td,
  .table th {
    background-color: #fff ;
    text-align: center;
  }
  .table-bordered th,
  .table-bordered td {
    border: 1px solid #ddd ;
  }
}
</style>

<page>

  <page_footer>
    <hr />
    <h1 style="font-size:13px;">Fait à .................................................... le <?= date('d/m/y')?></h1>
  </page_footer>
</page>
<table style="border-collapse:collapse;width:750px;margin:25px auto;" class="table table-bordered">
  <tr>
    <td colspan="4">DEPENSE</td>
  </tr>
  <tr>
        <td style="width:25%">Numéro de la facture :</td>
        <td style="width:25%">Dépense total :</td>
        <td style="width:25%">Patient :</td>
        <td style="width:25%">Date de traitement :</td>
    </tr>
<?php
$chiffre = 0;
  foreach($ca as $row) {
    $chiffre += $row->prix;
?>
    <tr>
        <td><?= $row->numero ?></td>
        <td><?= $row->prix?></td>
        <td><?= $row->nomPatient?></td>
        <td><?= $row->dateTraitement?></td>
    </tr>
<?php
  }
 ?>
</table>

<h3>CHIFFRE D'AFFAIRE : <?= $chiffre?> Ar</h3>
<?php
$content = ob_get_clean();

try{
	$pdf = new HTML2PDF('P' , 'A4' , 'fr');
	$pdf->pdf->setDisplayMode('fullpage');
	$pdf->writeHTML($content);
	$pdf->Output('client.pdf');
}
catch(HTML2PDF_exception $e){
	die($e);
}

 ?>
