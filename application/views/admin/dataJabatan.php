<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<?php echo $this->session->flashdata('pesan'); ?>
	<table>
		<a class="btn btn-sm btn-primary mt-2 mb-3" href="<?php echo base_url('admin/dataJabatan/tambahData') ?>"><i class="fas fa-plus"></i> Tambah Data</a>

		<form action="" method="post">
			<div class="input-group" style="width: 350px;float: right;">
				<input type="text" class="form-control" placeholder="Cari data jabatan..." name="keyword">
				<button class="btn btn-outline-secondary btn-primary" type="submit"><i class="fas fa-search text-white"></i></button>
			</div>
		</form>
	</table>

	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
			<tr>
				<th class="text-center text-dark">No</th>
				<th class="text-center text-dark">Nama Jabatan</th>
				<th class="text-center text-dark">Gaji Pokok</th>
				<th class="text-center text-dark">Tunjangan Transportasi</th>
				<th class="text-center text-dark">Uang Makan</th>
				<th class="text-center text-dark">Total</th>
				<th class="text-center text-dark">Action</th>
			</tr>

			<?php if (empty($jabatan)) : ?>
				<div class="alert alert-warning mt-2" role="alert">
					<i class="fas fa-exclamation-triangle"></i> Data jabatan tidak ditemukan.
				</div>
			<?php endif; ?>

			<?php
			foreach ($jabatan as $j) : ?>
				<tr>
					<td class="text-center text-dark"><?php echo ++$start; ?></td>
					<td class="text-center text-dark"><?php echo $j['nama_jabatan'] ?></td>
					<td class="text-center text-dark">Rp. <?php echo number_format($j['gaji_pokok'], 0, ',', '.') ?></td>
					<td class="text-center text-dark">Rp. <?php echo number_format($j['tj_transport'], 0, ',', '.') ?></td>
					<td class="text-center text-dark">Rp. <?php echo number_format($j['uang_makan'], 0, ',', '.') ?></td>
					<td class="text-center text-dark">Rp. <?php echo number_format($j['gaji_pokok'] + $j['tj_transport'] + $j['uang_makan'], 0, ',', '.') ?></td>
					<td>
						<center>
							<a class="btn btn-sm btn-info" href="<?php echo base_url('admin/dataJabatan/updateData/' . $j['id_jabatan']) ?>"><i class="fas fa-edit"></i></a>
							<a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/dataJabatan/deleteData/' . $j['id_jabatan']) ?>"><i class="fas fa-trash"></i></a>
						</center>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<div class="mt-2 mb-2">
			<?= $this->pagination->create_links(); ?>
		</div>
	</div>
</div>

</div>