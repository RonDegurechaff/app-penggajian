<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div> <!-- center -->
    	<center>
		<div class="alert alert-success mb-4 text-center" style="width: 69%">
			<strong>Selamat Datang</strong>, Saat Ini Anda Login Sebagai Pegawai <button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times </button>
		</div>

		<div class="card" style="margin-bottom: 120px; width: 69%">
			<div class="card-header font-weight-bold bg-primary text-white text-center">
				Data Pegawai
			</div>

			<?php foreach ($pegawai as $p) : ?>
				<div class="card-body">
					<div class="row">
						<div class="col-md-5">
							<img class="img-fluid" style="width: 235px" src="<?php echo base_url('assets/photo/'. $p->photo); ?>">
						</div>

						<div class="col-md-7 mt-1">
							<table class="table table-responsive">
								<tr>
									<td>Nama Pegawai</td>
									<td>:</td>
									<td><?php echo $p->nama_pegawai; ?></td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td><?php echo $p->jabatan; ?></td>
								</tr>
								<tr>
									<td>Tanggal Masuk</td>
									<td>:</td>
									<td><?php echo $p->tanggal_masuk; ?></td>
								</tr>
								<tr>
									<td>Status</td>
									<td>:</td>
									<td><?php echo $p->status; ?></td>
								</tr>
							</table>
						</div>
					</div>			
				</div>
			<?php endforeach; ?>
		</div>
	</center>
	</div>


</div>