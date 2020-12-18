<?php 
require_once('koneksi.php');

if(isset($_POST['register_submit']))
{
    $nama_user = $_POST['nama_user'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $username_user = $_POST['username_user'];
    $alamat = $_POST['alamat'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    if($register($nama_user,$email,$no_hp,$alamat,$username_user,$password))
    {
      header('location:logres.html');
    }
}

?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
  
  <!-- StyleSheet -->
  
  <!-- Bootstrap -->
  <link rel="stylesheet" href="public/css/bootstrap.css">
  <!-- Magnific Popup -->
    <link rel="stylesheet" href="public/css/magnific-popup.min.css">
  <!-- Font Awesome -->
    <link rel="stylesheet" href="public/css/font-awesome.css">
  <!-- Fancybox -->
  <link rel="stylesheet" href="public/css/jquery.fancybox.min.css">
  <!-- Themify Icons -->
    <link rel="stylesheet" href="public/css/themify-icons.css">
  <!-- Nice Select CSS -->
    <link rel="stylesheet" href="public/css/niceselect.css">
  <!-- Animate CSS -->
    <link rel="stylesheet" href="public/css/animate.css">
  <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="public/css/flex-slider.min.css">
  <!-- Owl Carousel -->
    <link rel="stylesheet" href="public/css/owl-carousel.css">
  <!-- Slicknav -->
    <link rel="stylesheet" href="public/css/slicknav.min.css">
  
  <!-- Eshop StyleSheet -->
  <link rel="stylesheet" href="public/css/reset.css">
  <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="public/css/responsive.css">
    <title>Register Form</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sticky-footer/">

    <!-- Bootstrap core CSS -->
<link href="public/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
    <!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Register Form</h1>
    <p class="lead">Silahkan Daftarkan Identitas Anda</p>
    <hr/>
    <form method="post" action="simpanregistrasi.php">
    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="nama_user" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="email" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">No Hp</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="no_hp" required>
      </div>
    </div>
<div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">alamat</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="alamat" required>
      </div>
    </div>
<div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="username_user" required>
      </div>
    </div>
  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <a href="logres.php" class="btn btn-success">Login</a>
      <button class="btn-primary" type="submit" class="btn btn-primary" name="register_submit">Register</button>
    </div>
  </div>
</form>
  </div>
</main>
<?php
  

?>

</body>
</html>