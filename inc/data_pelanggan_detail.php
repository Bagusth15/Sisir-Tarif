<?php  
// $id = @$_GET['id'];
$id_pel = @$_GET['id_pel'];
$sql_per_id = mysqli_query($db, "SELECT * FROM pelanggan JOIN user ON user.nik = pelanggan.nik JOIN data_daya_tarif ON pelanggan.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil WHERE id_pel = '$id_pel'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);
$no = 1;
?>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title"> Pelanggan Detail </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Detail</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="border-bottom text-center pb-4">
                <img src="images/foto/<?= $data['gambar']; ?>" alt="profile" class="img-lg rounded-circle mb-3" />
                <p><?= $data['nama_lengkap']; ?></p>
                <a href="?page=data_pelanggan_proses&id_pel=<?= $id_pel; ?>" class="btn btn-outline-primary btn-icon-text btn-sm">
                  <i class="mdi mdi-file-check btn-icon-prepend"></i>
                  Proses Data
                </a>
                <a href="?page=data_pelanggan_manajemen&action=edit_pelanggan&id=<?= $data['id']; ?>" class="btn btn-outline-primary btn-icon-text btn-sm">
                  <i class="mdi mdi-file-document btn-icon-prepend"></i>
                  Edit Data
                </a>
                <a href="./laporan/cetak_pelanggan_detail.php?id_pel=<?php echo $id_pel; ?>" target="_blank" class="btn btn-outline-primary btn-icon-text btn-sm">
                  <i class="mdi mdi-printer btn-icon-prepend"></i>
                  Cetak Data
                </a> 
              </div>
              <div class="p-3">
                <p class="clearfix">
                  <span class="float-left"> Hari/Tanggal </span>
                  <span class="float-right text-muted"> <?= $data['date']; ?> </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> ID Pelanggan </span>
                  <span class="float-right text-muted"> <?= $data['id_pel']; ?> </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Nama Lengkap </span>
                  <span class="float-right text-muted"> <?= $data['nama']; ?> </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Alamat </span>
                  <span class="float-right text-muted"> <?= $data['alamat_pel']; ?> </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Tarif/Daya </span>
                  <span class="float-right text-muted"> <?= $data['daya_tarif']; ?> </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> No. Telp </span>
                  <span class="float-right text-muted"> <?= $data['no_telp']; ?> </span>
                </p>

                <p class="clearfix">
                  <span class="float-left"> Peruntukan Persil </span>
                  <span class="float-right text-muted"> <?= $data['peruntukan_persil']; ?> </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Keterangan </span>
                  <span class="float-right text-muted"><?= $data['keterangan']; ?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row pt-2">
    <div class="col-lg-12">
      <div class="card px-3">
        <div class="card-body">
          <h4 class="card-title">Gambar Usaha</h4>
          <div class="row mt-3">
            <div class="col-3 pr-1">
              <a href="images/pelanggan/<?= $data['foto_1']; ?>" class="image-tile" target="_blank">
                <img src="images/pelanggan/<?= $data['foto_1']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
              </a>
            </div>
            <div class="col-3 pr-1">
              <a href="images/pelanggan/<?= $data['foto_2']; ?>" class="image-tile" target="_blank">
                <img src="images/pelanggan/<?= $data['foto_2']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
              </a>
            </div>
            <div class="col-3 pr-1">
              <a href="images/pelanggan/<?= $data['foto_3']; ?>" class="image-tile" target="_blank">
                <img src="images/pelanggan/<?= $data['foto_3']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
              </a>
            </div>
            <div class="col-3 pr-1">
              <a href="images/pelanggan/<?= $data['foto_4']; ?>" class="image-tile" target="_blank">
                <img src="images/pelanggan/<?= $data['foto_4']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
  $sql_alat_pelanggan = mysqli_query($db, "SELECT * FROM alat_pelanggan JOIN pelanggan ON pelanggan.id_pel = alat_pelanggan.id_pel WHERE alat_pelanggan.id_pel = '$id_pel'") or die ($db->error);
  ?>
  <div class="row pt-2">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Peralatan Elektronik Yang Digunakan</h4>
          <a href="?page=manajemen_alat&action=alat_generate&id_pel=<?= $id_pel; ?>" class="btn btn-outline-primary btn-icon-text btn-sm float-right">
            <i class="mdi mdi-plus"></i>
            Tambah Alat
          </a>
          <a href="?page=data_pelanggan_detail&id=<?= $id; ?>&id_pel=<?= $id_pel; ?>" class="btn btn-outline-primary btn-sm float-right mr-1">
            <i class="mdi mdi-refresh"></i>
            Refresh
          </a>
          <form method="post" name="proses">
            <div class="table-responsive pt-3">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Peralatan</th>
                    <th>Daya <small>(VA)</small></th>
                    <th>Jumlah</th>
                    <th>Total Daya <small>(VA)</small></th>
                    <th>Digunakan Untuk</th>
                    <th>Pemakaian Alat <small>(Jam)</small></th>
                    <th>Pemakaian Perhari <small>(KWH)</small></th>
                    <th>Foto</th>
                    <th>
                      <center>
                        <input type="checkbox" id="select_all" value="">
                      </center>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if ( mysqli_num_rows($sql_alat_pelanggan) > 0 ) {
                    while($data_alat_pelanggan = mysqli_fetch_array($sql_alat_pelanggan)) { ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data_alat_pelanggan['nama_peralatan']; ?></td>
                        <td><?= $data_alat_pelanggan['daya']; ?></td>
                        <td><?= $data_alat_pelanggan['jumlah']; ?></td>
                        <td><?= $data_alat_pelanggan['total_daya']; ?></td>
                        <td><?= $data_alat_pelanggan['keperluan_untuk']; ?></td>
                        <td><?= $data_alat_pelanggan['pemakaian_alat']; ?></td>
                        <td><?= $data_alat_pelanggan['pemakaian_perkwh']; ?></td>
                        
                        <td>
                          <a href="images/alat_pelanggan/<?= $data_alat_pelanggan['foto']; ?>" target="_blank" class="image-tile _blank">
                            <img src="images/alat_pelanggan/<?= $data_alat_pelanggan['foto']; ?>" class="mb-2 mw-30 w-30 rounded" alt="image">
                          </a>
                        </td>
                        <td align="center">
                          <input type="checkbox" name="checked[]" class="check" value="<?= $data_alat_pelanggan['id_alat']; ?>">
                        </td>
                      </tr>
                    <?php }
                  } else {
                    echo "<tr><td></td></tr>";
                  } ?>
                </tbody>
              </table>
            </div>
          </form>
          <button class="btn btn-outline-success btn-icon-text btn-sm float-right " onclick="hapus_alat()">
            Hapus
          </button>
          <button class="btn btn-outline-danger btn-sm float-right mr-1" onclick="edit_alat()">
            Edit
          </button>
          

        </div>
      </div>
    </div>
  </div>
