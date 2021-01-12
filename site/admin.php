<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
?>
<html>
<head>
  <title>MadinaTech - Page d'accueil</title>
      <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />

<style>
li a.active {
  background-color: blue;
  color: white;
}
#p1:hover {background-color:yellow;}
#p3:hover{background-color:red;}
</style>
</head>
<ul>
<li><a href="demandedajout.php">Demandes d'inscription</a></li>
<li><a href="gestionuser.php">Creer un utilisateur</a></li>
<li><a href="type.php">Gestion catégorie</a></li>
<li><a class="active" href="admin.php">Page d'accueil</a></li>
<div class="dropdown">
  <li><a>List</a></li>
  <div class="dropdown-content">
    <a id="p1" href="signaledusers.php">Signalés</a>
    <a id="p3" href="activate.php">Désactivés </a>
  </div>
</div>
<li><a href="consultationuser.php">Désactiver un profile</a></li>
<li><a href="manageaccadd.php">Paramètres de compte</a></li>
<li><a href="log.php">Se déconnecter</a></li>
</ul>
<div id="content2" style="margin-left:25%;padding:1px 16px;height:1000px;">
  <?php
  if($_SESSION['username'] !== ""){
    $user = $_SESSION['username'];
    echo "Bonjour $user, vous êtes admin";
  }
  ?>
</div>
</body>
</html>
