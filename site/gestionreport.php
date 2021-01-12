<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Créer un utilisateur</title>
  <link rel="stylesheet" href="gestionusercss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: brown;
    color: white;
  }
  #p1:hover {background-color:red;}
  #p3:hover{background-color:green;}
  </style>
</head>
<body>
<ul>
  <li><a class="active" href="gestionreport.php">Nouveaux signalements</a></li>
  <li><a href="nouvannounce.php">Nouvelles annonces</a></li>
  <li><a href="column.php">Statiques</a></li>
  <li><a href="resp.php">Page d'accueil</a></li>
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
<body id='grad1'>
  <?php
  $db_username = 'root';
  $db_password = '';
  $db_name     = 'base';
  $db_host     = 'localhost';
  $db = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');
  $result = mysqli_query($db,"SELECT * FROM signalement WHERE  etat = 1 and visible=1");
  while($row = mysqli_fetch_array($result)){
    echo '<div class="card">';
    echo  "<h1> Titre: ". $row['title'] . "</h1>";
    echo  '<img src="'.$row['image'].'"style="width:100%" >';
    echo  '<p class="date">à: ' . $row['date1'] . '</p>';
    echo  "<h1>" . $row['description'] . "</h1>";
    echo  '<p class="adress">Lieu: ' . $row['adress'] . '</p>';
    echo  '<p class="username">par: '. $row['username'] . '</p>';
    echo '<select class="type" name="owner" form="' . $row['id']  . '" >';
    $result2 = mysqli_query($db,"SELECT * FROM type");
    while ($row2 = mysqli_fetch_array($result2)){
      if($row2['idtype']==$row['type']){
        echo '<option selected value="'.$row2['idtype'].'">'.$row2['nametype'].'</option>';
      }
      else{
        echo '<option  value="'.$row2['idtype'].'">'.$row2['nametype'].'</option>';
      }
    }
    echo '</select>';
    echo '<select class="priority" name="priority" form="' . $row['id']  . '" >';
    echo '<option class="option1" value="3">Trés elevé</option>';
    echo '<option class="option2" value="2">Elevé</option>';
    echo '<option class="option3" value="1">Normal</option>';
    echo '</select>';
    echo '<form action="gestionreport.php" method="post" id="' . $row['id']  . '">
    <input type="hidden"  value="' . $row['id']  . '" name="hid">
    <input class="buttsub" type="submit" value="Valider" name="accepter">
    </form>';
    echo '<form action="gestionreport.php" method="post">
    <input type="hidden"  value="' . $row['id']  . '" name="hiden">
    <input class="butt" type="submit" value="Rejeter" style="vertical-align:middle" name="supprimer">
    </form>';
    echo '<form action="gestionreport.php" onsubmit="return confirm(\'signaler utilisateur et rejeter signalement?\');" method="POST">
    <input type="hidden"  value="' . $row['username']  . '" name="usersign">
    <input type="hidden"  value="' . $row['id']  . '" name="deletean">
    <input class="signaled" type="submit" value="signal"  name="signaled">
    </form>';
    echo '</div>';
  }
  if(isset($_POST['accepter'])){
    $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
    $type=mysqli_real_escape_string($db,htmlspecialchars($_POST['owner']));
    $priority=mysqli_real_escape_string($db,htmlspecialchars($_POST['priority']));
    $requete = "UPDATE signalement SET visible=2,type=\"$type\",priority=\"$priority\" where id =\"$id\"";
    $exec_requete = mysqli_query($db,$requete);
    print("<script type=\"text/javascript\">location.href=\"gestionreport.php\"</script>");
  }
  if(isset($_POST['supprimer'])){
    $idi=mysqli_real_escape_string($db,htmlspecialchars($_POST['hiden']));
    $requete = "UPDATE signalement SET visible=0  where id =\"$idi\"";
    $exec_requete = mysqli_query($db,$requete);
    print("<script type=\"text/javascript\">location.href=\"gestionreport.php\"</script>");
  }
  if(isset($_POST['signaled'])){
    $username=mysqli_real_escape_string($db,htmlspecialchars($_POST['usersign']));
    $idi=mysqli_real_escape_string($db,htmlspecialchars($_POST['deletean']));
    $requete = "UPDATE user SET signaled=signaled+1  where username =\"$username\"";
    $requete2 = "UPDATE signalement SET visible=0  where id =\"$idi\"";
    $exec_requete = mysqli_query($db,$requete);
    $exec_requete2 = mysqli_query($db,$requete2);
    $mailto = mysqli_query($db,"SELECT * FROM user WHERE  username =\"$username\"");
    while($row = mysqli_fetch_array($mailto)){
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
      $mail ->Body = "You have been signaled";
      $mail ->AddAddress($row["email"]);
      $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      ));
      print("<script type=\"text/javascript\">location.href=\"gestionreport.php\"</script>");
    }
  }
  ?>
</div>
</body>
</html>
