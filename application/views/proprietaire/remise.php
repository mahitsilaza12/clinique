<div id="proprietaire" style="background-color:white">
<
<table class="table table-hover">
		<thead>
			<tr>
				<th>Nom du proprietaire : </th>
				<th>Adresse :</th>
				<th>Contact :</th>
				<th>Email :</th>
				<th>Organisation :</th>

			</tr>
		</thead>
		<?php if(!empty($proprietaire)){?>
		<tbody id="tbody">
		</tbody>
		<?php }
		  else { ?>
		<div class="alert alert-info">
			Propriétaire vide
		</div>
		<?php } ?>
	</table>
<div class="paging" style="text-align:center;font-size:20px">
	<ul class="pagination">
	</ul>
</div>
</div>
<script>
function getProprio(page_url) {
var XML = new XMLHttpRequest();
XML.open("GET", "<?= base_url()?>proprietaire/remise");
XML.onreadystatechange = function () {
    if (XML.readyState == 4 && XML.status == 200) {
		var reponse = JSON.parse(XML.responseText);
		var html = reponse.map(function(response){
			return `
				<tr>
					<td><a href='<?= base_url()?>proprietaire/profil/${response.codeProprio}'>${response.nomProprio}</a></td>
					<td>${response.adresseProprio}</td>
					<td>${response.contactProprio}</td>
					<td>${response.emailProprio}</td>
					<td>${response.organisation}</td>
			`
		}).join("");
        document.getElementById("tbody").innerHTML = html;
    }
}
XML.send()
}

getProprio()
setInterval(() => {
getProprio()
}, 3000);

</script>