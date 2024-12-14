<?php 
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

$barang = $conn->query('SELECT DISTINCT id, nama_barang from vendor')->fetchAll(PDO::FETCH_ASSOC);

$gudang = $conn->query('SELECT id, nama_gudang from storage_unit')->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $conn->prepare('SELECT COUNT(*) FROM inventory WHERE series_number = :series_number');
    $stmt->execute(['series_number' => $_POST['series_number']]);
    $existing = $stmt->fetchColumn();

    if ($existing > 0) {
        $message = 'Nomor seri yang Anda masukkan sudah ada di database!';
        $alert_class = 'alert-danger';
    } else {
        $stmt = $conn->prepare('INSERT INTO inventory(nama_barang, jenis_barang, kuantitas_stock, lokasi_gudang, series_number) VALUES(:nama_barang, :jenis_barang, :kuantitas_stock, :lokasi_gudang, :series_number)');
        $stmt->execute([
            'nama_barang' => $_POST['nama_barang'],
            'jenis_barang' => $_POST['jenis_barang'],
            'kuantitas_stock' => $_POST['kuantitas_stock'],
            'lokasi_gudang' => $_POST['lokasi_gudang'],
            'series_number' => $_POST['series_number']
        ]);

        $message = 'Data Anda Berhasil Ditambahkan!';
        $alert_class = 'alert-success';
    }
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
                <div class="card ms-3">
                    <div class="card-header text-center">
                        <h3>Form Add Inventory</h3>

                        <?php if(isset($message)) : ?>
                            <div class="alert <?php echo $alert_class; ?>">
                                <?php echo $message ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="col-10">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="nama_barang">Pilih Nama Barang :</label>
                                    <select name="nama_barang" class="form-control">
                                        <?php foreach($barang as $barang): ?>
                                            <option value="<?= $barang['nama_barang'] ?>"><?= htmlspecialchars($barang['nama_barang']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="jenis_barang">Masukkan Jenis Barang :</label>
                                    <input type="text" name="jenis_barang" class="form-control" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="kuantitas_stock">Masukkan Stock Barang :</label>
                                    <input type="number" name="kuantitas_stock" class="form-control" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="lokasi_gudang">Pilih Lokasi Gudang :</label>
                                    <select name="lokasi_gudang" class="form-control">
                                        <?php foreach($gudang as $gudang): ?>
                                            <option value="<?= $gudang['nama_gudang'] ?>"><?= htmlspecialchars($gudang['nama_gudang']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="series_number">Masukkan Nomer Series :</label>
                                    <input type="text" name="series_number" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary col-12 mt-2 mb-1">Simpan Data Inventory</button>
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
