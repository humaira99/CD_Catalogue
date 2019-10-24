<?php require "connect.php"; ?>

<!doctype html>

<html>

<head>
  <title>Add New Artist</title>
  <link rel="stylesheet" type="text/css" href="main.css"/>
  <script>
  function alphanumericInput(input){
    var expected = /^[0-9 a-zA-Z]+$/;
    if (input.value.match(expected)){
      input.style.borderColor = "";
      return true;
    }
    else {
      return false;
    }
  }

  function formvalidationArtist(){
    var artistname = document.getElementById("artistinput");

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
  <h1>Add New Artist</h1>

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

  <form action="addArtist.php" method="post">
    <table>
      <tr>
        <td>Artist: </td>
    <td><input type="text" name="aartist" id="artistinput" onblur="return formvalidationArtist()" required></td> <br/>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" class="savebut" name="save" value="Save"></td>
  </tr>
    </table>
  </form>

<?php

  if (isset($_POST['save'])) {

    $sql = "INSERT INTO Artist(artName) VALUES (?)" or die ("Could not Add");

      $stmt = $conn->prepare($sql);

      $stmt->bind_param("s", $_POST['aartist']);
      $stmt->execute();

        header("Location: artists.php");
      }


 ?>

<a class="return" href="artists.php">Return to Artist Index</a>

</body>

<footer>psyha5 DBI CW2</footer>

</html>
