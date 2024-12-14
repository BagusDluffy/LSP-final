<?php 
include '../auth/auth.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(login($email,$password)){
        header('location: dashboard.php');
        exit();
    } else {
        $message = "Email atau Password Anda Salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row vh-100 align-items-center">
            <div class="col-12 d-flex justify-content-center">
                <div class="col-3">
                    <h2 class="text-center fw-bold">Halam Login </h2>
                    <?php if(isset($message)) : ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $message ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header text-center text-white bg-primary">
                            <small class="my-auto">Masukkan Email Dan Password!</small>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="email">Masukkan Email :</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="password">Masukkan Password :</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary col-12 mt-2">Masuk Ke Halaman Dashboard</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>