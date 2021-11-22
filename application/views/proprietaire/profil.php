<div id="proprietaire" style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;padding:10px">
<?php if($this->session->flashdata("status")){?>
    <div class="alert alert-<?= $this->session->flashdata("color") ?> alert-dismissible fade show" role="alert">
  <?= $this->session->flashdata("status")?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php }?>
	<ul class="list-group">

<?php
foreach($proprietaire as $proprio):
?>

		<li class="list-group-item disabled" aria-disabled="true">Nom : <em><?= $proprio->nomProprio?></em></li>
		<li class="list-group-item disabled">Adresse : <em><?= $proprio->adresseProprio?></em></li>
		<li class="list-group-item disabled">Contact : <em><?= $proprio->contactProprio?></em></li>
		<li class="list-group-item disabled">Email : <em><?= $proprio->emailProprio?></em></li>
		<li class="list-group-item disabled">Statu : <em><?= $proprio->status?></em></li>
		<li class="list-group-item disabled">Organisation : <em><?= $proprio->organisation?></em></li>
		<?php endforeach;?>
        <li class="list-group-item">Liste de ses patients :<?php foreach($listePatient as $patient):?>
                <a href="<?= base_url()?>patient/profil/<?=$patient->codePatient?>" class="btn btn-sm btn-outline-dark"><?= $patient->nomPatient?></a>
        <?php endforeach;?></li>

	</ul>

	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					<button class="btn btn-info btn-sm" type="button" data-toggle="collapse"
						data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Liste des dépenses :
					</button>
                    <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#exampleModal">
            METTRE A JOUR CE CLIENT
</button>
				</h2>
			</div>

			<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="height:400px;overflow-y:scroll">
                <table class="table table-hover">
					<thead>
                        <tr>
                            <th>Numéro de la facture :</th>
                            <th>Dépense total :</th>
                            <th>Payée</th>
                            <th>Reste à payer :</th>
                            <th>Type :</th>
                            <th>Régler la somme restante</th>
                            <th>Regénerer la facture</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $ca = 0;
                        $reste = 0;
                        foreach($data as $row)
                        {
                            $ca += $row->net;
                            $reste += ($row->net - $row->payee);
                            ?>
                            <tr>
                                <td><?= $row->numFact?></td>
                                <td><?= splitChiffre($row->net)?> Ar</td>
                                <td><?= splitChiffre($row->payee)?> Ar</td>
                                <td><?= splitChiffre( $row->net - $row->payee)?> Ar</td>
                                <td><?= $row->type?></td>
                                <?php if(($row->net - $row->payee) != 0){?>
                                <td><a href="<?=base_url()?>finance/regler_cli/<?= $row->codeComCli?>"><i class="fa fa-phone"></i></a></td>
                                <?php }?>
                                <td style="text-align:center"><a href='<?= base_url().$row->url ?>'><i class='fa fa-upload'></i></a></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                    </table>
                    SOMME TOTAL = <?= splitChiffre($ca)?> Ar <br>
                    RESTE A PAYER = <?= splitChiffre($reste) ?>Ar
				</div>
                <!-- <a class='m-2 btn btn-sm btn-outline-success' href="<?= base_url()?>proprietaire/ca/<?= $proprietaire[0]->codeProprio ?>">Exporter les dépenses <i class="fa fa-download"></i></a> -->
			</div>
		</div>
	</div>
<div><strong>DEPENSE TOTALE FAITE AU SEIN DE NOTRE CLINIQUE</strong> : <span style='color:blue'><?= splitChiffre($ca) ?> Ar</span></div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form  method="POST" action="<?= base_url()?>proprietaire/update/<?= $proprio->codeProprio?>">
<?php

foreach($proprietaire as $proprio):
?>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Nom</span>
  </div>
  <input type="text" class="form-control" name="nomProprio" value="<?= $proprio->nomProprio?>">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Contact</span>
  </div>
  <input type="text" class="form-control" name="contactProprio" value="<?= $proprio->contactProprio?>">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Email</span>
  </div>
  <input type="mail" class="form-control" name="emailProprio" value="<?= $proprio->emailProprio?>">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Adresse</span>
  </div>
  <input type="text" class="form-control" name="adresseProprio" value="<?= $proprio->adresseProprio?>">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Status</label>
  </div>
  <select name="status" class="custom-select" id="inputGroupSelect01">
    <option <?php if($proprio->status == "Remisé") echo "selected";?> value="Remisé">Remisé</option>
    <option <?php if($proprio->status == "Non remisé") echo "selected";?> value="Non remisé">Non remisé</option>
  </select>
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Organisation</span>
  </div>
  <input type="text" class="form-control" name="organisation" value="<?= $proprio->organisation?>">
</div>
		
		<?php endforeach;?>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>