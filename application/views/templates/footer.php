	<script src="<?= base_url()?>assets/js/bootstrap/jQuery.js"></script>
	<script src="<?= base_url()?>assets/js/bootstrap/bootstrap.bundle.js"></script>
	<script src="<?= base_url()?>assets/js/bootstrap/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/Chart/Chart.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/Chart.js"></script>
	<link rel="stylesheet" href="<?= base_url()?>assets\DataTables\datatables.css"/>
	<script src="<?= base_url()?>assets/js/script.js"></script>
	<?php
		if(isset($script)):
	?>

	<script src="<?= base_url()?>assets/js/<?= $script ?>"></script>

	<?php endif ?>
	</body>

	</html>
