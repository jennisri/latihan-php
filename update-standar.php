<?php 

$judul  = "Update Standar";
include 'layout/header.php';


$id_barang = (int)$_GET['id_barang'];

$barang = query("SELECT * FROM tbl_barang WHERE id_barang = '$id_barang'")[0];

if(isset($_POST['update'])){
    if(update_standar($_POST) > 0){
        echo "<script>
        alert ('Data berhasil diubah');
        document.location.href = 'standar.php';
        </script>
        ";
    }else {
        echo "<script>
        alert ('Data gagal diubah');
        document.location.href = 'standar.php';
        </script>
        ";
    }exit;

}


?>
<div class="container mt-5">
    <div class="card text-left">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h4 class="card-title">Formulir Update Barang</h4>
        <p class="card-text">
            <form action="" method="post">
                <input type="hidden" name="id_barang" value="<?php echo $barang['id_barang']; ?>">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama_barang" id="nama" class="form-control" required minlength="5" value="<?php echo $barang['nama_barang']; ?>">
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah_barang" id="jumlah" class="form-control" required value="<?php echo $barang['jumlah_barang']; ?>">
                    </div>
                </div>
                <div class="form-group">
                   <label for="harga">Harga</label>
                   <input type="text" name="harga_barang" id="harga" class="form-control" required minlength="3" value="<?php echo $barang['harga_barang']; ?>">
               </div>
               <div class="form-group">
                   <label for="catatan">Catatan</label>
                   <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control" required minlength="5" name="catatan"><?php echo $barang['catatan'] ?></textarea>
               </div>

               <button type="submit" class="btn btn-success float-right" name="update">Update</button>
           </form>
       </p>
   </div>
</div>
</div>