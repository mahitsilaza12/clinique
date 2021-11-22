<div id="proprietaire"
	style="box-shadow:0 0 30px rgba(0,0,0,0.9);margin-top:20px;padding:10px;background-color:rgba(0,0,0,0.2);background-image:url('<?=base_url()?>assets/img/bache  2m x 1m.jpg');background-size:100% 100%">
	<h1 style='text-align:center;font-weight:lighter' class='mb-0'>Cabinet Vétérinaire Boulevard</h1>
	<div class="content-card mt-0">
		<div class="card" style="width: 23rem;">
			<a href='<?= base_url()?>patient' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body" >
				<h5 class="card-title">Patient</h5>
				<h6 class="card-subtitle mb-2 text-muted">Section pour les animaux</h6>
				<div class="card-body">
				</div>
				<a href="<?= base_url()?>" class="btn btn-secondary" style="font-size:10px" data-toggle="modal"
					data-target="#exampleModalCenter">Nouveau patient <i class="fa fa-cat"></i></a>
				<a href="<?= base_url()?>patient" class="btn btn-secondary" style="font-size:10px">Voir la liste <i
						class="fa fa-list"></i></a>
			</div>
			</a>
		</div>
		<div class="card" style="width: 23rem;">
		<a href='<?= base_url()?>proprietaire' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body" >
				<h5 class="card-title">Client</h5>
				<h6 class="card-subtitle mb-2 text-muted">Proprietaire des animaux</h6>
				<div class="card-body">
				</div>
				<a href="<?= base_url()?>proprietaire" class="btn btn-secondary" style="font-size:10px">Nouveau client
					<i class="fas fa-user"></i></a>
				<a href="<?= base_url()?>proprietaire/proprio_remise" class="btn btn-secondary"
					style="font-size:10px">Client rémisé</a>
			</div>
		</a>
		</div>

		<div class="card" style="width: 23rem;">
		<a href='<?= base_url()?>medicament' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body">
				<h5 class="card-title">Stock</h5>
				<h6 class="card-subtitle mb-2 text-muted">Etat de stock</h6>
				<div class="card-body">
				</div>
				<a href="<?= base_url()?>medicament" class="btn btn-secondary" style="font-size:10px">Date de péremption <i
						class="fa fa-clock"></i></a>
				<a href="<?= base_url()?>fournisseur/approvisionner" class="btn btn-secondary" style="font-size:10px">Se réapprovisionner</a>
			</div>
			</a>
		</div>

		<div class="card" style="width: 23rem;" id="tache">
		<a href='<?= base_url()?>rappel' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body" >
				<h5 class="card-title">Tâches</h5>
				<h6 class="card-subtitle mb-2 text-muted">Vos occupations d'aujourd'hui</h6>
				<div class="card-body">
				</div>
				<a href="<?= base_url()?>rappel" class="btn btn-secondary" style="font-size:10px">Voir les tâches <i
						class="fa fa-eye"></i></a>
				<a href="<?= base_url()?>" class="btn btn-secondary" style="font-size:10px">Marquer comme lu <i
						class="fa fa-check"></i></a>
			</div>
			</a>
		</div>

		<div class="card" style="width: 23rem;">
		<a href='<?= base_url()?>soin' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body">
				<h5 class="card-title">Soin et Activité</h5>
				<h6 class="card-subtitle mb-2 text-muted">Soin pour un patient</h6>
				<div class="card-body" >
				</div>
				<a href="<?= base_url()?>tarif" class="btn btn-secondary" style="font-size:10px">Tarifs pour nos soins</a>
				<a href="<?= base_url()?>tarif" class="btn btn-secondary" style="font-size:10px">Ajouter une soin</a>
			</div>
			</a>
		</div>

		<div class="card" style="width: 23rem;">
		<a href='<?= base_url()?>consultation' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body">

				<h5 class="card-title">Clinique CVB</h5>
				<h6 class="card-subtitle mb-2 text-muted">Consultation</h6>
				<div class="card-body">
				</div>
				<a href="<?= base_url()?>consultation" class="btn btn-secondary" style="font-size:10px">Ajouter une consultation</a>
				<a href="<?= base_url()?>consultation" class="btn btn-secondary" style="font-size:10px">Voir les tâches</a>
			</div>
			</a>
		</div>
		<?php if($this->session->pseudo == "administrateur") {?>
		<div class="card" style="width: 23rem;">
		<a href='<?= base_url()?>statistique' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body" >
				<h5 class="card-title">Statistique</h5>
				<h6 class="card-subtitle mb-2 text-muted">Historique des recettes</h6>
				<div class="card-body">
				</div>
				<a href="<?= base_url()?>" class="btn btn-secondary" style="font-size:10px">Entrée/Sortie</a>
				<a href="<?= base_url()?>" class="btn btn-secondary" style="font-size:10px">Comparer les recettes</a>
			</div>
			</a>
		</div>
		
		<div class="card" style="width: 23rem;">
		<a href='<?= base_url()?>fournisseur' style='text-decoration:none;color:rgba(100,10,200,0.9)'>
			<div class="card-body" >
				<h5 class="card-title">Fournisseur</h5>
				<h6 class="card-subtitle mb-2 text-muted">Section approvisionnement</h6>
				<div class="card-body">
				</div>
				<a href="<?= base_url()?>" class="btn btn-secondary" style="font-size:10px">Nouveau fournisseur</a>
				<a href="<?= base_url()?>" class="btn btn-secondary" style="font-size:10px">Gérer les fournisseurs</a>
			</div>
			</a>
		</div>
		<?php } ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">

	<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Noveau patient</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closer">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?=base_url()?>patient/storepatient" method="POST" id="form_patient">
					<div class="form-group">
						<label for="">Nom :</label>
						<input type="text" class="form-control form-control-sm"
							placeholder="Snoopy" name="nomPatient" required>
					</div>
					<div class="form-group">
						<label for="proprio">Propriétaire :</label>
						<select class="form-control form-control-sm" id="proprio" name="codeProprio" required>

						</select>
						<br>
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h2 class="mb-0">
										<button class="btn btn-sm btn-secondary" type="button" data-toggle="collapse"
											data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Ajouter un nouveau proprietaire
										</button>
									</h2>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne"
									data-parent="#accordionExample">
									<div class="card-body"
										style="background-color:rgba(150,120,120,0.75);height:200px;overflow-y:scroll">
										<div class="form-group">
											<label style="font-weight : bold" for="nom">Nom du client :</label>
											<input type="text" class="form-control " id="nom" required
												placeholder="Nom du client" name="nom">
										</div>
										<div class="form-group">
											<label style="font-weight : bold" for="adresse">Adresse :</label>
											<input type="text" class="form-control " required id="adresse"
												placeholder="Lot PK 101 Ivato Antananarivo 101" name="adresse">
										</div>
										<div class="form-group">
											<label style="font-weight : bold" for="phone">Téléphone :</label>
											<input type="text" class="form-control " id="phone" required
												placeholder="Numéro de téléphone" name="phone">
										</div>
										<div class="form-group">
											<label style="font-weight : bold" for="email">Email :</label>
											<input type="email" class="form-control " id="email"
												aria-describedby="emailHelp" placeholder="exemple@gmail.com"
												name="email">
											<small id="emailHelp" class="form-text text-muted">Entrer un email
												valide s'il vous
												plaît.</small>
										</div>
										<label style="font-weight : bold" class="form-check-label">
											Status du client au sein du clinique :
										</label>
										<select class="form-control" required name="status" id="status">
											<option value="Remisé">Remisé</option>
											<option value="Non remisé" selected>Non remisé</option>
										</select>
										<div class="form-group">
											<label style="font-weight : bold" for="organisation">Organisation</label>
											<input type="text" class="form-control " name="organisation"
												id="organisation" placeholder="Organisation oeuvrant pour les animaux">
										</div>

										<div>
											<button type="button" id="sendClient" class="btn btn-success btn-sm">Save
												changes</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group" id="esp">
					
						
					</div>	
						<div class="accordion" id="accordionExample">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-sm btn-secondary" type="button"
												data-toggle="collapse" data-target="#especeCollapse" aria-expanded="true"
												aria-controls="especeCollapse">
												Nouvelle espèce
											</button>
										</h2>
									</div>

									<div id="especeCollapse" class="collapse" aria-labelledby="headingOne"
										data-parent="#accordionExample">
										<div class="card-body"
											style="background-color:rgba(150,120,120,0.75);height:200px;overflow-y:scroll">
											
											<input type="text" class="form-control mb-2" name="" id="newEspece"
												placeholder="">
											<div>
												<button type="button" id="sendEspece" class="btn btn-dark btn-sm">ENREGISTRER</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="form-group">
							<label for="race">Race :</label>
							<select class="form-control form-control-sm" id="race" name="codeRace" required>

							</select>
							<br>
							<div class="accordion" id="accordionExample">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-sm btn-secondary" type="button"
												data-toggle="collapse" data-target="#coll" aria-expanded="true"
												aria-controls="coll">
												Ajouter une nouvelle race
											</button>
										</h2>
									</div>

									<div id="coll" class="collapse" aria-labelledby="headingOne"
										data-parent="#accordionExample">
										<div class="card-body"
											style="background-color:rgba(150,120,120,0.75);height:200px;overflow-y:scroll">
											<select class="form-control form-control-sm mb-2" id="newRace"
												name="newRace" required>
												
											</select>
											<input type="text" class="form-control mb-2" name="race_new" id="newRaceNom"
												placeholder="">
											<div>
												<button type="button" id="sendRace" class="btn btn-success btn-sm">Save
													changes</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="">Age : <cite class="small">(mois)</cite></label>
							<input type="number" min="0" class="form-control form-control-sm"
							 placeholder="12" name="age">
						</div>
						<div class="form-group">
							<label for="">Date de naissance : <cite class="small">(à laisser
									vide
									si le propriétaire ne se souvient pas de la date exacte )</cite></label>
							<input type="date" class="form-control form-control-sm"
								placeholder="12" name="dateNais">
						</div>
						<div class="form-group">
							<label for="">Variété :</label>
							<select class="form-control form-control-sm" name="variete">
								<option value="géant">Géant</option>
								<option value="moyen">Moyen</option>
								<option value="nain">Nain</option>
								<option value="large">Large</option>
							</select>
						</div>
						<div class="form-group">
							<label>Sexe :</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" id="male" value="option1" checked
									name="labe_check">
								<label class="form-check-label" for="male">
									Mâle
								</label>
								<select class="form-control form-control-sm" id="selectMale" name="sexe">
									<option value="1">Castré</option>
									<option value="3">Non castré</option>
								</select>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" id="femelle" value="option2"
									name="labe_check">
								<label class="form-check-label" for="femelle">
									Femelle
								</label>
								<select class="form-control form-control-sm" id="selectFemelle"	style="display:none">
									<option value="2">Sterilisé</option>
									<option value="4">Non sterilisé</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="">Couleur :</label>
							<input class="form-control form-control-sm" name="couleur">
						</div>
						<div class="form-group">
							<label for="exampleFormControlFile1">Image associé aux patient</label>
							<input type="file" class="form-control-file form-control-sm" id="exampleFormControlFile1">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Déscription de l'animal</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descript"
								placeholder="Animal aggressif"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
						<button type="submit" class="btn btn-sm btn-info" id="sendPatient">Enregistrer</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	
</div>
<script>

function rappelTache()
{
	var xml = getHttp();

	xml.open("GET" , "<?= base_url()?>rappel/notifier")

	xml.onreadystatechange = function(){
		if(xml.readyState == 4 && xml.status == 200)
			if(xml.responseText != "[]")	
				document.getElementById("tache").classList.toggle("notification");
			else 
				document.getElementById("tache").classList.remove("notification");
	}
	xml.send()
}


	setInterval(function () {
		setTimeout(rappelTache(), 100)
	}, 1000);

	

	function getHttp() {
		if (window.XMLHttpRequest) {
			// code for modern browsers
			return new XMLHttpRequest();
		} else {
			// code for old IE browsers
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
	}

	let listeProprio = function () {
		var XHR = getHttp();

		XHR.open("GET", "<?= base_url()?>proprietaire/show");

		XHR.onreadystatechange = function () {
			if (XHR.readyState == 4 && XHR.status == 200) {
				var reponse = JSON.parse(XHR.responseText);
				html = reponse.map(function (proprio) {
					return `<option value='${proprio.codeProprio}'>${proprio.nomProprio}</option>`
				}).join("");

				document.getElementById("proprio").innerHTML = html;
			}
		}
		XHR.send();
	}
	listeProprio();

	document.getElementById("sendRace").addEventListener("click" , function(e){
	e.preventDefault()
	
	if(document.getElementById("newRaceNom").value == "")
	{
		alert("Le libellé de la race ne doit pas être vide");
	}
	else
		{
			xhr = getHttp();
			data = new FormData()
			data.append("codeEspece" , document.getElementById("newRace").value)
			data.append("nom_race" , document.getElementById("newRaceNom").value)

			xhr.open("POST" , "<?= base_url()?>race/insert");

			xhr.send(data)
		}
	
})

function addproprio() {

if(document.getElementById("nom").value != "")
{
	var XHRreq = new getHttp();

var data = new FormData();

data.append("nom" , document.getElementById("nom").value)
data.append("adresse" , document.getElementById("adresse").value)
data.append("email" , document.getElementById("email").value)
data.append("status" , document.getElementById("status").value)
data.append("phone" , document.getElementById("phone").value)
data.append("organisation" , document.getElementById("organisation").value)
XHRreq.open("POST", "<?= base_url()?>proprietaire/storeproprio")

XHRreq.send(data);
}
else{
	alert("Le nom du client ne doit pas être vide")
}


}

let button_Added = document.getElementById("sendClient");

button_Added.addEventListener("click", function (e) {
e.preventDefault();
addproprio();
listeProprio() ;

})

//==========================================================================================================
	function addPatient() {
		let formulaire = document.getElementById("form_patient");

		var XHRreq = new XMLHttpRequest();

		var data = new FormData(formulaire);

		XHRreq.open("POST", "<?= base_url()?>patient/storePatient");

		XHRreq.onreadystatechange = function () {
			if (XHRreq.status == 200 && XHRreq.readyState == 4) {
				setTimeout(function () {
					let tache = document.querySelector("#notif");
					tache.classList.toggle("notification");
					tache.innerHTML = "Un nouveau patient ajouté <i class='fa fa-sms'></i>"
				}, 1000)
			}
		}
		XHRreq.send(data);

	}


	//========================================================================//
	let buttons = document.getElementById("sendPatient");

	buttons.addEventListener("click", function (e) {
		e.preventDefault();
		addPatient();
		listeProprio();
		document.getElementById("closer").click();
	})

	

</script>
