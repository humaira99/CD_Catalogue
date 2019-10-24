<?php require "connect.php"; ?>

<!doctype html>

<html>

  <head>
    <title>Artists</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  </head>

  <body>
    <h1>Catalogue of Cds</h1>

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

  <form action="artists.php" method="POST">
    <input type="text" name="search" class="searchbox" placeholder="Search">
    <input type="submit" class="submit">
  </form>

  <div>

    <table>

    <th> Artist ID </th>
    <th> Artist Name </th>
    <th> Albums </th>
    <th></th>
    <th></th>

    <?php

    if(isset($_POST['search'])) {
      $search = $_POST['search'];
      $search = preg_replace("#[^0-9a-z]i#","", $search);

      $query = mysqli_query($conn, "SELECT * FROM Artist WHERE artName LIKE '%$search%'") or die ("Could not search");
      $count = mysqli_num_rows($query);

      if($count == 0){
        ?><script> $('th').hide(); </script><?php
        echo "There was no search results";
      }
      else{

        while ($row = mysqli_fetch_array($query)) {
          echo "<tr>";
          echo "<td>".$row['artID']."</td>
            <td>".$row['artName']."</td>";
?>
          <td> <a class=linktbl href="albumsfromartist.php?id=<?=$row['artID']?>">Albums</a> </td>
          <td> <button class='edit' name='edit'><a href = "editArtist.php?id=<?=$row['artID']?>">Edit</a></button> </td>
          <td> <input type="button" name="delete" class="delete" value="Delete" onclick="deleteart(<?php echo $row['artID'];?>)"> </td>
          </tr>
<?php  }
      }
    }
    else{
    $sql = "SELECT * from Artist";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);

    if($queryResults > 0) {
      while ($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['artID']."</td>
          <td>".$row['artName']."</td>";
?>
        <td> <a class=linktbl href="albumsfromartist.php?id=<?=$row['artID']?>">Albums</a> </td>
        <td> <button class='edit'><a href = "editArtist.php?id=<?=$row['artID']?>">Edit</a></button> </td>
        <td> <input type="button" class="delete" name="delete" value="Delete" onclick="deleteart(<?php echo $row['artID'];?>)"> </td>
        </tr>
<?php
      }
    }
      else{
        echo "No results";
    }
  }
         ?>


    <script type="text/javascript">

      function deleteart(delid){
        if(confirm("Are you sure you want to delete this artist?")){
          window.location.href='deleteArtist.php?id=' +delid+ '';
          return true;
        }
      }

    </script>

    </table>

    <button class="addbut"><a href = 'addArtist.php'>Add New Artist</a></button>

  </body>

<hr>
<footer>psyha5 DBI CW2</footer>

</html>
