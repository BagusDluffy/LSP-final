<?php 
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

$stmt = $conn->query('SELECT COUNT(*) as total_inventory from inventory');
$total_inventory = $stmt->fetchColumn();
$stmt = $conn->query('SELECT COUNT(*) as total_storage_unit from storage_unit');
$total_storage_unit = $stmt->fetchColumn();
$stmt = $conn->query('SELECT COUNT(*) as total_vendor from vendor');
$total_vendor = $stmt->fetchColumn();

$stmt = $conn->query('SELECT nama_barang, kuantitas_stock from inventory');
$inventory = $stmt->fetchAll();
?>

<?php include '../partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex ps-0">
            <div class="col-2">
                <?php include '../partials/sidebar.php' ?>
            </div>
            <div class="col-10">
                <div class="row mt-1 ms-2">
                    <h2 class="">Dashboard Panel</h2>
                    <p>Selamat Datang Di Admin Panel!</p>
                    <div class="col-4">
                        <div class="card bg-info">
                            <div class="card-header text-white fw-semibold">Total Data Inventory</div>
                            <div class="card-body text-white">
                                <h5 class=""><?php echo $total_inventory; ?> Data Inventory</h5>
                                <a href="inventory.php" class="btn btn-secondary">Kelolah Inventory</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-warning">
                            <div class="card-header text-white fw-semibold">Total Data Storage</div>
                            <div class="card-body text-white">
                                <h5 class=""><?php echo $total_storage_unit; ?> Data Storage</h5>
                                <a href="storage_unit.php" class="btn btn-secondary">Kelolah Storage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-success">
                            <div class="card-header text-white fw-semibold">Total Data Vendor</div>
                            <div class="card-body text-white">
                                <h5 class=""><?php echo $total_vendor; ?> Data Vendor</h5>
                                <a href="vendor.php" class="btn btn-secondary">Kelolah Vendor</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-flex mt-5 justify-content-center">
                    <div class="col-10">
                        <h4 class="text-center fw-semibold">Stock Barang</h4>
                        <div class="card">
                            <div class="card-header text-center text-white bg-primary">
                                <p class="my-auto">Memantau Stock Barang</p>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <td>No</td>
                                            <td>Nama Barang</td>
                                            <td>Kuantitas Stock</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach($inventory as $inventory):
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $inventory['nama_barang'] ?></td>
                                            <td><?php echo $inventory['kuantitas_stock'] ?></td>
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
    </div>
</div>
<?php include '../partials/footer.php' ?>