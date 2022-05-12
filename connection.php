<link rel="icon" href="./GP_ICON.png">
<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "getplaced";

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    //echo "GetPlaced";
} catch (PDOException $e) {
    header('location: error.php');
    die();
}
?>
