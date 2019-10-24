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
          <li><a href="albums.php">Albums</a></li>
          <li><a class="active" href="tracks.php">Tracks</a></li>
        </ul>
      </nav>
    </header>

    <form action="tracksfromalbum.php" method="POST">
      <input type="text" name="search" class="searchbox" placeholder="Search">
      <input type="submit" class="submit">
    </form>

    <div>

      <table>
      <th> Track ID </th>
      <th> Artist </th>
      <th> CD </th>
      <th> Title </th>
      <th> Duration </th>
      <th></th>
      <th></th>

      <?php

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

      if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $search = preg_replace("#[^0-9a-z]i#","", $search);

        $query = mysqli_query($conn, "SELECT trID, trTitle, artName, cdTitle, trDuration FROM tracks, Artist, CD WHERE
          (tracks.artID = artist.artID) AND (tracks.cdID = cd.cdID) AND (artName LIKE '%$search%' OR cdTitle LIKE '%$search%'
          OR trTitle LIKE '%$search%' OR trDuration LIKE '%$search%')") or die ("Could not search");
        $count = mysqli_num_rows($query);

        if($count == 0){
          echo "There was no search results";
          ?><script> $('th').hide(); </script><?php
        }
        else{

          while ($row = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$row['trID']."</td>
              <td>".$row['artName']."</td>
              <td>".$row['cdTitle']."</td>
              <td>".$row['trTitle']."</td>
              <td>".$row['trDuration']."</td>";
    ?>
            <td> <button class='edit'><a href = "editTrack.php?id=<?=$row['trID']?>">Edit</a></button> </td>
            <td> <input type="button" name="delete" value="Delete" class="delete" onclick="deletetr(<?php echo $row['trID'];?>)"> </td>
    <?php
            echo "</tr>";
          }
        }
      }
      else{
      $sql = "SELECT trID, trTitle, artName, cdTitle, trDuration FROM tracks, Artist, CD WHERE (tracks.artID = artist.artID)
              AND (tracks.cdID = cd.cdID) AND cd.cdID = $id";
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);

      if($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)){
          echo "<tr>";
          echo  "<td>".$row['trID']."</td>
            <td>".$row['artName']."</td>
            <td>".$row['cdTitle']."</td>
            <td>".$row['trTitle']."</td>
            <td>".$row['trDuration']."</td>";
    ?>
          <td> <button class='edit'><a href = "editTrack.php?id=<?=$row['trID']?>">Edit</a></button> </td>
          <td> <input type="button" name="delete" value="Delete" class="delete" onclick="deletetr(<?php echo $row['trID'];?>)"> </td>
    <?php
          echo "</tr>";
        }
      }
        else{
          ?><script> $('th').hide(); </script><?php
          echo "No results";
      }
    }

           ?>
           <script type="text/javascript">

             function deletetr(delid){
               if(confirm("Are you sure you want to delete this track?")){
                 window.location.href='deleteTrack.php?id=' +delid+ '';
                 return true;
               }
             }

           </script>

         </table>
       </div>

       <div>
         <button class="addbut"><a href = 'addTrack.php'>Add New Track</a></button>
       </div>

      </body>

    <hr>

    <a class="return" href="albums.php">Return to Albums Index</a>

    <hr>

    <footer>psyha5 DBI CW2</footer>

    </html>
