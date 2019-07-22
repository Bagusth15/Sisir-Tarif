  <?php  
  $id_pel = $_GET['id_pel'];
  mysqli_query($db, "UPDATE pelanggan SET hits = '0' WHERE id_pel = '$id_pel' ") or die ($db->error);
  $sql_per_id = mysqli_query($db, "SELECT * FROM pelanggan JOIN user ON user.nik = pelanggan.nik JOIN data_daya_tarif ON pelanggan.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil WHERE id_pel = '$id_pel'") or die ($db->error);
  $data = mysqli_fetch_array($sql_per_id);
  ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Pelanggan Proses </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Proses</a></li>
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
                  <a href="?page=data_pelanggan_detail&id_pel=<?= $id_pel; ?>" class="btn btn-outline-primary btn-icon-text btn-sm">
                    <i class="mdi mdi-keyboard-backspace btn-icon-prepend"></i>
                    Kembali
                  </a>
                  <a href="./laporan/cetak_pelanggan_detail.php?id_pel=<?php echo $id_pel; ?>" target="_blank" class="btn btn-outline-primary btn-icon-text btn-sm">
                    <i class="mdi mdi-printer btn-icon-prepend"></i>
                    Cetak Data Pelanggan
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
                    <span class="float-right text-muted"> <?= $data['no_telp_pel']; ?> </span>
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

    <div class="row pt-3">
      <?php  
      $sql_rt = mysqli_query($db, "SELECT * FROM pelanggan JOIN user ON user.nik = pelanggan.nik JOIN alat_pelanggan ON pelanggan.id_pel = alat_pelanggan.id_pel WHERE pelanggan.id_pel = '$id_pel' AND keperluan_untuk = 'Rumah Tangga' ") or die ($db->error);
      $sql_sum_rt = mysqli_query($db, "SELECT sum(pemakaian_perkwh) as total FROM pelanggan JOIN user ON user.nik = pelanggan.nik JOIN alat_pelanggan ON pelanggan.id_pel = alat_pelanggan.id_pel WHERE pelanggan.id_pel = '$id_pel' AND keperluan_untuk = 'Rumah Tangga' ") or die ($db->error);
      $data_total_rt = mysqli_fetch_array($sql_sum_rt);
      ?>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Peralatan Elektronik Yang Digunakan Untuk Rumah Tangga</h4>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Peralatan</th>
                    <th>Foto</th>
                    <th>KWH Perhari</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if (mysqli_num_rows($sql_rt) == 0) {
                    ?>
                    <tr><td colspan="7" align="center">Tidak Ada</td></tr>
                  <?php } else {
                    $no = 1;
                    while($data_rt = mysqli_fetch_array($sql_rt)) { 
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data_rt['nama_peralatan']; ?></td>
                        <td>
                          <a href="images/alat_pelanggan/<?= $data_rt['foto']; ?>" target="_blank" class="image-tile _blank">
                            <img src="images/alat_pelanggan/<?= $data_rt['foto']; ?>" class="mb-2 mw-30 w-30 rounded" alt="image">
                          </a>
                        </td>
                        <td><?= $data_rt['pemakaian_perkwh']; ?> Kwh</td>
                      </tr>
                      <?php 
                    }
                  }     
                  ?>
                  <hr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Jumlah Total</td>
                    <?php 
                    if (mysqli_num_rows($sql_rt) == 0) {
                      ?>
                      <td>0 Kwh</td>
                    <?php } else { ?>
                      <td><?= number_format($data_total_rt['total'],2); ?> Kwh</td>
                    <?php } ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php  
      $sql_b = mysqli_query($db, "SELECT * FROM pelanggan JOIN user ON user.nik = pelanggan.nik JOIN alat_pelanggan ON pelanggan.id_pel = alat_pelanggan.id_pel WHERE pelanggan.id_pel = '$id_pel' AND keperluan_untuk = 'Bisnis' ") or die ($db->error);
      $sql_sum_b = mysqli_query($db, "SELECT sum(pemakaian_perkwh) as total FROM pelanggan JOIN user ON user.nik = pelanggan.nik JOIN alat_pelanggan ON pelanggan.id_pel = alat_pelanggan.id_pel WHERE pelanggan.id_pel = '$id_pel' AND keperluan_untuk = 'Bisnis' ") or die ($db->error);
      $data_total_b = mysqli_fetch_array($sql_sum_b);
      ?>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Peralatan Elektronik Yang Digunakan Untuk Bisnis</h4>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Peralatan</th>
                    <th>Foto</th>
                    <th>KWH Perhari</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if (mysqli_num_rows($sql_b) == 0) {
                    ?>
                    <tr><td colspan="7" align="center">Tidak Ada</td></tr>
                  <?php } else {
                    $no = 1;
                    while($data_b = mysqli_fetch_array($sql_b)) { 
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data_b['nama_peralatan']; ?></td>
                        <td>
                          <a href="images/alat_pelanggan/<?= $data_b['foto']; ?>" target="_blank" class="image-tile _blank">
                            <img src="images/alat_pelanggan/<?= $data_b['foto']; ?>" class="mb-2 mw-30 w-30 rounded" alt="image">
                          </a>
                        </td>
                        <td><?= $data_b['pemakaian_perkwh']; ?> Kwh</td>
                      </tr>
                      <?php 
                    }
                  }     
                  ?>
                  <hr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Jumlah Total</td>
                    <?php 
                    if (mysqli_num_rows($sql_b) == 0) {
                      ?>
                      <td>0 Kwh</td>
                    <?php } else { ?>
                      <td><?= number_format($data_total_b['total'],2); ?> Kwh</td>
                    <?php } ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="row pt-3">
      <div class="col-12">
        <form action="" method="post">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="k">Input Nilai K</label>
                <input type="number" class="form-control" name="k" placeholder="Ex : 1" required>
              </div>
            </div>
            <button name="Hitung" id="Hitung" class="btn btn-gradient-primary">Hitung</button>
          </div>
        </form>
      </div>
    </div> -->

    <?php  
    // if (isset($_POST["Hitung"])) {
      $sql_testing = mysqli_query($db, "SELECT * FROM data_testing JOIN data_daya_tarif ON data_testing.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON data_testing.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil WHERE id_pel = '$id_pel' ") or die ($db->error);
      $data_testing = mysqli_fetch_array($sql_testing);

      $k=3;
      $d_kwh_rt=$data_testing['kwh_rt'];
      $d_kwh_bisnis=$data_testing['kwh_bisnis'];
      $d_id_daya_tarif=$data_testing['id_daya_tarif'];
      $d_id_peruntukan_persil=$data_testing['id_peruntukan_persil'];

      $sql_training = mysqli_query($db, "SELECT * FROM data_training ORDER BY id_dt ASC");
      $num_rows = mysqli_num_rows($sql_training);

      for($i=1; $i <= $num_rows; $i++) 
      {
        $sql1 = mysqli_query($db, "SELECT * FROM data_training Where id_dt = $i ");
        while($data = mysqli_fetch_array($sql1))
        {
          $kwh_rt = str_replace(array(".", ","), array(",","."), $data['kwh_rt']);
          $kwh_bisnis = str_replace(array(".", ","), array(",","."), $data['kwh_bisnis']);

      //Pengurangan(KNN)
          $v1 = $d_kwh_rt - $kwh_rt;
          $v2 = $d_kwh_bisnis - $kwh_bisnis;
          $v3 = $d_id_daya_tarif - $data['id_daya_tarif'];
          $v4 = $d_id_peruntukan_persil - $data['id_peruntukan_persil'];


      // //Pengkuadratan(KNN)
          $hit1 = (pow($v1,2)) + (pow($v2,2)) + (pow($v3,2)) + (pow($v4,2));
      // //Pengakaran(KNN)
          $hit2 = sqrt($hit1);
          $jarak = number_format($hit2, 5, ',', '');
      // Penyimpanan perhitungan ke database sementara
          mysqli_query($db, "INSERT INTO data_proses (id_proses,
            id_pel,
            kwh_rt,
            kwh_bisnis,
            id_daya_tarif,
            id_peruntukan_persil,
            hasil,
            jarak)
            VALUES ('$i',
            '$id_pel',
            '$data[kwh_rt]',
            '$data[kwh_bisnis]',
            '$data[id_daya_tarif]',
            '$data[id_peruntukan_persil]',
            '$data[hasil]',
            '$jarak')");
        }
      }

      $sql_hasil = mysqli_query($db, "SELECT * FROM data_proses JOIN data_daya_tarif ON data_proses.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON data_proses.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil 
        ORDER BY 
        1*SUBSTRING_INDEX(jarak, ',', 1) ASC,
        1*SUBSTRING_INDEX(SUBSTRING(jarak, ',', -3), ',', 1) ASC,
        1*SUBSTRING_INDEX(SUBSTRING(jarak, ',', -2), ',', 1) ASC,          
        1*SUBSTRING_INDEX(jarak, ',', -1) ASC,
        jarak ASC
        LIMIT $k ") or die ($db->error);

      while($data_hasil = mysqli_fetch_array($sql_hasil))
      {     
        $id_pel = $data_hasil['id_pel'];
        $kwh_rt = $data_hasil['kwh_rt'];
        $kwh_bisnis = $data_hasil['kwh_bisnis'];
        $id_daya_tarif = $data_hasil['id_daya_tarif'];
        $id_peruntukan_persil = $data_hasil['id_peruntukan_persil'];
        $hasil = $data_hasil['hasil'];
        $jarak = $data_hasil['jarak'];
      // echo $jarak;
        mysqli_query($db, "INSERT INTO data_hasil VALUES(
          '', '$id_pel', 
          '$kwh_rt',
          '$kwh_bisnis',
          '$id_daya_tarif',
          '$id_peruntukan_persil',
          '$hasil', '$jarak'
          )
          ") or die ($db->error);
      }

      ?>
      <div class="row pt-3">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h3 align="center">Perhitungan K-Nearest Neighbor</h3>
              <hr>
              <p align="center">Nilai K = <?= $k; ?></p>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr align="center">
                      <th>KWH Perhari <small>(Rumah Tangga)</small></th>
                      <th>KWH Perhari <small>(Bisnis)</small></th>
                      <th>Daya / Tarif</th>
                      <th>Peruntukan Persil</th>
                      <th>Hasil</th>
                    </tr>
                  </thead>
                  <?php  

                  ?>
                  <tbody>
                    <tr align="center">
                      <td><?= number_format($data_testing['kwh_rt'],2); ?></td>
                      <td><?= number_format($data_testing['kwh_bisnis'],2);?></td>
                      <td><?= $data_testing['id_daya_tarif'];?> ( <?= $data_testing['daya_tarif'];?> )</td>
                      <td><?= $data_testing['id_peruntukan_persil'];?> ( <?= $data_testing['peruntukan_persil'];?> )</td>
                      <td>?</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <hr>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>KWH Perhari <small>(Rumah Tangga)</small></th>
                    <th>KWH Perhari <small>(Bisnis)</small></th>
                    <th>Daya / Tarif</th>
                    <th>Peruntukan Persil</th>
                    <th>Jarak</th>
                    <th>Hasil</th>
                  </tr>
                </thead>
                <?php  
                $no = 1;
                $sql_data_hasil = mysqli_query($db, "SELECT * FROM data_hasil JOIN data_daya_tarif ON data_hasil.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON data_hasil.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil ") or die ($db->error);
                ?>
                <tbody>
                  <?php 
                  $no = 1;
                  while ($data_hasil= mysqli_fetch_array($sql_data_hasil)) {
                    ?>
                    <tr class="table-info">
                      <td><?= $no++; ?></td>
                      <td><?= $data_hasil['kwh_rt']; ?></td>
                      <td><?= $data_hasil['kwh_bisnis']; ?></td>
                      <td><?= $data_hasil['id_daya_tarif']; ?> ( <?= $data_hasil['daya_tarif']; ?> )</td>
                      <td><?= $data_hasil['id_peruntukan_persil']; ?> ( <?= $data_hasil['peruntukan_persil']; ?> )</td>
                      <td><?= $data_hasil['jarak']; ?></td>
                      <td><?= $data_hasil['hasil']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <hr>
              <?php  
              $sql_hasil_1 = mysqli_query($db, "SELECT * FROM data_hasil WHERE hasil = 'Disetujui' ") or die ($db->error);
              $sql_hasil_2 = mysqli_query($db, "SELECT * FROM data_hasil WHERE hasil = 'Tidak Disetujui' ") or die ($db->error);
              $data_hasil_1 = mysqli_num_rows($sql_hasil_1);
              $data_hasil_2 = mysqli_num_rows($sql_hasil_2);
              ?>
              <p>Dari hasil perhitungan menggunakan metode K-NN diketahui nilai k = <?= $k; ?>, <br> dan didapatkan hasil : Disetujui = <?= $data_hasil_1; ?>, Tidak Disetujui = <?= $data_hasil_2; ?></p>
            </div>
          </div>
          <?php if ($data_hasil_1 < $data_hasil_2): ?>
            <a href="./laporan/cetak_berita_acara.php?id_pel=<?php echo $id_pel; ?>" target="_blank" class="btn btn-gradient-primary btn-icon-text btn-block">
              <i class="mdi mdi-printer btn-icon-prepend"></i>
              Cetak Berita Acara
            </a> 
          <?php endif ?>
        </div>
      </div>
      <!-- DATA TRAINING -->
      <?php  
      $no = 1;
      $sql_data_training = mysqli_query($db, "SELECT * FROM data_proses JOIN data_daya_tarif ON data_proses.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON data_proses.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil") or die ($db->error);
      ?>
      <div class="row pt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h3 align="center">Data Training</h3>
              <hr>
              <div class="table-responsive">
                <table class="table" id="myTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>KWH Perhari <small>(Rumah Tangga)</small></th>
                      <th>KWH Perhari <small>(Bisnis)</small></th>
                      <th>Daya / Tarif</th>
                      <th>Peruntukan Persil</th>
                      <th>Hasil</th>
                      <th>Jarak</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($data_training = mysqli_fetch_array($sql_data_training)) {?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data_training['kwh_rt']; ?></td>
                        <td><?= $data_training['kwh_bisnis']; ?></td>
                        <td><?= $data_training['id_daya_tarif']; ?> ( <?= $data_training['daya_tarif']; ?> )</td>
                        <td><?= $data_training['id_peruntukan_persil']; ?> ( <?= $data_training['peruntukan_persil']; ?> )</td>
                        <td><?= $data_training['hasil']; ?></td>
                        <td><?= $data_training['jarak']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php  
    mysqli_query($db, "DELETE FROM data_hasil WHERE id_pel = '$id_pel'") or die ($db->error);
    mysqli_query($db, "DELETE FROM data_proses WHERE id_pel = '$id_pel'") or die ($db->error);
    ?>