<?php
require_once("koneksi.php");

if(isset($_GET['idproduk'])){
    $query="DELETE FROM `barang` WHERE `barang`.`id_barang` = ".$_GET['idproduk']."";

    $hasil =mysqli_query($con,$query);
?>
<script>
    alert("data berhasil dihapus");
    window.location='produk.php'
</script>

<?php
}
else{
?>
<script>
    alert("data gagal dihapus");
    window.location='produk.php'
</script>
<?php
}
?>