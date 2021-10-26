<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

     <div class="card mb-3">
	  <div class="card-header bg-primary text-white" >
	    Filter Data Gaji Pegawai
	  </div>
	  <div class="card-body">
	    <form class="form-inline">
	    	<div class="form-group mb-2">
	    		<label for="staticEmail2">Bulan :</label>
	    		<select class="form-control ml-2" name="bulan">
	    			<option value="">-- Pilih Bulan --</option>
	    			<option value="01">Januari</option>
	    			<option value="02">Februari</option>
	    			<option value="03">Maret</option>
	    			<option value="04">April</option>
	    			<option value="05">Mei</option>
	    			<option value="06">Juni</option>
	    			<option value="07">Juli</option>
	    			<option value="08">Agustus</option>
	    			<option value="09">September</option>
	    			<option value="10">Oktober</option>
	    			<option value="11">November</option>
	    			<option value="12">Desember</option>
	    		</select>
	    	</div>

	    	<div class="form-group mb-2 ml-5">
	    		<label for="staticEmail2">Tahun :</label>
	    		<select class="form-control ml-2" name="tahun">
	    			<option value="">-- Pilih Tahun --</option>
	    			<?php $tahun = date('Y');
	    			for($i = 2020; $i < $tahun + 5; $i++ ) { ?>
		    			<option value="<?php echo $i ?>"><?php echo $i ?></option>
	    			<?php } ?>
	    		</select>
	    	</div>
		<?php
			if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$bulantahun = $bulan.$tahun;
			}else{
				$bulan = date('m');
				$tahun = date('Y');
				$bulantahun = $bulan.$tahun;
			}
		 ?>
		 <button type="submit" class="btn btn-sm btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Filter Data</button>

<!--		 <?php if (count($gaji) > 0) { ?>
		 <a href="<?php echo base_url('admin/DataGaji/cetakGaji?bulan='.$bulan),'&tahun='.$tahun?>" class="btn btn-sm btn-success mb-2 ml-3"><i class="fas fa-print"></i> Cetak Data Gaji</a>

		 <?php }else{ ?>
         <a class="btn btn-sm btn-success mb-2 ml-3" data-toggle="modal" data-target="#dataModal">
            <i class="fas fa-print"></i>
             <span>Cetak Data Gaji</span></a>
		 <?php } ?> -->
	    </form>
	  </div>
	</div>

	<?php
		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}
	 ?>

	<div class="alert alert-info alert-dismissible fade show" role="alert">
		Menampilkan Data Gaji Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span>  Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times </button>
	</div>

	<?php 
		$jml_data = count($gaji);
		if ($jml_data > 0) { ?>

	<div class="table-responsive">
		<table class="table table-bordered table-striped" style="margin-bottom: 100px">
			<tr>
				<th class="text-center text-dark">No.</th>
				<th class="text-center text-dark">NIK</th>
				<th class="text-center text-dark">Nama Pegawai</th>
				<th class="text-center text-dark">Jenis Kelamin</th>
				<th class="text-center text-dark">Jabatan</th>
				<th class="text-center text-dark">Gaji Pokok</th>
				<th class="text-center text-dark">Tj. Transportasi</th>
				<th class="text-center text-dark">Uang Makan</th>
				<th class="text-center text-dark">Potongan</th>
				<th class="text-center text-dark">Total Gaji</th>
			</tr>

			<?php foreach ($potongan as $p) {
				$alpa=$p->jml_potongan;
			} ?>
			<?php $no=1; foreach ($gaji as $g) : ?>
			<?php $potongan = $g->alpa * $alpa ?>
			<tr>
				<td class="text-center text-dark"><?php echo $no++ ?></td>
				<td class="text-center text-dark"><?php echo $g->nik ?></td>
				<td class="text-center text-dark"><?php echo $g->nama_pegawai ?></td>
				<td class="text-center text-dark"><?php echo $g->jenis_kelamin ?></td>
				<td class="text-center text-dark"><?php echo $g->nama_jabatan ?></td>
				<td class="text-center text-dark">Rp.<?php echo number_format($g->gaji_pokok,0,',','.') ?>
				<td class="text-center text-dark">Rp.<?php echo number_format($g->tj_transport,0,',','.') ?>
				<td class="text-center text-dark">Rp.<?php echo number_format($g->uang_makan,0,',','.') ?>
				<td class="text-center text-dark">Rp.<?php echo number_format($potongan,0,',','.') ?>
				<td class="text-center text-dark">Rp.<?php echo number_format($g->gaji_pokok + $g->tj_transport + $g->uang_makan - $potongan,0,',','.') ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<?php }else{ ?>
		<span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data Gaji Kosong. Silahkan Input Data Kehadiran Pegawai Pada Bulan dan Tahun yang Anda Pilih</span>
	<?php } ?>

</div>
<!-- MODAL -->
     <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i> Informasi</h5>
                </div>
                <div class="modal-body">Data Absensi Kosong. Silahkan Input Data Kehadiran Pada Bulan Dan Tahun yang Anda Pilih!</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>