<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">
<table class="table table-hover">
<thead>
<th>Net à payer</th>
<th>Reste</th>
</thead>
<tbody>
<?php foreach ($facture as $d) {?>

<tr>
<td><?= splitChiffre($d->net)?> Ar</td>
<td style='color:red'><?= splitChiffre($d->net - $d->payee)?> Ar</td>
</tr>
<?php
}
?>
</tbody>

</table>

<form method="POST" action="<?= base_url()?>finance/reglement_cli/<?= $facture[0]->codeComCli?>">
<label class="form-check-label" for="exampleCheck1">Régler une partie (Ar) :</label>
  <div class="form-group">
    <input type="number" min="0" name="payee" class="form-control form-control-sm col-2" id="exampleCheck1">
    
  </div>
  <button type="submit" class="btn btn-sm btn-success">REGLER</button>
</form>
</div>