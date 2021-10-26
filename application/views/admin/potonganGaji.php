<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan'); ?>

    <a href="<?php echo base_url('admin/potonganGaji/tambahData'); ?>" class="btn btn-sm btn-primary mb-2 mt-2"><i class="fas fa-plus"></i> Tambah Data</a>

    <table class="table table-bordered table-striped" style="margin-bottom: 100px">
    	<tr>
    		<th class="text-center text-dark">No.</th>
    		<th class="text-center text-dark">Jenis Potongan</th>
    		<th class="text-center text-dark">Jumlah Potongan</th>
    		<th class="text-center text-dark">Action</th>
    	</tr>

    	<?php $no=1; foreach ($pot_gaji as $p) : ?>
    	<tr>
    		<td class="text-center text-dark"><?php echo $no++ ?></td>
    		<td class="text-center text-dark"><?php echo $p->potongan  ?></td>
    		<td class="text-center text-dark">Rp. <?php echo number_format($p->jml_potongan,0,',','.') ?></td>
    		<td>
    			<center>
    				<a href="<?php echo base_url('admin/potonganGaji/updateData/' .$p->id); ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
    				<a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/potonganGaji/deleteData/'.$p->id) ?>"><i class="fas fa-trash"></i></a>
    			</center>
    		</td>
    	</tr>
    	<?php endforeach; ?>
    </table>

</div>