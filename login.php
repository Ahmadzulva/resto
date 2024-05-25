<?php
  require_once("services/database.php");
  session_start();
  $login_notification = "";

  if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == false){
    header("loacation: index.php");
  }

  if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select_admin_query = "SELECT * FROM admin WHERE username ='$username' AND password ='$password' ";

    $select_admin = $db->query($select_admin_query);

    if($select_admin->num_rows > 0){
      $admin = $select_admin->fetch_assoc();

      $_SESSION['is_login'] = true;
      $_SESSION['username'] = $admin['username'];

      header("location: index.php");
    }else {
      $login_notification = "akun admin tidak ditemukan";
    }
  }


 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
 </head>
 <body>
  <div class="super-center">
  <h1>Login <Admin></Admin></h1>
  <i><?= $login_notification ?></i>
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <div>
      <label>username</label>
      <input name="username"/>
    </div>
    <div>
      <label>password</label>
      <input type="password" name="password"/>
    </div>
    <button type="submit" name="login">Login</button>
  </form>
  </div>
 </body>
 </html>