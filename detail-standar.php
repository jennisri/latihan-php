<?php 

$judul	= "Halaman Detail";
include 'layout/header.php';


$id_barang = (int)$_GET['id_barang'];

$barang = query("SELECT * FROM tbl_barang WHERE id_barang = '$id_barang'")[0];


?>

<div id="layoutSidenav_content">
	<main>
		<div class="container mt-4">

			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table mr-1"></i>
					Tabel Daftar Barang
				</div>
				<div class="card-body">
					<div class="table-responsive">

						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<tr>
								<td>Nama Barang</td>
								<td>: <?php echo $barang['nama_barang']; ?></td>
							</tr>

							<tr>
								<td>Jumlah Barang</td>
								<td>: <?php echo $barang['jumlah_barang']; ?></td>
							</tr>

							<tr>
								<td>Harga Barang</td>
								<td>: Rp. <?php echo number_format($barang['harga_barang'], 0, '.', '.'); ?></td>
							</tr>

							<tr>
								<td>Catatan</td>
								<td>: <?php echo $barang['catatan']; ?></td>
							</tr>
						</table>

						<div class="float-right">
							<a href="standar.php" class="btn btn-secondary">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>