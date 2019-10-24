<?php
ob_start();
require "connect.php"; ?>

<!doctype html>

<html>

<head>
  <title>Add New Album</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>
  <script>
  function dropdown(input){
    if (input.value == "----Select----"){
      input.style.borderColor = "red";
      alert("Please Select a field from the drop down list");
      return false;
    }
    else {
      input.style.borderColor = "";
      return true;
    }
  }

  function alphanumericInput(input){
    var expected = /^[0-9 a-zA-Z]+$/;
    if (input.value.match(expected)){
      input.style.borderColor = "";
      return true;
    }
    else {
      alert("Input must be only consist of letters or numbers");
      input.style.borderColor = "red";
      return false;
    }
  }

  function alphaInput(input){
    var expected = /^[A-Z a-z]+$/;
    if (input.value.match(expected)){
      input.style.borderColor = "";
      return true;
    }
    else {
      alert("Input must be alphabetical");
      input.style.borderColor = "red";
      return false;
    }
  }

  function priceInput(input){
    var expected = /^[0-9]\d*(?:\.\d{0,2})?$/;
    if (input.value.match(expected)){
      input.style.borderColor = "";
      return true;
    }
    else {
      alert("Price input must be numeric (e.g. 9.99)");
      input.style.borderColor = "red";
      return false;
    }
  }

  function numericInput(input){
    var expected = /^[0-9]+$/;
    if (input.value.match(expected)){
      input.style.borderColor = "";
      return true;
    }
    else {
      alert("Input must be numeric");
      input.style.borderColor = "red";
      return false;
    }
  }

  function formvalidationAlbum(){

    var fvart = document.getElementById("artf");
    var fvcdt  = document.getElementById("cdt");
    var fvgen = document.getElementById("pri");
    var fvpri = document.getElementById("gene");
    var fvnt = document.getElementById("nt");

    if(fvart.value == ''){
        fvart.style.borderColor = "red";
        return false;
    }

    if(fvcdt.value == ''){
        fvcdt.style.borderColor = "red";
        return false;
    }

    if(fvgen.value == ''){
        fvgen.style.borderColor = "red";
        return false;
    }

    if(fvpri.value == ''){
        fvpri.style.borderColor = "red";
        return false;
    }

    if(fvnt.value == ''){
        fvnt.style.borderColor = "red";
        return false;
    }

      if(dropdown(fvart)){
        if(alphanumericInput(fvcdt)){
          if(alphaInput(fvgen)){
              if(priceInput(fvpri)){
                if(numericInput(fvnt)){
                  return true;
                }
                else return false;
              }
              else return false;
            }
            else return false;
          }
          else return false;
        }
        else return false;

  }

  </script>
</head>

<body>
  <h1>Add New Album</h1>

  <header>
    <nav>
        <ul id="nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="artists.php">Artists</a></li>
        <li><a class="active" href="albums.php">Albums</a></li>
        <li><a href="tracks.php">Tracks</a></li>
      </ul>
    </nav>
  </header>

  <form action="addAlbum.php" method="post" onsubmit="return formvalidationAlbum()">

<table class="add">

  <tr><td>Artist: </td>
      <td><select name="cartist" id="artf" onblur="return dropdown(artf)">
      <option value="" selected disabled hidden>----Select----</option>
<?php
      $sql = "SELECT artID, artName FROM Artist order by artName" or die ("Could not Add");
      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_array($result)){
?>
      <option value="<?=$row['artID']?>"><?php echo $row['artName']; ?></option>
<?php
      }
        echo '</select>'
?>
    </td></tr>
    <tr><td>Title: </td><td><input type="text" name="ctitle" id="cdt" onblur="return alphanumericInput(cdt)" required></td></tr>
    <tr><td>Genre: </td><td><input type="text" name="genre" id="gen" onblur="return alphaInput(gen)" required></td>
    <tr><td>Price: </td><td><input type="text" name="price" id="pri" onblur="return priceInput(pri)" required></td>
    <tr><td>Number of Tracks: </td><td><input type="number" id="nt" name="numTracks" onblur="return numericInput(nt)" required></td>
      <td></td>
    <tr><td><input type="submit" class="savebut" name="save" value="Save"></td>
    </tr>
  </table>

  </form>

<?php

  $artid = '';
  if (isset($_POST['save'])) {
    $artid = $_POST['cartist'];
    $sql = "INSERT INTO CD(artID, cdTitle, cdPrice, cdGenre, cdNumTracks) VALUES ($artid,?,?,?,?)";

    if($_POST['ctitle'] == '' || $_POST['price'] == ''|| $_POST['genre'] == ''|| $_POST['numTracks'] == ''){
      echo "ERROR: Please fill in missing values";
    }
    else {

      $stmt = $conn->prepare($sql);

      $stmt->bind_param("sssi", $_POST['ctitle'], $_POST['price'], $_POST['genre'], $_POST['numTracks']);
      $stmt->execute();

        header("Location: albums.php");
      }
    }
 ?>
 <br/>

 <a  class="return" href="albums.php">Return to Album Index</a>

  </body>

  <footer>psyha5 DBI CW2</footer>

  </html>
