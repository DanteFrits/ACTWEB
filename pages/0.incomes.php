<?php include "../konekdb/koneksi.php";
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Income</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Incomes</h6>
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
              <h6>Income Talent</h6>
            </div>
            <div class="card-body">
            <a href="tambahincome.php" class="btn btn-primary bi bi-plus-lg"> Tambah Income</a>
              <div class="table-responsive p-2">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nama Talent</th>
                      <th>Nama Manager</th>
                      <th>Saldo Trakteer</th>
                      <th>Saldo Saweria</th>
                      <th>Saldo SocialBuzz</th>
                      <th>Youtube Adsense</th>
                      <th>Tiktok</th>
                    </tr>

                    <?php 
                      include "../konekdb/koneksi.php";
                    
                      $no = 1;
                      $ambildata = mysqli_query($koneksi, "SELECT * FROM income_db");
                      while ($tampil = mysqli_fetch_array($ambildata)) {
                        echo "
                          <tr>
                          <td>{$tampil['ic_date']}</td>
                            <td>{$tampil['ic_talent']}</td>
                            <td>{$tampil['ic_staff']}</td>
                            <td>Rp. {$tampil['ic_trakteer']}</td>
                            <td>Rp. {$tampil['ic_saweria']}</td>
                            <td>Rp. {$tampil['ic_socialbuzz']}</td>
                            <td>Rp. {$tampil['ic_yt']}</td>
                            <td>Rp. {$tampil['ic_tiktok']}</td>
                            <td><a href='editstaff.php?kode=$tampil[ic_id]' class='btn btn-warning btn-sm bi bi-pencil-square'>
                            <a href='?kode=$tampil[ic_id]' class='btn btn-danger btn-sm bi bi-trash' onClick=\"return confirm('Hapus Data?');\"></td>
                          </tr>
                        ";
                        $no++;
                      }
                    ?>
                    
                  </thead>
                </table>

                <?php
                if(isset($_GET['kode'])){
                mysqli_query($koneksi,"delete from income_db where ic_id='$_GET[kode]'");

                echo "Data Telah Dihapus";
                echo "<meta http-equiv=refresh content=2; URL='incomes.php'>";
                }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
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