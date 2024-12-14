<?php 
include '../config/db.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = $conn->prepare('DELETE from storage_unit where id = :id');
    $stmt->execute(['id' => $id]);

    $message = "Data Anda Berhasil Dihapus :)";
}

$stmt = $conn->query('SELECT * FROM storage_unit');
$storage_unit = $stmt->fetchAll();
?>

<?php include '../partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex ps-0">
            <div class="col-2">
                <?php include '../partials/sidebar.php' ?>
            </div>
            <div class="col-10 mt-2 mx-2">
                <h2>Management Storage Unit</h2>

                <?php if(isset($message)) : ?>
                    <div class="alert alert-success text-center">
                        <?php echo $message ?>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Data Storage Unit</h3>
                        <a href="add_storage_unit.php" class="btn btn-primary">Tambah Data Storage Unit</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <td>No</td>
                                    <td>Nama Gudang</td>
                                    <td>Lokasi</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach($storage_unit as $storage_unit) : 
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $storage_unit['nama_gudang'] ?></td>
                                    <td><?php echo $storage_unit['lokasi'] ?></td>
                                    <td>
                                        <a href="edit_storage_unit.php?id=<?php echo $storage_unit['id'] ?>" class="btn btn-warning">Edit</a>
                                        <a href="?delete=<?php echo $storage_unit['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus?')">Delete</a>
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