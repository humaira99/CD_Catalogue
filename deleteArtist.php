<?php require "connect.php";

  $sql = "DELETE from Artist Where artID = '".$_GET['id']."'";
  $result = mysqli_query($conn, $sql) or die($sql);

    header("Location: artists.php");

?>
