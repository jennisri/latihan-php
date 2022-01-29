<?php 

$judul	= "Upload";
include 'layout/header.php';


$brgmasuk = query("SELECT * FROM tbl_brgmasuk ORDER BY id_brgmasuk DESC");

if(isset($_POST['ubah'])){
	if(ubah_upload($_POST) > 0){
		echo "<script>
		alert ('Data berhasil diubah');
		document.location.href = 'upload.php';
		</script>
		";
	}else {
		echo "<script>
		alert ('Data gagal diubah');
		document.location.href = 'upload.php';
		</script>
		";
	}
}

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
					<a href="tambah-brgmasuk.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</a>

					<div class="table-responsive">

						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Nama</th>
									<th>Jumlah</th>
									<th>Harga Jual</th>
									<th>Foto</th>
									<th>Fungsi</th>
								</tr>
							</thead>

							<tbody>
								<?php $no = 1; ?>
								<?php foreach($brgmasuk as $data) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo date('d/m/Y H:i:s', strtotime($data['tanggal_masuk'])); ?></td>
										<td><?php echo $data['nama']; ?></td>
										<td><?php echo $data['jumlah']; ?></td>
										<td><?php echo $data['harga_jual']; ?></td>
										<td width="20%">
											<!-- mengambil foto -->
											<a href="assets/img/<?php echo $data['foto_brg'];?>">
												<!-- menampilkan foto -->
												<img src="assets/img/<?php echo $data['foto_brg'];?>" alt="foto_brg" width="100%">
											</a>
										</td>
										<td width="25%" class="text-center">

											<a href="detail-upload.php?id_brgmasuk=<?php echo $data['id_brgmasuk']; ?>" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modalDetail<?php echo $data['id_brgmasuk'];?>">
												<i class="fas fa-eye"></i>Detail</a>
												<!-- btn sm ukuran -->
												<!-- mb tuh batas bawah ee -->
												<a href="ubah-upload.php?id_brgmasuk=<?php echo $data['id_brgmasuk']; ?>" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUbah<?php echo $data['id_brgmasuk']; ?>">
													<i class="fas fa-edit"></i>Update</a>

													<a href="hapus-upload.php?id_brgmasuk=<?php echo $data['id_brgmasuk'] ?>" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_brgmasuk'];  ?>">
														<i class="fas fa-trash-alt"></i>Delete</a>
													</td>
												</tr>

											<?php endforeach; ?>
										</tbody>


									</table>
								</div>
							</div>
						</div>
					</div>
				</main>

				<!-- Modal Hapus -->
				<?php foreach ( $brgmasuk as $data ) : ?>
					<!-- Modal Hapus -->
					<div class="modal fade" id="modalHapus<?php echo $data['id_brgmasuk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header bg-danger text-white">
									<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Barang</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Yakin <?php echo $data['nama'] ?> akan dihapus ???</p>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
									<a href="hapus-upload.php?id_brgmasuk=<?php echo $data['id_brgmasuk'];?>" name="hapus" class="btn btn-danger btn-sm">Delete</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>

		<!-- Modal Ubah -->

		<?php foreach ( $brgmasuk as $data ) : ?>
			<div class="modal fade" id="modalUbah<?php echo $data['id_brgmasuk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-success text-white">
							<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Barang</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data">
								<input type="hidden" name="id_brgmasuk" value="<?php echo $data['id_brgmasuk']; ?>">
								<input type="hidden" name="fotoLama" value="<?php echo $data['foto_brg']; ?>">
								<input type="hidden" name="berkasLama" value="<?php echo $data['kwintasi']; ?>">
								<div class="row">
									<div class="form-group col-lg-6">
										<label for="nama">Nama</label>
										<input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama']; ?>">
									</div>
									<div class="form-group col-lg-6">
										<label for="jumlah">Jumlah</label>
										<input type="text" name="jumlah" id="jumlah" class="form-control" value="<?php echo $data['jumlah']; ?>">
									</div>
								</div>

								
								<div class="row">
									<div class="form-group col-lg-6">
										<label for="harga_awal">Harga Awal</label>
										<input type="text" name="harga_awal" id="harga_awal" class="form-control" value="<?php echo $data['harga_awal']; ?>">
									</div>

									<div class="form-group col-lg-6">
										<label for="harga_jual">Harga Jual</label>
										<input type="text" name="harga_jual" id="harga_jual" class="form-control" value="<?php echo $data['harga_jual']; ?>">
									</div>
								</div>

								<div class="form-group ">
									<label for="foto_brg">Foto Barang Masuk<small>(Max 2 MB)</small></label><br>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="foto_brg" name="foto_brg" onchange="previewImg()" >
										<label class="custom-file-label" for="foto_brg">Pilih foto...</label>
									</div>
									<div class="mt-1">
										<img src="assets/img/<?php echo $data['foto_brg']; ?>" alt="" class="img-thumbnail img-preview" width="100px">
									</div>
								</div>

								<div class="form-group">
									<label for="kwintasi">Berkas Kwitansi<small>(PDF Max 2 MB)</small></label><br>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="kwintasi" name="kwintasi" onchange="previewPdf()" >
										<label class="custom-file-label show-pdf<?php echo $data['id_brgmasuk']; ?>" for="kwintasi"><?php echo $data['kwintasi']; ?></label>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
								<button type="submit" name="ubah" class="btn btn-success btn-sm">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>


	<!-- Modal Detail -->
	<?php foreach ( $brgmasuk as $data ) : ?>
		<div class="modal fade" id="modalDetail<?php echo $data['id_brgmasuk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-secondary text-white">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eye"></i> Detail Barang</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table" id="dataTable" width="100%" cellspacing="0">
							<tr class="form-group">
								<td width="35%">Tanggal Masuk </td>
								<td>: <?php echo $data['tanggal_masuk']; ?></td>
							</tr>

							<tr class="form-group">
								<td width="35%">Nama </td>
								<td>: <?php echo $data['nama']; ?></td>
							</tr>

							<tr class="form-group">
								<td width="35%">Jumlah </td>
								<td>: <?php echo $data['jumlah']; ?></td>
							</tr>

							<tr class="form-group">
								<td width="35%">Harga Awal </td>
								<td>: Rp.<?php echo number_format($data['harga_awal'], 0,'.','.'); ?></td>
							</tr>

							<tr class="form-group">
								<td width="35%">Harga Jual </td>
								<td>: Rp.<?php echo number_format($data['harga_jual'], 0,'.','.'); ?></td>
							</tr>

							<tr class="form-group">
								<td width="35%">Foto Barang Masuk </td>
								<td>: <img width="35%" src="assets/img/<?php echo $data['foto_brg']; ?>" alt="foto_brg"></td>
							</tr>

							<tr class="form-group">
								<td width="35%">Berkas </td>
								<td>: <a href="assets/pdf/<?php echo $data['kwintasi'] ?>">Lihat disini</a></td>
							</tr>


						</table>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>

	<script type="text/javascript">
		function previewImg() {
			const gambar = document.querySelector('#foto_brg');
			const gambarLabel = document.querySelector('.custom-file-label');
			const imgPreview = document.querySelector('.img-preview');

			gambarLabel.textContent = gambar.files[0].name;

			const fileGambar = new FileReader();
			fileGambar.readAsDataURL(gambar.files[0]);

			fileGambar.onload = function(e) {
				imgPreview.src = e.target.result;
			}
		}
	</script>


	<?php foreach ( $brgmasuk as $data ) : ?>
		<script type="text/javascript">
			function previewPdf() {
				const gambar = document.querySelector('#kwintasi');
				const gambarLabel = document.querySelector('.show-pdf<?php echo $data['id_brgmasuk']; ?>');
				gambarLabel.textContent = gambar.files[0].name;
			}

		</script>
	<?php endforeach ?>

	

	<?php include 'layout/footer.php'; ?>