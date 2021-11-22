<?php
header('content-Type: application/vnd.ms-excel');
header('content-Disposition:attachment;filename="client.xls"');

?>
<table class="table table-hover table-dark">
									<thead>
										<tr>
											<th style="border:1px solid black;text-align:center">Nom du fournisseur</th>
											<th style="border:1px solid black;text-align:center">Responsable</th>
											<th style="border:1px solid black;text-align:center">Contact</th>
											<th style="border:1px solid black;text-align:center">Adresse</th>
											<th style="border:1px solid black;text-align:center">Email</th>
											<th style="border:1px solid black;text-align:center"></th>
										<tr>
									</thead>
									<tbody>
                                    <?php foreach($liste as $d){
                                    ?>
                                        <tr>
                                            <td style="border:1px solid black;text-align:center"><?=$d->nomFrs?></td>
                                            <td style="border:1px solid black;text-align:center"><?=$d->responsable?></td>
                                            <td style="border:1px solid black;text-align:center"><?=$d->contact_frs?></td>
                                            <td style="border:1px solid black;text-align:center"><?=$d->adresse_frs?></td>
                                            <td style="border:1px solid black;text-align:center"><?=$d->email_frs?></td>
                                        </tr>

                                    <?php } ?>
									</tbody>
</table>