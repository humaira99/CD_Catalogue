<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "psyha5";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$artResult = mysqli_query($conn, "SELECT * FROM Artist");
$artRows = mysqli_num_rows($artResult);

$cdResult = mysqli_query($conn, "SELECT * FROM CD");
$cdRows = mysqli_num_rows($cdResult);

$trResult = mysqli_query($conn, "SELECT * FROM Tracks");
$trRows = mysqli_num_rows($trResult);


?>
