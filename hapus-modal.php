<?php 

include 'config/core.php';

$id_pelanggan = (int)$_GET['id_pelanggan'];

if(hapus_pelanggan($id_pelanggan)){
	echo "<script>
	alert ('Data berhasil dihapus');
	document.location.href = 'modal.php';
	</script>
	";
}else{
	echo "<script>
	alert ('Data gagal dihapus');
	document.location.href = 'modal.php';
	</script>
	";
}

?>