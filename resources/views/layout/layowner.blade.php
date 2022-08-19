<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SI PMPC - Owner</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/custom.css">

  <link rel="stylesheet" href="assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
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
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                  collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <!-- <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form> -->
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          
          <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
                        fa-code"></i>
                  </span> <span class="dropdown-item-desc"> Template update is
                    available now! <span class="time">2 Min
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
                        fa-user"></i>
                  </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                      Sugiharto</b> are now friends <span class="time">10 Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i
                      class="fas
                        fa-check"></i>
                  </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                    moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                      Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i
                      class="fas fa-exclamation-triangle"></i>
                  </span> <span class="dropdown-item-desc"> Low disk space. Let's
                    clean it! <span class="time">17 Hours Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
                        fa-bell"></i>
                  </span> <span class="dropdown-item-desc"> Welcome to Otika
                    template! <span class="time">Yesterday</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li> -->
          <?php 
            $ses = Session::get('idp');
            $prof = DB::SELECT("select*from pengguna where PENG_ID = '$ses'");
          ?>
          @foreach($prof as $iprof)
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/foto/{{$iprof->FOTO}}" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">{{$iprof->NAMA}}<br> ({{$iprof->LEVEL}})</div>
              <!-- <a href="#" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profil </a>  -->
              <a href="#" class="dropdown-item has-icon" data-toggle="modal" data-target="#editPengguna{{$iprof->PENG_ID}}"> <i class="fas fa-edit"></i> Edit Profil </a> 
              <!-- <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> Settings </a> -->
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
          @endforeach
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/staf"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">SI PMPC </span>
            </a>
          </div>
            
          @yield('menu')  

        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content"> 

          @yield('content')

      </div>

      @foreach($prof as $ed)
      <div class="modal fade" id="editPengguna{{$ed->PENG_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Edit Profil</h5>
            </div>
            <?php 
                $id = $ed->PENG_ID;
                $edit = DB::SELECT("select*from pengguna where PENG_ID = '$id'");
            ?>
            @foreach($edit as $upd)
            <form action="/pet:upd={{$upd->PENG_ID}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="modal-body">             
                  <div class="row">
                    <div class="col-md-4">
                        <center>
                            FOTO<br><br>
                           <!-- <img id="image-preview" style="width: 130px; height: 130px;margin: 10px 0px 10px 0px;border:1px solid white;border-radius: 100px;margin-bottom: 20px;"><br> -->
                            <input type="file" name="foto" class="form-control" id="image-source" onchange="previewImage();" autocomplete="off" style="margin-bottom: 25px;">
                            <input type="hidden" name="level" value="Staf IT">
                        </center>
                        <input type="hidden" name="level" value="Staf IT" readonly="">
                    </div>
                    <div class="col-md-8">
                        
                        <div class="form-group">
                            <label for="pwd">Nama</label>
                            <input class="form-control" type="text" name="nama" value="{{$upd->NAMA}}" autocomplete="off" required="">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Email</label>
                            <input class="form-control" type="email" name="email" value="{{$upd->EMAIL}}" autocomplete="off" required="">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Username</label>
                            <input class="form-control" type="text" name="user" value="{{$upd->USERNAME}}" autocomplete="off" required="">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input class="form-control" type="text" name="pass" value="{{$upd->PASSWORD}}" autocomplete="off" required="">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="far fa-times-circle"></i> Batal</button>
                  <button class="btn btn-primary"><i class="far fa-check-circle"></i> Ubah</button>
                </div>
            </form>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach

      <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Templateshub</a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <script src="assets/bundles/cleave-js/dist/cleave.min.js"></script>
  <script src="assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <script src="assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/page/forms-advanced-forms.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>

  <script type="text/javascript">
    function previewImage() {
          document.getElementById("image-preview").style.display = "inline";
          var oFReader = new FileReader();
           oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

          oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
          };
      };

      $(function() {
        $('#gejala').hide();
        $('#sgej').change(function(){
            if($('#sgej').val() == 'Terkena Gejala') {
                $('#gejala').show();
            } else if($('#sgej').val() == 'Tanpa Gejala') {
                $('#gejala').hide();
            }
        });
      });


      $(function() {
        $('#esgej').change(function(){
            if($('#esgej').val() == 'Terkena Gejala') {
                $('#egejala').show();
            } else if($('#esgej').val() == 'Tanpa Gejala') {
                $('#egejala').hide();
            }
        });
      });

       window.onload=function(){
        $('#tglumur').on('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#umur').val(age);
        });
    }    

  </script>
</body>

</html>