<?php 
  session_start();
  function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
  include ("conn.php");
  if (isset($_SESSION['id'])){
    $id=addslashes($_SESSION['id']);
    if ($_SESSION['jk']=='cowok'){
      $data=mysqli_query($conn,"select ide as id, (select nama from cewek where id=ratingcotoce.ide)as nama , rating from ratingcotoce where ido=$id");
      $notrate=mysqli_query($conn,"select id, nama from cewek where id not in (select ide from ratingcotoce where ido=$id) order by id asc");
      $produc=array();
      $predic=array();
      foreach ($notrate as $key) {
        $atas = 0;
        $bawah = 0;
        foreach ($data as $val) {
          $temp=mysqli_query($conn,"select rating from ratingcotoce where ido in (select ido from ratingcotoce where ido in (select ido from ratingcotoce where ide=".$key['id'].") and ide=".$val['id'].") and (ide=".$key['id']." or ide=".$val['id'].")");
          $nil = array();
          foreach ($temp as $tmp) {
            array_push($nil,$tmp['rating']);
          }
          $a=0;
          $b=0;
          $c=0;
          for ($i=0; $i < count($nil)/2 ; $i++) {
            $a = $a + ($nil[$i]*$nil[($i+count($nil)/2)]);
            $b = $b + ($nil[$i]*$nil[$i]);
            $c = $c + ($nil[($i+count($nil)/2)]*$nil[($i+count($nil)/2)]);
          }
          if (count($nil)==0){
            $sim=0;
          }else{
            $sim = $a/sqrt($b*$c);
          }
          $bawah = $bawah + $sim;
          $atas = $atas + ($val['rating']*$sim);
        }
        array_push($predic, $atas/$bawah);
        array_push($produc, $key);
      }
    }else{
      $data=mysqli_query($conn,"select ido as id, (select nama from cowok where id=ratingcetoco.ido)as nama , rating from ratingcetoco where ide=$id");
      $notrate=mysqli_query($conn,"select id, nama from cowok where id not in (select ido from ratingcetoco where ide=$id) order by id asc");
      $produc=array();
      $predic=array();
      foreach ($notrate as $key) {
        $atas = 0;
        $bawah = 0;
        foreach ($data as $val) {
          $temp=mysqli_query($conn,"select rating from ratingcetoco where ide in (select ide from ratingcetoco where ide in (select ide from ratingcetoco where ido=".$key['id'].") and ido=".$val['id'].") and (ido=".$key['id']." or ido=".$val['id'].")");
          $nil = array();
          foreach ($temp as $tmp) {
            array_push($nil,$tmp['rating']);
          }
          $a=0;
          $b=0;
          $c=0;
          for ($i=0; $i < count($nil)/2 ; $i++) {
            $a = $a + ($nil[$i]*$nil[($i+count($nil)/2)]);
            $b = $b + ($nil[$i]*$nil[$i]);
            $c = $c + ($nil[($i+count($nil)/2)]*$nil[($i+count($nil)/2)]);
          }
          if (count($nil)==0){
            $sim=0;
          }else{
            $sim = $a/sqrt($b*$c);
          }
          $bawah = $bawah + $sim;
          $atas = $atas + ($val['rating']*$sim);
        }
        array_push($predic, $atas/$bawah);
        array_push($produc, $key);
      }
    }
    array_multisort($predic, $produc);
    // $data1=mysqli_query($conn,"select distinct * from checkout where id_user='$u'");
    // $jumlah=0;
    // foreach ($data1 as $key) {
    //   $jumlah++;
    // }
    //  $data2=mysqli_query($conn,"select distinct nama,harga,nama_gambar from checkout join produk using(id_produk) where id_user='$u'");
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
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="rating/css/star-rating.css">
  <link rel="stylesheet" type="text/css" href="rating/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  

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

          <div class="agileinfo-ads-display col-md-12">
        <div class="wrapper">
          <div class="product-sec1">
            <h6 class="heading-tittle" style="text-align: center; font-family: cursive;color: deepskyblue; font-size: 20px; font-weight: bold;">TEMAN</h6>
            <div class="grid-container">
            <div class="row">
            <?php foreach ($data as $key): ?>
            <div class="col-md-3">
            <div class="grid-item product-men" style="width: 25%; float: left;">
              <div class="men-pro-item simpleCart_shelfItem">
                <div class="men-thumb-item">
                  <img src="img/<?php echo $key['id'].".jpg"; ?>" alt="" style="width: 235px; height: 160px;">
                  <div class="men-cart-pro">
                    <div class="inner-men-cart-pro">
                      <form action="profile.php" method="get">
                        <fieldset>
                          <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
                          <button type="submit" class="link-product-add-cart" style="color: white; text-decoration: none; border: none; border-radius: 5px;">View</button>
                        </fieldset>
                      </form>
                      </div>
                  </div>
                </div>
                <div class="info-product-price">
                    <span class="item_price"><?php echo $key['nama']; ?></span>
                </div>
              </div>
            </div>

          </div>
          <?php endforeach; ?>
          </div>
          </div>
          <div class="clearfix"></div>

          </div>
          <!-- first section -->
          <div class="product-sec1">
            <h6 class="heading-tittle" style="font-family: cursive;color: deepskyblue; font-size: 20px; font-weight: bold;">Belum diketahui</h6>
            <div class="grid-container">

            <div class="row">
            <?php for($z=count($produc); $z>0; $z--): ?>
            <div class="col-md-3">
            <div class="grid-item product-men" style="width: 25%; float: left;">
              <div class="men-pro-item simpleCart_shelfItem">
                <div class="men-thumb-item">
                  <img src="img/<?php echo $produc[$z-1]['id'].".jpg"; ?>" alt="" style="width: 235px; height: 160px;">
                  <div class="men-cart-pro">
                    <div class="inner-men-cart-pro">
                      <button class="link-product-add-cart" style="color: white; text-decoration: none; border: none; border-radius: 5px;" data-toggle="modal" data-target="#modal-produk<?php echo $produc[$z-1]['id'] ?>">View</button>
                    </div>
                  </div>
                  <span class="product-new-top">New</span>
                </div>
                  <div class="info-product-price">
                    <span class="item_price"><?php echo $produc[$z-1]['nama'].$predic[$z-1]; ?></span>
                  </div>
              </div>
            </div>
          </div>
            <?php endfor; ?>
            </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- //first section (nuts) -->


        </div>
      </div>

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

  <?php for($z=count($produc); $z>0; $z--): ?>
    <div class="modal fade" id="modal-produk<?php echo $produc[$z-1]['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kenali <?php echo $produc[$z-1]['nama']; ?> lebih jauh lagi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" style="padding-bottom: 2rem">
            <center>
              <img src="img/<?php echo $produc[$z-1]['id'] ?>.jpg" style="width: 275px; height: 183px;">
            </center>
            <div class="text-center">
              <p>
              <h4><?php echo $produc[$z-1]['nama']; ?></h4>
              <input id="<?php echo $produc[$z-1]['id'] ?>rating-input" type="text" title=""/>
              </p>
            </div>
            <script type="text/javascript">
              $(document).ready(function(){
                var $inp = $('#<?php echo $produc[$z-1]['id'] ?>rating-input');
                
                //$inp.attr('value','4');
                  
                $inp.rating({
                            min: 0,
                            max: 5,
                            step: 1,
                            size: 'sm',
                            showClear: false
                        });
                $inp.on('rating.change', function () {
                  $("#btn<?php echo $produc[$z-1]['id']; ?>").attr("onclick","berirating(<?php echo $produc[$z-1]['id'] ?>,"+$('#<?php echo $produc[$z-1]['id'] ?>rating-input').val()+")");
                  $("#btn<?php echo $produc[$z-1]['id']; ?>").removeAttr("disabled");
                  // $('#<?php echo $produc[$z-1]['id'] ?>rating-input').val();
                });
              });
            </script>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button id="btn<?php echo $produc[$z-1]['id']; ?>" class="btn btn-success" disabled="" title="berikan rating dulu">Next</button>
          </div>
        </div>
      </div>
    </div>
  <?php endfor; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script type="text/javascript" src="rating/js/jquery.min.js"></script>
  <script type="text/javascript" src="rating/js/star-rating.js"></script>
  <script type="text/javascript" src="rating/js/bootstrap.js"></script>
  <script type="text/javascript">
    function berirating(a,b){
      window.location.replace("berirating.php?id="+a+"&rating="+b);
    }
  </script>

</body>

</html>

