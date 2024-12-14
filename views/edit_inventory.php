<?php 
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

$id = $_GET['id'] ?? '';

$stmt = $conn->prepare('SELECT * FROM inventory where id = :id');
$stmt->execute(['id' => $id]);
$inventory = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $jenis_barang = $_POST['jenis_barang'];
    $kuantitas_stock = $_POST['kuantitas_stock'];

    $stmt = $conn->prepare('UPDATE inventory SET jenis_barang = :jenis_barang, kuantitas_stock = :kuantitas_stock where id = :id');
    $stmt->execute([
        'jenis_barang' => $jenis_barang,
        'kuantitas_stock' => $kuantitas_stock,
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
                        <h3 class="fw-semibold">Form Edit Data Inventory</h3>

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
                                    <label for="">Nama Barang :</label>
                                    <input type="text" value="<?php echo $inventory['nama_barang'] ?>" class=" form-control" disabled>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="jenis_barang">Ubah Jenis Barang :</label>
                                    <input type="text" name="jenis_barang" value="<?php echo $inventory['jenis_barang'] ?>" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="kuantitas_stock">Ubah Stock Barang :</label>
                                    <input type="text" name="kuantitas_stock" value="<?php echo $inventory['kuantitas_stock'] ?>" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Lokasi Gudang :</label>
                                    <input type="text" value="<?php echo $inventory['lokasi_gudang'] ?>" class="form-control" disabled>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Nomer Series :</label>
                                    <input type="text" value="<?php echo $inventory['series_number'] ?>" class="form-control" disabled>
                                </div>

                                <button class="btn btn-primary col-12 mt-2 mb-1" type="submit">Simpan Perubahan Data Inventory</button>
                                <a href="inventory.php" class="btn btn-secondary col-12 mb-2">Kembali Ke Halaman List</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../partials/footer.php' ?>