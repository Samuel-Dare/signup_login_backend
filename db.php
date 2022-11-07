<?php
$serverName = '192.168.1.24';
$userName = 'root';
$password = '';
$databaseName = 'naira4dollar_database-project';
$conn = mysqli_connect($serverName, $userName, $password, $databaseName);
if($conn) {
        die("Database connection successful");
    }
else {
    echo "Error!";
}
?>  