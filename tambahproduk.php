<center>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah produk</title>
<?php 
require_once("koneksi.php");
?>
</head>
<body>

<?php 
$sql =mysqli_query($con,"SELECT * FROM  kategori ");

?>
    <h4>Tambah Produk</h4>
    <table>
    <form method="POST" enctype='multipart/form-data'>
    <tr>
        <td>Nama Produk</td>
        <td><input type="text" name="nama_barang" id="nama_barang"></td>
    </tr>
    <tr>
    <tr>
        <td>Harga Produk</td>
        <td><input type="text" name="harga_barang" id="harga_barang"></td>
    </tr>
    <tr>
        <td>Jumlah Produk</td>
        <td><input type="text" name="jumlah_barang" id="jumlah_barang"></td>
    </tr>
    <tr>
        <td>Deskirpsi Produk</td>
        <td><input type="text" name="deskripsi" id="deskripsi"></td>
    </tr>
    <tr>
    <td>Kategori Produk</td>
    <td>
        <select name="kategori" >
            <option>Pilih Kategori</option>
            <?php if(mysqli_num_rows($sql) >0) { 
                while ($row = mysqli_fetch_array($sql)){?>
                <option><?php echo $row['id_kategori'] ?> JK : <?php echo $row['jk'] ?> , Umur : <?php echo $row['umur'] ?></option>
                <?php } }?>               
        </select>
    </td>
    </tr>
    <tr>
        <td>Gambar</td>
        <td><input type="file" name="filegambar" id="filegambar"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="simpan" value="Simpan"></td>
    </tr>
    </form>
    </table>
    <?php
    if (isset($_POST['simpan'])) {
    //buat folder bernama gambar
    $tempdir = "public/images/product/"; 
            if (!file_exists($tempdir))
            mkdir($tempdir,0755); 

            $target_path = $tempdir . basename($_FILES['filegambar']['name']);

            //nama gambar
            $nama_gambar=$_FILES['filegambar']['name'];
            //ukuran gambar
            $ukuran_gambar = $_FILES['filegambar']['size']; 

            $fileinfo = @getimagesize($_FILES["filegambar"]["tmp_name"]);
            //lebar gambar
            $width = $fileinfo[0];
            //tinggi gambar
            $height = $fileinfo[1]; 
            if($ukuran_gambar > 81920){ 
                echo 'Ukuran gambar melebihi 80kb';
            }else if ($width > "480" || $height > "640") {
                echo 'Ukuran gambar harus 480x640';
            }else{
                if (move_uploaded_file($_FILES['filegambar']['tmp_name'], $target_path)) {
                    
                    $sql= "INSERT INTO barang(nama_barang,harga_brg, jml_barang, deskripsi,  id_kategori, foto) VALUES('".$_POST['nama_barang']."', '".$_POST['harga_barang']."', '".$_POST['jumlah_barang']."', '".$_POST['deskripsi']."', '".$_POST['kategori']."', '".$nama_gambar."')";

                    //eksekusi query
                    $hasil=mysqli_query($con,$sql) ;
                    ?>
            <script>
                alert("data sukses ditambahkan");
                window.location='produk.php';
            </script>
                

<?php
                } else {
                    echo 'Simpan data gagal';
                }
            } 
    }
?>

</body>

</html>
</center>