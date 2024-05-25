<?php
  require_once "services/database.php";
  define("APP_NAME", "Resto - Reservasi");

  session_start();
  if(isset($_SESSION['is_login']) == false){
    header("location: login.php");
  }

  $select_meja_query = "SELECT * FROM meja";
  $select_meja = $db->query($select_meja_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include("layouts/header.php")?>
  <br>
  
  <h1 align="center">DAFTAR MEJA</h1>
  <div class="container">
    <?php
    foreach ($select_meja as $meja) {
    ?>
    <div class="card" onclick="goToMeja(`<?= $meja['no_meja'] ?>`, `<?= $meja['nama_pelanggan'] ?>`)">

      <b><?= $meja['tipe_meja'] ." ". $meja['no_meja']; ?></b>
      <p>
        <?= $meja['nama_pelanggan'] == NULL && $meja['jumlah_orang'] == NULL ? "meja kosong" :
         $meja['nama_pelanggan']." ". $meja['jumlah_orang']. " orang"?>
      </p>

    </div>
     <?php }?>
  </div>
  <script>
    function goToMeja(no_meja, nama_pelanggan){
      const url = "meja.php";
      const params = `?no_meja=${no_meja}&nama_pelanggan=${nama_pelanggan}`;
      window.location.replace(url + params);
    }
  </script>
</body>
</html>