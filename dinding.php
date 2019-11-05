<?php 
  session_start();
  function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
  include ("conn.php");
  if (isset($_SESSION['id'])){
    $id=addslashes($_SESSION['id']);
    if (isset($_POST['status'])){
      $status=addslashes($_POST['status']);
      mysqli_query($conn,"insert into status (id, status) values($id,'$status')");
      // header("location: profile.php");
    }
    if ($_SESSION['jk']=='cowok'){
      $data=mysqli_query($conn,"select pk, id, (select nama from cewek where id=status.id) as nama, status from status where id in (select ide from ratingcotoce where ido=$id) or id=$id order by pk desc");
      if (isset($_GET['id'])){
        $id=addslashes($_GET['id']);
        $data=mysqli_query($conn,"select pk, id, (select nama from cewek where id=status.id) as nama, status from status where id=$id order by pk desc");
      }
    }else{
      $data=mysqli_query($conn,"select pk, id, (select nama from cowok where id=status.id) as nama, status from status where id in (select ido from ratingcetoco where ide=$id) of id=$id order by pk desc");
      if (isset($_GET['id'])){
        $id=addslashes($_GET['id']);
        $data=mysqli_query($conn,"select pk, id, (select nama from cowok where id=status.id) as nama, status from status where id=$id order by pk desc");
      }
    }
  }else{
    header("location: login.php");
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>COUPLE</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">COUPLE STORE</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->

      <!-- Nav Item - Pages Collapse Menu -->
      

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.php">Login</a>
            <a class="collapse-item" href="register.php">Register</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="profile.php">Profil</a>
            <a class="collapse-item" href="dinding.php">Dinding</a>
            <a class="collapse-item" href="jelajah.php">Jelajah</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><?php //if ($jumlah){echo $jumlah;}?></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header" style="font-size: 12px;">
                  Pesan
                </h6>
                <?php foreach ($data as $key): ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <img class="rounded-circle" style="width: 50px; height: 50px" src="img/<?php echo $key['id'].".jpg"; ?>">
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?php echo rupiah($key['nama']); ?></div>
                    <span class="font-weight-bold"><?php echo $key['nama']; ?></span>
                  </div>
                </a>
              <?php endforeach; ?>
               <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="pembayaran.php">
                  <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i>
                  make payment
                </a>
              </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                <!-- <i class="fas fa-user-circle" style="font-size: 30px;"></i> -->
                <img src="img/<?php echo $_SESSION['id'] ?>.jpg" class="fas fa-user-circle rounded-circle" style="width: 30px; height: 30px;">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>Profil
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

          </ul>

        </nav>
 
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Dinding</h1>
          <!-- DataTales Example -->
          <!-- informasi lain -->
          <div class="row">
            <div class="col-md-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <div>
                    <img class="rounded-circle" style="width: 48px; height: 30px; float: left;" src="img/<?php echo $_SESSION['id']; ?>.jpg">
                  </div>
                  <h6 class="m-0 font-weight-bold text-primary" style="padding-top: 1.5%; padding-left: 13%"><?php echo $_SESSION['username']; ?></h6>
                </div>
                <!-- foto -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10" style="font-family: cursive; color: black; text-align: left;">
                      <form action="dinding.php" method="post">
                        <div class="form-group">
                          <label for="comment">Status:</label>
                          <textarea class="form-control" rows="3" id="comment" name="status" placeholder="Apa yang <?php echo $_SESSION['username'] ?> pikirkan?"></textarea>
                        </div>
                        <div style="position: relative; display: flex; width: 100%; justify-content: flex-end;">
                          <button type="submit" name="submit" class="btn btn-success">Post</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-1"></div>
                  </div>
                </div>
                <!-- end foto -->
              </div>
            </div>
            <?php foreach ($data as $key):?>
            <div class="col-md-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <a href="profile.php?id=<?php echo $key['id'] ?>">
                  <div>
                    <img class="rounded-circle" style="width: 48px; height: 30px; float: left;" src="img/<?php echo $key['id']; ?>.jpg">
                  </div>
                  <h6 class="m-0 font-weight-bold text-primary" style="padding-top: 1.5%; padding-left: 13%"><?php echo $key['nama']; if ($key['nama']==''){echo "Anda";} ?></h6>
                  </a>
                </div>
                <!-- foto -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10" style="font-family: cursive; color: black; text-align: left;">
                      <div class="form-group">
                        <label style="color:#999;"><?php echo $key['nama']; ?> berkata :</label>
                        <p style="font-weight: bold; color: black;"><?php echo $key['status']; ?></p>
                      </div>
                    </div>
                    <div class="col-md-1"></div>
                  </div>
                </div>
                <!-- end foto -->
              </div>
            </div>

          <?php endforeach; ?>

          </div>

          <!-- end of status -->

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CBC 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
