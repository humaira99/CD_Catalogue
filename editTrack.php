<?php require "connect.php"; ?>

<!doctype html>

<html>

<head>
  <title>Edit Track</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>
  <script>
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

  function timeInput(input){
    var expected = /^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/;
    if (input.value.match(expected)){
      input.style.borderColor = "";
      return true;
    }
    else {
      alert("Duration input must be 6 numbers long (hh:mm:ss)");
      input.style.borderColor = "red";
      return false;
    }
  }

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

  function formvalidationTracks(){
    var fvt = document.getElementById("tfv");
    var fvcd  = document.getElementById("cdal");
    var fvdur = document.getElementById("durfv");

    if(fvt.value == ''){
        fvt.style.borderColor = "red";
        return false;
    }

    if(fvcd.value == ''){
        fvcd.style.borderColor = "red";
        return false;
    }

    if(fvdur.value == ''){
        fvdur.style.borderColor = "red";
        return false;
    }

  }

  </script>
</head>

<body>
  <h1>Edit Track</h1>

  <header>
    <nav>
        <ul id="nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="artists.php">Artists</a></li>
        <li><a href="albums.php">Albums</a></li>
        <li><a class="active" href="tracks.php">Tracks</a></li>
      </ul>
    </nav>
  </header>

  <?php

  $artname = '';
  $id = '';
  $cdid = '';
  $artid = '';
  $cdtitle = '';
  $title = '';
  $duration = '';

    if(isset($_POST['save'])){

      if(isset($_POST['albumsel'])){
         $cdid = $_POST['albumsel'];
      }

      $sql2 = "SELECT artID from CD WHERE cdID = $cdid";
      $result2 = mysqli_query($conn, $sql2);

      if(mysqli_num_rows($result2) > 0){
        $row2 = mysqli_fetch_assoc($result2);
        $artid = $row2['artID'];
      }
      else{
        echo "Could Not Update";
      }

      $sql1 = "UPDATE Tracks set cdID = $cdid, artID = $artid,
              trTitle = '".$_POST['ttitle']."', trDuration = '".$_POST['duration']."'
              WHERE trID = '".$_POST['textid']."'";
      if(mysqli_query($conn, $sql1)){
        header("Location: tracks.php");
      }
      else{
        echo "Error: Could Not Update";
      }
    }

    if(isset($_GET['id'])){
      $sql = "SELECT trID, tracks.cdID, tracks.artID, trTitle, cdTitle, trDuration from tracks, CD, Artist
      WHERE (tracks.artID = artist.artID) AND (tracks.cdID = cd.cdID) AND trID=".$_GET['id'];
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $id = $row['trID'];
        $cdid = $row['cdID'];
        $artid = $row['artID'];
        $cdtitle = $row['cdTitle'];
        $title = $row['trTitle'];
        $duration = $row['trDuration'];
      }
    }

  ?>

  <form action="editTrack.php" method="post" onblur="return formvalidationTracks()">
    <table>
    <tr><td>Title: </td><td><input type="text" name="ttitle" id="tfv" onblur="return alphanumericInput(tfv)"
                value="<?=$title?>" required></td></tr>
      <tr><td>Album: </td><td><select id="cdal" name="albumsel">
        <option value="" selected="selected" selected disabled hidden><?php echo $cdtitle; ?></option>
        <?php
        $sql3 = "SELECT cdID, cdTitle FROM CD";
        $result3 = mysqli_query($conn, $sql3);

        while($row3 = mysqli_fetch_array($result3)){
  ?>
          <option value="<?=$row3['cdID']?>"><?php echo $row3['cdTitle']; ?></option>
  <?php
        }
        echo '</select>'

        ?>

      </td><br/>
    </tr>
      <tr><td>Duration: </td><td><input type="text" name="duration" id="durfv" onblur="return timeInput(durfv)"
        value="<?=$duration?>" required> (hh:mm:ss)</td><tr>
        <td></td>
        <input type="hidden" name="textid" value="<?=$id?>">
      <tr><td><input type="submit" class="savebut" name="save" value="Save"></td>
      </tr>
      </table>

  </form>

  <br/>
  <a class="return" href="tracks.php">Return to Tracks Index</a>

  </body>
  </html>
