<?php
$serverName = '192.168.1.23';
$userName = 'root';
$password = '';
$databaseName = 'naira4dollar_database-project';
$conn = mysqli_connect($serverName, $userName, $password, $databaseName);
if($conn) {
        echo "Database connection successful";
    }
else {
    echo "Error!";
}
?>  