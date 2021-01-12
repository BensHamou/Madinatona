<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Comptes désactivés</title>
  <link rel="stylesheet" href="gestionusercss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: Wheat;
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
  <li><a href="admin.php">Page d'accueil</a></li>
  <div class="dropdown">
    <li><a class="active">List (Désactivés)</a></li>
    <div class="dropdown-content">
      <a id="p1" href="signaledusers.php">Signalés</a>
      <a id="p3" href="activate.php">Désactivés </a>
    </div>
  </div>
  <li><a href="consultationuser.php">Désactiver un profile</a></li>
  <li><a href="manageaccadd.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>
<body id='grad1'>
  <?php
  $db_username = 'root';
  $db_password = '';
  $db_name     = 'base';
  $db_host     = 'localhost';
  $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
  or die('could not connect to database');
  $result = mysqli_query($db,"SELECT * FROM user WHERE visible=0");
  while($row = mysqli_fetch_array($result)){
    echo '<div class="card">';
    $type = $row['type'];
      if($type==-1){
      echo " <h1>Admin</h1>";}
      else if($type==-2){
        echo " <h1>Responsable</h1>";}
      else if($type==1){
        echo " <h1>Authorité: Eau</h1>";}
      else if($type==2){
        echo " <h1>Authorité: Voiri</h1>";}
        else if($type==3){
          echo " <h1>Authorité: Electricité</h1>";}
          else if($type==4){
            echo " <h1>Authorité: Gas</h1>";}
    echo  "<h1>Nom: " . $row['nom'] . "</h1>";
    echo  "<h1>Prenom: " . $row['prenom'] . "</h1>";
    echo  '<p class="adress">Numero de téléphone: ' . $row['phone'] . '</p>';
    echo  '<p class="adress">Email: ' . $row['email'] . '</p>';
    echo  '<p class="adress">Address: ' . $row['adress'] . '</p>';
    echo  '<p class="username">username : '. $row['username'] . '</p>';

    echo '<form action="test.php" method="post">
    <input type="hidden"  value="' . $row['id']  . '" name="hid">
    <input type="hidden"  value="' . $row['email']  . '" name="mail">
    <input class="buttsub" type="submit" value="Réactiver" name="activer">
    </form>';
    echo '</div>';
  }
  if(isset($_POST['activer'])){
    $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
    $requete = "UPDATE user set visible=1 where id = '".$id."'  ";
    $exec_requete = mysqli_query($db,$requete);
    print("<script type=\"text/javascript\">location.href=\"test.php\"</script>");
  }
  ?>
</body>
</html>
