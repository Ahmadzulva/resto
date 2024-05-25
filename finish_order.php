<?php
require_once("services/database.php");
session_start();

$no_meja = "";
$nama_pelanggan = "";

if($_SESSION['is_login'] == false){
  header('location: login.php');
}

if(isset($_GET['no_meja']) && $_GET['no_meja']){
  $no_meja = $_GET['no_meja'];
}

if(isset($_GET['nama_pelanggan']) && $_GET['nama_pelanggan']){
  $nama_pelanggan = $_GET['nama_pelanggan'];
}

if(isset($_POST['finish_order'])){
  $hari = date('Y-m-d');
  $jam = date('H:i:s');

  $clear_meja_query = "UPDATE meja SET nama_pelanggan=NULL, jumlah_orang=NULL
  WHERE no_meja='$no_meja'";
  $insert_history_query = "INSERT INTO history (`no_meja`, `nama_pelanggan`, `hari`, `jam`) 
  VALUES('$no_meja', '$nama_pelanggan', '$hari', '$jam')";

  $clear_meja = $db->query($clear_meja_query);
  $insert_history = $db->query($insert_history_query);
  if($clear_meja){
    header("location: index.php");
  }else{
    echo "meja gagal di update";
  }
  $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finish Order</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include("layouts/header.php")?>

  <div class="super-center">
    <h3>Kosongkan Meja <?= $no_meja ?> atas nama <i><?= $nama_pelanggan?></i>?</h3>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
      <button type="submit" name="finish_order">KOSONGKAN</button>
    </form>
  </div>
</body>
</html>