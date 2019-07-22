<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>                 
      </span>
      Dashboard
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview
          <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <?php if ($data_terlogin['hak_akses'] == 'Admin'): ?>
    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
            <h4 class="font-weight-normal mb-3">Data Karyawan
              <i class="mdi mdi-account mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">
              <?php
              $sql_karyawan = mysqli_query($db, "SELECT * FROM user") or die ($db->error);
              echo mysqli_num_rows($sql_karyawan);
              ?>
              <small>Data</small>
            </h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
            <h4 class="font-weight-normal mb-3">Data Pelanggan
              <i class="mdi mdi-file mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">
              <?php
              $sql_pelanggan = mysqli_query($db, "SELECT * FROM pelanggan") or die ($db->error);
              echo mysqli_num_rows($sql_pelanggan);
              ?>
              <small>Data</small>
            </h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
            <h4 class="font-weight-normal mb-3">Data Training
              <i class="mdi mdi-file-chart mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">
              <?php
              $sql_data_training = mysqli_query($db, "SELECT * FROM data_training") or die ($db->error);
              echo mysqli_num_rows($sql_data_training);
              ?>
              <small>Data</small>
            </h2>
          </div>
        </div>
      </div>
    </div>
    <?php endif ?>

    <?php if ($data_terlogin['hak_akses'] == 'Karyawan'): ?>
    <div class="row">
      <div class="col-md-6 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
            <h4 class="font-weight-normal mb-3">Total Data Pelanggan
              <i class="mdi mdi-file mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">
              <?php
              $sql_pelanggan = mysqli_query($db, "SELECT * FROM pelanggan ") or die ($db->error);
              echo mysqli_num_rows($sql_pelanggan);
              ?>
              <small>Data</small>
            </h2>
          </div>
        </div>
      </div>
      <div class="col-md-6 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
          <div class="card-body">
            <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
            <h4 class="font-weight-normal mb-3">Data Pelanggan Yang Anda Survei
              <i class="mdi mdi-file mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">
              <?php
              $sql_pelanggan = mysqli_query($db, "SELECT * FROM pelanggan WHERE nik = '$_SESSION[karyawan]' ") or die ($db->error);
              echo mysqli_num_rows($sql_pelanggan);
              ?>
              <small>Data</small>
            </h2>
          </div>
        </div>
      </div>
    </div>
  <?php endif ?>
  
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">History User Online</h4>
            <div class="table-responsive">
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <!-- <th>#</th> -->
                    <th>Last Update</th>
                    <th>Nama Lengkap</th>
                    <th>No Telp</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                    $sql_user_online = mysqli_query($db, "SELECT * FROM user_online JOIN user ON user.nik = user_online.nik") or die ($db->error);
                    $no = 1;
                    while($data_user_online = mysqli_fetch_array($sql_user_online)) {
                  ?>
                  <tr>
                    <!-- <td><?= $data_user_online['id']; ?></td> -->
                    <td><?= $data_user_online['history']; ?></td>
                    <td>
                      <img src="images/foto/<?= $data_user_online['gambar']; ?>" class="mr-2" alt="image">
                        <?= $data_user_online['nama_lengkap']; ?>
                    </td>
                    <td><?= $data_user_online['no_telp']; ?></td>
                    <td>
                      <?php if ($data_user_online['status_ol'] == 'ONLINE'): ?>
                        <label class="badge badge-gradient-primary">ONLINE</label>
                      <?php elseif ($data_user_online['status_ol'] == 'OFFLINE'): ?>
                        <label class="badge badge-gradient-danger">OFFLINE</label>
                      <?php endif ?>
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