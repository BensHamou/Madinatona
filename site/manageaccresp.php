<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Paramètres</title>
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="announcecss.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: grey;
    color: white;
  }
</style>
</head>
<body>
  <ul>
    <li><a href="resp.php">Retourner </a></li>
    <li><a href="passresp.php">Changer le mot de pass</a></li>
    <li><a href="emailresp.php">Changer l'email</a></li>
    <li><a href="phoneresp.php">Changer le numero de téléphone</a></li>
    <li><a href="addressresp.php">Changer l'address</a></li>
  </ul>
</body>
</html>
