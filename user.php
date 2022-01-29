<?php 

$judul = 'Daftar User';

include 'layout/header.php';

// QUERY TAMPIL DATA user UNTUK ADMIN
$user = query("SELECT * FROM user ORDER BY id_user DESC");

// query tampil akun untuk operator
// $akun_operator = query("SELECT * FROM akun WHERE id_akun = '$id_akun'");

// ketika tombol submit ditekan jalankan fungsi dibawah ini
if(isset($_POST['tambah'])){
	if(tambah_user($_POST) > 0){
		echo "
		<script>
		alert ('Data Akun Berhasil Ditambahkan');
		document.location.href = 'user.php';
		</script>
		";
	}else {
		echo "
		<script>
		alert ('Data Akun Gagal Ditambahkan');
		document.location.href = 'user.php';
		</script>
		";

	}
}

// ketika tombol submit ditekan jalankan fungsi dibawah ini
if(isset($_POST['ubah'])){
	if(ubah_user($_POST) > 0){
		echo "
		<script>
		alert ('Data Akun Berhasil Diubah');
		document.location.href = 'user.php';
		</script>
		";
	}else {
		echo "
		<script>
		alert ('Data Akun Gagal Diubah');
		document.location.href = 'user.php';
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
					Tabel Daftar Akun
				</div>
				<div class="card-body">
					<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah</button>

					<div class="table-responsive">

						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Username</th>
									<th>Hak Akses</th>
									<th>Password</th>
									<th>Fungsi</th>
								</tr>
							</thead>

							<tbody>
								<?php $no = 1; ?>
								<?php foreach($user as $data) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $data['username']; ?></td>
										<td>
											<?php if($data['role'] == 1) : ?>
												Admin
												<?php else : ?>
													Operator
												<?php endif; ?>
											</td>

											<td>Ter-enkripsi</td>
											<td width="25%" class="text-center">
												<!-- btn sm ukuran -->
												<!-- mb tuh batas bawah ee -->
												<button class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUbah<?php echo $data['id_user']; ?>">
													<i class="fas fa-edit"></i>Update</button>

													<a href="hapus-user.php?id_user=<?php echo $data['id_user']; ?>" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_user'];  ?>">
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

				<!-- Modal Tambah -->
				<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary text-white">
								<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Akun</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<div class="form-group">
										<label for="username">Username :</label>
										<!-- name sesuai ke dengan database -->
										<!-- gunakan form control agar menarik -->
										<input type="text" name="username" id="username" class="form-control" required minlength="3">
									</div>


									<div class="form-group">
										<label for="role">Hak Akses</label>
										<select name="role" id="role" class="form-control">
											<option value="">--pilih--</option>
											<option value="1">Administrator</option>
											<option value="2">Operator</option>
										</select>
									</div>

									<div class="form-group">

										<label for="pass">Password :</label>
										<div class="input-group">
											<input type="password" name="password" id="pass" class="form-control" required minlength="5">
											<div class="input-group-append">
												<span class="input-group-text">
													<a id="check"><i class="fas fa-eye"></i></a>
												</span>
											</div>
										</div>

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

				<!-- Modal Ubah -->
				<?php foreach ( $user as $data) : ?>
					<div class="modal fade" id="modalUbah<?php echo $data['id_user'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-success text-white">
									<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Ubah Akun</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<input type="hidden" name="id_user" value="<?php echo $data['id_user'] ;?>">
										<div class="form-group">
											<label for="username">Username :</label>
											<!-- name sesuai ke dengan database -->
											<!-- gunakan form control agar menarik -->
											<input type="text" name="username" id="username" class="form-control" required minlength="3" value="<?php echo $data['username'] ?>">
										</div>


										<div class="form-group">
											<label for="role">Hak Akses</label>
											<select name="role" id="role" class="form-control">
												<?php $role = $data['role']; ?>
												<option value="1" <?php echo $role == '1' ? 'selected' : null ?>>Administrator</option>
												<option value="2" <?php echo $role == '2' ? 'selected' : null ?>>Operator</option>
											</select>
										</div>

										<div class="form-group">

											<label for="password">Password :</label>
											<div class="input-group">
												<input type="password" name="password" id="password<?php echo $data['id_user'];?>" class="form-control" required minlength="5">
												<div class="input-group-append">
													<span class="input-group-text">
														<input type="checkbox" class="form-checkbox<?php echo $data['id_user'];?>">
													</span>
												</div>
											</div>

										</div>



										<div class="modal-footer">
											<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
											<button type="submit" name="ubah" class="btn btn-success btn-sm">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ;?>

				<!-- Modal Hapus -->
				<?php foreach ( $user as $data) : ?>
					<div class="modal fade" id="modalHapus<?php echo $data['id_user'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-danger text-white">
									<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Akun</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Apakah yakin ingin menghapus <?php echo $data['username']; ?> ??</p>
								</div>


								<div class="modal-footer">
									<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
									<a href="hapus-user.php?id_user=<?php echo $data['id_user']; ?>" name="hapus" class="btn btn-danger btn-sm">Hapus</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ;?>
				


				<script>
					var x = document.getElementById("check");
					var pass = document.getElementById("pass");
					x.onclick = function(){
						if(pass.type === "password"){
							pass.type ='text';
							x.innerHTML = '<i class="fa fa-eye-slash"></i>';
						}else{
							pass.type ='password'
							x.innerHTML = '<i class="fa fa-eye"></i>';
						}
					}
				</script>

				<!-- script untuk dapat melihat password menjadi text -->
				<?php foreach ( $user as $data ) : ?>
					<script type="text/javascript">
						$(document).ready(function(){
							$('.form-checkbox<?php echo $data['id_user']; ?>').click(function(){
								if($(this).is(':checked')){
									$('#password<?php echo $data['id_user']; ?>').attr('type', 'text');
								}else{
									$('#password<?php echo $data['id_user']; ?>').attr('type', 'password');
								}
							});
						});


					</script>
				<?php endforeach ?>




				<?php include 'layout/footer.php'; ?>