<?php
require_once ("koneksi.php");
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Kasihkado</title>
	<!-- Favicon -->
	<link rel="icon" type="/publicimage/png" href="public/images/favicon.png">
	<!-- Web Font -->
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
	<link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="public/css/responsive.css">	
	
</head>
<body class="js body-margin-search">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	
	<?php 
	include "header.php";
	?>
	
	<!--/ End Slider Area -->
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h4>Hasil pencarian <?php if($cari = $_GET['cari']) {echo "'".$_GET['cari']."'";} ?> </h4>
                </div>
            </div>
        </div>
    </div>
	
    <!-- Start Product Area -->
 
        <?php

        $batas = 12;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
        $previous = $halaman - 1;
        $next = $halaman + 1;

            if(isset($_GET['cari'])){
                $cari = $_GET['cari'];
                $jeniskelamin = $_GET['jeniskelamin'];
                $query = mysqli_query($con, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori where barang.nama_barang like '%".$cari."%' AND (kategori.jk LIKE '%".$jeniskelamin."%')  ORDER BY barang.id_barang DESC");
                
                $jumlah_data = mysqli_num_rows($query);
                $total_halaman = ceil($jumlah_data / $batas);
                
                $data_barang = mysqli_query($con, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori where barang.nama_barang like '%".$cari."%' AND (kategori.jk LIKE '%".$jeniskelamin."%')  ORDER BY barang.id_barang DESC LIMIT $halaman_awal, $batas");
				$nomor = $halaman_awal+1;
				$cek = mysqli_num_rows($data_barang);

			}
			if ($cek==0){
				echo '<h6 class="mb-5 " style = "text-align:center; width:100%; padding-bottom:100px; padding-top:100px; color:red;">Maaf barang tidak ditemukan.</h6>';
			}
			?>

		<div class="container"> 
			<div class="row  justify-content-center">
		<?php
	    	while ($record= mysqli_fetch_array($data_barang)) {	
	    ?>

			<!-- menampilkan data yang ada didalam database -->

            <div class="col-md-2 card text-center m-3" style="width: 18rem; ">
                <form method="post">
                    <div>
						<img class="mt-3" src="public/images/product/<?php echo $record['foto'];  ?>"  width="200px" height="200px" /><br/></br>
                        <h6 class="judul-barang"><?php echo $record['nama_barang']; ?></h6>
                        <h5 class="text-danger mb-3"><?php echo "Rp ".number_format($record['harga_brg'],0,",",".");  ?></h5>

                        <input type="hidden" name="hidden_name" value="<?php echo $record['nama_barang']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo "Rp ".number_format($record['harga_brg'],0,",","."); ?>" />
                        <input type="hidden" name="hidden_id" value="<?php echo $record['id_barang']; ?>" />                     
                    </div>
                </form>
			</div>

            <?php
            } 
            ?>
        </div>
    </div>


    <?php
    $jumlahLink = 3;
        if($halaman >$jumlahLink ){
            $start_number = $halaman - $jumlahLink;
        } else{
            $start_number = 1;
        }

        if($halaman < $total_halaman - $jumlahLink){
            $end_number = $halaman + $jumlahLink;
        } else{
            $end_number = $total_halaman;
        }
        ?>
	<!-- End Product Area -->	
	
    <!-- Start Pagnation  -->
	<nav>
		<?php if ($jumlah_data >= $batas){ ?>
			<?php
				if(isset($_GET['cari'])){
			?>
		<ul class="pagination justify-content-center mb-5 mt-2">
			<li class="page-item">
				<a class="page-link mr-3" <?php if($halaman > 1 ){ echo "href='?jeniskelamin=$jeniskelamin&cari=$cari&halaman=$previous'"; } ?>>Sebelumnya</a>
			</li>

			<?php 
			for($x=$start_number;$x<=$end_number;$x++) :?> 
				<?php if ($halaman == $x) :?>
				<li class="page-item"><a class="page-link bg-warning text-white" href="?jeniskelamin=<?php echo $jeniskelamin ?>&cari=<?php echo $cari?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
				
			<?php else : ?>
				<li class="page-item"><a class="page-link" href="?jeniskelamin=<?php echo $jeniskelamin ?>&cari=<?php echo $cari?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>	
			<?php endif; ?>
			<?php endfor; ?>
			
			<li class="page-item">
				<a  class="page-link ml-3" <?php if($halaman < $total_halaman) { echo "href='?jeniskelamin=$jeniskelamin&cari=$cari&halaman=$next'"; } ?>>Selanjutnya</a>
			</li>
		</ul>
		<?php } }else{}?>
	</nav>
	<!-- End Pagnation -->
	
	<!-- Start Footer Area -->
	<?php
	include"footer.php";
	?>
	<!-- /End Footer Area -->

	<!-- Jquery -->
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/jquery-migrate-3.0.0.js"></script>
	<script src="public/js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="public/js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="public/js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="public/js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="public/js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="public/js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="public/js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="public/js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="public/js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="public/js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="public/js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="public/js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="public/js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="public/js/easing.js"></script>
	<!-- Active JS -->
	<script src="public/js/active.js"></script>
</body>
</html>