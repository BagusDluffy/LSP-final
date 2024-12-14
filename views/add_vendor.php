<?php 
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $nama_barang = $_POST['nama_barang'];

    $stmt = $conn->prepare('INSERT INTO vendor(nama, kontak, nama_barang) VALUES(:nama, :kontak, :nama_barang)');
    $stmt->execute([
        'nama' => $nama,
        'kontak' => $kontak,
        'nama_barang' => $nama_barang
    ]);

    $message = 'Data Vendor Berhasil Ditambahkan :)';
}
?>

<?php include '../partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex ps-0">
            <div class="col-2">
                <?php include '../partials/sidebar.php' ?>
            </div>
            <div class="col-10 mt-2">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="fw-semibold">Form Add Vendor</h3>

                        <?php if(isset($message)) : ?>
                            <div class="alert alert-success">
                                <?php echo $message ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="col-10">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="nama">Masukkan Nama Vendor :</label>
                                    <input type="text" name="nama" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="kontak">Masukkan Kontak Vendor :</label>
                                    <input type="text" name="kontak" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="nama_barang">Masukkan Nama Barang :</label>
                                    <input type="text" name="nama_barang" class="form-control">
                                </div>

                                <button class="btn btn-primary col-12 mt-2 mb-1" type="submit">Simpan Data Vendor</button>
                                <a href="vendor.php" class="btn btn-secondary col-12 mb-2">Kembali Ke Halaman List</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../partials/footer.php' ?>