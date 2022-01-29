<?php 
$judul  = "Halaman Awal";
include 'layout/header.php';


$barang  = query("SELECT * FROM tbl_barang ORDER BY id_barang DESC");

if(isset($_POST['tambah'])){
  if(tambah_standar($_POST) > 0){
    echo "<script>
    alert ('Data berhasil ditambahkan');
    document.location.href = 'standar.php';
    </script>
    ";
  }else {
    echo "<script>
    alert ('Data gagal ditambahkan');
    document.location.href = 'index.php';
    </script>
    ";

  }
}
?>


<div class="container mt-5">
  <div class="card text-left">
    <img class="card-img-top" src="holder.js/100px180/" alt="">
    <div class="card-body">
      <h4 class="card-title">Formulir Tambah Barang</h4>
      <p class="card-text">
        <form action="" method="post">
          <div class="row">
            <div class="form-group col-lg-6">
              <label for="nama">Nama</label>
              <input type="text" name="nama_barang" id="nama" class="form-control" required minlength="5">
            </div>

            <div class="form-group col-lg-6">
              <label for="jumlah">Jumlah</label>
              <input type="text" name="jumlah_barang" id="jumlah" class="form-control" required >
            </div>
          </div>
          <div class="form-group">
           <label for="harga">Harga</label>
           <input type="text" name="harga_barang" id="harga" class="form-control" required minlength="3">
         </div>
         <div class="form-group">
           <label for="catatan">Catatan</label>
           <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control" required minlength="5"></textarea>
         </div>

         <button type="submit" class="btn btn-primary float-right" name="tambah">Tambah</button>
       </form>
     </p>
   </div>
 </div>
</div>

<?php include 'layout/footer.php'; ?>