<?php
session_start();
if(empty($_SESSION['username']) || ($_SESSION['type']!=-1)) header('Location: log.php');
// connexion à la base de données
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
?>
<html lang="en">
<style>
  #grad1 {
    background: rgb(146,145,154);
    background: linear-gradient(90deg, rgba(146,145,154,1) 10%, rgba(0,212,255,1) 59%);
  }
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 600px;
  margin: auto;
  text-align: center;
  font-family: arial;
  background-color: #BFEADC;
  box-shadow: -3px 3px #A1FFDF;
}
.username {
  color: grey;
  font-size: 22px;
}
.date {
  color: black;
  font-size: 18px;
}
.adress {
  color: black;
  font-size: 18px;
}
.card button {
    display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.card button:hover {
  opacity: 0.7;
}
.card input[type=button], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
.butt{
width:250px;
height:45px;
border:none;
outline:none;

color:#fff;
font-size:12px;
text-shadow:0 1px rgba(0,0,0,0.4);
background-color:#FF0000;
font-weight:700;
box-shadow:-4px 4px 5px 0 #FF0000;

}
.butt:hover{
background-color:#FF6347;
cursor:pointer
}
.butt:active{
padding-top:2px;
box-shadow:none
}
.form{    background-color: rgb(16, 216, 252);
    padding: 10px;
    text-align: left;
    margin: auto;
    display: table;
}
</style>
<link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: brown;
    color: white;
  }
  .search{margin-left:650px;}
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
    <li><a class="active">List (Chercher)</a></li>
    <div class="dropdown-content">
      <a id="p1" href="signaledusers.php">Signalés</a>
      <a id="p3" href="activate.php">Désactivés </a>
    </div>
  </div>
  <li><a href="consultationuser.php">Désactiver un profile</a></li>
  <li><a href="manageaccadd.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>
<body>
  <form action="" method="post" class="form">
    Rechercher: <input type="text" name="username" /><br/>
    <input type="submit" class="butt" value="Rechercher" />
  </form>
  <?php
  if (!empty($_REQUEST['username'])) {
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username']));
    $sql = "SELECT * FROM user WHERE username LIKE '%".$username."%' and visible=1 and signaled<>0 order by signaled desc";
    $r_query =  mysqli_query($db,$sql);
    while ($row = mysqli_fetch_array($r_query)){
      echo '<div class="card">';
      echo  "<h1>Nom: " . $row['nom'] . "</h1>";
      echo  "<h1>Prenom: " . $row['prenom'] . "</h1>";
      echo  '<p class="adress">Numero de téléphone: ' . $row['phone'] . '</p>';
      echo  '<p class="adress">Email: ' . $row['email'] . '</p>';
      echo  '<p class="adress">Address: ' . $row['adress'] . '</p>';
      echo  '<p class="username">username : '. $row['username'] . '</p>';
      echo '<form action="search.php" method="post">
      <input type="hidden"  value="' . $row['id']  . '" name="hid">
      <input type="hidden"  value="' . $row['email']  . '" name="mail">
      <input class="butt" type="submit" value="Désactiver" name="supprimer">
      </form>';
      echo '</div>';
    }
  }
  if(isset($_POST['supprimer'])){
    $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
    $mailto=mysqli_real_escape_string($db,htmlspecialchars($_POST['mail']));
    $requete = "UPDATE user set visible=0 where id = '".$id."'  ";
    $exec_requete = mysqli_query($db,$requete);
    require_once(dirname(__FILE__) . "/PHPMailer-5.2.28/class.smtp.php");
    require_once(dirname(__FILE__) . "/PHPMailer-5.2.28/class.phpmailer.php");
    $mail = new PHPMailer(true);
    $mail ->IsSmtp();
    $mail ->SMTPDebug = 0;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = 'ssl';
    $mail ->Host = "smtp.gmail.com";
    $mail ->Port = 465; // or 587
    $mail ->IsHTML(true);
    $mail ->Username = "amadinatec@gmail.com";
    $mail ->Password = "admin123T";
    $mail ->SetFrom("amadinatec@gmail.com");
    $mail ->Subject  = "NOTICE";
    $mail ->Body = "SORRY YOUR ACCOUNT HAS BEEN DELETED";
    $mail ->AddAddress($mailto);
    $mail->SMTPOptions = array('ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    ));
  }
  ?>
</body>
</html>
