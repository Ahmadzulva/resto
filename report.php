<?php
  require_once("services/pdf/fpdf.php"); 
  require_once("services/database.php");

  session_start();

  if ($_SESSION['is_login'] == false) {
    header('location: login.php');
    exit(); // Penting untuk menghentikan eksekusi setelah header redirection
  }

  if (isset($_POST['report'])) {
    $hari = $_POST['hari'];
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetTitle("Laporan Pengunjung");
    $pdf->SetFont("Arial", "", 14);

    // Mengatur posisi dan gaya teks untuk judul di tengah
    $pdf->Cell(0, 10, "Laporan Pengunjung Tanggal $hari", 0, 1, 'C');

    $select_history_query = "SELECT * FROM history WHERE hari='$hari'";
    $select_history = $db->query($select_history_query);

    // Menambahkan header kolom dengan teks di tengah
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(24, 10, "No Meja", 1, 0, 'C');
    $pdf->Cell(50, 10, "Nama Pelanggan", 1, 0, 'C');
    $pdf->Cell(30, 10, "Hari Keluar", 1, 0, 'C');
    $pdf->Cell(30, 10, "Jam Keluar", 1, 1, 'C');

    if ($select_history->num_rows > 0) {
      $pdf->SetFont("Arial", "", 12);
      foreach ($select_history as $history) {
        $pdf->Cell(24, 10, $history["no_meja"], 1, 0, 'C');
        $pdf->Cell(50, 10, $history["nama_pelanggan"], 1, 0, 'C');
        $pdf->Cell(30, 10, $history["hari"], 1, 0, 'C');
        $pdf->Cell(30, 10, $history["jam"], 1, 1, 'C');
      }
      // Menambahkan informasi total pengunjung di bawah tabel
      $pdf->Ln(10); // Menambahkan jarak vertikal
      $pdf->Cell(0, 10, "Total " . $select_history->num_rows . " pengunjung pada tanggal $hari.", 0, 1, 'C');
    } else {
      // Jika tidak ada data, menampilkan pesan di tengah
      $pdf->Cell(0, 10, "Tidak ada pengunjung pada tanggal $hari.", 0, 1, 'C');
    }

    $pdf->Output();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Report</title>
</head>
<body>
  <?php include("layouts/header.php")?>

  <div class="super-center">
    <h3>Cetak PDF</h3>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
      <input type="date" name="hari" id="">
      <button type="submit" name="report">Generate Report</button>
    </form>
  </div>
  
</body>
</html>