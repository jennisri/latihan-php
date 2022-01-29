<?php 

include 'config/core.php';

$id_brgmasuk = (int)$_GET['id_brgmasuk'];

if(hapus_upload($id_brgmasuk)){
	echo "<script>
	alert ('Data berhasil dihapus');
	document.location.href = 'upload.php';
	</script>
	";
}else{
	echo "<script>
	alert ('Data gagal dihapus');
	</script>
	";
	exit;
}


?>