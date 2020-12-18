<?php
    session_start();
    require_once("koneksi.php");
    $username = $_POST['user'];
    $pass = $_POST['password'];   
    $sql = "SELECT * FROM user WHERE username_user = '$username'";
    $query = $con->query($sql);
    $hasil = $query->fetch_assoc();
    if($query->num_rows == 0) {
      echo "<div align='center'>Username Belum Terdaftar! <a href='logres.php'>Back</a></div>";
    } else {
      if($pass <> $hasil['password']) {
        echo "<div align='center'>Password salah! <a href='logres.php'>Back</a></div>";
      } else {
        $_SESSION['user'] = $hasil['user'];
        header('location:homeLogin.php');
      }
    }
  ?>