<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">List Resep</h3>
						<a href="<?= base_url() ?>resep/cetak/<?= $resep->id ?>" class="btn btn-sm btn-light-primary font-weight-bolder">
							Print
						</a>
					</div>
				</div>
				<div class="card-body">
					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-4">
							Nama Resep
						</div>
						<div class="col-md-8">
							<?= $resep->nama_resep ?>
						</div>
					</div>
					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-4">
							Jenis Resep
						</div>
						<div class="col-md-8">
							<?= $resep->jenis ?>
						</div>
					</div>
					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-4">
							Signa / Dosis
						</div>
						<div class="col-md-8">
							<?= $resep->signa_nama ?>
						</div>
					</div>

					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-12">
							<H2>
								Obat
							</H2>
						</div>
					</div>

					<div class="row" style="margin-bottom: 10px;">
						<div class="col-md-6">Obat</div>
						<div class="col-md-6">Ambil Stok</div>
					</div>

					<?php foreach($obat_resep as $or) { ?>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-6"><?= $or->obatalkes_nama ?></div>
							<div class="col-md-6"><?= $or->qty_obat ?></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>