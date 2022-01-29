<?php 

$judul	= "Hasil";
include 'layout/header.php';


$barang = query("SELECT * FROM tbl_barang ORDER BY id_barang LIMIT 0,3");

$pelanggan = query("SELECT * FROM tbl_pelanggan ORDER BY id_pelanggan LIMIT 0,3");

$brgmasuk =query("SELECT * FROM tbl_brgmasuk ORDER BY id_brgmasuk LIMIT 0,3");


// MODAL
if(isset($_POST['update'])){
	if(update_modal($_POST) > 0){
		echo "<script>
		alert ('Data berhasil diupdate');
		documents.location.href = 'hasil.php';
		</script>
		";
	}else{
		echo "<script>
		alert ('Data gagal diupdate');
		documents.location.href = 'hasil.php';
		</script>
		";
	}
}

// UPLOAD
if(isset($_POST['ubah'])){
	if(ubah_upload($_POST) > 0){
		echo "<script>
		alert ('Data berhasil diupdate');
		documents.location.href = 'hasil.php';
		</script>
		";
	}else{
		echo "<script>
		alert ('Data gagal diupdate');
		documents.location.href = 'hasil.php';
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
						<table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Catatan</th>
									<th>Fungsi</th>
								</tr>
							</thead>

							<tbody>
								<?php $no = 1; ?>
								<?php foreach($barang as $data) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $data['nama_barang']; ?></td>
										<td><?php echo $data['jumlah_barang']; ?></td>
										<td>Rp. <?php echo number_format($data['harga_barang'], 0,'.','.') ?></td>
										<td><?php echo $data['catatan']; ?></td>

										<td width="15%" class="text-center">

											<a href="detail-standar.php?id_barang=<?php echo $data['id_barang']; ?>" class="btn btn-secondary btn-sm mb-1">
												<i class="fas fa-eye"></i></a>
												<!-- btn sm ukuran -->
												<!-- mb tuh batas bawah ee -->
												<a href="update-standar.php?id_barang=<?php echo $data['id_barang']; ?>" class="btn btn-success btn-sm mb-1">
													<i class="fas fa-edit"></i></a>

													<a href="hapus-standar.php?id_barang=<?php echo $data['id_barang'] ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah yakin data bidang akan dihapus?');">
														<i class="fas fa-trash-alt"></i></a>
													</td>

												</tr>

											<?php endforeach; ?>
										</tbody>


									</table>
								</div>
							</div>
						</div>

						<div class="card mb-4">
							<div class="card-header">
								<i class="fas fa-table mr-1"></i>
								Tabel Daftar Pelanggan
							</div>
							<div class="card-body">
								<div class="table-responsive">
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
													<td width="15%" class="text-center">

														<a href="" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modalDetail<?php echo $data['id_pelanggan'];  ?>">
															<i class="fas fa-eye"></i></a>
															<!-- btn sm ukuran -->
															<!-- mb tuh batas bawah ee -->
															<a href="" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUpdate<?php echo $data['id_pelanggan']; ?>">
																<i class="fas fa-edit"></i></a>

																<a href="" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_pelanggan'];  ?>">
																	<i class="fas fa-trash-alt"></i></a>
																</td>

															</tr>

														<?php endforeach; ?>
													</tbody>


												</table>
											</div>
										</div>
									</div>

									<div class="card mb-4">
										<div class="card-header">
											<i class="fas fa-table mr-1"></i>
											Tabel Daftar Barang Masuk
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped" id="upload" width="100%" cellspacing="0">
													<thead>
														<tr>
															<th>No</th>
															<th>Tanggal Masuk</th>
															<th>Nama</th>
															<th>Jumlah</th>
															<th>Harga Awal</th>
															<th>Harga Jual</th>
															<th>Foto Barang Masuk</th>
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
																<td>Rp. <?php echo number_format($data['harga_awal'], 0,'.','.') ?></td>
																<td>Rp. <?php echo number_format($data['harga_jual'], 0, '.', '.') ?></td>
																<td width="20%">
																	<img width="40%" src="assets/img/<?php echo $data['foto_brg']; ?>" alt="">
																</td>

																<td width="15%" class="text-center">

																	<a href="detail-upload.php?id_brgmasuk=<?php echo $data['id_brgmasuk']; ?>" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modalDetail<?php echo $data['id_brgmasuk'];?>">
																		<i class="fas fa-eye"></i></a>
																		<!-- btn sm ukuran -->
																		<!-- mb tuh batas bawah ee -->
																		<a href="ubah-upload.php?id_brgmasuk=<?php echo $data['id_brgmasuk']; ?>" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUbah<?php echo $data['id_brgmasuk']; ?>">
																			<i class="fas fa-edit"></i></a>

																			<a href="hapus-upload.php?id_brgmasuk=<?php echo $data['id_brgmasuk'] ?>" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_brgmasuk'];  ?>">
																				<i class="fas fa-trash-alt"></i></a>
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


										<!-- MODAL UNTUK FILE MODAL.PHP -->

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
									<?php endforeach ?> ?>

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

									<!-- MODAL UNTUK FILE UPLOAD -->
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
								<?php endforeach ?> ?>

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

														<div class="form-group">
															<label for="nama">Nama</label>
															<input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama']; ?>">
														</div>

														<div class="form-group">
															<label for="jumlah">Jumlah</label>
															<input type="text" name="jumlah" id="jumlah" class="form-control" value="<?php echo $data['jumlah']; ?>">
														</div>

														<div class="form-group">
															<label for="harga_awal">Harga Awal</label>
															<input type="text" name="harga_awal" id="harga_awal" class="form-control" value="<?php echo $data['harga_awal']; ?>">
														</div>

														<div class="form-group">
															<label for="harga_jual">Harga Jual</label>
															<input type="text" name="harga_jual" id="harga_jual" class="form-control" value="<?php echo $data['harga_jual']; ?>">
														</div>

														<div class="form-group">
															<label for="foto_brg">Foto Barang Masuk<small>(Max 2 MB)</small></label><br>
															<div class="custom-file">
																<input type="file" class="custom-file-input" id="foto_brg" name="foto_brg" onchange="previewImg()" >
																<label class="custom-file-label" for="foto_brg">Pilih foto...</label>
															</div>
															<div class="mt-1">
																<img src="assets/img/<?php echo $data['foto_brg']; ?>" alt="" class="img-thumbnail img-preview" width="100px">
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
								<?php endforeach ?> ?>

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


													</table>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
												</div>
											</div>
										</div>
									</div>
									<?php endforeach ?> ?>









									<?php include 'layout/footer.php'; ?>