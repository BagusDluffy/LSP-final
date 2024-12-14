<?php
session_start();
include '../config/db.php';

function login($email, $password){
    global $conn;
    $password = md5($password);

    $stmt = $conn->prepare('SELECT * FROM user where email = :email and password = :password');
    $stmt->execute([
        'email' => $email,
        'password' => $password
    ]);

    if($stmt->rowCount() > 0){
        $user = $stmt->fetch();

        $_SESSION['user'] = $user['nama'];
        return true;
    }
    return false;
}

function checkAuth(){
    if(!isset($_SESSION['user'])){
        header('location: ../views/login.php');
        exit();
    }
}