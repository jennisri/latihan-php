<?php 

// menampilkan data
function query ($query){
	global $db;

	$result = mysqli_query($db, $query);
	$row	= [];

	while ($rows= mysqli_fetch_assoc($result)){
		$row[]=$rows;

	} return $row;

}


// fungsi tambah barang
function tambah_standar($post){
	// koneksi ke database
	global $db;
	// ambil input user
	$nama_barang = htmlspecialchars($post['nama_barang']);
	$jumlah_barang = htmlspecialchars($post['jumlah_barang']);
	$harga_barang = htmlspecialchars($post['harga_barang']);
	$catatan = htmlspecialchars($post['catatan']);
	// query tambah data
	$query = "INSERT INTO tbl_barang VALUES (null ,'$nama_barang', '$jumlah_barang', '$harga_barang', '$catatan')";
	// simpan query ke database
	mysqli_query($db, $query);
	
	return mysqli_affected_rows($db);
} 

// fungsi hapus barang
function hapus_standar($id_barang){
	global $db ;

	$query = "DELETE FROM tbl_barang WHERE id_barang = $id_barang";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// fungsi update barang
function update_standar($post){
	global $db;
	$id_barang		= $post['id_barang'];
	$nama_barang 	= strip_tags($post['nama_barang']);
	$jumlah_barang 	= strip_tags($post['jumlah_barang']);
	$harga_barang	= strip_tags($post['harga_barang']);
	$catatan 		= strip_tags($post['catatan']);
	// query tambah data
	$query = "UPDATE tbl_barang SET
	nama_barang = '$nama_barang', 
	jumlah_barang ='$jumlah_barang', 
	harga_barang = '$harga_barang',
	catatan = '$catatan' WHERE id_barang = $id_barang";
	// simpan query ke database
	mysqli_query($db, $query);
	
	return mysqli_affected_rows($db);

}

// ----------------------------------------------------------------------------------------------

function tambah_modal($post){
	global $db;

	$nama_pelanggan = htmlspecialchars($post['nama_pelanggan']);
	$alamat = htmlspecialchars($post['alamat']);
	$jenis_kelamin = htmlspecialchars($post['jenis_kelamin']);
	$no_telepon = htmlspecialchars($post['no_telepon']);

	$query = "INSERT INTO tbl_pelanggan VALUES (null, '$nama_pelanggan', '$alamat', '$jenis_kelamin', '$no_telepon')";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// hapus pelanggan
function hapus_pelanggan($id_pelanggan){
	global $db;

	$query = "DELETE FROM tbl_pelanggan WHERE id_pelanggan = '$id_pelanggan'";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// update pelanggan
function update_modal($post){
	global $db;

	$id_pelanggan = $post['id_pelanggan'];
	$nama_pelanggan = strip_tags($post['nama_pelanggan']);
	$alamat = strip_tags($post['alamat']);
	$jenis_kelamin = strip_tags($post['jenis_kelamin']);
	$no_telepon = strip_tags($post['no_telepon']);

	$query= "UPDATE tbl_pelanggan SET 
	nama_pelanggan = '$nama_pelanggan',
	alamat = '$alamat',
	jenis_kelamin = '$jenis_kelamin',
	no_telepon = '$no_telepon' WHERE id_pelanggan = $id_pelanggan
	";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// -------------------------------------------------------------------------------------------------

// tambah barang masuk
function tambah_brgmasuk($post){
	global $db;

	$nama = htmlspecialchars($post['nama']);
	$jumlah = htmlspecialchars($post['jumlah']);
	$harga_awal = htmlspecialchars($post['harga_awal']);
	$harga_jual = htmlspecialchars($post['harga_jual']);

	$foto_brg = upload_foto_barang();
	$kwintasi = upload_file();

	if(!"foto_brg"){
		return false;
	}

	if(!"kwintasi"){
		return false;
	}

	$query = "INSERT INTO tbl_brgmasuk VALUES (null, CURRENT_TIMESTAMP, '$nama', '$jumlah', '$harga_awal', '$harga_jual', '$foto_brg', '$kwintasi')";

	mysqli_query ($db, $query);

	return mysqli_affected_rows($db);

}

// fungsi ubah
function ubah_upload($post){
	global $db;

	$id_brgmasuk = $post['id_brgmasuk'];
	$nama = strip_tags($post['nama']);
	$jumlah = strip_tags($post['jumlah']);
	$harga_awal = strip_tags($post['harga_awal']);
	$harga_jual = strip_tags($post['harga_jual']);
	$fotoLama = $post['fotoLama'];
	$berkasLama = $post['berkasLama'];

	// check apakah foto diubah atau tidak
	if($_FILES['foto_brg']['error'] === 4){
		$foto_brg = $fotoLama;
	}else{
		$foto_brg = upload_foto_barang();
	}

	// check apakah foto diubah atau tidak
	if($_FILES['kwintasi']['error'] === 4){
		$kwintasi = $berkasLama;
	}else{
		$kwintasi = upload_file();
	}

	$query = "UPDATE tbl_brgmasuk SET 
	nama = '$nama',
	jumlah = '$jumlah',
	harga_awal = '$harga_awal',
	harga_jual = '$harga_jual',
	foto_brg = '$foto_brg',
	kwintasi = '$kwintasi'
	WHERE id_brgmasuk = $id_brgmasuk";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}


function upload_foto_barang(){

	$namaFile 		= $_FILES['foto_brg']['name'];
	$ukuranFile 	= $_FILES['foto_brg']['size'];
	$error 			= $_FILES['foto_brg']['error'];
	$tmpName 		= $_FILES['foto_brg']['tmp_name'];

	// check foto yang di upload 
	$ekstensiGambarValid =['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
		alert('Format Foto Tidak VALID');
		document.location.href = 'tambah_brgmasuk.php';
		</script>";
		die();
	}

	if($ukuranFile > 2048000){
		echo "<script>
		alert('Ukuran Foto Terlalu Besar');
		document.location.href = 'tambah_brgmasuk.php';
		</script>";
		die();
	}

	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensiGambar;

	// memindahkan gambar ke file
	move_uploaded_file($tmpName, 'assets/img/' . $namafilebaru);
	return $namafilebaru;
}


function upload_file(){

	$namaFile 		= $_FILES['kwintasi']['name'];
	$ukuranFile 	= $_FILES['kwintasi']['size'];
	$error 			= $_FILES['kwintasi']['error'];
	$tmpName 		= $_FILES['kwintasi']['tmp_name'];

	// check foto yang di upload 
	$ekstensiGambarValid =['pdf', 'docx', 'pptx'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
		alert('Format File Tidak VALID');
		document.location.href = 'tambah_brgmasuk.php';
		</script>";
		die();
	}

	if($ukuranFile > 2048000){
		echo "<script>
		alert('Ukuran Foto Terlalu Besar');
		document.location.href = 'tambah_brgmasuk.php';
		</script>";
		die();
	}

	
	// memindahkan gambar ke file
	move_uploaded_file($tmpName, 'assets/pdf/' . $namaFile);
	return $namaFile;
}

// function hapus
function hapus_upload($id_brgmasuk){
	global $db;

	$query = "DELETE FROM tbl_brgmasuk WHERE id_brgmasuk = '$id_brgmasuk'";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// ---------------------------------------------------------------------------------------------
// Tambah user 
function tambah_user($post){
	global $db;

	$username 	= htmlspecialchars($post['username']);
	$password	= htmlspecialchars($post['password']);
	$role 		= htmlspecialchars($post['role']);

	$password = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO user VALUES (null, '$username', '$password', '$role')";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// function hapus
function hapus_user($id_user){
	global $db;

	$query = "DELETE FROM user WHERE id_user = '$id_user'";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// Tambah user 
function ubah_user($post){
	global $db;

	$id_user	= $post['id_user'];
	$username 	= htmlspecialchars($post['username']);
	$password	= htmlspecialchars($post['password']);
	$role 		= htmlspecialchars($post['role']);

	$password = password_hash($password, PASSWORD_DEFAULT);

	$query = "UPDATE user SET
	username ='$username', 
	password ='$password', 
	role 	='$role' WHERE id_user = $id_user";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}


// -------------------------------------------------------------

?>