<?php require "connect.php"; ?>

<!doctype html>

<html>

<head>
  <title>Edit Artist</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>
  <script>
  function alphanumericInput(input){
    var expected = /^[0-9 a-zA-Z]+$/;
    if (input.value.match(expected)){
      input.style.borderColor = "";
      return true;
    }
    else {
      input.style.borderColor = "red";
      return false;
    }
  }

  function formvalidationArtist(){
    var artistname = document.getElementById("edar");

    if(artistname.value == ''){
          artistname.style.borderColor = "red";
          return false;
        }

      if(alphanumericInput(artistname)){
        return true;
      }
      else{
      artistname.style.borderColor = "red";
      alert("Input must be only consist of letters or numbers");
      return false;
      }
    }

  </script>
</head>

<body>
  <h1>Edit Artist</h1>

  <header>
    <nav>
        <ul id="nav">
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="artists.php">Artists</a></li>
        <li><a href="albums.php">Albums</a></li>
        <li><a href="tracks.php">Tracks</a></li>
      </ul>
    </nav>
  </header>

<?php

  if(isset($_POST['save'])){
    $sql = "UPDATE Artist set artName = '".$_POST['eartist']."' WHERE artID = '".$_POST['textid']."'";
    if(mysqli_query($conn, $sql)){
      header("Location: artists.php");
    }
    else{
      echo "Error: Could Not Update";
    }
  }

  $id = '';
  $artname = '';

  if(isset($_GET['id'])){
    $sql = "SELECT artID, artName from Artist WHERE artID=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      $artname = $row['artName'];
      $id = $row['artID'];

    }

  }

?>


  <form action="editArtist.php" method="post" onsubmit="return formvalidationArtist()">
    <table>
      <tr>
        <td>Artist: </td>
    <td><input type="text" name="eartist" value="<?=$artname?>" id="edar" onblur="return alphanumericInput(edar)"
          required></td> <br/>
  </tr>
  <tr>
    <td></td>
    <input type="hidden" name="textid" value="<?=$id?>">
    <td><input type="submit" class="savebut" name="save" value="Save"></td>
  </tr>
    </table>
  </form>


  <a class="return" href="artists.php">Return to Artist Index</a>

  </body>
  </html>
