<?php require "connect.php"; ?>

<!doctype html>

<html>

  <head>
    <title>Albums</title>
    <link rel="stylesheet" type="text/css"
      href="main.css"/>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  </head>

  <body>
    <h1>Catalogue of Cds</h1>

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


<form action="albums.php" method="POST">
  <input type="text" name="search" class="searchbox" placeholder="Search">
  <input type="submit" class="submit">
</form>

<div>

  <table>

  <th> CD ID </th>
  <th> Artist </th>
  <th> Title </th>
  <th> Genre </th>
  <th> Price </th>
  <th> Number of Tracks </th>
  <th> Tracks </th>
  <th></th>
  <th></th>

<?php

  if(isset($_GET['id'])){
    $sql = "SELECT * from CD, Artist WHERE (cd.artID = artist.artID) AND cd.artID=".$_GET['id'];
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

  if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $search = preg_replace("#[^0-9a-z]i#","", $search);

    $query = mysqli_query($conn, "SELECT * from CD, Artist WHERE (cd.artID = artist.artID) AND (artName LIKE '%$search%' OR
      cdGenre LIKE '%$search%' OR cdTitle LIKE '%$search%' OR cdPrice LIKE '%$search%' OR cdNumTracks LIKE '%$search%')")
      or die ("Could not search");
    $count = mysqli_num_rows($query);

    if($count == 0){

      echo "There was no search results";
      ?><script> $("th").hide(); </script><?php

    }
    else{

      while ($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>".$row['cdID']."</td>
          <td>".$row['artName']."</td>
          <td>".$row['cdTitle']."</td>
          <td>".$row['cdGenre']."</td>
          <td>".$row['cdPrice']."</td>";

            echo "<td>".$row['cdNumTracks']."</td>";
        }

  ?>
  <td> <a class=linktbl href="tracksbyartist?id=<?=$row['cdID']?>.php"> Tracks </a></td>
  <td> <button class='edit'><a href="editAlbum.php?id=<?=$row['cdID']?>">Edit</a></button> </td>
  <td> <input type="button" class="delete" name="delete" value="Delete" onclick="deletecd(<?php echo $row['cdID'];?>)"> </td>

<?php
        echo "</tr>";
      }
    }

  else{

  $sql = "SELECT * from CD, Artist WHERE (cd.artID = artist.artID) AND (cd.artID = '".$_GET['id']."')";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($result);

  if($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)){
      echo "<tr>";
      echo "<td>".$row['cdID']."</td>
        <td>".$row['artName']."</td>
        <td>".$row['cdTitle']."</td>
        <td>".$row['cdGenre']."</td>
        <td>".$row['cdPrice']."</td>";
      echo "<td>".$row['cdNumTracks']."</td>";
?>
      <td> <a class=linktbl href="tracksfromalbum.php?id=<?=$row['cdID']?>"> Tracks </a></td>
      <td> <button class='edit'><a href = "editAlbum.php?id=<?=$row['cdID']?>">Edit</a></button> </td>
      <td> <input type="button" name="delete" value="Delete" class="delete" onclick="deletecd(<?php echo $row['cdID'];?>)"> </td>
<?php
      echo "</tr>";
    }
  }
    else{
      echo "No results";
  }
}

       ?>
       <script type="text/javascript">

         function deletecd(delid){
           if(confirm("Are you sure you want to delete this album?")){
             window.location.href='deleteAlbum.php?id=' +delid+ '';
             return true;
           }
         }

       </script>

  </table>
</div>

<div>
  <button class="addbut"><a href = 'addAlbum.php'>Add New Album</a></button>

  </body>
  
<hr>

<a class="return" href="artists.php">Return to Artist Index</a>

<hr>
<footer>psyha5 DBI CW2</footer>

</html>
