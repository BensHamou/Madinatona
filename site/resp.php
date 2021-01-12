<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<html>
<head>
  <title>MadinaTech - Page d'accueil</title>
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  li a.active {
    background-color: blue;
    color: white;
  }
  #p1:hover {background-color:red;}
  #p3:hover{background-color:green;}
  </style>
</head>
<body>
<ul>
  <li><a href="gestionreport.php">Nouveaux signalements</a></li>
  <li><a href="nouvannounce.php">Nouvelles annonces</a></li>
  <li><a href="column.php">Statiques</a></li>
  <li><a class="active" href="resp.php">Page d'accueil</a></li>
  <div class="dropdown">
    <li><a>Map</a></li>
    <div class="dropdown-content">
      <a id="p1" href="mapres1.php">Nouveaux</a>
      <a id="p3" href="mapres2.php">Validés </a>
    </div>
  </div>
  <li><a href="manageaccresp.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>
<div id="content2" style="margin-left:25%;padding:1px 16px;height:1000px;">
  <?php
  if($_SESSION['username'] !== ""){
    $user = $_SESSION['username'];
    echo "Bonjour $user, vous êtes résponsable";
  }
  ?>
</div>
</body>
</html>
