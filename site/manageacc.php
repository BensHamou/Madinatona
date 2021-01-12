<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=0 ) header('Location: log.php');
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
    <li><a href="principale.php">Retourner </a></li>
    <li><a href="pass.php">Changer le mot de pass</a></li>
    <li><a href="email.php">Changer l'email</a></li>
    <li><a href="phone.php">Changer le numero de téléphone</a></li>
    <li><a href="address.php">Changer l'address</a></li>
    <li><a href="deleteacc.php">Désactiver le compte</a></li>
  </ul>
</body>
</html>
