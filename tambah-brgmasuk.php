<?php 

$judul	= "Tambah Barang Masuk";
include 'layout/header.php';


if(isset($_POST['tambah'])){
	if(tambah_brgmasuk($_POST) > 0){
		echo "<script>
		alert ('Data berhasil ditambahkan');
		document.location.href = 'upload.php';
		</script>
		";
		exit;
	}else {
		echo "<script>
		alert ('Data gagal ditambahkan');
		document.location.href = 'upload.php';
		</script>
		";
	}
}

?>

<div class="container mt-5">
	<div class="card text-left">
		<img class="card-img-top" src="holder.js/100px180/" alt="">
		<div class="card-body">
			<h4 class="card-title">Formulir Barang Masuk</h4>
			<p class="card-text">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-lg-6">
							<label for="nama">Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" required minlength="5">
						</div>

						<div class="form-group col-lg-6">
							<label for="jumlah">Jumlah</label>
							<input type="number" name="jumlah" id="jumlah" class="form-control" required minlength="3">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-lg-6">
							<label for="harga_awal">Harga Awal</label>
							<input type="number" name="harga_awal" id="harga_awal" class="form-control" required minlength="5">
						</div>

						<div class="form-group col-lg-6">
							<label for="harga_jual">Harga Jual</label>
							<input type="number" name="harga_jual" id="harga_jual" class="form-control" required minlength="3">
						</div>
					</div>


					<div class="row">
						<div class="form-group col-sm-6">
							<label for="foto_brg">Foto Barang Masuk<small>(Max 2 MB)</small></label><br>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="foto_brg" name="foto_brg" onchange="previewImg()" required>
								<label class="custom-file-label" for="foto_brg">Pilih foto...</label>
							</div>
							<div class="mt-1">
								<img src="" alt="" class="img-thumbnail img-preview" width="100px">
							</div>
						</div>

						<div class="form-group col-sm-6">
							<label for="kwintasi">Berkas Kwitansi<small>(PDF Max 2 MB)</small></label><br>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="kwintasi" name="kwintasi" onchange="previewPdf()" required>
								<label class="custom-file-label show-pdf" for="kwintasi">Pilih foto...</label>
							</div>
							
						</div>
					</div>	



					<div class="float-right">
						<button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>

					</div>
				</form>
			</p>
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

<script type="text/javascript">
	function previewPdf() {
		const gambar = document.querySelector('#kwintasi');
		const gambarLabel = document.querySelector('.show-pdf');
		gambarLabel.textContent = gambar.files[0].name;
	}
	
</script>



<?php include 'layout/footer.php'; ?>