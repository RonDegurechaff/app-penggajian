<div class="container-fluid">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<?php echo $this->session->flashdata('pesan'); ?>
	<table>
		<a class="btn btn-sm btn-primary mt-2 mb-3" href="<?php echo base_url('admin/dataPegawai/tambahData') ?>"><i class="fas fa-plus"></i> Tambah Pegawai</a>

		<form action="" method="post">
			<div class="input-group" style="width: 390px;float: right;">
				<input type="text" class="form-control" placeholder="Cari data pegawai..." name="keyword">
				<button class="btn btn-outline-secondary btn-primary" type="submit"><i class="fas fa-search text-white"></i></button>
			</div>
		</form>
	</table>
	<div class="table">
		<table class="table table-bordered table-striped table-hover table-responsive">
			<?php if (empty($pegawai)) : ?>
				<div class="alert alert-warning mt-2" role="alert">
					<i class="fas fa-exclamation-triangle"></i> Data pegawai tidak ditemukan.
				</div>
			<?php endif; ?>
			<tr>
				<th class="text-center text-dark">No</th>
				<th class="text-center text-dark">NIK</th>
				<th class="text-center text-dark">Nama Karyawan</th>
				<th class="text-center text-dark">Jenis Kelamin</th>
				<th class="text-center text-dark">Jabatan</th>
				<th class="text-center text-dark">Tanggal Masuk</th>
				<th class="text-center text-dark">Status</th>
				<th class="text-center text-dark">Photo</th>
				<th class="text-center text-dark">Hak Akses</th>
				<th class="text-center text-dark">Action</th>
			</tr>

			<?php
			foreach ($pegawai as $p) : ?>
				<tr>
					<td class="text-center text-dark"><?php echo ++$start ?></td>
					<td class="text-center text-dark"><?php echo $p['nik'] ?></td>
					<td class="text-center text-dark"><?php echo $p['nama_pegawai'] ?></td>
					<td class="text-center text-dark"><?php echo $p['jenis_kelamin'] ?></td>
					<td class="text-center text-dark"><?php echo $p['jabatan'] ?></td>
					<td class="text-center text-dark"><?php echo $p['tanggal_masuk'] ?></td>
					<td class="text-center text-dark"><?php echo $p['status'] ?></td>
					<td class="text-center"><img src="<?php echo base_url() . 'assets/photo/' . $p['photo'] ?>" ? width="70px"></td>

					<?php if ($p['hak_akses'] == '1') { ?>
						<td class="text-center text-dark">Admin</td>
					<?php } else { ?>
						<td class="text-center text-dark">Pegawai</td>
					<?php } ?>

					<td class="text-center">
						<center>
							<a class="btn btn-sm btn-info" href="<?php echo base_url('admin/dataPegawai/updateData/' . $p['id_pegawai']) ?>"><i class="fas fa-edit"></i></a>
							<a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/dataPegawai/deleteData/' . $p['id_pegawai']) ?>"><i class="fas fa-trash"></i></a>
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