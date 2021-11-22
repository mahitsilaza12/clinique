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
    <td colspan="6">LISTE DES CLIENTS</td>
  </tr>
  <tr>
      <th style="width:10%;">Identifiant</th>
      <th style="width:25%">Nom</th>
      <th style="width:23%">Adresse</th>
      <th style="width:15%">Contact</th>
      <th style="width:14%">Status</th>
      <th style="width:13%">Organisation</th>
  </tr>
<?php
  foreach($clients as $value) {
?>
    <tr>
      <td>C<?= $value->codeProprio ?></td>
      <td><?=$value->nomProprio ?></td>
      <td><?=$value->adresseProprio ?></td>
      <td><?=$value->contactProprio?></td>
      <td><?=$value->status ?></td>
      <td><?= $value->organisation?></td>
    </tr>
<?php
  }
 ?>
</table>
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
