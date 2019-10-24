<?php require "connect.php"; ?>

<!doctype html>

<html>

  <head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
  </head>

  <body>
    <h1>Catalogue of Cds</h1>

<header>
  <nav>
      <ul id="nav">
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="artists.php">Artists</a></li>
      <li><a href="albums.php">Albums</a></li>
      <li><a href="tracks.php">Tracks</a></li>
    </ul>
  </nav>
</header>


<h3> Database Metrics: </h3>
  <ul id="metrics">
    <li>Number of Artists: <?php echo $artRows ?></li>
    <li>Number of CDs: <?php echo $cdRows ?></li>
    <li>Number of Tracks:  <?php echo $trRows ?></li>
  </ul>


  </body>

<hr>
<footer>psyha5 DBI CW2</footer>

</html>
