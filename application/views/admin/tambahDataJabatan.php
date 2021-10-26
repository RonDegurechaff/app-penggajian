<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <a href="<?php echo base_url('admin/dataJabatan') ?>" class="btn btn-info mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

    <div class="card" style="width: 70%; margin-bottom: 100px">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url('admin/dataJabatan/tambahDataAksi') ?>">
    			<div class="form-group">
    				<label>Nama Jabatan</label>
    				<input type="text" name="nama_jabatan" class="form-control">
    				<?php echo form_error('nama_jabatan', '<div class="text-small text-danger"></div>'); ?>
    			</div>

    			<div class="form-group">
    				<label>Gaji Pokok</label>
    				<input type="text" name="gaji_pokok" class="form-control">
    				<?php echo form_error('gaji_pokok', '<div class="text-small text-danger"></div>'); ?>
    			</div>

    			<div class="form-group">
    				<label>Tunjangan Transportasi</label>
    				<input type="text" name="tj_transport" class="form-control">
    				<?php echo form_error('tj_transport', '<div class="text-small text-danger"></div>'); ?>
    			</div>

    			<div class="form-group">
    				<label>Uang Makan</label>
    				<input type="text" name="uang_makan" class="form-control">
    				<?php echo form_error('uang_makan', '<div class="text-small text-danger"></div>'); ?>
    			</div>

    			<button type="submit" class="btn btn-primary">Tambah</button>
    			
    		</form>
    	</div>
    </div>
</div>