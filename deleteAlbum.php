<?php require "connect.php";

  $sql = "DELETE from CD Where cdID = '".$_GET['id']."'";
  $result = mysqli_query($conn, $sql) or die($sql);

    header("Location: albums.php");

?>
