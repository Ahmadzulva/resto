<header>
  <div>
    <ul>
      <li><h3><a href="index.php">Resto </a></h3></li>
      <li> <h3><a href="report.php">Import</a></h3></li>
    </ul>
  </div>
  <div>    
    <?php
      if(isset($_SESSION['is_login'])){
        echo "<a href='logout.php'>logout</a>";
      }else{
        echo "<a href='login.php'>login</a>";
      }
    ?>
  </div>
</header>