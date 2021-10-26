<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>

  <div class="card mx-auto" style="width: 35%;">
    <div class="card-header bg-primary text-white text-center">
      Filter Laporan Gaji Pegawai
    </div>

    <form>
      <div class="card-body">
        <div class="form-group row">
          <label for="staticEmail2" class="col-sm-3 col-form-label">Bulan :</label>
          <div class="col-sm-9">
            <select class="form-control" name="bulan">
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
        </div>

        <div class="form-group row">
          <label for="staticEmail2" class="col-sm-3 col-form-label">Tahun :</label>
          <div class="col-sm-9">
            <select class="form-control" name="tahun">
              <option value="">-- Pilih Tahun --</option>
              <?php $tahun = date('Y');
              for ($i = 2020; $i < $tahun + 5; $i++) { ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <?php
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
          $bulan = $_GET['bulan'];
          $tahun = $_GET['tahun'];
          $bulantahun = $bulan . $tahun;
        } else {
          $bulan = date('m');
          $tahun = date('Y');
          $bulantahun = $bulan . $tahun;
        }
        ?>
        <center>
          <table>
            <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-sync-alt"></i> Set Data</button>

            <a href="<?php echo base_url('admin/LaporanGaji/cetakLaporanGaji?bulan=' . $bulan), '&tahun=' . $tahun ?>" class="btn btn-success mb-2 ml-3"><i class="fas fa-print"></i> Cetak Data Gaji</a>
          </table>
        </center>
      </div>
    </form>
  </div>
</div>