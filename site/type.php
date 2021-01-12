<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Gestion catégorie</title>
  <link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: brown;
    color: white;
  }
  input[type=text]{
    width: 60%;
    padding: 11px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    margin-bottom: 8px;
  }
  #p1:hover {background-color:yellow;}
  #p3:hover{background-color:red;}
  </style>
</head>
<ul>
  <li><a href="demandedajout.php">Demandes d'inscription</a></li>
  <li><a href="gestionuser.php">Creer un utilisateur</a></li>
  <li><a class="active" href="type.php">Gestion catégorie</a></li>
  <li><a href="admin.php">Page d'accueil</a></li>
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
<body id='grad1'>
  <?php
  $db_username = 'root';
  $db_password = '';
  $db_name     = 'base';
  $db_host     = 'localhost';
  $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
  or die('could not connect to database');
  $result = mysqli_query($db,"SELECT * FROM type");
  while($row = mysqli_fetch_array($result)){
    echo '<div class="card">';
    echo  "<h1>Nom d'athorité: " . $row['nametype'] . "</h1>";
    $type = $row['idtype'];
    $result2 = mysqli_query($db,"SELECT count(*) FROM user where type =  '".$type."'");
      while($row2 = mysqli_fetch_array($result2)){
    echo  '<p class="adress">Il ya : ' . $row2['count(*)'] . ' comptes associés a cet athorité</p>';
  }
  if(isset($_POST['edit'])){
    $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
    echo '<form action="type.php" method="post">';
    if($type==$id){
      echo '<input type="text" placeholder="Nouveau nom" name="newname" required >';
      echo '<input type="hidden"  value="' . $row['idtype']  . '" name="hid">
      <input class="buttsub" type="submit" value="Modifier le nom" name="editde">';
      echo '</form>';
      echo '<form action="type.php" method="post">
      <input class="butt" type="submit" value="Annuler" name="cancel">
      </form>';
    }
    }
  else{
  echo '<form action="type.php" method="post">
  <input type="hidden"  value="' . $row['idtype']  . '" name="hid">
  <input class="buttsub" type="submit" value="Modifier le nom" name="edit">
  </form>';
  }
  echo '</div>';
  }
  if(isset($_POST['editde'])){
    $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
    $nom=mysqli_real_escape_string($db,htmlspecialchars($_POST['newname']));
    $requete = "UPDATE type set nametype= '".$nom."' where idtype = '".$id."'  ";
    $exec_requete = mysqli_query($db,$requete);
    print("<script type=\"text/javascript\">location.href=\"type.php\"</script>");
  }
  if(isset($_POST['add'])){
    $nom=mysqli_real_escape_string($db,htmlspecialchars($_POST['name']));
    $requete = "INSERT INTO type (nametype) values('".$nom."')";
    $exec_requete = mysqli_query($db,$requete);
    print("<script type=\"text/javascript\">location.href=\"type.php\"</script>");
  }
  ?>
  <form  action="type.php" method="POST" class="form-container">
    <button class="open-button" onclick="openForm()">Ajouter un type</button>
    <div class="form-popup" id="type">
      <label><b>Nom :</b></label>
      <input type="text" placeholder="Nouveau nom" name="name" required >
      <button type="submit" class="btn" name="add">Ajouter</button>
      <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
  </div>
      </form>
      <script>
      function openForm() {
        document.getElementById("type").style.display = "block";
      }
      function closeForm() {
        document.getElementById("type").style.display = "none";
      }
    </script>
</body>
</html>
