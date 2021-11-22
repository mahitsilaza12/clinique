<div class="container-fluid slide-content"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;padding:10px;background-color:rgba(0,0,0,0.2)">
	<div class="jumbotron pt-1" style="background-color:rgba(0,0,0,0.2)">
		<?php foreach($medicament as $med):?>
		<h3 class="display-3 mt-1">

			<?= $med->libelleMed;?>
		</h3>

		<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Type :
                <em style='color:blue'><?= $med->libelleTrait?></em></span></li>
        <li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Unité :
				<em style='color:blue'><?= $med->unite?></em></span></li>
		<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Présentation :
				<em style='color:blue'><?= $med->presentation?></em></span></li>
		<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Présentation en gros :
				<em style='color:blue'><?= $med->presentationGros?></em></span></li>
		<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Prix unitaire :
				<em style='color:blue'><?= splitChiffre($med->puDetail)?> Ar</em></span></li>
		<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Prix par présentation :
				<em style='color:blue'><?= $med->prixPresentation?> Ar / <?= $med->presentation?></em></span></li>
		<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Stock actuel :
				<em style='color:blue'><?=( $med->stock)?> <?=$med->unite?></em></span></li>
        <li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">
				<em style='color:blue'><?=splitChiffre((int) ($med->stock / $med->parPresentation))?> <?=$med->presentation?> et <?= splitChiffre((int) $med->stock % $med->parPresentation)." ".$med->unite?></em></span></li>
		<li class="list-group-item list-group-item-dark list-group-item-action" style="cursor:pointer"><span
				class="">Date de peremption :
				<em style='color:blue'><?= $med->datePeremption?></em></span></li>
		<?php endforeach;?>
	</div>
</div>
