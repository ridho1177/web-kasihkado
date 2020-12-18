<?php 
require_once ("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Produk</title>
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap/bootstrap.css">
        <link href="public/css/admin.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Kasihkado</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/login">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
        <?php
            require_once ("sidenavadmin.php")
        ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">PRODUCT</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                        <form name="tambahproduk" action="tambahproduk.php" method="post">
                        <button class="btn btn-success" type="submit">Tambah Produk</button>
                        </form>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Data Produk
                            </div>
                            <div class="card-body">                          
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="mytable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Deskripsi</th>
                                                <th>Foto Produk</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                            $batas = 10;
                                            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                                            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

                                            $previous = $halaman - 1;
                                            $next = $halaman + 1;

                                            $query = mysqli_query($con,"SELECT * FROM barang  ORDER BY id_barang DESC");

                                            $jumlah_data = mysqli_num_rows($query);
                                            $total_halaman = ceil($jumlah_data / $batas);

                                            $data_barang = mysqli_query($con, "SELECT * FROM barang ORDER BY id_barang DESC LIMIT $halaman_awal, $batas");
                                            $nomor = $halaman_awal+1;
                                            while ($record = mysqli_fetch_array($data_barang)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $record['nama_barang'] ?></td>
                                                    <td><?php echo "Rp ".number_format($record['harga_brg'],0,",",".");?></td>
                                                    <td><?php echo $record['jml_barang'] ?></td>
                                                    <td><?php echo $record['deskripsi'] ?></td>
                                                    <td><img src="public/images/product/<?php echo $record['foto'];  ?>"  width="200px" height="200px" /></td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-info edit"
                                                                data-id="{{ id_product }}" data-nama_product="{{ nama_product }}"
                                                                data-harga_product="{{ harga_product }}"
                                                                data-deskripsi_product="{{ deskripsi_product }}">Edit</a>
                                                            <a href="hapusproduk.php?idproduk=<?php echo $record['id_barang'] ?>;" class="btn btn-sm btn-danger delete"
                                                                >Delete</a>
                                                        </div>
                                                        
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
                    
                        </div>
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>


    </body>
</html>
