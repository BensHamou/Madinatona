<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<html>
<head>
  <title>MadinaTech - Annonces rejetées</title>
  <link rel="stylesheet" href="gestionusercss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  .dropdown {
    width: 100%;
    display: block;
  }

  .dropdown .dropbtn {
    color: #000;
    border: none;
    padding: 8px 16px;
    background-color: inherit;
    font-family: inherit;
  }

  .navbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }

  .dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }

  .dropdown-content a:hover {
    background-color: blue;
  }
  li a.active {
    background-color: LightSalmon;
    color: white;
  }
  .dropdown:hover .dropdown-content {
    display: block;
    width: 15%;
  }
  #p1:hover {background-color:green;}
  #p2:hover {background-color:red;}
  </style>
</head>
<body>
  <ul>
    <li><a href="announce.php">Ecrire une annonce</a></li>
    <div class="dropdown">
      <li><a class="active" >Annonces rejetées  </a></li>
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
    $result = mysqli_query($db,"SELECT * FROM announce where announce.visible = -2");
    while($row = mysqli_fetch_array($result)){
      echo '<div class="card" >';
      $type = $row['authority'];
      $result2 = mysqli_query($db,"SELECT nametype FROM type where idtype = '".$type."'");
          while($row2 = mysqli_fetch_array($result2)){
            echo  "<h1> Authorité responsable à: ". $row2['nametype'] . "</h1>";
          }
      echo "<h1> Titre: ". $row['title'] . "</h1>";
      echo '<img src="'.$row['image'].'" alt  = "No photo for this announce." style="width:100%">';
      echo '<p class="date">Publié le :' . $row['date'] . '</p>';
      echo '<p class="date">Début :' . $row['dateD'] . '</p>';
      echo '<p class="date">Fin :' . $row['dateF'] . '</p>';
      echo "<h1>" . $row['body'] . "</h1>";
      echo '<form action="compann.php" method="post" id="' . $row['id']  . '">
    <input type="hidden"  value="' . $row['id']  . '" name="hid">
    <input class="buttsub" type="submit" value="Modifier" name="edit">
    </form>';
    echo '<form action="annrej.php" method="post">
    <input type="hidden"  value="' . $row['id']  . '" name="hiden">
    <input class="butt" type="submit" value="Supprimer" style="vertical-align:middle" name="supprimer">
    </form>';
      echo '</form>';
      echo '</div>';
    }
      if(isset($_POST['supprimer'])){
        $idi=mysqli_real_escape_string($db,htmlspecialchars($_POST['hiden']));
        $requete = "UPDATE announce SET visible= 0 where id =\"$idi\"";
        $exec_requete = mysqli_query($db,$requete);
        print("<script type=\"text/javascript\">location.href=\"annrej.php\"</script>");
      }
    ?>
</div>

</body>

</html>
