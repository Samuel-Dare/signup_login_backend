<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require_once('./db.php');



$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$email = trim($_POST['email']);
$password = (trim($_POST['password']));
$confirm_password = (trim($_POST['reenterpassword']));
// $salt = preg_replace(" /[^0-9]/", '', $password);
// $password = md5($salt.$password);
$hash_password = password_hash($password, PASSWORD_BCRYPT);

// die($reenterpassword);
// die($hash);

$duplicate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR password = '$hash_password'");

// $result2 = mysqli_num_rows($duplicate);
// die($result2);

if(password_verify($confirm_password, $hash_password)){
    $sql = 'INSERT INTO users SET firstname = ?, lastname = ?, email = ?, password = ?';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Query failed");
        }
    else if (mysqli_num_rows($duplicate) > 0)
{
 die("email or password is already in use");
}
    else{mysqli_stmt_bind_param($stmt, 'ssss', $firstname,$lastname, $email, $hash_password);
    mysqli_stmt_execute($stmt);
    }
    die("registration is successful");
}

else{
    echo "password does not match";
}

