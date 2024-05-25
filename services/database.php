<?php

$hostname = "localhost";
$database_name = "resto";
$username = "root";
$password = "";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error) {
  echo "koneksi database error";
  die("koneksi database error");
}
