<table width="50%">
	<tr>
		<td>Tanggal : <?= date('d-m-Y'); ?></td>
	</tr>
	<tr>
		<td>
			Nama Pasien :
			<br><br>
			<br><br>
			<br>
		</td>
	</tr>
	<tr>
		<td>
			<hr>
			<br>
			<?= $resep->signa_nama ?>
		</td>
	</tr>
	<tr>
		<td>
			<hr>
			<br>
			<?php foreach($obat_resep as $or) { ?>
				<?= $or->obatalkes_nama ?> (<?= $or->qty_obat ?>)
				<br>
			<?php } ?>
		</td>
	</tr>
</table>

<script type="text/javascript">
	window.onload = function() { window.print(); }
</script>