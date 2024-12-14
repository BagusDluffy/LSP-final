<?php 
include '../config/db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = $conn->prepare('DELETE from inventory where id = :id');
    $stmt->execute(['id' => $id]);

    $message = "Data Anda Berhasil Dihapus :)";
}

$sql = "SELECT * FROM inventory WHERE 
    nama_barang LIKE :search OR 
    jenis_barang LIKE :search OR 
    kuantitas_stock LIKE :search OR 
    lokasi_gudang LIKE :search OR 
    series_number LIKE :search";
$stmt = $conn->prepare($sql);
$stmt->execute(['search' => '%' . $search . '%']);
$inventory = $stmt->fetchAll();

$stock_kosong = false;
foreach($inventory as $item) {
    if ($item['kuantitas_stock'] == 0) {
        $stock_kosong = true;
        break;
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
            <div class="col-10 mt-2 mx-2">
                <h2>Management Inventory</h2>

                <?php if(isset($message)) : ?>
                    <div class="alert alert-success text-center">
                        <?php echo $message ?>
                    </div>
                <?php endif; ?>

                <?php if($stock_kosong) : ?>
                    <div class="alert alert-danger text-center">
                        Ada barang yang stoknya kosong!
                    </div>
                <?php endif; ?>

                <form method="get" class="mb-3 d-flex me-2">
                    <input type="text" name="search" class="form-control border-end-0 rounded-end-0" placeholder="Cari..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="reset" class="btn btn-secondary border-end-0 rounded-end-0 border-start-0 rounded-start-0" onclick="window.location.href='inventory.php';">Reset</button>
                    <button type="submit" class="btn btn-primary border-start-0 rounded-start-0">Cari</button>
                </form>
                <div class="card">
                    <div class="card-header">
                        <h3>Data Inventory</h3>
                        <a href="add_inventory.php" class="btn btn-primary">Tambah Data Inventory</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <td>No</td>
                                    <td>Nama Barang</td>
                                    <td>Jenis Barang</td>
                                    <td>Kuantitas Stock</td>
                                    <td>Lokasi Gudang</td>
                                    <td>Nomer Series</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach($inventory as $item) : 
                                    $rowClass = ($item['kuantitas_stock'] == 0) ? 'table-danger' : '';
                                ?>
                                <tr class="text-center <?php echo $rowClass; ?>">
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $item['nama_barang'] ?></td>
                                    <td><?php echo $item['jenis_barang'] ?></td>
                                    <td><?php echo $item['kuantitas_stock'] ?></td>
                                    <td><?php echo $item['lokasi_gudang'] ?></td>
                                    <td><?php echo $item['series_number'] ?></td>
                                    <td>
                                        <a href="edit_inventory.php?id=<?php echo $item['id'] ?>" class="btn btn-warning">Edit</a>
                                        <a href="?delete=<?php echo $item['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../partials/footer.php' ?>
