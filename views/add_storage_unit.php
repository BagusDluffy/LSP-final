<?php 
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi = $_POST['lokasi'];

    $stmt = $conn->prepare('INSERT INTO storage_unit(nama_gudang, lokasi) VALUES(:nama_gudang, :lokasi)');
    $stmt->execute([
        'nama_gudang' => $nama_gudang,
        'lokasi' => $lokasi,
    ]);

    $message = 'Data storage_unit Berhasil Ditambahkan :)';
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
                        <h3 class="fw-semibold">Form Add Storage Unit</h3>

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
                                    <label for="nama_gudang">Masukkan Nama Gudang :</label>
                                    <input type="text" name="nama_gudang" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="lokasi">Masukkan Lokasi Gudang :</label>
                                    <input type="text" name="lokasi" class="form-control">
                                </div>

                                <button class="btn btn-primary col-12 mt-2 mb-1" type="submit">Simpan Data Storage Unit</button>
                                <a href="storage_unit.php" class="btn btn-secondary col-12 mb-2">Kembali Ke Halaman List</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../partials/footer.php' ?>