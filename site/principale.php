<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=0 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
    <title>MadinaTech - Page d'accueil</title>
    <link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: blue;
    color: white;
  }
  #p1:hover {background-color:red;}
  #p2:hover{background-color:orange;}
  #p3:hover{background-color:green;}
  </style>
</head>
<ul>
  <li><a href="wreport.php">Ecrire un signalement</a></li>
  <li><a href="viewacc.php">Consulter actualités</a></li>
  <li><a href="newmap.php">Ouvrir la map</a></li>
  <li><a class="active" href="principale.php">Page d'accueil</a></li>
  <li><a href="statuser.php">Statiques personnel</a></li>
  <div class="dropdown">
  <li><a href="myrep.php">Mes signalements</a></li>
    <div class="dropdown-content">
      <a id="p1" href="odeclared.php">Déclaré</a>
      <a id="p2" href="oonprogress.php">En cours</a>
      <a id="p3" href="ofinished.php">Cloturé</a>
    </div>
  </div>
  <li><a href="manageacc.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>
<div id="content" style="margin-left: 5%;padding:1px 16px;height:1000px;">
    <?php
    if($_SESSION['username'] !== ""){
      $db_username = 'root';
      $db_password = '';
      $db_name     = 'base';
      $db_host     = 'localhost';
      $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
      or die('could not connect to database');
      $date = date('Y-m-d');
      $result = mysqli_query($db,"SELECT * FROM announce where visible=1 and '".$date."'< dateF");
      while($row = mysqli_fetch_array($result)){
        echo '<div class="card" >';
        echo "<h1> TITLE :". $row['title'] . "</h1>";
        echo '<img src="'.$row['image'].'" alt  = "No photo for this announce." style="width:100%">';
        echo '<p class="date">posted :' . $row['date'] . '</p>';
        echo '<p class="date">starts :' . $row['dateD'] . '</p>';
        echo '<p class="date">ends :' . $row['dateF'] . '</p>';
        echo "<h1>" . $row['body'] . "</h1>";
        echo '</div>';
      }
    }
    ?>
  </div>
</body>
</html>
