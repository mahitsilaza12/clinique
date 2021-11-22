<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;margin-bottom:20px;padding:10px;background-color:rgba(0,0,0,0.2)">

	<div class="jumbotron jumbotron-fluid pt-4 pb-4">
		<div class="container">
			<h1 class="display-4">Utilisateur actuel (<?= $this->session->userdata("nomUser") ?>)</h1>
			<div class="progress" style="height: 1px;">
				<div class="progress-bar" role="progressbar" style="width: 35%;background-color: black"
					aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-sm mt-4 btn-primary" data-toggle="modal"
				data-target="#exampleModalScrollable">
				Ajouter un nouveau utilisateur
			</button>
		</div>
	</div>
	<div class="accordion" id="accordionExample">
    
    <?php 

foreach($users as $user){
?>
<div class="card">
    <div class="card-header" id="heading<?= $user->id?>">
      <h2 class="mb-0">
        <button class="btn btn-outline-dark btn-sm" type="button" data-toggle="collapse" data-target="#collapse<?= $user->id?>" aria-expanded="true" aria-controls="collapse<?= $user->id?>">
          <?= $user->pseudo?><span> 
		</button>
      </h2>
    </div>
</div>

<?php if($user->pseudo == $this->session->userdata('nomUser'))
{
?>

<div id="collapse<?= $user->id?>" class="collapse" aria-labelledby="heading<?= $user->id?>" data-parent="#accordionExample">
      <div class="card-body">
      <form method="POST" action="<?= base_url()?>user/update/<?= $user->id?>">
					<div class="form-group">
						<label for="pseudo">Nom d'utilisateur</label>
						<input min="4" required type="text" value="<?= $user->pseudo?>" class="form-control col-4" name="nomUser">
					</div>
					<div class="form-group">
						<label class="text-mutted">Mot de passe <i class="fa fa-eye text-mutted" id="text-m"></i></label>
						<input type="password" name="mdp" value="<?= $user->mdp?>" id="passwor<?=$user->id?>" class="form-control col-4" min="4" required>
					</div>
					
					<div class="form-group">
						<label >Privilège </label>
						<select class="form-control col-4" name="type" value="<?=$user->type ?>">
							<option value="administrateur">Administrateur</option>
							<option value="simple">Simple utilisateur</option>
						</select>
					</div>

		
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-warning">Modifier</button>
			</div>
			</form>
      </div>
    </div>
  </div>
<?php }

}

?>

</div>


</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Utilisateur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url()?>user/store">
					<div class="form-group">
						<label for="pseudo">Nom d'utilisateur</label>
						<input min="4" required type="text" class="form-control" id="pseudo" name="nomUser">
					</div>
					<div class="form-group">
						<label class="text-mutted" id="text-mut">Mot de passe <i class="fa fa-eye text-mutted"></i></label>
						<input type="password" name="mdp" class="form-control has-text" id="mdp" min="4" required>
					</div>
					
					<div class="form-group">
						<label >Privilège </label>
						<select class="form-control" name="type">
							<option value="administrateur">Administrateur</option>
							<option value="simple">Simple utilisateur</option>
						</select>
					</div>

			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-sm btn-secondary">Réinitialiser</button>
				<button type="submit" id="submit" class="btn btn-sm btn-success">Enregistrer</button>
			</div>
			</form>
		</div>

	</div>
</div>
</div>

<script>
	document.getElementById("text-mut").addEventListener("click", function () {
		document.getElementById("mdp").classList.toggle("has-text")
	})

	if(document.getElementById("mdp").classList.contains("has-text"))
	console.log(4)	
	//document.getElementById("mdp").setAttribute("type" , "text")
	else
	console.log(8)	
	//document.getElementById("mdp").setAttribute("type" , "password")

	document.getElementById("text-m").addEventListener("click", function (e) {
		document.getElementById("passwor5").classList.toogle = "has-text";
	})
/*
	if(document.getElementById("passwor5").classList.contains = "has-text")

		document.getElementById("passwor5").attributes.type = "text"
	else
		document.getElementById("passwor5").attributes.type = "password"

*/
</script>
