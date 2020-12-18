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
	<link rel="icon" type="public/image/png" href="public/images/favicon.png">
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
<body class="js body-margin">
	
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
	include "headerLogin.php";
	?>
	<!--/ End Header -->
	
	<!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>DISKON NATAL UP TO 50% OFF </span>UNTUK ORANG TERKASIH</h1>
										<p>Bingung mau cari kado apa ?<br> Disini aja bisa pilih-pilih sesuai <br> untuk orang yang spesial.</p>
										<div class="button">
											<a href="#" class="btn">BELI SEKARANG</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
    </section>
    
<!-- Start Shop Services Area -->
<section class="shop-services section home">
		<div class="container justify-content-center">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Gratis Ongkir</h4>
						<p>Minimal belanja Rp 150.000</p>
					</div>
					<!-- End Single Service -->
				</div>

				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Keamanan pembayaran</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Harga terbaik</h4>
						<p>Dapatkan dengan harga terbaik</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->

	<!--/ End Slider Area -->
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2>Berikan kado spesial buat orang yang anda cintai</h2>
                </div>
            </div>
        </div>
    </div>
	
    <!-- Start Product Area -->

    
        <?php

        $batas = 15;
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
            }

            else{
                $query = mysqli_query($con, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori ORDER BY barang.id_barang DESC");
                $jumlah_data = mysqli_num_rows($query);
                $total_halaman = ceil($jumlah_data / $batas);
                
                $data_barang = mysqli_query($con, "SELECT * FROM barang JOIN kategori ON barang.id_kategori=kategori.id_kategori ORDER BY barang.id_barang DESC LIMIT $halaman_awal, $batas");
				$nomor = $halaman_awal+1;	
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
                        <h6 class=" judul-barang"><?php echo $record['nama_barang']; ?></h6>
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
        <ul class="pagination justify-content-center mb-5 mt-2">
            <li class="page-item">
                <a class="page-link mr-3" <?php if($halaman > 1 ){ echo "href='?halaman=$previous'"; } ?>>Sebelumnya</a>
            </li>
            <?php 
            for($x=$start_number;$x<=$end_number;$x++) :?> 
                <?php if ($halaman == $x) :?>
                <li class="page-item"><a class="page-link bg-warning text-white" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                
            <?php else : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>	
            <?php endif; ?>
            <?php endfor; ?>

            <li class="page-item">
                <a  class="page-link ml-3" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Selanjutnya</a>
            </li>
        </ul>
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