<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<html>
<head>
  <title>MadinaTech - Nouvelles annonces</title>
  <link rel="stylesheet" href="gestionusercss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  li a.active {
    background-color: Olive;
    color: white;
  }
  #p1:hover {background-color:red;}
  #p3:hover{background-color:green;}
  </style>
</head>
<body>
<ul>
  <li><a href="gestionreport.php">Nouveaux signalements</a></li>
  <li><a class="active" href="nouvannounce.php">Nouvelles annonces</a></li>
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
    $result = mysqli_query($db,"SELECT * FROM announce where announce.visible = -1 and '".$date."'< dateF");
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
      echo '<form action="nouvannounce.php" method="post" id="' . $row['id']  . '">
    <input type="hidden"  value="' . $row['id']  . '" name="hid">
    <input class="buttsub" type="submit" value="Valider" name="accepter">
    </form>';
    echo '<form action="nouvannounce.php" method="post">
    <input type="hidden"  value="' . $row['id']  . '" name="hiden">
    <input class="butt" type="submit" value="Rejeter" style="vertical-align:middle" name="supprimer">
    </form>';
      echo '</form>';
      echo '</div>';
    }


    if(isset($_POST['accepter'])){
        $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));

        $requete = "UPDATE announce SET visible=1 where id =\"$id\"";
        $exec_requete = mysqli_query($db,$requete);

        $mailto = mysqli_query($db,"SELECT * FROM user where type = 0");
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
          $mail ->Body = "There's a new annonce in the app, please log in to check it in order to stay informed";
          $mail ->AddAddress($row["email"]);
          $mail->SMTPOptions = array('ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
          ));
          print("<script type=\"text/javascript\">location.href=\"nouvannounce.php\"</script>");
        }
      }
      if(isset($_POST['supprimer'])){
        $idi=mysqli_real_escape_string($db,htmlspecialchars($_POST['hiden']));
        $requete = "UPDATE announce SET visible= -2 where id =\"$idi\"";
        $exec_requete = mysqli_query($db,$requete);
        print("<script type=\"text/javascript\">location.href=\"nouvannounce.php\"</script>");
      }
    ?>
</div>

</body>

</html>
