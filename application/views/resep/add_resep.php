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
						<h3 class="card-label">Tambah Resep</h3>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?= base_url('resep/simpan') ?>" id="form_resep">					
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-4">
								Nama Resep <font color="red">*</font>
							</div>
							<div class="col-md-8">
								<input type="text" name="resep" class="form-control" required>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-4">
								Jenis Resep
							</div>
							<div class="col-md-8">
								<select name="jenis_resep" class="form-control" required>
									<option value="non_racikan">Non Racikan</option>
									<option value="racikan">Racikan</option>
								</select>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-4">
								Signa / Dosis
							</div>
							<div class="col-md-8">
								<select name="dosis" class="form-control" id="dosis" required>
									<?php foreach($signa as $s) { ?>
										<option value="<?= $s->signa_id ?>"><?= $s->signa_nama ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-12">
								<H2>
									Obat
								</H2>
							</div>
							<div class="col-md-12">
								<a onclick="addObat()" class="btn btn-sm btn-light-primary font-weight-bolder">Tambah Obat</a>
								<input type="hidden" name="jml_obat" id="jml_obat" value="0">
							</div>
						</div>

						<div class="row" id="daftar_obat">

						</div>

						<div class="row">
							<div class="col-md-12 d-none" id="submit_btn">
								<a onclick="submit()" class="btn btn-sm btn-light-primary font-weight-bolder">Simpan</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function addObat() {
		var jml = parseInt($('#jml_obat').val());
		jml += 1;

		$('#jml_obat').val(jml);

		var html = `
			<div class="col-md-6 nama_obat" style="margin-bottom: 10px;" id="nama_obat_`+jml+`">
				<select name="obat[]" class="form-control obat obat_`+jml+`" onchange="ganti_obat(`+jml+`);" id="select_`+jml+`" form-id="`+jml+`">
					<?php foreach($obat as $o) { ?>
						<option value="<?= $o->obatalkes_id ?>" <?= ($o->stok < 1) ? 'disabled' : '' ?>><?= $o->obatalkes_nama ?> | Stok : <?= (int) $o->stok ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6 ambil_stok" style="margin-bottom: 10px;" id="ambil_stok_`+jml+`">
				<input type="number" name="ambil_stok[]" id="ambil_id_`+jml+`" value="1" min="1" max="10" class="form-control ambil_stok" onkeyup="validasi('`+jml+`');" required>
				<span id="status_`+jml+`" style="color: red;"></span>
			</div>
		`;


		$('#daftar_obat').append(html);

		$('#submit_btn').removeClass('d-none');
	}

	function submit() {
		var jml = parseInt($('#jml_obat').val());

		if(jml > 0) {
			$('#form_resep').submit();
		} else {
			alert('Mohon input obat terlebih dahulu.');
		}
	}

	function ganti_obat(id) {
		var x = document.getElementById("select_"+id).value;
		
		$.ajax({
			url: "<?= base_url() ?>get_stok/"+x, 
			success: function(result) {
				var hasil = parseInt(result);
				$('#ambil_id_'+id).attr('max', hasil);
				$('#ambil_id_'+id).val(1);
			}
		});
	}

	function validasi(id) {
		var max = parseInt($('#ambil_id_'+id).attr('max'));
		var aff = document.getElementById('ambil_id_'+id);
		if(parseInt(aff.value) > max) {
			$('#ambil_id_'+id).val(max)
		}
	}
</script>