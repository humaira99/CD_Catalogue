<?php require "connect.php"; ?>

<!doctype html>

<html>

<head>
  <title>Add New Track</title>
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
    var fvtitle = document.getElementById("titlein");
    var fvalbum  = document.getElementById("albumin");
    var fvduration = document.getElementById("durationin");

    if(fvtitle.value == ''){
        fvtitle.style.borderColor = "red";
        return false;
    }

    if(fvalbum.value == ''){
        fvalbum.style.borderColor = "red";
        return false;
    }

    if(fvduration.value == ''){
        fvduration.style.borderColor = "red";
        return false;
    }

      if(alphanumericInput(fvtitle)){
        if(dropdown(fvalbum)){
          if(timeInput(fvduration)){
            return true;
          }
          else{
            return false;
        }
        }
        else{
            return false;
        }
      }
      else{
        return false;
      }

  }

  </script>

</head>

<body>
  <h1>Add New Track</h1>

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

  <form action="addTrack.php" method="post" onsubmit="return formvalidationTracks()">

<table class="add">

  <tr><td>Title: </td><td><input type="text" name="ttitle" id="titlein" required
                            onblur="return alphanumericInput(titlein)"></td></tr>
    <tr><td>Album: </td><td><select name="album" id="albumin" onblur="return dropdown(albumin)">
      <option value="" selected disabled hidden>----Select----</option>
      <?php
      $sql = "SELECT cdID, cdTitle FROM CD";
      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_array($result)){
?>
        <option value =<?php echo $row['cdID'];?>><?php echo $row['cdTitle']; ?></option>
<?php
      }
      echo '</select>'

      ?>

      <br/>
    <tr><td>Duration: </td><td><input type="text" name="duration" id="durationin" required
                                onblur="return timeInput(durationin)">(hh:mm:ss)</td></tr>
      <td></td>
    <tr><td><input type="submit" class="savebut" name="save" value="Save"></td>
    </tr>
    </table>

  </form>


<?php

  if (isset($_POST['save'])) {
    $cdid = $_POST['album'];

    $sql2 = "SELECT artID from CD WHERE cdID = $cdid";
    $result2 = mysqli_query($conn, $sql2);

    if(mysqli_num_rows($result2) > 0){
      $row2 = mysqli_fetch_assoc($result2);
      $artid = $row2['artID'];
    }

    $sql = "INSERT INTO Tracks (artID, cdID, trTitle, trDuration) VALUES ($artid, $cdid,?,?)" or die ("Could not Add");

    if($_POST['duration'] == '' || $_POST['ttitle'] == ''){
    echo "ERROR: Please fill in missing values";
    }
    else {

      $stmt = $conn->prepare($sql);

      $stmt->bind_param("ss", $_POST['ttitle'], $_POST['duration']);
      $stmt->execute();

        header("Location: tracks.php");
      }
      }

 ?>
<br/>
<a  class="return" href="tracks.php">Return to Tracks Index</a>

</body>

<footer>psyha5 DBI CW2</footer>

</html>
