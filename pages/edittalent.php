<?php include "../konekdb/koneksi.php"; 
$sql=mysqli_query($koneksi,"select * from talent_db where tl_kode ='$_GET[kode]'");
$data=mysqli_fetch_array($sql);

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Ambil informasi pengguna dari session
$username = $_SESSION['username'];

// Lakukan pengecekan untuk menentukan akses pengguna
$is_admin = false; // Misalnya, beri nilai default false
if ($username === 'admin') {
    $is_admin = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include "../component/head.php"; ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?php include "../component/sidebar.php"; ?>
  <main class="main-content position-relative border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit Data Talent</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Edit Data Talent</h6>
        </nav>
        <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Edit Data Talent</h6>
            </div>
            <div class="card-body">
            <div class= "formstaff">
            <div class="ms-sm-auto ml-10">
              <form method="post">
                <div class="form-group">
                  <label for="Input Kode Talent">Kode Talent</label>
                  <input type="text" class="form-control" name="tl_kode" value="<?php echo $data['tl_kode']; ?>">
                </div>

                <div class="form-group">
                  <label for="Input Nama">Nama Lengkap</label>
                  <input type="text" class="form-control" name="tl_nama" value="<?php echo $data['tl_nama']; ?>">
                </div>

                <div class="form-group">
                  <label for="Input Nama Talent">Nama Talent</label>
                  <input type="text" class="form-control" name="tl_alias" value="<?php echo $data['tl_alias']; ?>">
                </div>

                <div class="form-group">
                  <label for="Input Manager">Manager</label>
                  <input type="text" class="form-control" name="tl_manager" value="<?php echo $data['tl_manager']; ?>">
                </div>

                <div class="form-group">
                  <label for="Input Email">Email</label>
                  <input type="text" class="form-control" name="tl_email" value="<?php echo $data['tl_email']; ?>">
                </div>

                <div class="form-group">
                  <label for="Input Email">Email Talent</label>
                  <input type="text" class="form-control" name="tl_emailtalent" value="<?php echo $data['tl_emailtalent']; ?>">
                </div>

                <div class="form-group">
                  <label for="Input Telepon">Telepon</label>
                  <input type="text" class="form-control" name="tl_telepon" value="<?php echo $data['tl_telepon']; ?>">
                </div>

                <button type="submit" class="btn btn-primary" name="proses">Simpan</button>
                
              </form>

          <?php
        if(isset($_POST['proses'])){
        mysqli_query($koneksi, "update talent_db set
        tl_nama           = '$_POST[tl_nama]',
        tl_alias          = '$_POST[tl_alias]',
        tl_manager        = '$_POST[tl_manager]',
        tl_email          = '$_POST[tl_email]',
        tl_emailtalent    = '$_POST[tl_emailtalent]',
        tl_telepon        = '$_POST[tl_telepon]'
        where tl_kode     = '$_GET[kode]'");

        echo "Edit Talent Berhasil";
        echo '<meta http-equiv="refresh" content="1;url=talents.php">';
    }
    ?>
  </div>
</main>

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Talents Income",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>