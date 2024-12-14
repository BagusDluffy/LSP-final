<?php 
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

$id = $_GET['id'] ?? '';

$stmt = $conn->prepare('SELECT * FROM storage_unit where id = :id');
$stmt->execute(['id' => $id]);
$storage_unit = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi = $_POST['lokasi'];

    $stmt = $conn->prepare('UPDATE storage_unit SET nama_gudang = :nama_gudang, lokasi = :lokasi where id = :id');
    $stmt->execute([
        'nama_gudang' => $nama_gudang,
        'lokasi' => $lokasi,
        'id' => $id
    ]);

    $message = 'Data Anda Berhasil Diperbarui :)';
}
?>

<?php include '../partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex ps-0">
            <div class="col-2">
                <?php include '../partials/sidebar.php' ?>
            </div>
            <div class="col-10 mt-2 mx-2">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="fw-semibold">Form Edit Data Storage Unit</h3>

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
                                    <label for="nama_gudang">Ubah Nama Gudang :</label>
                                    <input type="text" name="nama_gudang" value="<?php echo $storage_unit['nama_gudang'] ?>" class=" form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="lokasi">Ubah Lokasi Gudang :</label>
                                    <input type="text" name="lokasi" value="<?php echo $storage_unit['lokasi'] ?>" class="form-control">
                                </div>

                                <button class="btn btn-primary col-12 mt-2 mb-1" type="submit">Simpan Perubahan Data Storage Unit</button>
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