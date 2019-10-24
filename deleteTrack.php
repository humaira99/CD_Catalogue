<?php require "connect.php";

  $sql = "DELETE from Tracks Where trID = '".$_GET['id']."'";
  $result = mysqli_query($conn, $sql) or die($sql);

    header("Location: tracks.php");

?>
