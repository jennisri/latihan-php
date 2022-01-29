<?php 

include 'config/core.php';

$id_barang = (int)$_GET['id_barang'];

if(hapus_standar($id_barang)){
	echo "<script>
	alert ('Data berhasil dihapus');
	document.location.href = 'standar.php';
	</script>
	";
}else {
	echo "<script>
	alert ('Data gagal dihapus');
	document.location.href = 'standar.php';
	</script>
	";

}



?>