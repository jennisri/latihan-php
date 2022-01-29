<?php 
$judul  = "Standar";
include 'layout/header.php';


$barang  = query("SELECT * FROM tbl_barang ORDER BY id_barang DESC");


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
                        <table id="example" class="table table-striped table-bordered data">
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
                                        <td><?php echo $data['harga_barang']; ?></td>
                                        <td><?php echo $data['catatan']; ?></td>
                                        <td width="25%" class="text-center">

                                            <a href="detail-standar.php?id_barang=<?php echo $data['id_barang']; ?>" class="btn btn-secondary btn-sm mb-1">
                                                <i class="fas fa-eye"></i>Detail</a>
                                                <!-- btn sm ukuran -->
                                                <!-- mb tuh batas bawah ee -->
                                                <a href="update-standar.php?id_barang=<?php echo $data['id_barang']; ?>" class="btn btn-success btn-sm mb-1">
                                                    <i class="fas fa-edit"></i>Update</a>

                                                    <a href="hapus-standar.php?id_barang=<?php echo $data['id_barang'] ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah yakin data bidang akan dihapus?');">
                                                        <i class="fas fa-trash-alt"></i>Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ; ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </main>



                <?php include 'layout/footer.php'; ?>

