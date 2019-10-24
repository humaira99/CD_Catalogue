<?php
ob_start();
require "connect.php"; ?>

<!doctype html>

<html>

<head>
  <title>Edit Album</title>
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

    var fvarte = document.getElementById("edart");
    var fvcdte  = document.getElementById("altitle");
    var fvgene = document.getElementById("alpr");
    var fvprie = document.getElementById("algenr");
    var fvnte = document.getElementById("alnt");

    if(fvarte.value == ''){
        fvarte.style.borderColor = "red";
        return false;
    }

    if(fvcdte.value == ''){
        fvcdte.style.borderColor = "red";
        return false;
    }

    if(fvgene.value == ''){
        fvgene.style.borderColor = "red";
        return false;
    }

    if(fvprie.value == ''){
        fvprie.style.borderColor = "red";
        return false;
    }

    if(fvnte.value == ''){
        fvnte.style.borderColor = "red";
        return false;
    }

      }

  </script>
</head>

<body>
  <h1>Edit Album</h1>

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

  <?php

  $artid = '';
  $id = '';
  $artname = '';
  $title = '';
  $genre = '';
  $price = '';
  $numtracks = '';

    if(isset($_POST['save'])){

      if(isset($_POST['eartist'])){
         $artid = $_POST['eartist'];
      }

      $sql = "UPDATE CD set artID = $artid, cdTitle = '".$_POST['ctitle']."',
              cdGenre = '".$_POST['genre']."', cdPrice = '".$_POST['price']."', cdNumTracks = '".$_POST['numTracks']."'
              WHERE cdID = '".$_POST['textid']."'";
      if(mysqli_query($conn, $sql)){
        header("Location: albums.php");
      }
      else{
        echo "Error: Could Not Update";
      }
    }

    if(isset($_GET['id'])){
      $sql = "SELECT * from CD, Artist WHERE (cd.artID = artist.artID) AND cdID=".$_GET['id'];
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $artid = $row['artID'];
        $id = $row['cdID'];
        $artname = $row['artName'];
        $title = $row['cdTitle'];
        $genre = $row['cdGenre'];
        $price = $row['cdPrice'];
        $numtracks = $row['cdNumTracks'];
      }
    }

  ?>

  <form id="form" action="editAlbum.php" method="post" onsubmit="return formvalidationAlbum()">

    <table>
  <tr>
      <td>Artist: </td>
      <td><select id="edart" name="eartist" onblur="return dropdown(edart)">
      <option selected="selected" value="" selected disabled hidden><?php echo $artname; ?></option>
      <?php
      $sql = "SELECT artID, artName FROM Artist order by artName" or die ("Could not Add");
      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_array($result)){
?>

      <option value=<?=$row['artID']?>><?php echo $row['artName']; ?></option>
<?php
      }
      echo '</select>';

      ?>

    </td>

    <tr><td>Title: </td><td><input type="text" name="ctitle" value="<?=$title?>" id="altitle"
                              onblur="return alphanumericInput(altitle)" required></td></tr>
    <tr><td>Genre: </td><td><input type="text" name="genre" value="<?=$genre?>" id="algenr"
                              onblur="return alphaInput(algenr)" required></td>
    <tr><td>Price: </td><td><input type="text" name="price" value="<?=$price?>" id="alpr"
                              onblur="return priceInput(alpr)" required></td>
    <tr><td>Number of Tracks: </td><td><input type="text" name="numTracks" value="<?=$numtracks?>" id="alnt"
                              onblur="return numericInput(alnt)" required></td><br/>
      <td></td>
      <input type="hidden" name="textid" value="<?=$id?>">
    <tr><td><input type="submit" class="savebut" name="save" value="Save"></td>
    </tr>
  </table>

    <a class="return" href="albums.php">Return to Albums Index</a>

  </form>
