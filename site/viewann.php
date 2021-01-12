<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>MadinaTech - Consulter annonces</title>
    <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
    <style>
    li a.active {
      background-color: SpringGreen;
      color: white;
    }
    .card button {
      border: none;
      outline: 0;
      margin: 5px;
      padding: 12px;
      color: white;
      background-color : red;
      text-align: center;
      cursor: pointer;
      font-size: 18px;
    }
    #p1:hover {background-color:green;}
    #p2:hover {background-color:red;}
    </style>
  </head>
  <ul>
    <li><a href="announce.php">Ecrire une annonce</a></li>
    <div class="dropdown">
      <li><a class="active">Nouveaux annonces</a></li>
      <div class="dropdown-content">
        <a id="p1" href="viewann.php">Nouveaux </a>
        <a id="p2" href="annrej.php">Rejetées </a>
      </div>
    </div>
    <li><a href="statauth.php">Statiques</a></li>
    <li><a href="auth.php">Page d'accueil</a></li>
    <li><a href="declared.php">Consulter les nouveaux signalements</a></li>
    <li><a href="encours.php">Consulter les signalements en cours</a></li>
    <li><a href="finished.php">Consulter les signalements terminé</a></li>
    <li><a href="manageaccau.php">Paramètres de compte</a></li>
    <li><a href="log.php">Se déconnecter</a></li>
  </ul>
<body id='grad1'>
    <?php
    if($_SESSION['type'] !== ""){
      $type = $_SESSION['type'];
    }
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'base';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    $date = date('Y-m-d');
    $result = mysqli_query($db,"SELECT * FROM announce where visible=1 and announce.authority = '".$type."' and '".$date."'< dateF");
    while($row = mysqli_fetch_array($result)){
      echo '<div class="card" >';
      echo "<h1> Titre: ". $row['title'] . "</h1>";
      echo '<img src="'.$row['image'].'" alt  = "No photo for this announce." style="width:100%">';
      echo '<p class="date">Publié le :' . $row['date'] . '</p>';
      echo '<p class="date">Début :' . $row['dateD'] . '</p>';
      echo '<p class="date">Fin :' . $row['dateF'] . '</p>';
      echo "<h1>" . $row['body'] . "</h1>";
      echo '<form action="editann.php" method="POST">';
      echo '<button type="submit" name="edit"  value="'.$row['id'].'" class="button">Modifier</button>';
      echo '</form>';
      echo '<form action="editannonce.php" onsubmit="return confirm(\'Tu es sure tu veux supprimer cet annonce?\');" method="POST">';
      echo '<button type="submit" name="delete"  value="' . $row['id']  . '" class="button">Supprimer</button>';
      echo '</form>';
      echo '</div>';
    }
    ?>
</div>
</body>
</html>
