<div class="content"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">
	<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Hospitalisation </h1>
			<div class="progress" style="height: 1px;">
				<div class="progress-bar" role="progressbar" style="width: 32%;background-color: black"
					aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>

	<div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseOne"
						aria-expanded="true" aria-controls="collapseOne">
						Liste des patients hospitalisés :
					</button>
				</h2>
			</div>

			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="height:500px;overflow-y:scroll">
					<table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Patient :</th>
                            <th>Date d'hospitalisation :</th>
                            <th>Date de sortie :</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($hospitalise)) foreach($hospitalise as $patient){?>
<tr>
    <td><a href='<?= base_url()?>patient/profil/<?=$patient->codePatient?>' class='btn btn-sm btn-link'><?= $patient->nomPatient?></a></td>
    <td><?= $patient->dateDebut?></td>
    <td><?= $patient->dateFin?></td>
</tr>


                        <?php
                        }
                         ?>
                    </tbody>
                    </table>
				</div>
			</div>
		</div>
    </div>
		<?php
?>
	</div>
