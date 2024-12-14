<?php 
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

$id = $_GET['id'] ?? '';

$stmt = $conn->prepare('SELECT * FROM vendor where id = :id');
$stmt->execute(['id' => $id]);
$vendor = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $nama_barang = $_POST['nama_barang'];

    $stmt = $conn->prepare('UPDATE vendor SET nama = :nama, kontak = :kontak, nama_barang = :nama_barang where id = :id');
    $stmt->execute([
        'nama' => $nama,
        'kontak' => $kontak,
        'nama_barang' => $nama_barang,
        'id' => $id
    ]);

    $message = "Data Anda Berhasil Diperbarui :)";
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
                        <h3 class="fw-semibold">Form Edit Data Vendor</h3>

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
                                    <label for="nama">Ubah Nama Vendor :</label>
                                    <input type="text" name="nama" value="<?php echo $vendor['nama'] ?>" class=" form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="kontak">Ubah Kontak Vendor :</label>
                                    <input type="text" name="kontak" value="<?php echo $vendor['kontak'] ?>" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="nama_barang">Ubah Nama Barang :</label>
                                    <input type="text" name="nama_barang" value="<?php echo $vendor['nama_barang'] ?>" class="form-control">
                                </div>

                                <button class="btn btn-primary col-12 mt-2 mb-1" type="submit">Simpan Perubahan Data Vendor</button>
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