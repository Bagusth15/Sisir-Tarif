<?php
@session_start();
include "+koneksi.php";
$id_pel = @$_GET['id_pel'];
if(@$_SESSION['superadmin'] || @$_SESSION['admin'] || @$_SESSION['karyawan']) {
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sisir Tarif | <?php cek_session("Halaman Administrator", "Halaman Admin", "Halaman Karyawan"); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
  </head>
  <?php
  if(@$_SESSION['superadmin']) { 
    $sql_terlogin = mysqli_query($db, "SELECT * FROM user WHERE nik = '$_SESSION[superadmin]' ") or die ($db->error);
    $data_terlogin = mysqli_fetch_array($sql_terlogin);
  } elseif (@$_SESSION['admin']) {
    $sql_terlogin = mysqli_query($db, "SELECT * FROM user WHERE nik = '$_SESSION[admin]' ") or die ($db->error);
    $data_terlogin = mysqli_fetch_array($sql_terlogin);
  } else {
    $sql_terlogin = mysqli_query($db, "SELECT * FROM user WHERE nik = '$_SESSION[karyawan]' ") or die ($db->error);
    $data_terlogin = mysqli_fetch_array($sql_terlogin);
  }
  ?>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="./"><img src="images/logo.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="./"><img src="images/logo-mini.svg" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <div class="search-field d-none d-md-block">
            <!-- <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>                
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Cari Data Pelanggan..">
              </div>
            </form> -->
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <?php if ($data_terlogin['hak_akses'] != 'Karyawan'): ?>

              <?php  
              $sql_notif = mysqli_query($db, "SELECT * FROM pelanggan JOIN user ON pelanggan.nik = user.nik WHERE hits = '1' LIMIT 5 ");
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-file-outline"></i>
                  <?php  
                  if (mysqli_num_rows($sql_notif) > 0) {
                    ?>
                    <span class="count-symbol bg-warning"></span>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                      <h6 class="p-1 mb-0">Data Masuk</h6>
                      <?php  
                    } else { ?>
                      <span class="count-symbol bg-danger"></span>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                        <p class="p-1 mb-0" align="center">Tidak Ada Data Masuk </p>
                        <?php 
                      }
                      ?>
                    </a>
                    <?php while($data_notif = mysqli_fetch_array($sql_notif)) { ?>
                      <div class="dropdown-divider"></div>
                      <a href="?page=data_pelanggan_detail&id_pel=<?= $data_notif['id_pel']; ?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                          <img src="images/foto/<?= $data_notif['gambar']; ?>" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                          <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?= $data_notif['nama_lengkap']; ?> Mengirimkan Data</h6>
                          <p class="text-gray mb-0">
                            <?= $data_notif['date']; ?>
                          </p>
                        </div>
                      </a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <a href="?page=data_pelanggan" style="text-decoration: none; color: black;"><h6 class="p-3 mb-0 text-center">Lihat Semua</h6></a>
                  </div>
                </li>
              <?php endif ?>

              <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                  <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-format-line-spacing"></i>
                </a>
              </li>
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-img">
                    <img src="images/foto/<?= ucfirst($data_terlogin['gambar']); ?>" alt="image">
                    <span class="availability-status online"></span>             
                  </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="?page=users_detail&action=editusers&nik=<?= $data_terlogin['nik']; ?>">
                    <i class="mdi mdi-account-settings-variant mr-2 text-success"></i>
                    Edit Profil
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php cek_session('inc/logout.php?sesi=superadmin', 'inc/logout.php?sesi=admin', 'inc/logout.php?sesi=karyawan'); ?>">
                    <i class="mdi mdi-logout mr-2 text-primary"></i>
                    Signout
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>

        <!-- BATAS ATAS -->


        <!-- NAVBAR ATAS -->
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_sidebar.html -->
          <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item nav-profile">
                <a href="?page=users_detail" class="nav-link">
                  <div class="nav-profile-image">
                    <img src="images/foto/<?= ucfirst($data_terlogin['gambar']); ?>" alt="profile">
                    <span class="login-status online"></span> <!--change to offline or busy as needed-->              
                  </div>
                  <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?php echo ucfirst($data_terlogin['nama_lengkap']); ?></span>
                    <span class="text-secondary text-small"><?php echo ucfirst($data_terlogin['hak_akses']); ?></span>
                  </div>
                  <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
              </li>


              <li class="nav-item <?php if(@$_GET['page'] == '') { echo 'active'; } ?>">
                <a class="nav-link" href="./">
                  <span class="menu-title">Dashboard</span>
                  <i class="mdi mdi-home menu-icon"></i>
                </a>
              </li>

              <?php if ($data_terlogin['hak_akses'] != 'Karyawan'): ?>
                <li class="nav-item <?php if(@$_GET['page'] == 'user_admin') { echo 'active'; } elseif(@$_GET['page'] == 'user_karyawan') { echo 'active'; }  ?>">
                  <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-title">Manajemen User</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-account-network menu-icon"></i>
                  </a>
                  <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="?page=user_karyawan">Karyawan</a></li>
                      </ul>
                    </div>
                  </li>


                  <li class="nav-item <?php if(@$_GET['page'] == 'data_tarif_daya') { echo 'active'; } elseif(@$_GET['page'] == 'data_peruntukan_persil') { echo 'active'; }  ?>">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
                      <span class="menu-title">Manajemen Data</span>
                      <i class="menu-arrow"></i>
                      <i class="mdi mdi-book menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-basic1">
                      <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> 
                          <a class="nav-link" href="?page=data_tarif_daya">Daya / Tarif</a></li>
                          <li class="nav-item">
                            <a class="nav-link" href="?page=data_peruntukan_persil">Peruntukan Persil</a></li>
                          </ul>
                        </div>
                      </li>
                    <?php endif ?>

                    <li class="nav-item <?php if(@$_GET['page'] == 'data_pelanggan') { echo 'active'; } ?>">
                      <a class="nav-link" href="?page=data_pelanggan">
                        <span class="menu-title">Data Pelanggan</span>
                        <i class="mdi mdi-file menu-icon"></i>
                      </a>
                    </li>
                    <?php if ($data_terlogin['hak_akses'] == 'Admin'): ?>
                      <li class="nav-item <?php if(@$_GET['page'] == 'data_training') { echo 'active'; } ?>">
                        <a class="nav-link" href="?page=data_training">
                          <span class="menu-title">Data Training</span>
                          <i class="mdi mdi-file-chart menu-icon"></i>
                        </a>
                      </li>
                    <?php endif ?>
                  </ul>
                </nav>
                <!-- NAVBAR BAWAH -->

                <!-- partial -->
                <div class="main-panel">

                 <!-- batas awal -->  
                 <?php
                 if(@$_GET['page'] == '') {
                  include "inc/dashboard.php";
                } else if(@$_GET['page'] == 'user_admin') {
                  include "inc/user_admin.php";
                } else if(@$_GET['page'] == 'user_karyawan') {
                  include "inc/user_karyawan.php";
                } else if(@$_GET['page'] == 'users_detail') {
                  include "inc/users_detail.php";
                } else if(@$_GET['page'] == 'user_detail') {
                  include "inc/user_detail.php";
                } else if(@$_GET['page'] == 'data_tarif_daya') {
                  include "inc/data_tarif_daya.php";
                } else if(@$_GET['page'] == 'data_peruntukan_persil') {
                  include "inc/data_peruntukan_persil.php";
                    // } else if(@$_GET['page'] == 'user_tambah') {
                    //   include "inc/user_tambah.php";
                    // } else if(@$_GET['page'] == 'user_edit') {
                    //   include "inc/user_edit.php";
                } else if(@$_GET['page'] == 'data_pelanggan') {
                  include "inc/data_pelanggan.php";
                } else if(@$_GET['page'] == 'data_pelanggan_manajemen') {
                  include "inc/data_pelanggan_manajemen.php";
                } else if(@$_GET['page'] == 'data_pelanggan_detail') {
                  include "inc/data_pelanggan_detail.php";
                } else if(@$_GET['page'] == 'data_pelanggan_proses') {
                  include "inc/data_pelanggan_proses.php";
                } else if(@$_GET['page'] == 'data_training') {
                  include "inc/data_training.php";
                } else if(@$_GET['page'] == 'manajemen_alat') {
                  include "inc/manajemen_alat.php";
                } else {
                  include "inc/error-404.php";
                } ?>
                <!-- batas akhir -->


                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                  <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 Version 0.0</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Bagus TH made with <i class="mdi mdi-heart text-danger"></i></span>
                  </div>
                </footer>
                <!-- partial -->
              </div>
              <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
          </div>
          <!-- container-scroller -->

          <!-- plugins:js -->
          <script src="vendors/js/vendor.bundle.base.js"></script>
          <script src="vendors/js/vendor.bundle.addons.js"></script>
          <!-- endinject -->
          <!-- Plugin js for this page-->
          <!-- End plugin js for this page-->
          <!-- inject:js -->
          <script src="js/off-canvas.js"></script>
          <script src="js/misc.js"></script>
          <!-- endinject -->
          <!-- Custom js for this page-->
          <script src="js/dashboard.js"></script>
          <script src="js/chart.js"></script>
          <script src="js/sweetalert2.all.min.js"></script>
          <script src="js/myscript.js"></script>
          <!-- End custom js for this page-->
          <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
          <script>
            $(document).ready( function () {
              $('#myTable').DataTable();
            });
          </script>
          <script>
            function edit_alat() {
              document.proses.action = '?page=manajemen_alat&action=alat_edit&id_pel=<?= $id_pel;?>';
              document.proses.submit();
            };

            function hapus_alat() {
              var conf = confirm('Yakin akan menghapus data ?');
              if (conf) {
                document.proses.action = '?page=manajemen_alat&action=alat_hapus&id_pel=<?= $id_pel;?>';
                document.proses.submit();
              }
            };
          </script>
        </body>

        </html>
        <?php    
      } else { 
        include "login.php";
      }
      ?>