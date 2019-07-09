<?php 
$nik = @$_GET['nik'];
$sql_per_id = mysqli_query($db, "SELECT * FROM user WHERE nik = '$nik'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);
?>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title"> Manajemen User </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">User Detail</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="border-bottom text-center pb-4">
                <img src="images/faces/face1.jpg" alt="profile" class="img-lg rounded-circle mb-3" />
                <p>David Grey. H</p>
                
              </div>
              <div class="py-4">
                <p class="clearfix">
                  <span class="float-left"> Status </span>
                  <span class="float-right text-muted"> Aktif </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Nama Lengkap </span>
                  <span class="float-right text-muted"> David Grey. H </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Email </span>
                  <span class="float-right text-muted"> Jacod@testmail.com </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> No. HP </span>
                  <span class="float-right text-muted"> 006 3435 22 </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Jenis Kelamin </span>
                  <span class="float-right text-muted"> Pria </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Alamat </span><br>
                  <span class="float-left text-muted"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem dolorem totam tempore beatae odio, sint accusantium est animi officia quas ab natus et ipsa cum voluptatum ipsum rem labore. Quibusdam. </span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Username </span>
                  <span class="float-right text-muted">David Grey</span>
                </p>
                <p class="clearfix">
                  <span class="float-left"> Password </span>
                  <span class="float-right text-muted">@davidgrey</span>
                </p>
              </div>
              <button onclick="self.history.back();" class="btn btn-gradient-primary btn-block">Kembali</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>