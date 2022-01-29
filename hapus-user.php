<?php 

include 'config/core.php';

$id_user = (int)$_GET['id_user'];

if(hapus_user($id_user)){
	echo "<script>
	alert ('data berhasil dihapus');
	document.location.href = 'user.php';
	</script>
	";
}else{
	echo "<script>
	alert ('data gagal dihapus');
	document.location.href = 'user.php';
	</script>
	";
}

?>