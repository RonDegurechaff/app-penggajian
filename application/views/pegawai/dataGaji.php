<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="table-responsive">
	    <table class="table table-striped table-bordered">
	    	<tr>
	    		<th class="text-center text-dark">Bulan/Tahun</th>
	    		<th class="text-center text-dark">Gaji Pokok</th>
	    		<th class="text-center text-dark">Tj. Transportasi</th>
	    		<th class="text-center text-dark">Uang Makan</th>
	    		<th class="text-center text-dark">Potongan</th>
	    		<th class="text-center text-dark">Total</th>
	    		<th class="text-center text-dark">Cetak Slip</th>
	    	</tr>

	    	<?php foreach ($potongan as $p) 
	    		$potongan = $p->jml_potongan;
	    	?>

	    	<?php foreach ($gaji as $g) : ?>
	    	<?php $pot_gaji = $g->alpa * $potongan ?>
		    	<tr>
		    		<td class="text-center text-dark"><?php echo substr($g->bulan, 0, 2);; echo"/" ,substr($g->bulan, 2, 4);; ?></td>
		    		<td class="text-center text-dark">Rp. <?php echo number_format($g->gaji_pokok,0,',','.'); ?>,-</td>
		    		<td class="text-center text-dark">Rp. <?php echo number_format($g->tj_transport,0,',','.'); ?>,-</td>
		    		<td class="text-center text-dark">Rp. <?php echo number_format($g->uang_makan,0,',','.'); ?>,-</td>
		    		<td class="text-center text-dark">Rp. <?php echo number_format($pot_gaji,0,',','.'); ?>,-</td>
		    		<td class="text-center text-dark">Rp. <?php echo number_format($g->gaji_pokok + $g->tj_transport + $g->uang_makan - $pot_gaji,0,',','.'); ?>,-</td>
		    		<td>
				        <center>
				          <a class="btn btn-sm btn-primary" href="<?= base_url('pegawai/dataGaji/cetakSlip/'.$g->id_kehadiran); ?>"><i class="fas fa-print"></i></a>
				        </center>
				    </td>
		    	</tr>
		    <?php endforeach; ?>
	    </table>
	</div>

</div>