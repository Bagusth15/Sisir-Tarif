<?php if ($data_terlogin['hak_akses'] != 'Karyawan'): ?>
<?php
$sql_pelanggan = mysqli_query($db, "SELECT * FROM pelanggan JOIN data_daya_tarif ON pelanggan.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil WHERE hits = '1' LIMIT 5 ") or die ($db->error);
$no = 1;
?>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Data Pelanggan
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Table</li>
        <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
      </ol>
    </nav>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
      <a href="?page=data_pelanggan_manajemen&action=tambah_pelanggan" class="btn btn-gradient-primary">Tambah Data Pelanggan</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Yang Belum Di Proses</h5>
          <hr>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>ID Pelanggan</th>
                  <th>Nama Pelanggan</th>
                  <th>Tarif/Daya</th>
                  <th>Peruntukan Persil</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if (mysqli_num_rows($sql_pelanggan) == 0) {
                  ?>
                  <tr><td colspan="7" align="center">Data tidak ditemukan</td></tr>
                <?php } else {
                  while($data_pelanggan = mysqli_fetch_array($sql_pelanggan)) { 
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data_pelanggan['id_pel']; ?></td>
                      <td><?= $data_pelanggan['nama']; ?></td>
                      <td><?= $data_pelanggan['daya_tarif']; ?></td>
                      <td><?= $data_pelanggan['peruntukan_persil']; ?></td>
                      <td><?= $data_pelanggan['keterangan']; ?></td>
                      <td>
                        <a href="?page=data_pelanggan_detail&id_pel=<?= $data_pelanggan['id_pel']; ?>" class="btn btn-gradient-primary btn-sm">Detail</a>
                      </td>
                    </tr>
                    <?php 
                  }
                }     
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php  
$sql_pelanggan_proses = mysqli_query($db, "SELECT * FROM pelanggan JOIN data_daya_tarif ON pelanggan.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil WHERE hits = '0' ") or die ($db->error);
?>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Yang Sudah Di Proses</h4>
          <hr>
          <div class="table-responsive">
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>ID Pelanggan</th>
                  <th>Nama Pelanggan</th>
                  <th>Tarif/Daya</th>
                  <th>Peruntukan Persil</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                while($data_pelanggan_proses = mysqli_fetch_array($sql_pelanggan_proses)) { 
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $data_pelanggan_proses['id_pel']; ?></td>
                  <td><?= $data_pelanggan_proses['nama']; ?></td>
                  <td><?= $data_pelanggan_proses['daya_tarif']; ?></td>
                  <td><?= $data_pelanggan_proses['peruntukan_persil']; ?></td>
                  <td><?= $data_pelanggan_proses['keterangan']; ?></td>
                  <td>
                    <a href="?page=data_pelanggan_detail&id_pel=<?= $data_pelanggan_proses['id_pel']; ?>" class="badge badge-gradient-primary btn-sm" style="text-decoration: none;">Detail</a><br>
                    <a href="?page=data_pelanggan_manajemen&action=edit_pelanggan&id=<?= $data_pelanggan_proses['id']; ?>" class="badge badge-gradient-success btn-sm" style="text-decoration: none;">Edit</a><br>
                    <a href="?page=data_pelanggan_manajemen&action=hapus_pelanggan&id_pel=<?= $data_pelanggan_proses['id_pel']; ?>" class="badge badge-gradient-danger btn-sm tombol-hapus" style="text-decoration: none;">Hapus</a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php elseif ($data_terlogin['hak_akses'] == 'Karyawan'): ?>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Data Pelanggan
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Table</li>
        <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
      </ol>
    </nav>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
      <a href="?page=data_pelanggan_manajemen&action=tambah_pelanggan" class="btn btn-gradient-primary">Tambah Data Pelanggan</a>
      </div>
    </div>
  </div>

<?php  
$no = 1;
$sql_pelanggan_proses = mysqli_query($db, "SELECT * FROM pelanggan JOIN data_daya_tarif ON pelanggan.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil WHERE pelanggan.nik = '$_SESSION[karyawan]' ") or die ($db->error);
?>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>ID Pelanggan</th>
                  <th>Nama Pelanggan</th>
                  <th>Tarif/Daya</th>
                  <th>Peruntukan Persil</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                while($data_pelanggan_proses = mysqli_fetch_array($sql_pelanggan_proses)) { 
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $data_pelanggan_proses['id_pel']; ?></td>
                  <td><?= $data_pelanggan_proses['nama']; ?></td>
                  <td><?= $data_pelanggan_proses['daya_tarif']; ?></td>
                  <td><?= $data_pelanggan_proses['peruntukan_persil']; ?></td>
                  <td><?= $data_pelanggan_proses['keterangan']; ?></td>
                  <?php if ($data_pelanggan_proses['hits'] == '0'): ?>
                  <td>Data Sudah Di Proses</td>
                  <?php elseif ($data_pelanggan_proses['hits'] == '1'): ?>
                  <td>Data Menunggu Di Proses</td>
                  <?php endif ?>
                  <td>
                    <a href="?page=data_pelanggan_detail&id_pel=<?= $data_pelanggan_proses['id_pel']; ?>" class="badge badge-gradient-primary btn-sm" style="text-decoration: none;">Detail</a><br>
                    <a href="?page=data_pelanggan_manajemen&action=edit_pelanggan&id=<?= $data_pelanggan_proses['id']; ?>" class="badge badge-gradient-success btn-sm" style="text-decoration: none;">Edit</a><br>
                    <a href="?page=data_pelanggan_manajemen&action=hapus_pelanggan&id_pel=<?= $data_pelanggan_proses['id_pel']; ?>" class="badge badge-gradient-danger btn-sm tombol-hapus" style="text-decoration: none;">Hapus</a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>