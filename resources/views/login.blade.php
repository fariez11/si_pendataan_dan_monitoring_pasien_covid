<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sistem Informasi Monitoring Pasien Covid-19</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary" style="margin-top: 70px;">
              <div class="card-header">
                <img src="assets/img/logo.png">
                <br><!-- <h4>Login</h4> -->              
              </div>
              <div class="card-body">
                <form method="get" action="/actlog" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="text" class="form-control" name="user" tabindex="1" required="">
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                      <!--   <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a> -->
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="pass" tabindex="2" required="">
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                    <?php 
                        if($sql == null){
                    ?>
                    <a type="button" class="btn btn-primary btn-lg btn-block" tabindex="4" data-toggle="modal" data-target="#regis">
                      Daftar
                    </a>
                  <?php }else{} ?>
                  </div>
                </form>
              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="regis" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Staf IT</h5>
        </div>
        <form action="{{url('/regis')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                    @foreach($idp as $id)
                    <input type="hidden" name="idp" value="{{$id->PENG_ID+1}}" readonly="">
                    @endforeach

                    <input type="hidden" name="level" value="Staf IT" readonly="">
                    <center>
                        FOTO<br>
                       <img id="image-preview" style="width: 130px; height: 130px;margin: 10px 0px 10px 0px;border:1px solid white;border-radius: 100px;margin-bottom: 20px;"><br>
                        <input type="file" name="foto" class="form-control" id="image-source" onchange="previewImage();" autocomplete="off" style="margin-bottom: 25px;">
                    </center>
                </div>
                <div class="col-md-8">
                    
                    <div class="form-group">
                        <label for="pwd">Nama</label>
                        <input class="form-control" type="text" name="nama" placeholder="nama lengkap" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="email" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Username</label>
                        <input class="form-control" type="text" name="user" placeholder="username" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input class="form-control" type="text" name="pass" placeholder="password" autocomplete="off" required="">
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="far fa-times-circle"></i> Batal</button>
              <button class="btn btn-primary"><i class="far fa-check-circle"></i> Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>