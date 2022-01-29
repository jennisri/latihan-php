<?php 

$judul	= "Modal";
include 'layout/header.php';


$pelanggan = query("SELECT * FROM tbl_pelanggan ORDER BY id_pelanggan DESC");

if(isset($_POST['tambah'])){
	if(tambah_modal($_POST) > 0){
		echo "<script>
		alert ('Data berhasil ditambahkan');
		document.location.href = 'modal.php';
		</script>
		";
		exit;

	}else {
		echo "<script>
		alert ('Data gagal ditambahkan');
		document.location.href = 'modal.php';
		</script>
		";	
	}
}

if(isset($_POST['update'])){
	if(update_modal($_POST) > 0){
		echo "<script>
		alert ('Data berhasil diupdate');
		document.location.href = 'modal.php';
		</script>
		";
	}else{
		echo "<script>
		alert ('Data gagal diupdate');
		document.location.href = 'modal.php';
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
					<div class="table-responsive">

						<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah</button>

						<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Jenis Kelamin</th>
									<th>No Telepon</th>
									<th>Fungsi</th>
								</tr>
							</thead>

							<tbody>
								<?php $no = 1; ?>
								<?php foreach($pelanggan as $data) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $data['nama_pelanggan']; ?></td>
										<td><?php echo $data['alamat']; ?></td>
										<td><?php echo $data['jenis_kelamin']; ?></td>
										<td><?php echo $data['no_telepon']; ?></td>

										<td width="25%" class="text-center">

											<a href="" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modalDetail<?php echo $data['id_pelanggan'];  ?>">
												<i class="fas fa-eye"></i>Detail</a>
												<!-- btn sm ukuran -->
												<!-- mb tuh batas bawah ee -->
												<a href="" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUpdate<?php echo $data['id_pelanggan']; ?>">
													<i class="fas fa-edit"></i>Update</a>

													<a href="" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_pelanggan'];  ?>">
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
			</div>

			<!-- Modal Tambah -->
			<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white">
							<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Bidang</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="form-group">
									<label for="nama_pelanggan">Nama Pelanggan :</label>
									<!-- name sesuai ke dengan database -->
									<!-- gunakan form control agar menarik -->
									<input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required minlength="3">
								</div>

								<div class="form-group">
									<label for="alamat">Alamat :</label>
									<!-- name sesuai ke dengan database -->
									<!-- gunakan form control agar menarik -->
									<input type="text" name="alamat" id="alamat" class="form-control" required minlength="3">
								</div>

								<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin :</label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
										<option value="">--pilih--</option>
										<option value="Laki-laki">Laki-laki<option>
											<option value="Perempuan">Perempuan<option>
											</select>

										</div>

										<div class="form-group">
											<label for="no_telepon">No Telepon :</label>
											<!-- name sesuai ke dengan database -->
											<!-- gunakan form control agar menarik -->
											<input type="text" name="no_telepon" id="no_telepon" class="form-control" required minlength="3">
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
											<button type="submit" name="tambah" class="btn btn-primary btn-sm">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<?php foreach ( $pelanggan as $data ) : ?>
						<!-- Modal Hapus -->
						<div class="modal fade" id="modalHapus<?php echo $data['id_pelanggan'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header bg-danger text-white">
										<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Pelanggan</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Yakin <?php echo $data['nama_pelanggan'] ?> akan dihapus ???</p>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
										<a href="hapus-modal.php?id_pelanggan=<?php echo $data['id_pelanggan'];?>" name="hapus" class="btn btn-danger btn-sm">Delete</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>

			<?php foreach ( $pelanggan as $data ) : ?>
				<!-- Modal Update -->
				<div class="modal fade" id="modalUpdate<?php echo $data['id_pelanggan'];  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header bg-success text-white">
								<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Update Pelanggan</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>">
									<div class="form-group">
										<label for="nama_pelanggan">Nama Pelanggan :</label>
										<!-- name sesuai ke dengan database -->
										<!-- gunakan form control agar menarik -->
										<input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required minlength="3" value="<?php echo $data['nama_pelanggan']; ?>">
									</div>

									<div class="form-group">
										<label for="alamat">Alamat :</label>
										<!-- name sesuai ke dengan database -->
										<!-- gunakan form control agar menarik -->
										<input type="text" name="alamat" id="alamat" class="form-control" required minlength="3" value="<?php echo $data['alamat']; ?>">
									</div>

									<div class="form-group">
										<label for="jenis_kelamin">Jenis Kelamin :</label>
										<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
											<?php $jenis_kelamin = $data['jenis_kelamin']; ?>
											<option value="Laki-laki" <?php echo $jenis_kelamin == 'Laki-laki' ? 'selected' : null ?>>Laki-laki<option>
												<option value="Perempuan" <?php echo $jenis_kelamin == 'Perempuan' ? 'selected' : null ?>>Perempuan<option>
												</select>

											</div>

											<div class="form-group">
												<label for="no_telepon">No Telepon :</label>
												<!-- name sesuai ke dengan database -->
												<!-- gunakan form control agar menarik -->
												<input type="text" name="no_telepon" id="no_telepon" class="form-control" required minlength="3" value="<?php echo $data['no_telepon']; ?>">
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
												<button type="submit" name="update" class="btn btn-success btn-sm">Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>

					<?php foreach ( $pelanggan as $data ) : ?>
						<!-- Modal Detail -->
						<div class="modal fade" id="modalDetail<?php echo $data['id_pelanggan'];  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header bg-secondary text-white">
										<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eye"></i> Detail Pelanggan</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table class="table" id="dataTable" width="100%" cellspacing="0">
											<tr class="form-group">
												<td  width="35%">Nama</td>
												<td>: <?php echo $data['nama_pelanggan']; ?></td>
											</tr>

											<tr class="form-group">
												<td  width="35%">Alamat</td>
												<td>: <?php echo $data['alamat']; ?></td>
											</tr>

											<tr class="form-group">
												<td  width="35%">Jenis Kelamin</td>
												<td>: <?php echo $data['jenis_kelamin']; ?></td>
											</tr>

											<tr class="form-group">
												<td  width="35%">No Telepon</td>
												<td>: <?php echo $data['no_telepon']; ?></td>
											</tr>
										</table>
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>



			<?php 
			include 'layout/footer.php';
			?>
