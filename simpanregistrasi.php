<?php
//Include file koneksi ke database
include "koneksi.php";
//untuk password digunakan enskripsi md5
$nama_user = $_POST['nama_user'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $username_user = $_POST['username_user'];
    $alamat = $_POST['alamat'];
    $password =$_POST['password'];
    //$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
   
//Query input menginput data kedalam tabel anggota



//Mengeksekusi/menjalankan query diatas	
  
   $cek_user=mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE username_user ='$_POST[username_user]'"));
    if ($cek_user > 0) {
        echo '<script language="javascript">
              alert ("Username Sudah Ada Yang Menggunakan");
              window.location="register.php";
              </script>';
              exit();
    }
    else {
        $query="insert into user (nama_user,email,no_hp,alamat,username_user,password) values
		('$nama_user','$email','$no_hp','$alamat','$username_user','$password')";
        $hasil=mysqli_query($con,$query);
        echo '<script language="javascript">
              alert ("Registrasi Berhasil Di Lakukan!");
              window.location="logres.php";
              </script>';
              exit();
}  

?>