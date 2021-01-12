<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>MadinaTech - Signalement Attachés</title>
    <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
    <style>
    .card button {
      border: none;
      outline: 0;
      margin: 5px;
      padding: 12px;
      color: white;
      background-color : red;
      text-align: center;
      cursor: pointer;
      font-size: 18px;
    }
    </style>
</head>
<body id='grad1'>
  <ul>
    <li><a href="declared.php">Retourner</a></li>
  </ul>
    <?php
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'base';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    if(isset($_POST['list'])){
      $id = $_POST['id'];
      $result = mysqli_query($db,"SELECT * FROM signalement WHERE attached = '".$id."' ");
      while($row = mysqli_fetch_array($result)){
        echo '<div class="card" >';
        echo  "<h1> Titre: ". $row['title'] . "</h1>";
        echo  '<img src="'.$row['image'].'" alt  = "No photo for this report." style="width:100%">';
        echo  '<p class="date">à: ' . $row['date1'] . '</p>';
        echo  "<h1>" . $row['description'] . "</h1>";
        echo  '<p class="adress">Lieu: ' . $row['adress'] . '</p>';
        echo  '<p class="username">par: '. $row['username'] . '</p>';
          if($row['id'] != $id ){
            echo '<form  action="attach.php" method="POST">';
            echo '<input type="hidden"  value="' . $row['id']  . '" name="id">';
            echo '<input type="hidden"  value="'.$id.'" name="idfrom">';
            echo  '<button type="submit" name="desattach" class="button">Détacher</button>';
            echo '</form>';
          }
          echo '</div>';
        }
    }
    if(isset($_POST['attach'])){
      $id = $_POST['id'];
      $x =  $_POST['x'];
      $y =  $_POST['y'];
      $type =  $_POST['type'];
      $result = mysqli_query($db,"SELECT * FROM signalement WHERE locx BETWEEN '".$x."' - 0.001 and '".$x."' + 0.001 AND locy BETWEEN '".$y."' - 0.001 and '".$y."' + 0.001
        AND etat = 1 AND type = '".$type."' AND id != '".$id."' ");
      while($row = mysqli_fetch_array($result)){
        echo '<div class="card" >';
        echo  "<h1> Titre: ". $row['title'] . "</h1>";
        echo  '<img src="'.$row['image'].'" alt  = "No photo for this report." style="width:100%">';
        echo  '<p class="date">à: ' . $row['date1'] . '</p>';
        echo  "<h1>" . $row['description'] . "</h1>";
        echo  '<p class="adress">Lieu: ' . $row['adress'] . '</p>';
        echo  '<p class="username">par: '. $row['username'] . '</p>';
        if(!empty( $row['rapport'])){
        echo  "<h1> Rapport: " . $row['rapport'] . "</h1>";
        }
        if(!empty( $row['imagerapport'])){
          echo  '<img src="'.$row['imagerapport'].'" alt  = "No rapport photo for this report." style="width:100%">';
        }
          if($row['etat'] == 1 ){
            echo '<form  action="attach.php" method="POST">';
            echo '<input type="hidden"  value="' . $row['id']  . '" name="idto">';
            echo '<input type="hidden"  value="'.$id.'" name="id">';
            echo  '<button type="submit" name="attachto" class="button">Attacher à</button>';
            echo '</form>';
          }
          echo '</div>';
        }
    }
    if(isset($_POST['attachto'])){
      $id = $_POST['id'];
      $idto = $_POST['idto'];
      $sql = "UPDATE signalement set attached = '".$idto."', visible = 0 where id = '".$id."'";
      $sql2 = "UPDATE signalement set priority = priority + 1 where id = '".$idto."'";
      //$sql = "INSERT INTO announce (body,image,authority) values('".$body."','".$filename."','".$type."')";
      $qry = mysqli_query($db, $sql);
      $qry2 = mysqli_query($db, $sql2);
      if($qry){
        $message = "Signalement attaché";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
      }
      else{
        $message = "Error.. please try again";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
      }
    }
    if(isset($_POST['desattach'])){
      $id = $_POST['id'];
      $idfrom = $_POST['idfrom'];
      $sql = "UPDATE signalement set attached = '".$id."', visible = 2 where id = '".$id."'";
      $sql2 = "UPDATE signalement set priority = priority - 1 where id = '".$idfrom."'";
      //$sql = "INSERT INTO announce (body,image,authority) values('".$body."','".$filename."','".$type."')";
      $qry = mysqli_query($db, $sql);
      $qry2 = mysqli_query($db, $sql2);
      if($qry){
        $message = "Signalement détacher";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
      }
      else{
        $message = "Error.. please try again";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
      }
    }
    ?>
</body>
</html>
