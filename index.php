<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
?>

<?php require_once('./db.php'); ?>

<?php

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$email = trim($_POST['email']);
$password = (trim($_POST['password']));
$password2 = (trim($_POST['reenterpassword']));
// $salt = preg_replace(" /[^0-9]/", '', $password);
// $password = md5($salt.$password);
$hash = password_hash($password, PASSWORD_BCRYPT);

// die($reenterpassword);
// die($hash);

if (password_verify($password2, $hash)){
    die ("password is valid");
}
else{
    die ("password is invalid");
}



$sql = 'INSERT INTO users SET firstname = ?, lastname = ?, email = ?, password = ?, reenterpassword = ?';

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("Query failed");
    }
else{mysqli_stmt_bind_param($stmt, 'sssss', $firstname,$lastname, $email, $password, $reenterpassword);
mysqli_stmt_execute($stmt);
}
?>