<?php 
include '../config/db.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = $conn->prepare('DELETE from vendor where id = :id');
    $stmt->execute(['id' => $id]);

    $message = "Data Anda Berhasil Dihapus :)";
}

$stmt = $conn->query('SELECT * FROM vendor');
$vendor = $stmt->fetchAll();
?>

<?php include '../partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex ps-0">
            <div class="col-2">
                <?php include '../partials/sidebar.php' ?>
            </div>
            <div class="col-10 mt-2 mx-2">
                <h2>Management vendor</h2>

                <?php if(isset($message)) : ?>
                    <div class="alert alert-success text-center">
                        <?php echo $message ?>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Data Vendor</h3>
                        <a href="add_vendor.php" class="btn btn-primary">Tambah Data Vendor</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <td>No</td>
                                    <td>Nama Vendor</td>
                                    <td>Kontak</td>
                                    <td>Nama Barang</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach($vendor as $vendor) : 
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $vendor['nama'] ?></td>
                                    <td><?php echo $vendor['kontak'] ?></td>
                                    <td><?php echo $vendor['nama_barang'] ?></td>
                                    <td>
                                        <a href="edit_vendo r.php?id=<?php echo $vendor['id'] ?>" class="btn btn-warning">Edit</a>
                                        <a href="?delete=<?php echo $vendor['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus?')">Delete</a>
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