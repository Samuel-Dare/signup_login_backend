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
// $salt = preg_replace(" /[^0-9]/", '', $password);
// $password = md5($salt.$password);
$hash_password = password_hash($password, PASSWORD_BCRYPT);
$confirm_password = (trim($_POST['reenterpassword']));

// die($reenterpassword);
// die($hash);

$duplicate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR password = '$hash_password'");

if(isset($firstname)) && isset($lastname) && isset($email) && isset($password) && isset($confirm_password)
{
    $sql = 'INSERT INTO users SET firstname = ?, lastname = ?, email = ?, password = ?';
    $stmt = mysqli_stmt_init($conn);

    if(!password_verify($confirm_password, $hash_password))
    {
        echo "password does not match";
    }
    else if(mysqli_num_rows($duplicate) > 0)
    {
        die("email or password already in use");
    }
    else if (!mysqli_stmt_prepare($stmt, $sql)) 
    {
        die("Query failed");
    }
    else if(!mysqli_stmt_bind_param($stmt, 'ssss', $firstname, $lastname, $email, $hash_password))
    {
        die("Prepared statement failed to input data into database")
    }    
    else
    {
        mysqli_stmt_execute($stmt);
        die("registration is successful");
    }
}
  
else if(empty($firstname))
{
    $em = "First name is required";
    header("Location: index.php?error=$em");
    exit;
    die("firstname is required");
}
else if(empty($lastname))
{
    $em = "Last name is required";
    header("Location: index.php?error=$em");
    exit;
    die("lastname is required");
}
else if(empty($email))
{
    $em = "Email address is required";
    header("Location: index.php?error=$em");
    exit;
    die("email is required");
}
else if(empty($hash_password))
{
    $em = "Password is required";
    header("Location: index.php?error=$em");
    exit;
    die("Password is required");
}
else if(empty($confirm_password))
{
    $em = "Confirm password";
    header("Location: index.php?error=$em");
    exit;
    die("Confirm password")
}

else
{
    $em = "Missing fields, kindly fill all fields";
    header("Location: index.php?error=$em");
    exit;
    die("Missing fields")
}

?>