<div class="card">
	<h5 class="card-header">Race pour les chiens :</h5>
	<div class="card-body" style="height:400px">
		<ul class="list-group list-group-flush" id="race_chien">
			<?php foreach($chien as $race_chien): 
            
        ?>

			<li class="list-group-item list-group-item-sm col-md-3 list-group-item-action list-group-item-dark">
				<?= $race_chien->nom_race?></li>

			<?php
            endforeach;
        ?>
		</ul>
		</ul>

	</div>
</div>

<div class="card">
	<h5 class="card-header">Race pour les chats :</h5>
	<div class="card-body">
		<ul class="list-group list-group-flush" id="race_chat">
			<?php foreach($chat as $race_chat): 
            
        ?>

			<li class="list-group-item list-group-item-sm col-md-3 list-group-item-action list-group-item-dark">
				<?= $race_chat->nom_race?></li>

			<?php
            endforeach;
        ?>
		</ul>
		</ul>

	</div>
</div>
<div class="content-fluid">

</div>
